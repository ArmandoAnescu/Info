<?php
$content='data from DB - this is the about page';
require 'header.php';
?>
<div>
    <p><?= /**@var $content*/$content?></p>

</div>
<?php
require 'footer.php';
?>