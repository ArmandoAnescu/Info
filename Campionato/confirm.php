<?php
$message=$_REQUEST['msg'];
require 'header.php';
?>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <?= $message?>
        </div>
    </div>
<?php
require 'footer.php';
?>