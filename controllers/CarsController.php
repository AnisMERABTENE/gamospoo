<?php

class CarsController
{
    private $carsRepository;

    public function __construct($dbh)
    {
        $this->carsRepository = new CarsRepository($dbh);
    }

    // Méthode pour afficher les voitures disponibles
    public function home()
    {
        if (!isset($_SESSION['start_date'], $_SESSION['end_date'])) {
            $_SESSION['error'] = 'Veuillez saisir une plage de dates valide.';
            header('Location: /Home');
            exit;
        }

        $start_date = $_SESSION['start_date'];
        $end_date = $_SESSION['end_date'];

        $availableCars = $this->carsRepository->getAvailableCars($start_date, $end_date);

        require __DIR__ . '/../views/cars.php';
    }

    // Méthode pour afficher les détails d'une voiture spécifique
    public function page()
{
    $carId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$carId) {
        $_SESSION['error'] = 'Voiture introuvable.';
        header('Location: /cars');
        exit;
    }

    $carDetails = $this->carsRepository->getCarById($carId);

    if (!$carDetails) {
        $_SESSION['error'] = 'Voiture introuvable.';
        header('Location: /cars');
        exit;
    }

    require __DIR__ . '/../views/car_details.php';
}
}
