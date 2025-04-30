<?php
    session_start();
    require_once("../../model/UserRepository.php");

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

                $this->setSuccessAndRedirect('Bienvenue sur le Dashboard admin', "Connexion réussie");
               
            } 

            return false;
            
        }

        // Permet d'authentifier un administrateur
        public function authAdmin($email, $password, $userRepository)
        {
            $user = $userRepository->login($email, $password);

            if ($user && $user == 1){
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['etat'] = $user['etat'];

                if (isset($_POST['remember'])) {
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

                $email = trim($_POST['email'] ?? '');
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
    }
?>