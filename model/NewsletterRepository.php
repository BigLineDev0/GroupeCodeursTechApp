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
}