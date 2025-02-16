<?php
require 'header.php';
require 'connection.php';
if(isset($_REQUEST['action'])&& $_REQUEST['action']==='update'){
    $id = $_REQUEST['id'];
    $risultato=OttieniRisultato($id);
    $action ='update.php?action=risultato&id='.$id ;
}else{
    $action ='insert.php?action=risultato';
}
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="<?=$action?>" method="post">
        <label for="posizione">Inserisci la posizione</label>
        <br>
        <input type="number" name="posizione" value="<?=isset($risultato['posizione'])?$risultato['posizione']:''?>">
        <br>
        <label for="numero">Inserisci il numero del pilota</label>
        <br>
        <input type="number" name="numero" value="<?=isset($risultato['piloti'])?$risultato['piloti']:''?>">
        <br>
        <label for="id_gara">Inserisci l'id della gara</label>
        <br>
        <input type="number" name="id_gara" value="<?=isset($risultato['id_gara'])?$risultato['id_gara']:''?>">
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
