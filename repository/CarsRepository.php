<?php

class CarsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    // Récupérer les voitures disponibles pour une plage horaire donnée
    public function getAvailableCars(string $start_date, string $end_date): array
    {
        $query = "
            SELECT v.* 
            FROM Voitures v
            LEFT JOIN Disponibilites d ON v.id_voiture = d.id_voiture
            WHERE (d.date_debut > :end_date OR d.date_fin < :start_date OR d.statut = 'disponible')
               OR d.id_voiture IS NULL
        ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        $carsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cars = [];

        foreach ($carsData as $carData) {
            $car = new CarModel();
            $car->setId($carData['id_voiture'])
                ->setMarque($carData['marque'])
                ->setPrix($carData['prix'])
                ->setImagePath($carData['image_path']);
            $cars[] = $car;
        }

        return $cars;
    }

    // Récupérer une voiture par son ID
    public function getCarById(int $carId): ?CarModel
    {
        $query = "SELECT * FROM Voitures WHERE id_voiture = :id_voiture";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':id_voiture', $carId, PDO::PARAM_INT);
        $stmt->execute();

        $carData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($carData) {
            $car = new CarModel();
            $car->setId($carData['id_voiture'])
                ->setMarque($carData['marque'])
                ->setPrix($carData['prix'])
                ->setImagePath($carData['image_path']);
            return $car;
        }

        return null;
    }
}
