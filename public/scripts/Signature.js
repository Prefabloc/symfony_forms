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

    getClientOffset(event) {
        const rect = this.canvas.getBoundingClientRect();
        const clientX = event.clientX || (event.touches ? event.touches[0].clientX : 0);
        const clientY = event.clientY || (event.touches ? event.touches[0].clientY : 0);
        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    startSigning(event) {
        this.sign = true;
        const { x, y } = this.getClientOffset(event);
        this.prevX = x;
        this.prevY = y;
    }

    signing(event) {
        if (this.sign) {
            const { x, y } = this.getClientOffset(event);
            this.draw(this.prevX, this.prevY, x, y);
            this.prevX = x;
            this.prevY = y;

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
