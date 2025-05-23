<?php
require_once('DBRepository.php');

class ServiceReaRepository extends DBRepository
{
    // Récuperer la liste des réalisations ou services
    public function getAll(int $etat)
    {
        $sql = "SELECT 
                sr.*,
                u1.nom as created_by_name,
                u2.nom as updated_by_name
            FROM servicereas sr
            LEFT JOIN 
                users u1 ON sr.created_by = u1.id
            LEFT JOIN 
                users u2 ON sr.updated_by = u2.id
            WHERE sr.etat = :etat";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['etat' => $etat]);
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            $etatLabel = $etat = 1 ? 'actives' : 'supprimés';
            $type = 'R' ? 'réalisations' : 'services';
            error_log("Erreur lors de la récuperation des $type $etatLabel" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer la liste des réalisations ou services avec etat et type
    public function getAllByEtatAndType(int $etat, string $type)
    {
        $sql = "SELECT * FROM servicereas WHERE etat = :etat AND type = :type";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['etat' => $etat, 'type' => $type]);
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            $etatLabel = ($etat === 1) ? 'actives' : 'supprimés';
            $labelType = ($type === 'R') ? 'réalisations' : 'services';
            error_log("Erreur lors de la récuperation des $labelType $etatLabel" . $error->getMessage());
            throw $error;
        }
    }

    // Récuperer une réalisation ou service via son id
    public function getServiceReaById(int $id)
    {
        $sql = "SELECT * FROM servicereas WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $statement->fecth(PDO::FETCH_ASSOC) ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de la récuperation de réalisation/service d'id $id" . $error->getMessage());
            throw $error;
        }
    }

    // Ajouter un service ou une réalisation
    public function add($nom, $description, $photo, $type, $createdBy)
    {
        $sql = "INSERT INTO servicereas (nom, description, photo, type, etat, created_at, created_by)
                    VALUES (:nom, :description, :photo, :type, default, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'description' => $description,
                'photo' => $photo,
                'type' => $type,
                'created_by' => $createdBy
            ]);
            return $this->db->lastInsertId() ?: null;

        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout d'une réalisation/serivce $nom" . $error->getMessage());
            throw $error;
        }
    }

    // Modifier un service ou une réalisation
    public function edit($id, $nom, $description, $photo, $type, $updatedBy)
    {
        $sql = "UPDATE servicereas SET nom = :nom, description = :description, 
                photo = :photo, type = :type, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'description' => $description,
                'photo' => $photo,
                'type' => $type,
                'updated_by' => $updatedBy,
                'id' => $id
            ]);
            return $statement->rowCount() >= 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de modification d'une réalisation/serivce $nom" . $error->getMessage());
            throw $error;
        }
    }

    // Désactiver un service ou une réalisation
    public function desactivate($id, $deletedBy)
    {
        $sql = "UPDATE servicereas SET etat = 0, deleted_at = NOW(), deleted_by = :deleted_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'deleted_by' => $deletedBy,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression d'une réalisation/serivce" . $error->getMessage());
            throw $error;
        }
    }

    // Activer un service ou une réalisation
    public function activate($id, $updatedBy)
    {
        $sql = "UPDATE servicereas SET etat = 1, updated_at = NOW(), updated_by = :updated_by WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'updated_by' => $updatedBy,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;

        } catch (PDOException $error) {
            error_log("Erreur lors de la Restauration d'une réalisation/serivce" . $error->getMessage());
            throw $error;
        }
    }

    // Supprimer définitivement une réalisation ou un service
    public function delete(int $id)
    {
        $sql = "DELETE FROM servicereas WHERE id = :id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
            
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression définitivement de la réalisation/service d'id $id" . $error->getMessage());
            throw $error;
        }
    }
}