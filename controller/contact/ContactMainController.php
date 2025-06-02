<?php
   
    require_once('ContactController.php');

    $contactController = new ContactController();

    // Ajout d'un nouveau contact
    if (isset($_POST['frmAddContact'])) {
        $contactController->addContact();
    }