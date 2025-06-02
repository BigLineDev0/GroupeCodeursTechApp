<?php
require_once('DBRepository.php');

class NewsletterRepository extends DBRepository
{
    // Récuperer la liste des newsletters
    public function getAll()
    {
        $sql = "SELECT * FROM newsletters";

        try {
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation des newsletters" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer un utilisateur via son email
    public function getByEmail(string $email)
    {
        $sql = "SELECT * FROM newsletters WHERE email = :email";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation de la newsletters de l'email $email" . $error->getMessage());
            throw $error;
        }
    }

    // Ajouter une nouvelle newsletters
    public function add($email)
    {
        $sql = "INSERT INTO newsletters (email, created_at) VALUES (:email, NOW())";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['email' => $email]);
            return $this->db->lastInsertId() ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout d'un contact" . $error->getMessage());
            throw $error;
        }
    }
}