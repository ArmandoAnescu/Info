<?php
require 'header.php';
require 'connection.php';
if(isset($_REQUEST['action'])&& $_REQUEST['action']==='update'){
    $id = $_REQUEST['nome_liv'];
    $casa=OttieniCasa($id);
    $action ='update.php?action=casa&oldName='.$casa['nome_casa'] ;
}else{
    $action ='insert.php?action=casa';
}

?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="<?=$action?>" method="post">
        <label for="name">Inserisci il nome della livrea:</label>
        <br>
        <input type="text" name="name" id="name" required value="<?=isset($casa['nome_casa'])?$casa['nome_casa']:''?>">
        <br>
        <label for="lname">Inserisci il colore della livrea:</label>
        <br>
        <input type="text" name="color" id="color" required value="<?=isset($casa['livrea'])?$casa['livrea']:''?>">
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
