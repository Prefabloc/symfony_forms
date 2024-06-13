

//timer va stocker l'ID du minuteur
let timer;
let test ;
//variable pour savoir combien de secondes se sont écoulées depuis le démarrage du minuteur
let totalSeconds = 180 ;
let minutes ;
let seconds ;


//fonction pour démarrer le minuteur, va appeler la fonction updateTimer toutes les 1 sec
function startTimer(){
    timer = setInterval( updateTimer , 1000 );
}

//fonction pour update le minuteur, chaque fois qu'elle est appelée, baisse d'1 sec le total de secondes, et recalcule les minutes et les secondes à afficher
function updateTimer() {
    totalSeconds -- ;

    minutes = Math.floor( totalSeconds / 60 )
    seconds = totalSeconds % 60 ;
    //padStart est utilisé pour que les nombres aient toujours deux chiffres, et on choisit ce que l'on met devant
    document.getElementById( 'minutes').textContent = String(minutes).padStart(2 , '0' );
    document.getElementById( 'seconds').textContent = String(seconds).padStart(2 ,'0' );

    console.log( totalSeconds)
}

function stopTimer() {
    clearInterval( timer );
    clearInterval( test )
}

function resetTimer() {
    clearInterval( timer );
    totalSeconds = 180;

    document.getElementById( 'minutes').textContent = '03';
    document.getElementById( 'seconds').textContent = '00';

}
