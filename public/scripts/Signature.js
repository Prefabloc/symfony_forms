class Signature {
    constructor(canvas) {
        this.sign = false;
        this.prevX = 0;
        this.prevY = 0;

        this.canvas = document.querySelector(canvas);
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;

        this.ctx = this.canvas.getContext('2d');
        this.ctx.strokeStyle = 'black';
        this.ctx.lineWidth = 2;

        this.canvas.addEventListener('pointerdown', this.startSigning.bind(this));
        this.canvas.addEventListener('pointermove', this.signing.bind(this));
        this.canvas.addEventListener('pointerup', this.stopSigning.bind(this));
        this.canvas.addEventListener('pointerout', this.stopSigning.bind(this));

        // Adding touch events for mobile compatibility
        this.canvas.addEventListener('touchstart', this.startSigning.bind(this));
        this.canvas.addEventListener('touchmove', this.signing.bind(this));
        this.canvas.addEventListener('touchend', this.stopSigning.bind(this));
        this.canvas.addEventListener('touchcancel', this.stopSigning.bind(this));
    }

    startSigning(event) {
        this.sign = true;

        let clientX = event.clientX || event.touches[0].clientX;
        let clientY = event.clientY || event.touches[0].clientY;

        this.prevX = clientX - this.canvas.offsetLeft;
        this.prevY = clientY - this.canvas.offsetTop;
    }

    signing(event) {
        if (this.sign) {
            let clientX = event.clientX || event.touches[0].clientX;
            let clientY = event.clientY || event.touches[0].clientY;

            let currX = clientX - this.canvas.offsetLeft;
            let currY = clientY - this.canvas.offsetTop;

            this.draw(this.prevX, this.prevY, currX, currY);

            this.prevX = currX;
            this.prevY = currY;

            // Prevent scrolling on touch move
            event.preventDefault();
        }
    }

    stopSigning() {
        this.sign = false;
    }

    draw(depX, depY, destX, destY) {
        this.ctx.beginPath();
        this.ctx.moveTo(depX, depY);
        this.ctx.lineTo(destX, destY);
        this.ctx.closePath();
        this.ctx.stroke();
    }

    effacer() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }

    genererImg() {
        let image = this.canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream');
        return image;
    }
}
