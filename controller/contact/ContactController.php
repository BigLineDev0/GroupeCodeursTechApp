<?php
session_start();
require_once("../../model/ContactRepository.php");

class ContactController
{
    private $contactRepository;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
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

    // Permet d'ajouter une nouveau contact dans la BD
    public function addContact()
    {
        // Permet de recuperer des donnees du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = trim($_POST['nom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $sujet = trim($_POST['sujet'] ?? '');
            $message = trim($_POST['message'] ?? '');

            // Validation des données
            if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
                $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Message non envoyé");
            }

            // Validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setErrorAndRedirect("L'adresse email n'est pas valide.", "Message non envoyé");
            }

            // Appel de la methode add pour inserer dans la base de données
            try {
                $reponse =  $this->contactRepository->add($nom, $email, $sujet, $message);
                if ($reponse) {

                    $this->setSuccessAndRedirect("Votre message a été envoyé avec succès.", "Envoie reussie");
                } else {
                    $this->setErrorAndRedirect("Une erreur est suvenue lors de l'envoi du message.", "Message non envoyé");
                }
            } catch (Exception $e) {
                $this->setErrorAndRedirect("ERREUR", "Erreur d'envoie" . $e->getMessage());
            }
        }
    }
}
