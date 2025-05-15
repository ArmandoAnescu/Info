<?php
include 'components/header.php';
include 'connection.php';
$personalInfo=OttieniInfoPersonali();
$lingue=OttieniLingue();
?>
    <div class="container mt-5 mb-5">
        <div class="page-header text-center">
            <h1>Il tuo profilo</h1>
            <p>Gestisci i tuoi dati personali</p>
        </div>
        <p> Nome: <?=$_SESSION['user']['username']?></p>
        <p> Email: <?=$_SESSION['user']['email']?></p>
        <p> Nazionalità: <?=$personalInfo['nazionalita']?></p>
        <p> Telefono: <?=$personalInfo['telefono']?></p>
        <p> Lingua: <?=$personalInfo['lingua']?></p>
        <!-- Modale -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Modifica Dati</h2>
                <form id="updateForm" action="action_page.php?action=update" method="POST">
                    <label for="nome">Nome:</label>
                    <br>
                    <input type="text" id="nome" name="nome" value="<?=$_SESSION['user']['username']?>" required><br><br>
                    <br>
                    <label for="email">Email:</label>
                    <br>
                    <input type="email" id="email" name="email" value="<?=$_SESSION['user']['email']?>" required><br><br>
                    <br>
                    <label for="nazionalita">Nazionalità:</label>
                    <br>
                    <input type="text" id="nazionalita" name="nazionalita" value="<?=$personalInfo['nazionalita']?>" required><br><br>
                    <br>
                    <label for="telefono">Telefono:</label>
                    <br>
                    <input type="tel" id="telefono" name="telefono" value="<?=$personalInfo['telefono']?>" required><br><br>
                    <br>
                    <lable for="lingua_base">Lingua</lable>
                    <br>
                    <select name="lingua_base">
                        <?php
                        foreach ($lingue as $lingua){
                            ?>
                            <option value="<?=$lingua['id']?>"> <?=$lingua['nome']?></option>
                        <?php }
                        ?>
                    </select>
                    <br>
                    <button id="updateForm" type="submit">Modifica dati</button>
                </form>
            </div>
        </div>
    </div>
    <button id="openModalBtn" style="align-self: center" class="btn btn-action">Modifica Dati</button>


<?php
include 'components/footer.php';
?>