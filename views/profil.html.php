<?php

if(!empty ($_SESSION["error"])){
    $errors= $_SESSION["error"];
    foreach($errors as $error){
        echo $error;
    }
    unset($_SESSION["error"]);   
}


if (isset($_SESSION)){
    $prenom=$_SESSION['prenom'];
    $email=$_SESSION['email'];

}

?>


<div>
    <h2>Modifier votre profil</h2>

    <a href="login">page d'accueil</a>

    <form  method="POST">
        <div >
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlentities($prenom); ?>" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email"value="<?php echo htmlentities($email); ?>" required>
        </div>

        

        <button type="submit" name="updateProfile">Mettre à jour le profil</button>
    </form>

    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre profil et vos réservations ?');">
        <button type="submit" name="deleteProfile" style="background-color: red;">Supprimer mon profil</button>
    </form>
</div>