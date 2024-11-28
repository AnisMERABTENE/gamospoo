<?php

class ReservationModel
{
    private int $id;
    private int $idUtilisateur;
    private int $idVoiture;
    private string $dateDebut;
    private string $dateFin;
    private float $prixTotal;

    // Getters et Setters
    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getIdUtilisateur(): int { return $this->idUtilisateur; }
    public function setIdUtilisateur(int $idUtilisateur): self { $this->idUtilisateur = $idUtilisateur; return $this; }

    public function getIdVoiture(): int { return $this->idVoiture; }
    public function setIdVoiture(int $idVoiture): self { $this->idVoiture = $idVoiture; return $this; }

    public function getDateDebut(): string { return $this->dateDebut; }
    public function setDateDebut(string $dateDebut): self { $this->dateDebut = $dateDebut; return $this; }

    public function getDateFin(): string { return $this->dateFin; }
    public function setDateFin(string $dateFin): self { $this->dateFin = $dateFin; return $this; }

    public function getPrixTotal(): float { return $this->prixTotal; }
    public function setPrixTotal(float $prixTotal): self { $this->prixTotal = $prixTotal; return $this; }
}
