<?php
    require_once('UserController.php');

    $userController = new UserController();

    if (isset($_POST['frmLogin'])) {
        $userController->auth();
    }

    if (isset($_GET['logout'])) {
        $userController->logout();
    }
?>