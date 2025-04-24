<?php
include 'componets/header.php';
include 'connection.php';
$prenotazioni=OttieniPrenotazioni();
?>
<div class="container mt-5 mb-5">
    <h1 class="mt-3 pt-3">Eventi</h1>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover table-bordered rounded" id="tabella-prodotti">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>Titolo</th>
                <th>Luogo</th><!--creo i le colonne con i dati da mostrare-->
                <th>Costo</th>
                <th>Durata</th>
                <th>Data</th>
                <th>Guida</th>
                <th>Lingua</th>
                <th>Prenotazione</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($prenotazioni){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($prenotazioni as $prenotazione){?>
                <tr>
                    <td><?=$prenotazione['titolo'];?></td>
                    <td><?= $prenotazione['luogo'];?></td>
                    <td><?= $prenotazione['prezzo'];?></td>
                    <td><?= $prenotazione['durata'];?></td>
                    <td><?= $prenotazione['data']?></td>
                    <td><?= $prenotazione['guida']?></td>
                    <td><?= $prenotazione['lingua']?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-danger btn-sm" href="action_page.php?action=order&id=<?=$prenotazione['id']?>">
                                    <i class="fa fa-pen"></i>
                                    Annulla
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tfoot>
            <?php
            }else{ ?>
                <tr>
                    <td colspan="6">No records found</td><!-- Se non ci sono user o i par della ricerca non trovano niente lo dico -->
                </tr>
                <?php
            }
            ?>
            </tfoot>
        </table>
    </div>
    <button class="btn btn-success" onclick="window.location.href='pagamento.php'">Procedi al pagamento</button>
</div>
</main>
<?php
include 'componets/footer.php';
?>
