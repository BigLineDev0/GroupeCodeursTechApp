<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

session_start();
require_once("../../model/NewsletterRepository.php");
require_once('../../vendor/autoload.php');

class NewsletterController
{
    private $newsletterRepository;

    public function __construct()
    {
        $this->newsletterRepository = new NewsletterRepository();
    }

    // Permet de faire la gestion des erreurs et redirection
    public function setErrorAndRedirect($message, $title, $redirectUrl = "home")
    {
        $_SESSION['error'] = $message;
        header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    // Permet de faire la gestion des success et redirection
    public function setSuccessAndRedirect($message, $title, $redirectUrl = "home")
    {
        $_SESSION['success'] = $message;
        header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    // Permet d'ajouter une nouveau Newsletter dans la BD
    public function add()
    {
        // Permet de recuperer des donnees du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
           
            // Validation des données
            if (empty($email)) {
                $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'inscrition");
            }

            // Validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setErrorAndRedirect("L'adresse email n'est pas valide.", "Erreur d'inscrition");
            }

            // Appel de la methode add pour inserer dans la base de données
            try {
                $reponse =  $this->newsletterRepository->add($email);
                if ($reponse) {

                    $this->setSuccessAndRedirect("Vous recevrez toutes nos nouvelles par mail.", "Inscription reussie");
                } else {
                    $this->setErrorAndRedirect("Une erreur est suvenue lors de l'inscription.", "Erreur d'inscrition");
                }
            } catch (Exception $e) {
                $this->setErrorAndRedirect("ERREUR", "Erreur d'inscription" . $e->getMessage());
            }
        }
    }

    // Permet d'envoyer un mail aux abonnés à notre newsletter
        function sendMessageNewsletter($email, $message)
        {
            $mail = new PHPMailer(true);

            try {
                // configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = 'd9381bb728147e';
                $mail->Password = '8853b74892f67c';
                $mail->Port = 2525;

                // Expediteur et destinataire
                $mail->setFrom('no-reply@groupecodeur.com', 'Groupe Codeurs');
                $mail->addAddress($email, 'Inscription à la Newsletter');

                // Contenu du mail
                $mail->isHTML(true);
                $mail->Subject = "Information sur plateforme Groupe Codeurs";
                $mail->Body = "
                    <h1>Bienvenue $email</h1>
                    <p>$message</p>
                    <p>Merci pour votre fidélité.</p>
                ";

                // Envoi de l'email
                $mail->send();

            } catch (Exception $error) {
                echo "erreur lors de l'envoi de l'email {$mail->ErrorInfo}";
            }

        }
}
