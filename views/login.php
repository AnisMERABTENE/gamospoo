<?php 

if(!empty ($_SESSION["error"])){
    $errors = $_SESSION["error"];
    echo '<div class="session-message">';
    foreach($errors as $error){
        echo "<p>$error</p>";
    }
    echo '</div>';
    unset($_SESSION["error"]); 
}

if(!empty ($_SESSION["message"])){
    $message = $_SESSION["message"];
    echo '<div class="session-message">';
    echo "<p>$message</p>";
    echo '</div>';
    unset($_SESSION["message"]);   
}

?>



<h1>BIENVENUE <?php if(isset($_SESSION['prenom'])){
    echo $_SESSION['prenom'];} ?></h1>


<h2>Découvre nos Voitures de Luxe</h2>
<div class="login-voitures-container">
    <?php if (isset($voitures) && !empty($voitures)): ?>
        <?php foreach (array_slice($voitures, 0, 3) as $voiture): ?>
            <div class="login-voiture-card">
                <img src="<?php echo $voiture['image_path']; ?>" alt="" class="login-voiture-image">
                <h2><?php echo $voiture['marque']; ?></h2>
                <p class="login-voiture-price"><?php echo number_format($voiture['prix'], 2, ',', ' ') . " €"; ?></p>
                <p class="login-voiture-slogan">Luxe et performance, à portée de main.</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune voiture à afficher pour le moment.</p>
    <?php endif; ?>
</div>