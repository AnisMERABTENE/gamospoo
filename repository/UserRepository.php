<?php

class UserRepository
{
    public $dbh;

    public function __construct($dbh) 
    {
        $this->dbh=$dbh;
    }

      public function recupUserBdd(string $email):array|bool
    {
      
      $query = "SELECT * from utilisateurs where email=:email";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      
      return $stmt->fetch(PDO::FETCH_ASSOC);
      
    }
    
     
    public function addUserBdd(string $email, ?string $prenom, string $hashedPassword): bool
{
    // Si le prénom est vide, extraire la partie avant le '@' de l'email
    if (empty($prenom)) {
        $prenom = explode('@', $email)[0];
    }

    $query = "INSERT INTO utilisateurs (prenom, email, mot_de_passe, role) 
              VALUES (:prenom, :email, :mot_de_passe, :role)";
    $stmt = $this->dbh->prepare($query);

    // Associer les valeurs aux paramètres
    $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':role', 'utilisateur', PDO::PARAM_STR);

    // Exécuter la requête et retourner le résultat
    return $stmt->execute();
}

    public function updateUserBdd(string $prenom, string $email, int $userId):bool
    {
    $query = "UPDATE utilisateurs SET prenom=:prenom,email=:email WHERE id_utilisateur=:userId";
    $stmt = $this->dbh->prepare($query);
    $stmt->bindParam(':prenom',$prenom, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

    $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;  
      } else {
        return false; 
      }

    }

    public function deleteReservationsUser($userId)
    {
      $query = "DELETE FROM reservations WHERE id_utilisateur=:userId";
      $stmt=$this->dbh->prepare($query);
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

      return $stmt->execute();
    }

    public function delateUserBdd($userId)
    {
      $this->deleteReservationsUser($userId);
      
      $query = "DELETE FROM utilisateurs WHERE id_utilisateur=:userId";
      $stmt=$this->dbh->prepare($query);
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

      return $stmt->execute();
    }

   
  
}