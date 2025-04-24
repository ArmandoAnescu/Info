<?php
include 'componets/header.php';
include 'connection.php';
$prenotazioni=OttieniPrenotazioni();
$somma=0;
?>
<div class="container mt-5 mb-5">
    <h1 class="mt-3 pt-3">Check out</h1>
    <br>
    <div>
        <ul class="list-group">
        <?php
        if($prenotazioni){
        foreach($prenotazioni as $prenotazione){
            $somma=$somma+$prenotazione['prezzo'];
            ?>
            <li class="list-group-item">Titolo: <?=$prenotazione['titolo']?> durata: <?=$prenotazione['durata']?> prezzo:€<?=$prenotazione['prezzo']?></li>
            <?php
        }
        }
            ?>
        </ul>
    </div>
    <br>
    <p>totale: <strong>€<?=$somma?></strong></p>
    <br>
    <button class="btn btn-success" onclick="window.location.href='action_page.php?action=payment'">Paga</button>
</div>
</main>
<?php
include 'componets/footer.php';
?>
