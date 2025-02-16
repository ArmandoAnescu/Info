<?php
require 'header.php';
require 'connection.php';
if(isset($_REQUEST['action'])&& $_REQUEST['action']==='update'){
    $id = $_REQUEST['id'];
    $gara=OttieniGara($id);
    $action ='update.php?action=gara&id='.$id ;
}else{
    $action ='insert.php?action=gara';
}
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="<?=$action?>" method="post">
        <label for="luogo">Luogo</label>
        <br>
        <input type="text" id="luogo" name="luogo" placeholder="Luogo" required value="<?= isset($gara['luogo'])?$gara['luogo']:'' ?>">
        <br>
        <label for="data">Data</label>
        <br>
        <input type="date" id="data" name="data" required value="<?= isset($gara['data'])?$gara['data']:'' ?>">
        <br>
        <label for="best_time">Tempo migliore</label>
        <br>
        <input type="text" id="best_time" name="best_time" placeholder="Tempo migliore" required value="<?= isset($gara['tempo_migliore'])?$gara['tempo_migliore']:'' ?>">
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
