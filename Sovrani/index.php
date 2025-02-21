<?php
require 'header.php';
?>
<div class="container mt-5 mb-5">
    <h1 class="mt-3 pt-3">Sovrani di utopia</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered rounded" id="tabella-piloti">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>Nome</th>
                <th>Inizio regno</th><!--creo i le colonne con i dati da mostrare-->
                <th>Fine Regno</th>
                <th>Immagine</th>
                <th>Predecessore</th>
                <th>Successore</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'connection.php';
            $sovrani=OttieniSovrani();
            if($sovrani){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($sovrani as $sovrano){?>
                <tr>
                    <td><?=$sovrano['nome'];?></td>
                    <td><?= $sovrano['data_inizio'];?></td>
                    <td><?= $sovrano['data_fine'];?></td>
                    <td><img src="<?= $sovrano['immagine'];?>" alt=""<?=$sovrano['nome']?>></td>
                    <td><?= $sovrano['predecessore']?></td>
                    <td><?= $sovrano['successore']?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-success" href="#">
                                    <i class="fa fa-pen"></i>
                                    UPDATE
                                </a>
                            </div>
                            <div class="col-auto">
                                <a onclick="return confirm('Vuoi eliminare lo user?')" class="btn btn-danger" href="#">
                                    <i class="fa fa-trash"></i>
                                    DELETE
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
            </tbody>
        </table>
</div>
</main>
<?php
require 'footer.php'
?>

