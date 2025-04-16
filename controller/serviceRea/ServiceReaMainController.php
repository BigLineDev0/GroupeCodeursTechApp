<?php
   
    require_once('ServiceReaController.php');

    $serviceReaController = new ServiceReaController();

    // Ajout d'un service/réalisation
    if (isset($_POST['frmAddServiceRea'])) {
        $serviceReaController->addServiceRea();
    }

    // suppression d'un service/réalisation
    if ($_SERVER['REQUEST_METHOD'] === 'GET' 
        && isset($_GET['id'], $_GET['action']) 
        && $_GET['action'] === 'delete'
        ) {
        $serviceReaController->desactivateServiceRea();
    }
?>