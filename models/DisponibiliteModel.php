<?php

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
