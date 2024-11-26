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

        require_once "views\mesReservation.html.php";    
       
    }
}