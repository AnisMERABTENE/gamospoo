<?php

class MesreservationsController{
    public $mesReservationsRepository;

    public function __construct($dbh)
    {
        $this->mesReservationsRepository = new MesReservationsRepository($dbh);
    }

    public function home(){
             
        $reservations=[];

        if (isset($_SESSION["userId"])) {            
            $userId = $_SESSION["userId"];

            $reservations=$this->mesReservationsRepository->recupReservationBdd($userId); 
            
        }

        require "views\mesReservation.html.php";   
    }
        

        public function modifierReservation() {

                if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["id_reservation"]) && isset($_POST["updateReservation"]) && isset($_POST["date_debut"])   && isset($_POST["date_fin"])) { {
                $reservation_id = $_POST['id_reservation'];
                $date_debut = $_POST['date_debut'];
                $date_fin = $_POST['date_fin'];
                
    
                $this->mesReservationsRepository->updateReservation($reservation_id, $date_debut, $date_fin);
    
                header('Location: MesReservations.php');
                exit();
            }
        }

       
    }
}