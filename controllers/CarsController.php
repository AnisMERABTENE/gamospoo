<?php

class CarsController
{
    public CarsRepository $CarsRepository;

    public function __construct($dbh)
    {
        $this->CarsRepository = new CarsRepository($dbh);
    }

    public function home()
    {
        if (!isset($_SESSION['start_date']) && (!isset($_SESSION['end_date']))) {
            $_SESSION['error'] = " Veuillez saisir une date de début et une date de fin";
            header("Location: /home");
            exit;
        }
        $startDate = $_SESSION['start_date'];
        $endDate = $_SESSION['end_date'];
        $availableCars = $this->CarsRepository->getCarAvailable($startDate, $endDate);
        require 'views/cars.php';
    }
}
