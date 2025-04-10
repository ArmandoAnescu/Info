<?php
require 'componets/header.php';
$eventi=OttieniEventi();
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
                <?php if (isset($_SESSION['admin']) &&$_SESSION['admin']){ ?>
                    <th>Azioni</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if($eventi){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($eventi as $evento){?>
                <tr>
                    <td><?=$evento['titolo'];?></td>
                    <td><?= $evento['luogo'];?></td>
                    <td><?= $evento['prezzo'];?></td>
                    <td><?= $evento['durata'];?></td>
                    <td><?= $evento['data']?></td>
                    <td><?= $evento['guida']?></td>
                    <td><?= $evento['lingua']?></td>
                    <td>
                    <div class="row">
                        <div class="col-auto">
                            <a class="btn btn-success btn-sm" href="evento.php?action=order&id=<?=$evento['id']?>">
                                <i class="fa fa-pen"></i>
                                Prenota
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
</div>
</main>
<?php
require 'componets/footer.php';
?>
