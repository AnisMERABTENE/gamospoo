<?php

class ReserveController
{
    private $reservationsRepository;

    public function __construct($dbh)
    {
        $this->reservationsRepository = new ReservationsRepository($dbh);
    }

    public function home()
    {
        // Vérifier si l'utilisateur est connecté
        $userId = $_SESSION['userId'] ?? null;
        if (!$userId) {
            $_SESSION['error'] = "Veuillez vous connecter pour effectuer une réservation.";
            header("Location: /Login");
            exit;
        }

        // Récupérer les données envoyées depuis le formulaire
        $carId = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
        $startDate = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
        $endDate = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);
        $insurance = isset($_POST['insurance']) && $_POST['insurance'] === 'on'; // Checkbox "Assurance"

        if (!$carId || !$startDate || !$endDate) {
            $_SESSION['error'] = "Données manquantes pour effectuer la réservation.";
            header("Location: /cars/page?id=$carId");
            exit;
        }

        // Calculer le prix total
        $basePrice = $this->reservationsRepository->calculatePrice($carId, $startDate, $endDate);
        $totalPrice = $insurance ? $basePrice + 10 : $basePrice;

        try {
            // Ajouter la réservation
            $this->reservationsRepository->addReservation($userId, $carId, $startDate, $endDate, $totalPrice);

            // Ajouter la disponibilité pour le véhicule
            $this->reservationsRepository->addDisponibilites($carId, $startDate, $endDate);

            // Rediriger vers la vue des réservations
            $_SESSION['success'] = "Réservation effectuée avec succès.";
            header("Location: /mesreservations");
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur lors de la réservation : " . $e->getMessage();
            header("Location: /cars/page?id=$carId");
            exit;
        }
    }
}
