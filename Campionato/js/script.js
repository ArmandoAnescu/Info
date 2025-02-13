// Funzione per redirigere alla home page
function redirectToHomePage() {
    window.location.href = 'inserimento.php';
}

// Funzione per redirigere alla pagina selezionata
function redirectToPage() {
    var redirectSelect = document.getElementById('redirectSelect'); // Ottieni l'elemento select
    var selectedValue = redirectSelect.value; // Ottieni il valore selezionato
    window.location.href = selectedValue; // Redirigi alla pagina selezionata
}

// Aggiungi un listener per il cambio selezione (se esiste redirectSelect)
var redirectSelect = document.getElementById('redirectSelect');
if (redirectSelect) {
    redirectSelect.addEventListener('change', function () {
        redirectToPage(); // Redirigi alla pagina selezionata
    });
}

// Aggiungi un listener per il click sul pulsante "return" per tornare alla home
document.getElementById('return').addEventListener('click', function () {
    redirectToHomePage(); // Redirigi alla home
});
