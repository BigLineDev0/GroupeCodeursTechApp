<?php
require_once('DBRepository.php');

class UserRepository extends DBRepository
{
    // Permet de créer un compte utilisateur
    public function register($nom, $adresse, $telephone, $photo, $email, $password,	$role, $createdBy)
    {
        $sql = "INSERT INTO users (nom, adresse, telephone, photo, email, password, role, etat, created_at, created_by)
                VALUES (:nom, :adresse, :telephone, :photo, :email, :password, :role, default, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            // Crypter le mot de passe
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $statement->execute([
                'nom' => $nom,
                'adresse' => $adresse,
                'telephone' => $telephone,
                'photo' => $photo,
                'email' => $email,
                'password' => $hashPassword,
                'role' => $role,
                'created_by' => $createdBy
            ]);
            $result = $this->db->lastInsertId();
            return $result ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la création de compte utilisateur " . $error->getMessage());
            throw $error;
        }
    }

    // Permet de connecter un utilisateur
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND etat = 1";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['email' => $email]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;

        } catch (PDOException $error) {
            error_log("Erreur lors de la connexion d'un utilisateur  " . $error->getMessage());
            throw $error;
        }
    }

    // Permet de se déconnecter un utilisateur
    public function logout()
    {
        
    }
}