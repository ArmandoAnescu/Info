<?php
include 'header.php';
?>
<div class="container mt-5">
    <h1 class="mt-3 pt-3">Classifiche</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered rounded" id="tabella-piloti">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>Numero</th>
                <th>Nome</th><!--creo i le colonne con i dati da mostrare-->
                <th>Cognome</th>
                <th>Nazionalita</th>
                <th>Casa</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'connection.php';
            $piloti=ClassificaPiloti();
            if($piloti){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($piloti as $pilota){?>
                <tr>
                    <td><?=$pilota['numero'];?></td>
                    <td><?= $pilota['nome'];?></td>
                    <td><?= $pilota['cognome'];?></td>
                    <td><?= $pilota['nazionalita'];?></td>
                    <td><?= $pilota['nome_casa']?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-success" href="">
                                    <i class="fa fa-pen"></i>
                                    UPDATE
                                </a>
                            </div>
                            <div class="col-auto">
                                <a onclick="return confirm('Vuoi eliminare lo user?')" class="btn btn-danger" href="">
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
    <!--Risultati-->
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered rounded" id="tabella-risultati">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>ID</th>
                <th>Posizione</th><!--creo i le colonne con i dati da mostrare-->
                <th>Pilota</th>
                <th>Luogo</th>
                <th>Data</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $risultati=ClassificaRisultati();
            if($risultati){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($risultati as $risultato){?>
                <tr>
                    <td><?=$risultato['id'];?></td>
                    <td><?= $risultato['posizione'];?></td>
                    <td><?= $risultato['piloti'];?></td>
                    <td><?= $risultato['luogo'];?></td>
                    <td><?= $risultato['data_gara']?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-success btn-sm" href="">
                                    <i class="fa fa-pen"></i>
                                    UPDATE
                                </a>
                            </div>
                            <div class="col-auto">
                                <a onclick="return confirm('Vuoi eliminare lo user?')" class="btn btn-danger btn-sm" href="">
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

    <!-- Case automobilistiche-->
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered rounded" id="tabella-case">
            <thead>
            <tr>
            </tr>
            <tr>
                <th>Nome Livrea</th>
                <th>Colore livrea</th><!--creo i le colonne con i dati da mostrare-->
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $case=ClassificaSquadre();
            if($case){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
            foreach($case as $casa){?>
                <tr>
                    <td><?=$casa['nome_casa'];?></td>
                    <td><?= $casa['livrea'];?></td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-success" href="">
                                    <i class="fa fa-pen"></i>
                                    UPDATE
                                </a>
                            </div>
                            <div class="col-auto">
                                <a onclick="return confirm('Vuoi eliminare lo user?')" class="btn btn-danger" href="">
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
    
</div>
<?php
include 'footer.php';
?>
