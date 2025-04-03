let timer;
let seconds=60;
function startTimer() {
    timer = setInterval(() => {
        if (seconds <= 0) {
            clearInterval(timer); // Ferma il timer quando i secondi arrivano a zero
            document.getElementById('timer').textContent = "Tempo scaduto!";
            window.location.href = "message.php";
            return; // Esce dalla funzione se il tempo è finito
        }

        seconds--; // Decrementa ogni secondo

        document.getElementById('timer').textContent = ` Tempo:${String(seconds)}`;
    }, 1000);
}
window.onload = function() {
    startTimer(); // Avvia il timer
}
// Force redirect at 60s
/*
setTimeout(() => {
    window.location.href = "message.php";
}, 60000);
*/
