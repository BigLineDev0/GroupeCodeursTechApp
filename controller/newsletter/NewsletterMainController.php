<?php
   
    require_once('NewsletterController.php');

    $newsletterController = new NewsletterController();
    $newsletterRepository = new NewsletterRepository();

    // Ajout d'un nouveau contact
    if (isset($_POST['frmAddNewsletter'])) {
        $newsletterController->add();
    }

    // Envoi mail aux abonnées
    if (isset($_POST['frmSendMessage'])) {

        $message = trim($_POST['message']);
        $listeNewsletters = $newsletterRepository->getAll();
        
        // verifier s'il y a des abonnés
        if (empty($listeNewsletters)) {
            $message = "Aucun d'abonné trouvé dans la base de données.";
            $_SESSION['error'] = $message;
            header("Location: listeNewsletter?error=1&message=" . urldecode($message) . "&title=" . "Newsletter");
            exit;
        }
        
        // envoi mail groupé 
        foreach ($listeNewsletters as $newsletter) {
            $newsletterController->sendMessageMail($newsletter['email'], $message);
        }

        $messageSucess = "Message envoyé avec succès.";
        header("Location: listeNewsletter?success=1&message=" . urldecode($messageSucess) . "&title=" . "Newsletter");
        exit;
    }