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


<h2>Nos Voitures de Luxe</h2>
<div class="voitures-container">
    <?php if (isset($voitures) && !empty($voitures)): ?>
        <?php foreach ($voitures as $voiture): ?>
            <div class="voiture-card">
                <img src="<?php echo $voiture['image_path']; ?>" alt="" class="voiture-image">
                <h2><?php echo $voiture['marque']; ?></h2>
                <p class="voiture-price"><?php echo number_format($voiture['prix'], 2, ',', ' ') . " €"; ?></p>
                <p class="voiture-slogan">Luxe et performance, à portée de main.</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune voiture à afficher pour le moment.</p>
    <?php endif; ?>
</div>