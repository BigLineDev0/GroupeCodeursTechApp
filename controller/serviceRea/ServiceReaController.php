<?php
session_start();
require_once("../../model/ServiceReaRepository.php");

class ServiceReaController
{
    private $serviceReaRepository;

    public function __construct()
    {
        $this->serviceReaRepository = new ServiceReaRepository();
    }

    // Permet de faire la gestion des erreurs et redirection
    public function setErrorAndRedirect($message, $title, $redirectUrl = "listeServiceRea")
    {
        $_SESSION['error'] = $message;
        header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    // Permet de faire la gestion des success et redirection
    public function setSuccessAndRedirect($message, $title, $redirectUrl = "listeServiceRea")
    {
        $_SESSION['success'] = $message;
        header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
        exit;
    }

    // Permet d'ajouter une nouvelle service dans la BD
    public function addServiceRea()
    {
        // Permet de recuperer des donnees du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $photo = $_FILES['photo'] ?? null;
            $type = trim($_POST['type'] ?? '');
            $createdBy = $_SESSION['id'] ?? null;

            // Validation des données
            if (empty($nom) || empty($description) || empty($type) || !$photo) {
                $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur d'ajout");
            }

            // Validation du type
            if (!in_array($type, ['R', 'S'])) {
                $this->setErrorAndRedirect("Le type selectionné est invalide.", "Erreur d'ajout");
            }

            // Validation de la photo
            if ($photo['error'] !== UPLOAD_ERR_OK) {
                $this->setErrorAndRedirect("Une erreur est surveue lors du téléchargement de la photo.", "Erreur d'ajout");
            }

            // Récupération de la photo
            $uploadDir = '../../public/images/servicesRea/';
            $photoName = uniqid() . '_' . basename($photo['name']);
            $uploadPath = $uploadDir . $photoName;

            // Déplacement de la photo dans servicesRea
            if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                $this->setErrorAndRedirect("Echec du télécharement de la photo.", "Erreur d'ajout");
            }

            // Appel de la methode add pour inserer dans la base de données
            try {
                $reponse =  $this->serviceReaRepository->add($nom, $description, $photoName, $type, $createdBy);
                if ($reponse) {
                    $msg = $type = 'R' ? 'Réalisation ajoutée avec succès.' : 'Service ajouté avec succès.';
                    $this->setSuccessAndRedirect($msg, "Ajout reussie");
                }
                else{
                    $this->setErrorAndRedirect("Une erreur est suvenue lors de l'ajout.", "Erreur d'ajout");
                }
            } catch (Exception $e) {
                $this->setErrorAndRedirect("ERREUR", "Erreur d'ajout" . $e->getMessage());
            }
        }
    }

    // Permet de modifier un service/réalisation dans la BD
    public function editServiceRea()
    {
        // Permet de recuperer des donnees du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = intval(trim($_POST['edit-id'] ?? ''));
            $nom = trim($_POST['edit-nom'] ?? '');
            $description = trim($_POST['edit-description'] ?? '');
            $photo = $_FILES['edit-photo'] ?? null;
            $type = trim($_POST['edit-type'] ?? '');
            $updatedBy = $_SESSION['id'] ?? null;

            // Validation des données
            if (empty($nom) || empty($description) || empty($type)) {
                $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification");
            }

            // Validation du type
            if (!in_array($type, ['R', 'S'])) {
                $this->setErrorAndRedirect("Le type selectionné est invalide.", "Erreur de modification");
            }

            // Validation de la photo
            $photoName = null;
            if ($photo) {
                
                // Récupération de la photo
                $uploadDir = '../../public/images/servicesRea/';
                $photoName = uniqid() . '_' . basename($photo['name']);
                $uploadPath = $uploadDir . $photoName;

                // Déplacement de la photo dans servicesRea
                if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                    $this->setErrorAndRedirect("Echec du télécharement de la photo.", "Erreur de modification");
                }

            }

            // Si aucune photo n'est choisie conserver l'ancienne photo
            if (!$photoName) {
                $photoName = trim($photo['current_photo'] ?? '');
            }

            // Appel de la methode edit pour inserer dans la base de données
            try {
                $reponse =  $this->serviceReaRepository->edit($id, $nom, $description, $photoName, $type, $updatedBy);
                if ($reponse) {
                    $msg = $type = 'R' ? 'Réalisation modifiée avec succès.' : 'Service modifié avec succès.';
                    $this->setSuccessAndRedirect($msg, "Modification reussie");
                }
                else{
                    $this->setErrorAndRedirect("Une erreur est suvenue lors de la modification.", "Erreur de modification");
                }
            } catch (Exception $e) {
                $this->setErrorAndRedirect("ERREUR", "Erreur de modification" . $e->getMessage());
            }
        }
    }

    // Permet désactiver un service/réalisation
    public function desactivateServiceRea()
    {
        $id = intval($_GET['id']);
        $deletedBy = $_SESSION['id'] ?? null;
        $etatUser = $_SESSION['etat'] ?? null;

        //   Vérifier l'état de l'utiliateur
        if ($etatUser != 1) {
            $this->setErrorAndRedirect("Votre compte n'est pas active.", "Acces non autorité", 'login');
        }

        // vérification des données
        if (empty($id) || empty($deletedBy)) {
            $this->setErrorAndRedirect("Impossible de désactiver cette réalisation.", "Informations manquantes");
        }

        // Appelle de la methode desactivate
        try {
            $result = $this->serviceReaRepository->desactivate($id, $deletedBy);
            if ($result) {
                $this->setSuccessAndRedirect("Réalisation/Service supprimé(e) avec success.", "Suppression reussie");
            }
        } catch (Exception $error) {
            $this->setErrorAndRedirect("Erreur lors de la suppression", "Erreur de suppression." . $error->getMessage());
        }
    }

    // Permet d'activer un service/réalisation
    public function activateServiceRea()
    {
        $id = intval($_GET['id']);
        $updatedBy = $_SESSION['id'] ?? null;
        $etatUser = $_SESSION['etat'] ?? null;

        //   Vérifier l'état de l'utiliateur
        if ($etatUser != 1) {
            $this->setErrorAndRedirect("Votre compte n'est pas active.", "Acces non autorité", 'login');
        }

        // vérification des données
        if (empty($id) || empty($updatedBy)) {
            $this->setErrorAndRedirect("Impossible d'activer cette réalisation.", "Informations manquantes");
        }

        // Appelle de la methode desactivate
        try {
            $result = $this->serviceReaRepository->activate($id, $updatedBy);
            if ($result) {
                $this->setSuccessAndRedirect("Réalisation/Service restauré(e) avec success.", "Restauration reussie");
            }
        } catch (Exception $error) {
            $this->setErrorAndRedirect("Erreur lors de la restauration", "Erreur de restauration." . $error->getMessage());
        }
    }

    // Permet de supprimer définitivement un service/réalisation
    public function deleteServiceRea()
    {
        $id = intval($_GET['id']);
        $etatUser = $_SESSION['etat'] ?? null;

        //   Vérifier l'état de l'utiliateur
        if ($etatUser != 1) {
            $this->setErrorAndRedirect("Votre compte n'est pas active.", "Acces non autorité", 'login');
        }

        // vérification des données
        if (empty($id)) {
            $this->setErrorAndRedirect("Impossible de supprimer définitivement cette réalisation.", "Informations manquantes");
        }

        // Appelle de la methode delete
        try {
            $result = $this->serviceReaRepository->delete($id);
            if ($result) {
                $this->setSuccessAndRedirect("Réalisation/Service supprimé(e) avec success.", "Suppression reussie");
            }
        } catch (Exception $error) {
            $this->setErrorAndRedirect("Erreur lors de la suppression définitive", "Erreur de suppression." . $error->getMessage());
        }
    }


}