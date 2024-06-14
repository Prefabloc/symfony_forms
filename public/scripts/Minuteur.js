
class Minuteur {
    constructor( start , stop , reset , minutesSpan , secondsSpan ) {
        this.start = start ;
        this.stop = stop ;
        this.reset = reset ;
        this.minutesSpan = minutesSpan;
        this.secondsSpan = secondsSpan;

        this.timer = null ;
        this.totalSeconds = 180 ;
        this.minutes = null ;
        this.seconds = null ;

        this.startTimer = this.startTimer.bind(this);
        this.updateTimer = this.updateTimer.bind(this);
        this.stopTimer = this.stopTimer.bind(this);
        this.resetTimer = this.resetTimer.bind(this);

        this.start.addEventListener( 'click' , () => this.startTimer() )
        this.stop.addEventListener( 'click' , () => this.stopTimer() )
        this.reset.addEventListener( 'click' , () => this.resetTimer() )
    }

    startTimer(){
        this.timer = setInterval( this.updateTimer , 1000 );
    }

    updateTimer() {
        this.totalSeconds -- ;

        this.minutes = Math.floor( this.totalSeconds / 60 )
        this.seconds = this.totalSeconds % 60 ;
        //padStart est utilisé pour que les nombres aient toujours deux chiffres, et on choisit ce que l'on met devant
        this.minutesSpan.textContent = String(this.minutes).padStart(2 , '0' );
        this.secondsSpan.textContent = String(this.seconds).padStart(2 ,'0' );

    }

    stopTimer() {
        clearInterval( this.timer );
    }

    resetTimer() {
        clearInterval( this.timer );
        this.totalSeconds = 180;

        this.minutesSpan.textContent = '03';
        this.secondsSpan.textContent = '00';
    }
}
