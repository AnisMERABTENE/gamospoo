<?php

require_once __DIR__ . '/../models/CarModel.php';

class AdminCarsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    // Récupérer toutes les voitures
    public function getAllCars(): array
    {
        $query = "SELECT * FROM Voitures";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        $carsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($carsData === false) {
            return []; // Retourner un tableau vide si aucune donnée n'est trouvée
        }

        $cars = [];
        foreach ($carsData as $carData) {
            $car = new CarModel();
            $car->setId((int)$carData['id_voiture'])
                ->setMarque(htmlspecialchars($carData['marque'], ENT_QUOTES, 'UTF-8'))
                ->setPrix((float)$carData['prix'])
                ->setImagePath(htmlspecialchars($carData['image_path'] ?? '', ENT_QUOTES, 'UTF-8'));
            $cars[] = $car;
        }

        return $cars;
    }

    // Ajouter une voiture
    public function addCar(CarModel $car)
    {
        $query = "INSERT INTO Voitures (marque, image_path, prix) VALUES (:marque, :image_path, :prix)";
        $stmt = $this->dbh->prepare($query);

        // Validation et sécurisation des paramètres
        $stmt->bindValue(':marque', htmlspecialchars($car->getMarque(), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(':image_path', htmlspecialchars($car->getImagePath(), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(':prix', filter_var($car->getPrix(), FILTER_VALIDATE_FLOAT), PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'ajout de la voiture.");
        }
    }

    // Supprimer une voiture
    public function deleteCar(int $carId)
    {
        if ($carId <= 0) {
            throw new InvalidArgumentException("ID de voiture invalide.");
        }

        $query = "DELETE FROM Voitures WHERE id_voiture = :id_voiture";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':id_voiture', $carId, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la suppression de la voiture.");
        }
    }

    // Modifier une voiture
    public function editCar(CarModel $car)
    {
        $query = "UPDATE Voitures SET marque = :marque, prix = :prix, image_path = :image_path WHERE id_voiture = :id_voiture";
        $stmt = $this->dbh->prepare($query);

        // Validation et sécurisation des paramètres
        $stmt->bindValue(':marque', htmlspecialchars($car->getMarque(), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(':prix', filter_var($car->getPrix(), FILTER_VALIDATE_FLOAT), PDO::PARAM_STR);
        $stmt->bindValue(':image_path', htmlspecialchars($car->getImagePath(), ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(':id_voiture', (int)$car->getId(), PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la modification de la voiture.");
        }
    }
}
