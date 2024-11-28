<?php
class CarsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
            public function getAvailableCars(string $startDate, string $endDate): array
{
    $query = "
        SELECT v.id_voiture, v.marque, v.image_path, v.prix, d.date_debut, d.date_fin, d.statut
        FROM Voitures v
        LEFT JOIN Disponibilites d ON v.id_voiture = d.id_voiture
    ";
    $stmt = $this->dbh->prepare($query);
    $stmt->execute();
    $carsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $uniqueCars = []; // Tableau pour stocker les voitures uniques

    foreach ($carsData as $carData) {
        $reservedStartDate = $carData['date_debut'] ?? null;
        $reservedEndDate = $carData['date_fin'] ?? null;

        if (
            $reservedStartDate !== null &&
            $reservedEndDate !== null &&
            (
                strtotime($startDate) <= strtotime($reservedEndDate) &&
                strtotime($endDate) >= strtotime($reservedStartDate)
            )
        ) {
            continue;
        }

        // Assurer l'unicité en utilisant l'id_voiture comme clé
        if (!isset($uniqueCars[$carData['id_voiture']])) {
            $car = new CarModel();
            $car->setId($carData['id_voiture'])
                ->setMarque($carData['marque'])
                ->setPrix($carData['prix'])
                ->setImagePath($carData['image_path']);
            $uniqueCars[$carData['id_voiture']] = $car;
        }
    }

    // Retourner uniquement les voitures uniques
    return array_values($uniqueCars);
}
        public function calculatePrice(int $carId, string $startDate, string $endDate): ?float
        {
            $query = "SELECT prix FROM Voitures WHERE id_voiture = :id";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $carId, PDO::PARAM_INT);
            $stmt->execute();
            $car = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$car) {
                return null;
            }
    
            $start = new DateTime($startDate);
            $end = new DateTime($endDate);
            $interval = $start->diff($end)->days + 1;
    
            $pricePerDay = (float)$car['prix'];
            return $pricePerDay * $interval;
        }
    
        public function getCarById(int $carId): ?CarModel
        {
            $query = "SELECT * FROM Voitures WHERE id_voiture = :id";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $carId, PDO::PARAM_INT);
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
    
