<script src="js/sweetalert.min.js"></script>
<?php include_once "db_connection.php";?>
<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
        ?>
        <script>
            swal({
                title:"<?php echo $_SESSION['status']; ?>",
                icon:"<?php echo $_SESSION['status_code']; ?>",
                button:"OK",
            });
        </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
    }
?>