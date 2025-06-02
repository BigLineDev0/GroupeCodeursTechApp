<?php
require_once('DBRepository.php');

class ContactRepository extends DBRepository
{
    // Récuperer la liste des contacts
    public function getAll()
    {
        $sql = "SELECT * FROM contacts";

        try {
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation des contacts" . $error->getMessage());
            throw $error;
        }
    }

    // Ajouter un nouvel contact
    public function add($nom, $email, $sujet, $message)
    {
        $sql = "INSERT INTO contacts (nom, email, sujet, message, created_at)
                    VALUES (:nom, :email, :sujet, :message, NOW())";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'email' => $email,
                'sujet' => $sujet,
                'message' => $message
            ]);
            return $this->db->lastInsertId() ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout d'un contact" . $error->getMessage());
            throw $error;
        }
    }
}