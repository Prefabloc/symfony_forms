
class CameraClass
{

    constructor( boutonAfficherDivPhoto, boutonMasquerDivPhoto , divPhoto , divPhotoTablette , divModal , urlFetch ){
        this.boutonAfficherDivPhoto = boutonAfficherDivPhoto ;
        this.boutonMasquerDivPhoto = boutonMasquerDivPhoto;
        this.divPhoto = divPhoto ;
        this.divPhotoTablette = divPhotoTablette;
        this.divModal = divModal ;
        this.urlFetch = urlFetch ;

        this.width = window.innerWidth ;
        this.height = window.innerHeight ;
        this.stream = null;

        this.formData = new FormData();

        //div Photo
        this.video = document.createElement('video');
        this.divBoutonSnap = document.createElement('div');
        this.boutonSnap = document.createElement('button');
        this.divUpload = document.createElement('div');
        this.inputFile = document.createElement('input');
        this.uploadFromDevice = document.createElement('button');

        //divPhotoTablette
        this.labelInput = document.createElement( 'label' );
        this.inputFile2 = document.createElement( 'input');
        this.uploadFromDevice2 = document.createElement('button');

        //div Modal Confirm
        this.canvas = document.createElement('canvas');
        this.context = this.canvas.getContext( '2d');
        this.para = document.createElement('p');
        this.divBoutonsConfirm = document.createElement('div');
        this.boutonEffacer = document.createElement('button');
        this.boutonEnvoyer = document.createElement('button');

        //Binder les fonctions pour s'assurer qu'elles respectent le contexte
        this.structureDivPhoto = this.structureDivPhoto.bind(this);
        this.structureDivPhotoTablette = this.structureDivPhotoTablette.bind(this);
        this.structureModalConfirm = this.structureModalConfirm.bind(this);
        this.showCamera = this.showCamera.bind(this);
        this.hideCamera = this.hideCamera.bind(this);
        this.startCamera = this.startCamera.bind(this);
        this.stopCamera = this.stopCamera.bind(this);
        this.capturePicture = this.capturePicture.bind(this);
        this.erasePicture = this.erasePicture.bind(this);
        this.uploadPhoto = this.uploadPhoto.bind(this);

        this.boutonAfficherDivPhoto.addEventListener( 'click' , () => this.showCamera() );
        this.boutonMasquerDivPhoto.addEventListener( 'click' , () => this.hideCamera() );
        this.boutonSnap.addEventListener('click' , () => this.capturePicture() );
        this.boutonEffacer.addEventListener( 'click' , () => this.erasePicture() );
        this.boutonEnvoyer.addEventListener( 'click', () => this.uploadPhoto() );

    }

    //fonction pour remplir la divPhoto
    structureDivPhoto() {
        //style de la divPhoto qui va recevoir les autres divs
        this.divPhoto.style.display = 'none' ;
        this.divPhoto.style.flexDirection = 'column' ;
        this.divPhoto.style.justifyContent = 'center';
        this.divPhoto.style.alignItems = 'center';

        //video , va récupérer le flux de la camera
        this.video = document.createElement('video');
        this.video.height = 380;
        this.video.width = 540;
        this.video.autoplay = true ;
        this.video.style.border = '3px solid black';
        this.video.style.borderRadius = '10px';
        this.video.style.margin = '10px'
        this.video.style.display = 'none';

        //div pour le bouton de capture
        this.divBoutonSnap.style.display = 'flex';
        this.divBoutonSnap.style.justifyContent = 'space-evenly';
        this.divBoutonSnap.style.width = '100%';

        //bouton de capture
        this.boutonSnap.style.display = 'none';
        this.boutonSnap.innerText = 'Prendre une photo';
        this.divBoutonSnap.append(this.boutonSnap);

        //div de l'upload
        this.divUpload.style.margin = '10px';
        this.divUpload.style.textAlign = 'center';
        this.divUpload.style.borderRadius = '10px';
        this.divUpload.style.gap = '2rem';
        this.divUpload.style.justifyContent = 'center' ;
        this.divUpload.style.alignItems = 'center' ;
        this.divUpload.style.display = 'flex';

        //input file
        this.inputFile.type = 'file';
        this.inputFile.style.height = '1.5rem';
        this.divUpload.append(this.inputFile);

        //bouton Upload from Device
        this.uploadFromDevice.innerText = 'Envoyer';
        this.divUpload.append(this.uploadFromDevice);

        //On met tout dans la divPhoto
        this.divPhoto.append( this.video , this.divBoutonSnap , this.divUpload );
    }

    structureDivPhotoTablette (){
        //label
        this.labelInput.innerText = 'Upload file'

        //input
        this.inputFile2.type = 'file';

        //bouton d'envoi
        this.uploadFromDevice2.innerText = 'Envoyer'

        //liaison à la div
        this.divPhotoTablette.append( this.labelInput , this.inputFile2 , this.uploadFromDevice2 )
    }

    structureModalConfirm() {
        //style de la balise dialog qui va recevoir les autres divs
        this.divModal.className = 'modaleConfirmation' ;

        //canvas qui recevra la photo
        this.canvas.width = 640 ;
        this.canvas.height = 480 ;

        //paragraphe pour phrase confirmation
        this.para.innerText = 'Confirmez vous vouloir utiliser cette photo ?'

        //div pour les boutons de confirmation
        this.divBoutonsConfirm.className = 'divBoutonsPhotos';

        //bouton pour effacer le canvas
        this.boutonEffacer.className = 'boutonsConfirmPhoto';
        this.boutonEffacer.innerText = 'Effacer';
        this.divBoutonsConfirm.append(this.boutonEffacer);

        //bouton pour envoyer la photo
        this.boutonEnvoyer.className = 'boutonsConfirmPhoto'
        this.boutonEnvoyer.innerText = 'Envoyer' ;
        this.divBoutonsConfirm.append(this.boutonEnvoyer);

        //On met tout dans la div Modal
        this.divModal.append( this.canvas , this.para , this.divBoutonsConfirm );
    }

    showCamera() {
        if ( this.width === 2000 && this.height === 1200 || this.width < 1200 ) {
            this.divPhotoTablette.style.display = 'flex';
        } else {
            this.divPhoto.style.display = 'flex';
            this.startCamera();
            this.boutonAfficherDivPhoto.style.display = 'none';
            this.boutonMasquerDivPhoto.style.display = 'block';
        }
    }

    hideCamera() {
        if ( this.width === 2000 && this.height === 1200 || this.width < 1200 ) {
            this.divPhotoTablette.style.display = 'none';
        } else {
            this.divPhoto.style.display = 'none';
            this.stopCamera();
            this.boutonMasquerDivPhoto.display = 'none';
            this.boutonAfficherDivPhoto.style.display = 'flex';
        }
    }

    startCamera() {
        this.video.style.display = 'block';
        this.boutonSnap.style.display = 'block';

        if ( navigator.mediaDevices && navigator.mediaDevices.getUserMedia() ) {
            navigator.mediaDevices.getUserMedia({ video : true } )
                .then(( stream ) => {
                    this.stream = stream;
                    this.video.srcObject = this.stream ;
                    this.video.onloadedmetadata = () => {
                        this.video.play() ;
                    };
                })
                .catch( function ( error ) {
                    console.error( 'Erreur lors de l\'accès à la webcam : ' , error )
                    alert('Impossible d\'accéder à la webcam, vérifiez les permissions du navigateur.');
                })
        } else {
            alert('Votre navigateur ne supporte pas getUserMedia.')
        }
    }

    stopCamera() {
        if ( this.stream ) {
            this.stream.getTracks().forEach( track => track.stop());
            this.video.srcObject = null;
            this.stream = null ;
            this.video.style.display = 'none';
            this.boutonSnap.style.display = 'none';
        }
    }

    capturePicture() {
        this.context.drawImage( this.video , 0 , 0 , 640 , 480 );
        this.canvas.style.display = 'block';
        this.boutonEnvoyer.style.display = 'block';
        this.boutonEffacer.style.display = 'block';
        this.divModal.style.display = 'flex';
        this.divModal.showModal();
    }

    erasePicture() {
        this.context.clearRect( 0 , 0 , this.canvas.width , this.canvas.height );
        this.canvas.style.display = 'none';
        this.boutonEnvoyer.style.display = 'none';
        this.boutonEffacer.style.display = 'none';
        this.divModal.style.display = 'none';
        this.divModal.close();
    }

    uploadPhoto() {
        this.stopCamera();
        this.divModal.style.display = 'none';
        this.divModal.close();

        this.canvas.toBlob( function ( blob) {
            this.formData.append( 'photo' , blob , 'photo.png' );

            fetch( this.urlFetch  , {
                method : 'POST' ,
                body : this.formData
            })
                .then( response => response.json() )
                .then( data => {
                    alert( 'Photo envoyée avec succès' );
                })
                .catch( error => {
                    console.error( 'Erreur lors de l\'envoi de la photo : ' , error );
                })
        })
    }
































}