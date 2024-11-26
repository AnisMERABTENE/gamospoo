<?php

class ProfilController{

    public $userRepository;

         
    public function __construct($dbh)
    {
        $this->userRepository = new UserRepository($dbh);
    }

    public function home(){
        
        require "views\header.php";
        require_once "views\profil.html.php";

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["updateProfile"]) && isset($_SESSION["userId"])) {
            $prenom = trim($_POST["prenom"]);
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $userId=$_SESSION["userId"];
           
            $errors = [];
                   
            if (empty($email)) {
              $errors[] = " le mail doit etre renseigné";
            }
          
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errors[] = "email invalide";
            }
          
            if (empty($prenom)) {
              $errors[] = "le prénom doit etre renseigné";
            }
          
            if (!preg_match("/^[A-Za-zÀ-ÿéèêëîïôûùüÿçÇ]+(?:[-'][A-Za-zÀ-ÿéèêëîïôûùüÿçÇ]+)*$/", $prenom)) {
              $errors[] = "le prenom n'est pas valide";
            }     
          
            if (!empty($errors)) {
              $_SESSION["error"] = $errors;
              header("location:/profil");
              exit();
           }   

            
             if ($this->userRepository->updateUserBdd($prenom, $email, $userId)) {
                $user=$this->userRepository->recupUserBdd($email);
                if($user){
                      $_SESSION["email"] = $user["email"];
                      $_SESSION["role"] = $user["role"];  
                      $_SESSION['prenom']=$user['prenom'];   
                      $_SESSION['userId']=$user['id_utilisateur'];  
               
                echo "Votre profil a été mis à jour avec succès.";
                } else {
                echo "Aucune modification effectuée ou erreur.";
                }
                 
             }


        }

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["deleteProfile"]) && isset($_SESSION["userId"])) {
          $userId=$_SESSION['userId'];

          if ($this->userRepository->delateUserBdd($userId)){
            
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['message']= "votre profil a bien été supprimé";

            header("location:\login");
            exit();        
          }else{
            echo "erreur de la suppression du profil";
          }
        }

        require "views/footer.php";
    }

}
