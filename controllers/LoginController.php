<?php

class LoginController{
    public $userRepository;

    public function __construct($dbh)
    {
        $this->userRepository = new UserRepository($dbh);
    }

    public function home(){
        
        require_once "views\login.html.php";
       
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST["password"]);
            $errors = [];
         
            if (!preg_match("/^\d{3,6}$/", $password)) {
              $errors[] = "le mot de passe doit seulement entre 3 et 6 chiffres";
            }
          
            if (empty($email)) {
              $errors[] = " le mail doit etre renseigné";
            }
          
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errors[] = "email invalide";
            }
          
            if (empty($password)) {
              $errors[] = "le mot de passe doit etre renseigné";
            }
          
            if (!preg_match("/^\d{3,6}$/", $password)) {
              $errors[] = "le mot de passe doit seulement entre 3 et 6 chiffres";
            }
          
            if (!empty($errors)) {
              $_SESSION["error"] = $errors;
              header("location:/login");
              exit();
            }
            
           
          
            $user=$this->userRepository->recupUserBdd($email);
            if($user){
                if (password_verify($password, $user["mot_de_passe"])) {
                  $_SESSION["email"] = $user["email"];
                  $_SESSION["role"] = $user["role"];  
                  $_SESSION['prenom']=$user['prenom'];   
                  $_SESSION['userId']=$user['id_utilisateur'];   
                  
         
                  header("location:/login");
                  exit();

                } else {
                  $errors[]=" mot de passe incorrect";
                  $_SESSION['error']=$errors;
                  exit();

                }

            }else{

              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
              if($this->userRepository->addUserBdd($email,$hashedPassword)){
               echo " profil crée avec succées, maintenant connectez vous.";
                
              }else{                            
                $errors[]=" erreur d'inscription";
                $_SESSION['error']=$errors;
                header("location:/login");
                exit();
              }
            }
        }

        
    }

  }