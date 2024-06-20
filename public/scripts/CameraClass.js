
class CameraClass {
    constructor(boutonAfficherDivPhoto, boutonMasquerDivPhoto, divPhoto, divPhotoTablette, divModal, urlFetch) {
        this.boutonAfficherDivPhoto = boutonAfficherDivPhoto;
        this.boutonMasquerDivPhoto = boutonMasquerDivPhoto;
        this.divPhoto = divPhoto;
        this.divPhotoTablette = divPhotoTablette;
        this.divModal = divModal;
        this.urlFetch = urlFetch;

        this.width = window.innerWidth;
        this.height = window.innerHeight;
        this.stream = null;

        //variables bool qui servent pour la double vérification
        this.boolPhoto = false;
        this.boolUpload = false;
        //formData atteignable depuis l'extérieur pour envoyer ce qu'on veut en plus de la photo, attention à gérer le controller après
        this.formData = new FormData();


        //div Photo
        this.video = document.createElement('video');
        this.divBoutonSnap = document.createElement('div');
        this.boutonSnap = document.createElement('button');
        this.divUpload = document.createElement('div');
        this.inputFile = document.createElement('input');
        this.uploadFromDevice = document.createElement('button');

        //divPhotoTablette
        this.labelInput = document.createElement('label');
        this.inputFile2 = document.createElement('input');
        this.uploadFromDevice2 = document.createElement('button');

        //div Modal Confirm
        this.canvas = document.createElement('canvas');
        this.context = this.canvas.getContext('2d');
        this.para = document.createElement('p');
        this.divBoutonsConfirm = document.createElement('div');
        this.boutonEffacer = document.createElement('button');
        this.boutonEnvoyer = document.createElement('button');

        //Binder les fonctions pour s'assurer qu'elles respectent le contexte
        this.structureDivPhoto = this.structureDivPhoto.bind(this);
        this.structureDivPhotoTablette = this.structureDivPhotoTablette.bind(this);
        this.structureModalConfirm = this.structureModalConfirm.bind(this);
        this.init = this.init.bind(this);
        this.showCamera = this.showCamera.bind(this);
        this.hideCamera = this.hideCamera.bind(this);
        this.startCamera = this.startCamera.bind(this);
        this.stopCamera = this.stopCamera.bind(this);
        this.capturePicture = this.capturePicture.bind(this);
        this.erasePicture = this.erasePicture.bind(this);
        this.uploadPhoto = this.uploadPhoto.bind(this);
        this.uploadFile = this.uploadFile.bind(this);

        this.boutonAfficherDivPhoto.addEventListener('click', () => this.showCamera());
        this.boutonMasquerDivPhoto.addEventListener('click', () => this.hideCamera());
        this.boutonSnap.addEventListener('click', (e) => { e.preventDefault(); this.capturePicture() });
        this.boutonEffacer.addEventListener('click', () => this.erasePicture());
        this.boutonEnvoyer.addEventListener('click', () => this.uploadPhoto());
        this.uploadFromDevice.addEventListener("click", (e) => { e.preventDefault(); this.uploadFile(this.inputFile) })
        this.uploadFromDevice2.addEventListener("click", (e) => { e.preventDefault(); this.uploadFile(this.inputFile2) })
    }

    //fonction pour remplir la divPhoto
    structureDivPhoto() {
        //style de la divPhoto qui va recevoir les autres divs
        this.divPhoto.style.display = 'none';
        this.divPhoto.style.flexDirection = 'column';
        this.divPhoto.style.justifyContent = 'center';
        this.divPhoto.style.alignItems = 'center';

        //video , va récupérer le flux de la camera
        this.video = document.createElement('video');
        this.video.height = 380;
        this.video.width = 540;
        this.video.autoplay = true;
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
        this.boutonSnap.classList = "px-3 py-2 text-sm me-2 mb-2 font-medium text-center inline-flex items-center text-white bg-amber-800 rounded-lg hover:bg-blue-800 dark:bg-slate-500 dark:hover:bg-slate-700 "
        this.divBoutonSnap.append(this.boutonSnap);

        //div de l'upload
        this.divUpload.style.margin = '10px';
        this.divUpload.style.textAlign = 'center';
        this.divUpload.style.borderRadius = '10px';
        this.divUpload.style.gap = '2rem';
        this.divUpload.style.justifyContent = 'center';
        this.divUpload.style.alignItems = 'center';
        this.divUpload.style.display = 'flex';

        //input file
        this.inputFile.type = 'file';
        this.inputFile.style.height = '1.5rem';
        this.inputFile.classList = "block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-black focus:outline-none dark:bg-orange-100 dark:border-black dark:placeholder-black"
        this.divUpload.append(this.inputFile);

        //bouton Upload from Device
        this.uploadFromDevice.innerText = 'Envoyer';
        this.uploadFromDevice.classList = "focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
        this.divUpload.append(this.uploadFromDevice);

        //On met tout dans la divPhoto
        this.divPhoto.append(this.video, this.divBoutonSnap, this.divUpload);
    }



    structureDivPhotoTablette() {
        //label
        this.labelInput.innerText = 'Upload file'
        this.labelInput.classList = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"

        //input
        this.inputFile2.type = 'file';
        this.inputFile2.classList = "block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-black focus:outline-none dark:bg-orange-100 dark:border-black dark:placeholder-black"

        //bouton d'envoi
        this.uploadFromDevice2.innerText = 'Envoyer'
        this.uploadFromDevice2.classList = "focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"

        //liaison à la div
        this.divPhotoTablette.append(this.labelInput, this.inputFile2, this.uploadFromDevice2)
    }



    structureModalConfirm() {
        //style de la balise dialog qui va recevoir les autres divs
        this.divModal.className = 'modalConfirmationPhotoIdentificationPrestation';

        //canvas qui recevra la photo
        this.canvas.width = 640;
        this.canvas.height = 480;
        this.canvas.className = 'canvasPhoto'

        //paragraphe pour phrase confirmation
        this.para.innerText = 'Confirmez vous vouloir utiliser cette photo ?'

        //div pour les boutons de confirmation
        this.divBoutonsConfirm.className = 'divBoutonsPhotos';

        //bouton pour effacer le canvas
        this.boutonEffacer.className = 'boutonsConfirmPhoto';
        this.boutonEffacer.innerText = 'Effacer';
        this.boutonEffacer.id = 'effacer'
        this.divBoutonsConfirm.append(this.boutonEffacer);

        //bouton pour envoyer la photo
        this.boutonEnvoyer.className = 'boutonsConfirmPhoto'
        this.boutonEnvoyer.innerText = 'Envoyer';
        this.boutonEnvoyer.id = 'upload'
        this.divBoutonsConfirm.append(this.boutonEnvoyer);

        //On met tout dans la div Modal
        this.divModal.append(this.canvas, this.para, this.divBoutonsConfirm);
    }

    init() {
        this.structureDivPhoto();
        this.structureDivPhotoTablette();
        this.structureModalConfirm();
    }

    showCamera() {
        const isLargeScreen = (this.width === 2000 && this.height === 1200);
        const isSmallScreen = (this.width < 1200);

        if (isLargeScreen || isSmallScreen) {
            this.divPhotoTablette.style.display = 'flex';
        } else {
            this.divPhoto.style.display = 'flex';
            this.startCamera();
            this.boutonAfficherDivPhoto.style.display = 'none';
            this.boutonMasquerDivPhoto.style.display = 'block';
        }
    }

    hideCamera() {
        const isLargeScreen = (this.width === 2000 && this.height === 1200);
        const isSmallScreen = (this.width < 1200);

        if (isLargeScreen || isSmallScreen) {
            this.divPhotoTablette.style.display = 'none';
        } else {
            this.divPhoto.style.display = 'none';
            this.boutonMasquerDivPhoto.style.display = 'none';
            this.stopCamera();
            this.boutonAfficherDivPhoto.style.display = 'flex';
        }
    }

    startCamera() {
        this.video.style.display = 'block';
        this.boutonSnap.style.display = 'block';

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia()) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    this.stream = stream;
                    this.video.srcObject = this.stream;
                    this.video.onloadedmetadata = () => {
                        this.video.play();
                    };
                })
                .catch(function (error) {
                    console.error('Erreur lors de l\'accès à la webcam : ', error)
                    alert('Impossible d\'accéder à la webcam, vérifiez les permissions du navigateur.');
                })
        } else {
            alert('Votre navigateur ne supporte pas getUserMedia.')
        }
    }

    stopCamera() {
        if (this.stream) {
            this.stream.getTracks().forEach(track => track.stop());
            this.video.srcObject = null;
            this.stream = null;
            this.video.style.display = 'none';
            this.boutonSnap.style.display = 'none';
        }
    }

    capturePicture() {
        this.context.drawImage(this.video, 0, 0, 640, 480);
        this.canvas.style.display = 'block';
        this.boutonEnvoyer.style.display = 'block';
        this.boutonEffacer.style.display = 'block';
        this.divModal.style.display = 'flex';
        this.divModal.showModal();
    }

    erasePicture() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
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

        this.canvas.toBlob((blob) => {
            this.formData.append('photo', blob, 'photo.png');

            fetch(this.urlFetch, {
                method: 'POST',
                body: this.formData
            })
                .then(response => response.json())
                .then(data => {
                    this.boolPhoto = true;
                    alert('Photo envoyée avec succès');
                })
                .catch(error => {
                    console.error('Erreur lors de l\'envoi de la photo : ', error);
                })
        })
    }

    uploadFile(fileInput) {
        const file = fileInput.files[0];

        if (file) {
            this.formData.append('photo2', file);

            fetch(this.urlFetch, {
                method: 'POST',
                body: this.formData
            })
                .then(response => response.json())
                .then(data => {
                    alert('Photo envoyée avec succès.');
                    this.boolUpload = true;
                })
                .catch(error => {
                    console.error('Erreur lors de l\'envoi du fichier.' + error)
                })
        } else {
            alert('Veuillez séléctionner un fichier.');
        }
    }

}