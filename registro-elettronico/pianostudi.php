<?php
include 'components/header.php';
include 'connection.php';
$classe=$_REQUEST['classe'];
?>
<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <?php
            $dati=OttieniPianoStudi($classe);
            //var_dump($dati);
            foreach($dati as $piano){
                echo $piano['materia'].'<br>    ';
            }

        ?>
    </div>
</main>
<?php
include 'components/footer.php';