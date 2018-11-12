<!DOCTYPE html>
<html lang="fr">
    <?php
    include('Web/inc/forAllPages/head.php');
    ?>
        <body id="page-top">
            
            <!-- Navigation -->
            <?php
            include('Web/inc/forAllPages/menuPages.php');
            ?>

            <!-- Header -->
            <?php
            include('Web/inc/forAllPages/headerPages.php');
            ?>

            <?= $contentTemplate ?>
            
            <!-- Footer Write  -->
             <?php
            include('Web/inc/forAllPages/footer.php');
            ?>

            <!-- script -->
            <?php
            include('Web/inc/forAllPages/script.php');
            ?>

            <!-- script tinyMCE -->
            <?php
            include('Web/incAdmin/writeAdminViewInc/scriptPlusTinyMCEAdmin.php');
            ?>
        </body>
</html>
