// Ottieni gli elementi necessari
const modal = document.getElementById("modal");
const openModalBtn = document.getElementById("openModalBtn");
const closeBtn = document.getElementsByClassName("close")[0];

// Quando l'utente clicca sul bottone, apri il modale
openModalBtn.onclick = function() {
    modal.style.display = "block";
}

// Quando l'utente clicca sulla "X", chiudi il modale
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Quando l'utente clicca fuori dal modale, chiudilo
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

