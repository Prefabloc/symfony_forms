


document.addEventListener('DOMContentLoaded' , function() {
    //On récupère les éléments html qui serviront
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const takePicture = document.getElementById('snap');
    const upload = document.getElementById('upload');
    const context = canvas.getContext('2d');
    const on = document.getElementById('camOn');
    const off = document.getElementById('camOff');
    const effacer = document.getElementById('effacer');
    //On initialise une variable stream qui nous servira à couper / ouvrir le flux de video à volonté
    let stream = null ;


    //Fonction pour lancer la caméra
    function startCamera() {
        //On vérifie si le navigateur supporte l'API getUserMedia
        if ( navigator.mediaDevices && navigator.mediaDevices.getUserMedia() ) {
            //Demander l'accès à la webcam
            navigator.mediaDevices.getUserMedia({ video : true })
                .then( function ( s) {
                    stream = s ;
                    video.srcObject = stream ;
                    video.play();
                })
                .catch( function ( error ) {
                    console.error("Erreur lors de l'accès à la webcam : " , error )
                    alert("Impossible d'accéder à la webcam, vérifiez les permissions du navigateur.");
                })
        } else {
            alert('Votre navigateur ne supporte pas getUserMedia');
        }
    }

    on.addEventListener( "click", startCamera);


    //Fonction pour couper la caméra
    function stopCamera(){
        if ( stream ) {
            stream.getTracks().forEach( track => track.stop());
            video.srcObject = null ;
            stream = null ;
        }
    }

    off.addEventListener( 'click' , stopCamera );


    //Capturer la photo
    takePicture.addEventListener('click' , function () {
        context.drawImage( video , 0 , 0 , 640 , 480 );
        canvas.style.display = 'block' ;
        upload.style.display = 'block' ;
        effacer.style.display = 'block';
    });

    //Effacer la photo
    effacer.addEventListener('click' , function() {
        context.clearRect( 0 , 0 , canvas.width , canvas.height );
        canvas.style.display = 'none';
        upload.style.display = 'none' ;
        effacer.style.display = 'none' ;
    })


    //Envoyer la photo
    upload.addEventListener('click' , function() {
        canvas.toBlob( function( blob) {
            const formData = new FormData();
            formData.append('photo' , blob , 'photo.png');

            fetch('/identification_prestation/upload_photo' , {
                method : 'POST' ,
                body : formData
            })
                .then( response => response.json())
                .then( data => {
                    alert( 'Photo envoyée avec succès !');
                    console.log(data);
                })
                .catch( error => {
                    console.error( 'Erreur lors de l\'envoi de la photo : ' , error );
                })
        })
    })
})