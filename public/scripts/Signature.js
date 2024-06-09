class Signature {
    constructor(canvasSelector) {
        this.sign = false;
        this.prevX = 0;
        this.prevY = 0;

        this.canvas = document.querySelector(canvasSelector);
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;
        this.ctx = this.canvas.getContext('2d');
        this.ctx.strokeStyle = 'black';
        this.ctx.lineWidth = 2;

        this.canvas.addEventListener('mousedown', this.startDrawing.bind(this));
        this.canvas.addEventListener('mousemove', this.draw.bind(this));
        this.canvas.addEventListener('mouseup', this.stopDrawing.bind(this));
        this.canvas.addEventListener('mouseout', this.stopDrawing.bind(this));

        this.canvas.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
        this.canvas.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
        this.canvas.addEventListener('touchend', this.handleTouchEnd.bind(this), { passive: false });

        document.body.addEventListener('touchstart', this.preventTouchScrolling.bind(this), { passive: false });
        document.body.addEventListener('touchend', this.preventTouchScrolling.bind(this), { passive: false });
        document.body.addEventListener('touchmove', this.preventTouchScrolling.bind(this), { passive: false });

        document.getElementById('effacerSignature').addEventListener('click', () => this.clearCanvas());
        document.getElementById('enregistrerSignature').addEventListener('click', () => this.saveSignature());
    }

    startDrawing(event) {
        this.sign = true;
        this.prevX = event.clientX - this.canvas.offsetLeft;
        this.prevY = event.clientY - this.canvas.offsetTop;
    }

    draw(event) {
        if (!this.sign) return;
        const currX = event.offsetX;
        const currY = event.offsetY;
        this.drawLine(this.prevX, this.prevY, currX, currY);
        this.prevX = currX;
        this.prevY = currY;
    }

    stopDrawing() {
        this.sign = false;
        this.ctx.beginPath();
    }

    handleTouchStart(event) {
        event.preventDefault();
        const touch = event.touches[0];
        const mouseEvent = new MouseEvent('mousedown', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        this.canvas.dispatchEvent(mouseEvent);
    }

    handleTouchMove(event) {
        event.preventDefault();
        const touch = event.touches[0];
        const mouseEvent = new MouseEvent('mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        this.canvas.dispatchEvent(mouseEvent);
    }

    handleTouchEnd(event) {
        event.preventDefault();
        const mouseEvent = new MouseEvent('mouseup', {});
        this.canvas.dispatchEvent(mouseEvent);
    }

    preventTouchScrolling(event) {
        if (event.target === this.canvas) {
            event.preventDefault();
        }
    }

    drawLine(depX, depY, destX, destY) {
        this.ctx.beginPath();
        this.ctx.moveTo(depX, depY);
        this.ctx.lineTo(destX, destY);
        this.ctx.closePath();
        this.ctx.stroke();
    }

    clearCanvas() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }

    saveSignature() {
        const image = this.canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream');
        return image;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const signature = new Signature('#signature');
});

// 
