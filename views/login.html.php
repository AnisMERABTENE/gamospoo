<?php 

if(!empty ($_SESSION["error"])){
    $errors= $_SESSION["error"];
    foreach($errors as $error){
        echo $error;
    }
    unset($_SESSION["error"]); 
}

if(!empty ($_SESSION["message"])){
    $message= $_SESSION["message"];
    echo $message;
    unset($_SESSION["message"]);   
}

?>
<h1>BIENVENUE <?php if(isset($_SESSION['prenom'])){
    echo $_SESSION['prenom'];} ?></h1>

<?php
if (!empty($_SESSION['email'])){ ?>

    <nav>
        <ul>
            <li><a href="home">Réserver</a></li>
            <li><a href="profil">Mon Profil</a></li>
            <li><a href="mesreservations">Mes réservations</a></li>
            <li><a href="logout">Se déconnecter</a></li>
        </ul>
    </nav>
<?php } else { ?>

    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Se connecter</button>
    </form>
<?php } ?>







