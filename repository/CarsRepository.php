<?php

class CarsRepository
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
    if ($stmt->execute()){
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cars;
    } else {
        return [];
    }
}


}
?>