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
    
    public function updateReservation($id_reservation, $date_debut, $date_fin) {
        $query= "UPDATE reservations SET date_debut = :date_debut, date_fin = :date_fin, prix_total = :prix_total WHERE id_reservation = :id_reservation";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':date_debut',$date_debut,PDO::PARAM_STR);
        $stmt->bindParam(':date_fin',$date_fin,PDO::PARAM_STR);
        $stmt->bindParam(':id_reservation',$id_reservation,PDO::PARAM_INT);

        $stmt->execute();

        // Vérification si la mise à jour a été effectuée
        if ($stmt->rowCount() > 0) {
            return true;  // Mise à jour réussie
        } else {
            // Si aucune ligne n'a été mise à jour
            return false;
        }
    
    }
}