<?php

<<<<<<< HEAD

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

=======
class DisponibiliteModel
{
    private int $id;
    private int $voitureId;
    private string $dateDebut;
    private string $dateFin;
    private string $statut;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getVoitureId(): int
    {
        return $this->voitureId;
    }

    public function getDateDebut(): string
    {
        return $this->dateDebut;
    }

    public function getDateFin(): string
    {
        return $this->dateFin;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setVoitureId(int $voitureId): self
    {
        $this->voitureId = $voitureId;
        return $this;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function setDateFin(string $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }
}
>>>>>>> 4e6ec1bd350f560e1b8516ca4250ec15805490d0
