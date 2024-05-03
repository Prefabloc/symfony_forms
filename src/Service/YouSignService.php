<?php

namespace App\Service;

use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YouSignService {

    private const PATHFILE = __DIR__ . '/../../public/PDFs/' ;

    public function __construct(
        private HttpClientInterface $youSignClient ,
    ) {
    }

    //1 Initier une signature
    public function signatureRequest() : array {

        $response = $this->youSignClient->request(
            'POST' ,
            'signature_requests',
            [
                'body' => <<<JSON
                          {
                            "name" : "Identification Prestation",
                            "delivery_mode" : "email" ,
                            "timezone" : "Europe/Paris"
                          }
                          JSON,
                'headers' => [
                    'Content-Type' => 'application/json' ,
                ] ,
            ]
        );

        $statusCode = $response->getStatusCode();

        if ( $statusCode != 201 ) {
            throw new \Exception('Error while creating signature request');
        }

        return $response->toArray();
    }

    //2 Uploader le document
    public function uploadDocument( string $signatureRequestId , string $filename ) : array {
        //On a récupéré dans les paramètres la signature request qu'on a défini juste en haut, ainsi que le nom du fichier pdf non signé qu'on a enregistré

        // On crée un tableau formfields qui a deux champs
        $formFields = [
            //nature pour lui dire que c'est un document signable
            'nature' => 'signable_document',
            //file pour lui passer le fichier et l'upload
            'file' => DataPart::fromPath(self::PATHFILE . $filename, $filename , 'application/json')
        ];

        //On passe le formfields qu'on vient de créer pour le mettre en multi part ( format demandé par Yousign )
        $formData = new FormDataPart($formFields);
        //On récupère les headers de la formData
        $headers = $formData->getPreparedHeaders()->toArray();

        //On fait une requête en POST, l'URL c'est celle qu'on a précedemment configurée
        $response = $this->youSignClient->request(
            'POST' ,
            sprintf('signature_requests/%s/documents' , $signatureRequestId ),
            [
                'headers' => $headers,
                'body' => $formData->bodyToIterable(),
            ]
        );

        $statusCode = $response->getStatusCode();

        if ( $statusCode != 201 ) {
            throw new \Exception('Error while uploading document');
        }

        return $response->toArray();
    }

    //3 Ajouter un signataire
    public function addSigner(
        string $signatureRequestId,
        string $documentId,
        string $email,
        string $prenom,
        string $nom,
    ) : array {

        $response = $this->youSignClient->request(
            'POST',
            sprintf('signature_requests/%s/signers' , $signatureRequestId ),
            [   //Infos du signataire, emplacement de la signature sur le document , niveau de signature
                'body' => <<<JSON
                        {
                            "info" : {
                                "first_name" : "$prenom",
                                "last_name" : "$nom",
                                "email" : "$email",
                                "locale" : "fr"
                            }, 
                            "fields" : [
                                {
                                    "type" : "signature",
                                    "document_id" : "$documentId", 
                                    "page" : 1,
                                    "x" : 77, 
                                    "y" : 581
                                }
                            ],
                            "signature_level" : "electronic_signature",
                            "signature_authentication_mode" : "no_otp"
                        }
                        JSON,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        $statusCode = $response->getStatusCode();

        if ( $statusCode != 201 ) {
            throw new \Exception('Error while adding signer');
        }

        return $response->toArray();
    }

    //4 Envoyer la demande de signature
    public function activateSignatureRequest( string $signatureRequestId ) : array {

        $response = $this->youSignClient->request(
            'POST',
            sprintf('signature_requests/%s/signers' , $signatureRequestId )
        );

        $statusCode = $response->getStatusCode();

        if ( $statusCode != 201 ) {
            throw new \Exception('Error while activating signature request');
        }

        return $response->toArray();
    }
}