<?php


class ReservationModel {

    public int $idReservation;
    public int $idUtilisateur;
    public int $idVoiture;
    public string $startDate;
    public string $endDate;
    public float $prixTotal;

    public function getIdReservation() : int
    {
        return $this->idReservation;
    }

    public function getIdUtilisateur() : int
    {
        return $this->idUtilisateur;
    }
    public function getIdVoiture() : int
    {
        return $this->idVoiture;
    }

    public function getStartDate() : string
    {
        return $this->startDate;
    }
    public function getEndDate() : string
    {
        return $this->endDate;
    }

    public function getPrixTotal() : float
    {
        return $this->prixTotal;
    }

    public function setIdReservation(string $idReservation) : self
    {
        $this->idReservation = $idReservation;

        return $this;
    }
    public function setIdUtilisateur(string $idUtilisateur) : self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
    public function setIdVoiture(string $idVoiture) : self
    {
        $this->idVoiture = $idVoiture;

        return $this;
    }
    public function setStartDate(string $startDate) : self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function setEndDate(string $endDate) : self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function setPrixTotal(string $prixTotal) : self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }


}

