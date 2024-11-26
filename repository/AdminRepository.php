<?php

class AdminRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    // Récupérer les utilisateurs normaux
    public function getNormalUsers()
    {
        $query = "SELECT id_utilisateur, email, role FROM utilisateurs WHERE role = 'utilisateur'";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les administrateurs
    public function getAdminUsers()
    {
        $query = "SELECT id_utilisateur, email, role FROM utilisateurs WHERE role = 'admin'";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour le rôle d'un utilisateur
    public function updateUserRole($userId, $newRole)
    {
        $query = "UPDATE utilisateurs SET role = :role WHERE id_utilisateur = :userId";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':role', $newRole, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un utilisateur
    public function deleteUser($userId)
    {
        $query = "DELETE FROM utilisateurs WHERE id_utilisateur = :userId";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
