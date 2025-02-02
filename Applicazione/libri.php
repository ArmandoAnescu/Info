<?php
require 'header.php';
?>
<div class="container mt-5">
<h1 class="mt-3 pt-3">Catalogo</h1>
<br>
<div class="table-responsive">
<table class="table table-dark table-striped table-bordered rounded" id="tabella-libri">
    <thead>
    <tr>
    </tr>
    <tr><!-- passo l'order by e il dir così quando il modo di vedere tra asc e desc non si resetta -->
        <th >Titolo</th><!--creo i le colonne con i dati da mostrare-->
        <th>Autore</th>
        <th>Genere</th>
        <th>Anno Pubblicazione</th>
        <th>Prezzo</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require 'connection.php';
    $libri=LeggiLibri();
    if($libri){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
    foreach($libri as $libro){?>
        <tr>
            <td><?= $libro['titolo'];?></td>
            <td><?= $libro['autore'];?></td>
            <td><?= $libro['genere'];?></td>
            <td><?= $libro['anno_pubblicazione']?></td>
            <td><?= $libro['prezzo']; ?></td>
            <td>
                <div class="row">
                    <div class="col-7">
                        <a class="btn btn-success" href="formupdate.php?titolo=<?=$libro['titolo']?>&autore=<?=$libro['autore']?>&genere=<?=$libro['genere']?>&anno_pubblicazione=<?=$libro['anno_pubblicazione']?>&prezzo=<?=$libro['prezzo']?>">
                            <i class="fa fa-pen"></i>
                            UPDATE
                        </a>
                    </div>
                    <div class="col-5">
                        <a onclick="return confirm('Vuoi eliminare lo user?')" class="btn btn-danger" href="eliminazione.php?titolo=<?=$libro['titolo']?>&autore=<?=$libro['autore']?>">
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
    </tbody>
</table>
</div>
</div>
<?php
require 'footer.php';