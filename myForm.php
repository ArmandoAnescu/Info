<?php
/*
 * Realizzare un'applicazione PHP che simuli un modulo di Google Forms.
L'applicazione deve essere composta da due pagine principali:
Prima pagina:
Contiene un form con domande sui DBMS.
Il form deve includere tutti i controlli visti a lezione (ad esempio,pulsanti di scelta, caselle di selezione,

 un campo di testo per fornire una risposta libera,   ecc.).
Seconda pagina:
Visualizza le risposte date dall'utente confrontandole con le risposte corrette.
Per ogni risposta:
Se la risposta è corretta, deve essere contrassegnata con un simbolo di conferma (ad esempio, un apice verde).
Se la risposta è errata, deve essere contrassegnata con un simbolo di errore (ad esempio, una croce rossa).
Per la risposta aperta:
Deve essere effettuata un'analisi del testo fornendo il numero di parole, consonanti, vocali e caratteri numerici presenti. Per questa domanda, non è richiesto il confronto con una risposta corretta.
Requisiti aggiuntivi del form:
Deve includere campi obbligatori per nome, cognome, email e password dell'utente.
Il front end deve essere realizzao con HTML,CSS e js.
 * */
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>myForm</title>
</head>
<body>
<h2>PHP form validation with main controllers</h2>
<form method="post" action="risposte.php">
    <label for="name">Inserisci il tuo nome</label>
    <br>
    <input type="text" id="name" placeholder="name" name="name"required>
    <br>
    <label for="surname">Inserisci il tuo cognome</label>
    <br>
    <input type="text" id="surname" placeholder="Surname" name="surname" required>
    <br>
    <label for="email">Inserisci la tua email</label>
    <br>
    <input type="text" id="email" placeholder="example@example" name="email" required>
    <br>
    <label for="password">Inserisci la tua password</label>
    <br>
    <input type="password" id="password" placeholder="Password" name="password" required>
    <br><br>
    <label for="domandaaperta">Spiega i pro e i contro del DBMS e del file system</label>
    <br>
    <textarea id="domandaaperta" placeholder="Rispsota...." name="domandaaperta" rows="5" cols="40"></textarea>
    <br><br>
    <label for="avoid">Il DBMS evita</label>
    <br>
    <input type="radio" id="avoid" name="avoid" value="ridondanza"> Ridondanza
    <br>
    <input type="radio" id="avoid" name="avoid" value="efficienza"> Efficienza
    <br>
    <input type="radio" id="avoid" name="avoid" value="malware"> Malware
    <br>

    <label for="acid">l'acronimo ACID sta per:</label>
    <br>
    <input type="checkbox" id="acid" name="acid[]" value="atomicità"> Atomicità
    <br>
    <input type="checkbox" id="acid" name="acid[]" value="destrezza"> Destrezza
    <br>
    <input type="checkbox" id="acid" name="acid[]" value="isolazione"> Isolazione
    <br>
    <label for="admin">Chi si occupa di amministrare il DBMS</label>
    <br>
    <!-- Dropdown list -->
    <select id="admin" name="admin">
        <option value="dba">DBA</option>
        <option value="ceo">CEO</option>
        <option value="tecnico">Tecnico</option>
    </select>
    <br>

    <!-- List box -->
    <label for="option">Il DBMS permette:</label>
    <br><br>
    <select id="option" size="3" name="option">
        <option value="concorrenza">Accesso Concorrente</option>
        <option value="software">Creare nuovi software</option>
        <option value="schemiER">fare schemi E R</option>
    </select>
    <br><br>
    <input type="submit" value="Submit">
</form>
<script src="../myScript.js"></script>
</body>
</html>