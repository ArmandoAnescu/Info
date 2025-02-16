<?php
require 'header.php';
require 'connection.php';
if(isset($_REQUEST['action'])&& $_REQUEST['action']==='update'){
    $oldNum = $_REQUEST['num'];
    $pilota=OttieniPilota($oldNum);
    $action ='update.php?action=pilota&oldNum='.$oldNum;
}else{
    $action ='insert.php?action=pilota';
}
?>
<div class="container mt-5 pt-5">
    <button id="return"><i class="bi bi-arrow-left"></i></button>
    <form action="<?=$action?>" method="post">
        <label for="name">Inserisci il nome:</label>
        <br>
        <input required type="text" name="name" id="name" value="<?= isset($pilota['nome'])?$pilota['nome']:''?>">
        <br>
        <label for="lname">Inserisci il cognome:</label>
        <br>
        <input required type="text" name="lname" id="lname" value="<?= isset($pilota['cognome'])?$pilota['cognome']:''?>">
        <br>
        <label for="number">Inserisci il numero:</label>
        <br>
        <input required type="number" min="1" max="99" name="number" id="number" value="<?= isset($pilota['numero'])?$pilota['numero']:''?>">
        <br>
        <label for="nationality">Inserisci la nazionalità:</label>
        <br>
        <input required type="text" name="nationality" id="nationality" value="<?= isset($pilota['nazionalita'])?$pilota['nazionalita']:''?>">
        <br>
        <label for="casa">inserisci la casa</label>
        <br>
        <select required name="casa" id="casa">
            <?php
            $case=RitornaSquadre();
            if($case){//controllo che gli user esistano altrimenti dico che non ho trovato nulla
                foreach($case as $casa){?>
            <option value="<?=$casa['nome_casa']?>" <?=(isset($pilota)&&$pilota['nome_casa']===$casa['nome_casa'])?'selected':''?>> <?=$casa['nome_casa']?></option>
                <?php
                }
            }else{ ?>
            <option>Nessuna casa trovata</option>
            <?php
            }?>
        </select>
        <br>
        <button id="submit" type="submit">Inserisci</button>
    </form>
</div>
<?php
require 'footer.php'
?>
