<?php


class UserModel {

    public int $id;
    public string $password;
    public string $email;
    public string $pseudo;
    public string $role;

    public function getId() : int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }
    public function getPseudo() : string
    {
        return $this->pseudo;
    }

    public function getPassword() : string
    {
        return $this->password;
    }
    public function getRole() : string
    {
        return $this->role;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }
    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }
    public function setPseudo(string $pseudo) : self
    {
        $this->pseudo = $pseudo;

        return $this;
    }
    public function setRole(string $role) : self
    {
        $this->role = $role;

        return $this;
    }

}

