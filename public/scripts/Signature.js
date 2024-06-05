class Signature {
    //Définition du constructeur, avec un seul paramètre, le canvas sur lequel on dessine
    constructor(canvas) {
        //On initie un boolean sign à false qui nous servira pour savoir si on est actuellement en train de signer ou non
        this.sign = false
        //On rajoute les coordonnées du click
        this.prevX = 0;
        this.prevY = 0;

        //Séléction de l'élément canvas grâce au QuerySelector
        this.canvas = document.querySelector(canvas);
        //on fait en sorte que la taille du canvas soit toujours égale à son affichage sur le navigateur pour eviter la désynchro
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;

        //Obtention du contexte 2D du canvas et stockage dans la propriété ctx ( contexte )
        this.ctx = this.canvas.getContext('2d');
        //Paramètre du contexte, ici on définit la couleur du trait du 'stylo'
        this.ctx.strokeStyle = 'black';
        //Définition de l'épaisseur du trait
        this.ctx.lineWidth = 2;

        //Récupération des coordonnées de départ
        this.canvas.addEventListener('mousedown', (event) => {
            //On passe la signature à true ( c'est pour se dire "je suis en train de signer" )
            this.sign = true;

            //Je stocke mes coordonnées de départ
            this.prevX = event.clientX - this.canvas.offsetLeft;
            this.prevY = event.clientY - this.canvas.offsetTop;
        })

        //On suit le déplacement de la souris si on a commencé à signer, donc si on a cliqué une fois pour passer la variable sign à true
        this.canvas.addEventListener('mousemove', (event) => {

            if (this.sign) {
                //On garde toujours la variable prevX et prevY parce qu'on devra tracer un trait entre currX/currY et prevX/prevY
                let currX = event.offsetX;
                let currY = event.offsetY;
                //On appelle la méthode draw définie juste en dessous pour dessiner
                this.draw(this.prevX, this.prevY, currX, currY);
                //On redéfinit
                this.prevX = currX;
                this.prevY = currY;
            }
        })

        //Si on lâche le clic de la souris, on arrête de dessiner
        this.canvas.addEventListener('mouseup', () => {
            this.sign = false;
        })

        this.canvas.addEventListener('mouseout', () => {
            this.sign = false;
        })
    }


    //Méthode pour dessiner
    draw(depX, depY, destX, destY) {
        //dessiner un nouveau trait
        this.ctx.beginPath()
        //placer le crayon sur A
        this.ctx.moveTo(depX, depY)
        //faire le trait de A à B
        this.ctx.lineTo(destX, destY)
        //arrêter de dessiner
        this.ctx.closePath()
        //faire le trait
        this.ctx.stroke()
    }

    //Méthode pour effacer
    effacer() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)
    }


    //Méthode pour générer l'image de la signature
    genererImg() {
        let image = this.canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream')
        return image;
    }
}