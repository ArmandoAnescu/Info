<?php
require 'header.php';
require 'connection.php';
$prodotti=OttieniProdotti();
if (!$_SESSION['email']){
    header('Location:index.php');
}
?>

<div class="container mt-5 mb-5">
    <h1 class="mt-3 pt-3">Prodotti</h1>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover table-bordered rounded" id="tabella-prodotti">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>ID</th>
                <th>Desc.</th><!--creo i le colonne con i dati da mostrare-->
                <th>Costo</th>
                <th>Qt.</th>
                <th>Data</th>
            <?php if (isset($_SESSION['admin']) &&$_SESSION['admin']){ ?>
                <th>Azioni</th>
            <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if($prodotti){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($prodotti as $prodotto){?>
                <tr>
                    <td><?=$prodotto['codice'];?></td>
                    <td><?= $prodotto['descrizione'];?></td>
                    <td><?= $prodotto['costo'];?></td>
                    <td><?= $prodotto['quantita'];?></td>
                    <td><?= $prodotto['data_produzione']?></td>
                    <?php if (isset($_SESSION['admin']) &&$_SESSION['admin']){ ?>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-success btn-sm" href="prodotto.php?action=update&id=<?=$prodotto['codice']?>">
                                    <i class="fa fa-pen"></i>
                                    UPDATE
                                </a>
                            </div>
                            <div class="col-auto">
                                <a onclick="return confirm('Vuoi eliminare il prodotto?')" class="btn btn-danger btn-sm" href="action_page.php?action=delete&codice=<?=$prodotto['codice']?>">
                                    <i class="fa fa-trash"></i>
                                    DELETE
                                </a>
                            </div>
                        </div>
                   <?php }
                   ?>
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
require 'footer.php';
?>
