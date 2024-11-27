<?php

class CarRepository
{
    public $dbh;

    public function __construct($dbh)
    {
        $this->dbh=$dbh;
    }

    public function getCarAvailable(string $startDate, string $endDate) :array // fonction qui renvoie un tableau des voitures disponibles
    { 
        
    $sql = 'SELECT * FROM Reservations WHERE `status` = "disponible" '; // Demande les véhicules disponibles

    $stmt = $this->dbh->prepare($sql);
    $stmt->bindValue(':date_debut', $startDate);
    $stmt->bindValue(':date_fin', $endDate);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cars = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Tant qu'il y a des lignes à extraire de la base de données sous forme de tableau associatif.
            $cars[] = new Car(
                $row['id_voiture'],
                $row['marque'],
                $row['prix'],
                $row['status']
            );
        }
}


}
?>