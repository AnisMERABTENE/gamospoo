<?php

class MesReservationsRepository
{
    public $dbh;

    public function __construct($dbh) 
    {
        $this->dbh=$dbh;
    }


public function recupReservationBdd(int $userId):array
    {
        $query= "SELECT * FROM reservations WHERE id_utilisateur=:userId AND date_debut > CURDATE() ORDER BY date_debut ASC ";
        $stmt=$this->dbh->prepare($query);
        $stmt->bindParam(':userId',$userId,PDO::PARAM_STR);
        $stmt->execute();
        $reservationAVenir= $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query= "SELECT * FROM reservations WHERE id_utilisateur=:userId AND date_debut <= CURDATE() AND date_fin >= CURDATE() ORDER BY date_debut ASC ";
        $stmt=$this->dbh->prepare($query);
        $stmt->bindParam(':userId',$userId,PDO::PARAM_STR);
        $stmt->execute();
        $reservationEnCours= $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query= "SELECT * FROM reservations WHERE id_utilisateur=:userId AND date_fin < CURDATE() ORDER BY date_debut DESC ";
        $stmt=$this->dbh->prepare($query);
        $stmt->bindParam(':userId',$userId,PDO::PARAM_STR);
        $stmt->execute();
        $reservationPassee= $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
          'A venir' =>$reservationAVenir,
          'En cours' =>$reservationEnCours,
          'Passee'=>$reservationPassee
        ];

    }
}