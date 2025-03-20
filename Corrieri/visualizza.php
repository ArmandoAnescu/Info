<?php
require 'connection.php';
require 'header.php';
?>
<div class="container mt-5">
    <h1 class="mt-3 pt-3">Classifiche</h1>
    <br>
    <h2>Plichi</h2>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered rounded" id="tabella-plichi">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mittente</th>
                    <th>Sede Partenza</th>
                    <th>Sede Arrivo</th>
                    <th>Responsabile</th>
                    <th>Data Consegna</th>
                    <th>Data Spedizione</th>
                    <th>Data Ritiro</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $plichi = ClassificaPlichi(); // Funzione per recuperare i plichi
                if ($plichi) {
                    foreach ($plichi as $plico) { ?>
                        <tr>
                            <td><?= $plico['id']; ?></td>
                            <td><?= $plico['mittente']; ?></td>
                            <td><?= $plico['sede_partenza']; ?></td>
                            <td><?= $plico['sede_arrivo']; ?></td>
                            <td><?= $plico['responsabile']; ?></td>
                            <td><?= $plico['consegna']; ?></td>
                            <td><?= $plico['spedizione'] ? $plico['spedizione'] : 'N/A'; ?></td>
                            <td><?= $plico['ritiro'] ? $plico['ritiro'] : 'N/A'; ?></td>
                            <td><?= $plico['stato']; ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-auto">
                                        <a class="btn btn-success" href="plichi.php?action=update&id=<?= $plico['id'] ?>">
                                            <i class="fa fa-pen"></i> UPDATE
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a onclick="return confirm('Vuoi eliminare il plico?')" class="btn btn-danger" href="action_page.php?action=delete&id=<?= $plico['id'] ?>">
                                            <i class="fa fa-trash"></i> DELETE
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="9">No records found</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require 'footer.php';
?>