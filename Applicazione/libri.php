<?php
require 'header.php';
?>
<body>
    <h1>Catalogo</h1>
<table class="table table-dark table-striped table-bordered" id="tabella-libri">
    <caption style="caption-side:top">Lista libri</caption>
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
            <td><?= $libro['anno_pubblicazione']?></td><!-- aggiungo anche il link per scrivere una email -->
            <td><?= $libro['prezzo']; ?></td>
            <td>
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-success" href="#">

                            <i class="fa fa-pen"></i>
                            UPDATE
                        </a>
                    </div>
                    <div class="col-6">
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
    <tr>
        <td colspan="6">
        </td><!-- Se non ci sono user o i par della ricerca non trovano niente lo dico -->
    </tr>
    </tfoot>
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
<?php
require 'footer.php';