<?php
   
    require_once('ServiceReaController.php');

    $serviceReaController = new ServiceReaController();

    // Ajout d'un service/réalisation
    if (isset($_POST['frmAddServiceRea'])) {
        $serviceReaController->addServiceRea();
    }

    // Suppression d'un service/réalisation
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delete') {
        $serviceReaController->desactivateServiceRea();
    }

    // Restauration d'un service/réalisation
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'restaurer') {
        $serviceReaController->activateServiceRea();
    }

    // Suppression definitivement d'un service/réalisation
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'], $_GET['action']) && $_GET['action'] === 'delelteDef') {
        $serviceReaController->deleteServiceRea();
    }

    // Modification d'un service/réalisation
    if (isset($_POST['frmEditServiceRea'])) {
        $serviceReaController->editServiceRea();
    }
?>