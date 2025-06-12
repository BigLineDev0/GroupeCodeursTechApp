<?php
require_once('DBRepository.php');

class UserRepository extends DBRepository
{
    // Permet de créer un compte utilisateur
    public function register($nom, $adresse, $telephone, $photo, $email, $password, $role, $createdBy)
    {
        $sql = "INSERT INTO users (nom, adresse, telephone, photo, email, password, role, etat, created_at, created_by)
                VALUES (:nom, :adresse, :telephone, :photo, :email, :password, :role, default, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
        
            $statement->execute([
                'nom' => $nom,
                'adresse' => $adresse,
                'telephone' => $telephone,
                'photo' => $photo,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'created_by' => $createdBy
            ]);
            return $this->db->lastInsertId() ?: null;
            
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

    // Récuperer la liste des utilisateurs
    public function getAll(int $etat, $role = null)
    {
        $sql = "SELECT 
                u.*,
                u1.nom as created_by_name,
                u1.nom as updated_by_name
            FROM users u
            LEFT JOIN 
                users u1 ON u.created_by = u1.id
            LEFT JOIN 
                users u2 ON u.updated_by = u2.id
            WHERE u.etat = :etat";

            if ($role) {
               $sql .= "AND role = :role";
            }

        try {
            $statement = $this->db->prepare($sql);
            $params = ['etat' => $etat];

            if ($role) {
                $params['role'] = $role;
            }
            
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            $etatLabel = $etat = 1 ? 'actives' : 'supprimés';
            error_log("Erreur lors de la récuperation des utilisateurs $etatLabel" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer la liste des utilisateurs avec etat et role
    public function getAllByEtatAndRole(int $etat, string $role)
    {
        $sql = "SELECT * FROM users WHERE etat = :etat AND role = :role";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['etat' => $etat, 'role' => $role]);
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            $etatLabel = ($etat === 1) ? 'actives' : 'supprimés';
        
            error_log("Erreur lors de la récuperation des utilisateurs $etatLabel" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer un utilisateur via son id
    public function getById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation del'utilisateur d'id $id" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer un utilisateur via son email
    public function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation del'utilisateur d'email $email" . $error->getMessage());
            throw $error;
        }
    }

    // Modifier un utilisateur
    public function edit($id, $nom, $adresse, $telephone, $photo, $email, $role, $updatedBy)
    {
        $sql = "UPDATE users SET nom = :nom, adresse = :adresse, telephone = :telephone,
                photo = :photo, email = :email, 
                role = :role, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'adresse' => $adresse,
                'telephone' => $telephone,
                'photo' => $photo,
                'email' => $email,
                'role' => $role,
                'updated_by' => $updatedBy,
                'id' => $id
            ]);
            $rowAffected = $statement->rowCount();
            return $rowAffected >= 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de modification d'un utilisateur $nom" . $error->getMessage());
            throw $error;
        }
    }

    // Désactiver un utilisateur
    public function desactivate($id, $deletedBy)
    {
        $sql = "UPDATE users SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'deleted_by' => $deletedBy,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression d'un utilisateur" . $error->getMessage());
            throw $error;
        }
    }

    // Activer un utilisateur
    public function activate($id, $updatedBy)
    {
        $sql = "UPDATE users SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'updated_by' => $updatedBy,
                'id' => $id
            ]);
            return  $statement->rowCount() > 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de l'activation l'utlisateur" . $error->getMessage());
            throw $error;
        }
    }

    // Supprimer définitivement un utilisateur
    public function delete(int $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression définitivement de l'utilisateur d'id $id" . $error->getMessage());
            throw $error;
        }
    }

    // Modification du mot de passe
    public function updatePassword($id, $password)
    {
        $sql = "UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id";

        try {
            
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'password' => $password,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification du mot de passe de l'utilisateur d'id $id : " . $error->getMessage());
            throw $error;
        }
    }
}