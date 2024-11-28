<?php

class ReservationsRepository
{
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function calculatePrice(int $carId, string $startDate, string $endDate): float
    {
        $query = "SELECT prix FROM Voitures WHERE id_voiture = :carId";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            throw new Exception("Voiture introuvable.");
        }

        $days = (new DateTime($startDate))->diff(new DateTime($endDate))->days + 1;
        return $car['prix'] * $days;
    }

    public function addReservation(int $userId, int $carId, string $startDate, string $endDate, float $totalPrice)
    {
        $query = "
            INSERT INTO Reservations (id_utilisateur, id_voiture, date_debut, date_fin, prix_total)
            VALUES (:userId, :carId, :startDate, :endDate, :totalPrice)
        ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addDisponibilites(int $carId, string $startDate, string $endDate)
    {
        $query = "
            INSERT INTO Disponibilites (id_voiture, date_debut, date_fin, statut)
            VALUES (:carId, :startDate, :endDate, 'reserve')
        ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();
    }
}
