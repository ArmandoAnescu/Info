<?php
include 'components/header.php';
?>
<main class="flex-shrink-0">
    <div class="container mt-5 pt-5">
        <?php
        if($_SESSION['user']['access']==='docente'){
            echo "buongiorno prof";
        }
        ?>
    </div>
</main>
<?php
include 'components/footer.php';