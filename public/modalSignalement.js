// Sélectionnez la modale et obtenez l'élément <span> qui ferme la modale
let infoModal = document.getElementById("infoModal");
let span = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur la modale, fermez-la
infoModal.onclick = function(event) {
    if (event.target === infoModal) {
        infoModal.style.display = "none";
    }
};

// Lorsque l'utilisateur clique sur le bouton "x", fermez la modale
span.onclick = function() {
    infoModal.style.display = "none";
};

// Lorsque l'utilisateur clique sur le bouton "Soumettre", récupérez les informations et effectuez une action
document.getElementById("submitInfo").addEventListener("click", function() {
    let infoType = document.getElementById("infoType").value;
    let infoMessage = document.getElementById("infoMessage").value;

    // Ici, vous pouvez effectuer une action avec les informations récupérées,
    // comme par exemple les envoyer à un serveur via une requête AJAX.

    // Fermer la modale
    infoModal.style.display = "none";
});

// Fonction pour afficher la modale
function showInfoModal() {
    infoModal.style.display = "block";
}