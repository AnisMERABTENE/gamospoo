<?php

class CarModel
{
    private int $id;
    private string $marque;
    private string $imagePath;
    private float $prix;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getMarque(): string
    {
        return $this->marque;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;
        return $this;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }
}
