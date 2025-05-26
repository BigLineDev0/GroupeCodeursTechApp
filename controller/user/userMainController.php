<?php
    require_once('UserController.php');

    $userController = new UserController();

    // Connexion utilisateur
    if (isset($_POST['frmLogin'])) {
        $userController->auth();
    }

    // Déconnexion utilisateur
    if (isset($_GET['logout'])) {
        $userController->logout();
    }

    // Inscription utilisateur
    if (isset($_POST['frmAddUser'])) {
        $userController->registerUser();
    }

    // Suppression d'un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
        $userController->desactivateUser();
    }

    // Restauration d'un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'restaurer') {
        $userController->activateUser();
    }

    // Suppression definitivement d'un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delelteDef') {
        $userController->deleteUser();
    }

    // Modification d'un utilisateur
    if (isset($_POST['frmEditUser'])) {
        $userController->editUser();
    }
?>