<?php


class CarsController
{
    private $carsRepository;

    public function __construct($dbh)
    {
        $this->carsRepository = new CarsRepository($dbh);
    }

    // Afficher les voitures disponibles
    public function home()
    {
        $startDate = $_SESSION['start_date'] ?? null;
        $endDate = $_SESSION['end_date'] ?? null;

        if ($startDate && $endDate) {
            $currentDate = date('Y-m-d');

            // Vérifier si la date de début est dans le passé
            if (strtotime($startDate) < strtotime($currentDate)) {
                $_SESSION['error'] = "La date de début ne peut pas être dans le passé.";
                header('Location: /Home');
                exit;
            }

            // Vérifier si la date de fin est avant la date de début
            if (strtotime($endDate) < strtotime($startDate)) {
                $_SESSION['error'] = "La date de fin ne peut pas être avant la date de début.";
                header('Location: /Home');
                exit;
            }

            // Récupérer les voitures disponibles
            $availableCars = $this->carsRepository->getAvailableCars($startDate, $endDate);
            require __DIR__ . '/../views/cars.php';
        } else {
            $_SESSION['error'] = "Veuillez sélectionner une plage de dates.";
            header('Location: /Home');
            exit;
        }
    }

    // Afficher les détails d'une voiture et calculer son prix total
    public function page()
    {
        $carId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $startDate = $_SESSION['start_date'] ?? null;
        $endDate = $_SESSION['end_date'] ?? null;

        if (!$carId || !$startDate || !$endDate) {
            $_SESSION['error'] = 'Données manquantes ou voiture introuvable.';
            header('Location: /cars');
            exit;
        }

        $carDetails = $this->carsRepository->getCarById($carId);
        $totalPrice = $this->carsRepository->calculatePrice($carId, $startDate, $endDate);

        if (!$carDetails || $totalPrice === null) {
            $_SESSION['error'] = 'Erreur lors du calcul du prix.';
            header('Location: /cars');
            exit;
        }

        require __DIR__ . '/../views/car_details.php';
    }
}
