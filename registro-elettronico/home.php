<?php
include 'components/header.php';
include 'connection.php';
?>
<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <?php
        if($_SESSION['user']['access']==='docente'){
            echo "buongiorno prof".'<br>';
            $info=OttieniClassi();
            //var_dump($info);
            foreach($info as $classe){
                echo $classe['anno'].''.$classe['sezione'].' A.S: '.$classe['anno_scolastico'].' '.$classe['materia'].' '.$classe['articolazione'].'-'.$classe['indirizzo'];
                ?>
                <a href="pianostudi.php?classe=<?=$classe['id']?>">Guarda Piano di studi</a>
                <br>
                <?php
            }
           
        }
        if($_SESSION['user']['access']==='studente'){
            echo "buongiorno".$user['user']['nome'];
        }if($_SESSION['user']['access']==='genitore'){
            $figli=OttieniFigli();
            echo "Guarda i tuoi figli".'<br>';
            foreach($figli as $figlio){
                echo $figlio['nome'].' '.$figlio['cognome'].'<br>';
            }
        }
        ?>
    </div>
</main>
<?php
include 'components/footer.php';