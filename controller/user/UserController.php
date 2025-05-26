<?php
    session_start();

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require_once("../../model/UserRepository.php");
    require_once('../../vendor/autoload.php');

    class UserController
    {
        private $userRepository;

        public function __construct()
        {
            $this->userRepository = new UserRepository();
        }

        // Permet de valider l'email et le password
        public function validateLoginField($email, $password)
        {
            if (empty($email) || empty($password)) {
                return "Tous les champs sont obligatoires.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "L'email fourni est invalide.";
            }

            return null;
        }

        // Permet de faire la gestion des erreurs et redirection
        public function setErrorAndRedirect($message, $title, $redirectUrl = "login")
        {
            $_SESSION['error'] = $message;
            header("Location: $redirectUrl?error=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet de faire la gestion des success et redirection
        public function setSuccessAndRedirect($message, $title, $redirectUrl = "admin")
        {
            $_SESSION['success'] = $message;
            header("Location: $redirectUrl?success=1&message=" . urldecode($message) . "&title=" . urldecode($title));
            exit;
        }

        // Permet d'authentifier le super administrateur
        public function authSuperAdmin($email, $password)
        {
            if ($email === "admin@gmail.com" && $password === "Passer123") {
                $_SESSION['id'] = 1;
                $_SESSION['email'] = $email;
                $_SESSION['nom'] = "Aliou Diallo";
                $_SESSION['etat'] = 1;
                $_SESSION['photo'] = 'default.jpg';

                $this->setSuccessAndRedirect('Bienvenue sur le Dashboard admin', "Connexion réussie");
               
            } 

            return false;
            
        }

        // Permet d'authentifier un administrateur
        public function authAdmin($email, $password, $userRepository)
        {
            $user = $userRepository->login($email, $password);

            if ($user && $user['etat'] == 1){
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['etat'] = $user['etat'];
                $_SESSION['photo'] = $user['photo'];

                if (isset($_POST['edit-user-remember'])) {
                    setcookie('remember_me', $user['id'], time() + 86400 * 30, '/', '', false, true);
                }

                $this->setSuccessAndRedirect('Bienvenue sur le Dashboard admin', "Connexion réussie");
            }
            else{
                $this->setErrorAndRedirect('Votre compte a été désactivé', "Acces non autorité");
            }

            return false;
            
        }

        // Authentification
        public function auth()
        {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $email = trim($_POST['edit-user-email'] ?? '');
                $password = trim($_POST['password'] ?? '');

                $messageError = $this->validateLoginField($email, $password);

                if ($messageError) {
                    $this->setErrorAndRedirect($messageError, "Erreur de connexion");
                }

                // Vérifier si c'est un super administrateur
                if ($this->authSuperAdmin($email, $password)) {
                    exit;
                }

                // Authentication classique des admini via la methode login;
                if (!$this->authAdmin($email, $password, $this->userRepository)) {
                    $this->setErrorAndRedirect("Identifiants incorrects", "Erreur de connexion");
                }
                
            }
        }

        // Permet de se déconnecter un utilisateur
        public function logout()
        {
            session_unset();
            session_destroy();
            if (isset($_COOKIE['remember_me'])) {
                setcookie('remember_me', '', time() - 3000, '/', '', false, true);
            }
            $this->setSuccessAndRedirect('Vous avez été déconnecté avec succès.', "Déconnexion réussie", "home");

        }

        // Permet de generer un mot de passe par defaut
        private function generateDefaultPassword($length = 8)
        {
            $chaine = "abcdefghijklmnopqrstuvwyzABCDEFGHIJKLMNOPQRSTUVWYZ0123456789";
            $chaineLength = strlen($chaine);
            $randomPassword = "";

            for ($i=0; $i < $length; $i++) { 
                $randomPassword .= $chaine[rand(0, $chaineLength - 1)];
            }

            return $randomPassword;
        }

        // Permet d'envoyer un mail contenant les identifiants de connexion(email et password)
        function sendPasswordEmail($email, $password)
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
                $mail->addAddress($email, 'Utilisateur');

                // Contenu du mail
                $mail->isHTML(true);
                $mail->Subject = "Bienvenue sur la plateforme Groupe Codeurs";
                $mail->Body = "
                    <h1>Bienvenue !</h1>
                    <p>Votre compte a été avec succès. Voici vos identifiants:</p>
                    <ul>
                        <li>Email: <strong>{$email}</strong> </li>
                        <li>Mot de passe: <strong>{$password}</strong> </li>
                    </ul>
                    <p>Merci de vous connecter pour commencer.</p>
                ";

                $mail->AltBody = "Bienvenue: Votre comptea été crée. Email: {$email}, Mot de passe {$password}";

                // Envoi de l'email
                $mail->send();
                echo "Email envoyé avec succès à " . $email;

            } catch (Exception $error) {
                echo "erreur lors de l'envoi email {$mail->ErrorInfo}";
            }

        }

        // Permet d'enregistrer un utilisateur
        function registerUser()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // récupearation des données
                $nom = trim($_POST['nom'] ?? '');
                $adresse = trim($_POST['adresse'] ?? '');
                $telephone = trim($_POST['telephone'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $role = trim($_POST['role'] ?? 'Admin');
                $photo = $_FILES['photo'] ?? null;
                $createdBy = $_SESSION['id'] ?? null;

                // Generer le mot de passe par defaut
                $password = $this->generateDefaultPassword();
                // Crypter le mot de passe
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                // Vérifier un user avec cet email existe deja
                if ($this->userRepository->getUserByEmail($email)) {
                    $this->setErrorAndRedirect('Cet email est dejà utilisé.', "Erreur de création de compte.", 'listeUser');
                }

                // Vérifier si tous les champs sont bien remplis
                if (empty($nom) || empty($adresse) || empty($telephone) || empty($email) || empty($photo)) {
                    $this->setErrorAndRedirect('Tous les champs sont obligatoires.', "Erreur de création de compte.", 'listeUser');
                }

                // Validation de l'email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->setErrorAndRedirect("L'email fourni est invalide.", "Erreur de création de compte.", 'listeUser');
                }

                // Validation de la photo
                $photoName = null;
                if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
                    // Récupération de la photo
                    $uploadDir = '../../public/images/users/';
                    $photoName = uniqid() . '_' . basename($photo['name']);
                    $uploadPath = $uploadDir . $photoName;
                }

                // Déplacement de la photo dans servicesRea
                if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                    $this->setErrorAndRedirect("Echec du télécharement de la photo.", "Erreur de création de compte.", 'listeUser');
                }

                // Enregistrement de l'utilisateur
                try {
                    $userId = $this->userRepository->register(
                        $nom, 
                        $adresse, 
                        $telephone, 
                        $photoName, 
                        $email, 
                        $hashPassword,	
                        $role, 
                        $createdBy
                    );
                    if ($userId) {
                        // Envoie mail
                        $message = $role == 'Admin' 
                            ? "Compte crée avec succès. Un mail contenant les identifiants de connexion vous a été envoyé." 
                            : "Compte crée avec succès";
                        if ($role == 'Admin') {
                            $this->sendPasswordEmail($email, $password);
                        }

                       $this->setSuccessAndRedirect($message, "Connexion réussie", 'listeUser');
                    }
                } catch (Exception $error) {
                    $this->setErrorAndRedirect("Erreur ". $error->getMessage(), "Erreur de création de compte.", 'listeUser');
                }

            }
        }

        // Permet de modifier un utilisateur dans la BD
        public function editUser()
        {
            // Permet de recuperer des donnees du formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = intval(trim($_POST['edit-user-id'] ?? ''));
                $nom = trim($_POST['edit-user-nom'] ?? '');
                $adresse = trim($_POST['edit-user-adresse'] ?? '');
                $telephone = trim($_POST['edit-user-telephone'] ?? '');
                $email = trim($_POST['edit-user-email'] ?? '');
                $role = trim($_POST['edit-user-role'] ?? 'Admin');
                $photo = $_FILES['edit-user-photo'] ?? null;
                $updatedBy = $_SESSION['id'] ?? null;

                // Validation des données
                if (empty($nom) || empty($adresse) || empty($telephone) || empty($email) || empty($role)) {
                    $this->setErrorAndRedirect("Tous les champs sont obligatoires.", "Erreur de modification", "listeUser");
                }

                // Validation du role
                if (!in_array($role, ['Admin', 'Equipe'])) {
                    $this->setErrorAndRedirect("Le type selectionné est invalide.", "Erreur de modification");
                }

                // Validation de l'email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->setErrorAndRedirect("L'email fourni est invalide.", "Erreur de création de compte.", 'listeUser');
                }

                // Validation de la photo
                $photoName = null;
                if ($photo) {
                    
                    // Récupération de la photo
                    $uploadDir = '../../public/images/users/';
                    $photoName = uniqid() . '_' . basename($photo['name']);
                    $uploadPath = $uploadDir . $photoName;

                    // Déplacement de la photo dans servicesRea
                    if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
                        $this->setErrorAndRedirect("Echec du télécharement de la photo.", "Erreur de modification", "listeUser");
                    }

                }

                // Si aucune photo n'est choisie conserver l'ancienne photo
                if (!$photoName) {
                    $photoName = trim($photo['current_photo'] ?? '');
                }

                // Appel de la methode edit pour inserer dans la base de données
                try {
                    $reponse =  $this->userRepository->edit($id, $nom, $adresse, $telephone, $photoName, $email, $role, $updatedBy);
                    if ($reponse) {
                        $this->setSuccessAndRedirect("Utilsateur modifié avec succès", "Modification reussie", "listeUser");
                    }
                    else{
                        $this->setErrorAndRedirect("Une erreur est suvenue lors de la modification.", "Erreur de modification", "listeUser");
                    }
                } catch (Exception $e) {
                    $this->setErrorAndRedirect("ERREUR", "Erreur de modification" . $e->getMessage());
                }
            }
        }

        // Permet désactiver un utilisateur
        public function desactivateUser()
        {
            $id = intval($_GET['id']);
            $deletedBy = $_SESSION['id'] ?? null;
            $etatUser = $_SESSION['etat'] ?? null;

            //   Vérifier l'état de l'utiliateur
            if ($etatUser != 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas active.", "Acces non autorité", 'login');
            }

            // Vérifier si le super admin
            if ($id == 1) {
                $this->setErrorAndRedirect("Impossible de supprimer le super admin.", "Action non autorité", 'listeUser');
            }

            // vérification des données
            if (empty($id) || empty($deletedBy)) {
                $this->setErrorAndRedirect("Impossible de désactiver cet utilisateur.", "Informations manquantes", "listeUser");
            }

            // Appelle de la methode desactivate
            try {
                $result = $this->userRepository->desactivate($id, $deletedBy);
                if ($result) {
                    $this->setSuccessAndRedirect("Utilisateur supprimé avec success.", "Suppression reussie", "listeUser");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la suppression", "Erreur de suppression." . $error->getMessage());
            }
        }

        // Permet d'activer un utilisateur
        public function activateUser()
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
                $this->setErrorAndRedirect("Impossible d'activer cet utilisateur.", "Informations manquantes", "listeUser");
            }

            // Appelle de la methode desactivate
            try {
                $result = $this->userRepository->activate($id, $updatedBy);
                if ($result) {
                    $this->setSuccessAndRedirect("Utilisateur restauré avec success.", "Restauration reussie", "listeUser");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la restauration", "Erreur de restauration." . $error->getMessage());
            }
        }

        // Permet de supprimer définitivement un utilisateur
        public function deleteUser()
        {
            $id = intval($_GET['id']);
            $etatUser = $_SESSION['etat'] ?? null;

            //   Vérifier l'état de l'utiliateur
            if ($etatUser != 1) {
                $this->setErrorAndRedirect("Votre compte n'est pas active.", "Acces non autorité", 'login');
            }

            // vérification des données
            if (empty($id)) {
                $this->setErrorAndRedirect("Impossible de supprimer définitivement cette réalisation.", "Informations manquantes", "listeUser");
            }

            // Vérifier si le super admin
            if ($id == 1) {
                $this->setErrorAndRedirect("Impossible de supprimer le super admin.", "Action non autorité", 'listeUser');
            }

            // Appelle de la methode delete
            try {
                $result = $this->userRepository->delete($id);
                if ($result) {
                    $this->setSuccessAndRedirect("Utilisateur supprimé avec success.", "Suppression reussie", "listeUser");
                }
            } catch (Exception $error) {
                $this->setErrorAndRedirect("Erreur lors de la suppression définitive", "Erreur de suppression." . $error->getMessage());
            }
        }
    }
    
?>