<<<<<<< HEAD
<?php

$title = "cars";

?>
<style>
    .centertop {
        display: flex;
        flex-wrap: wrap;


        height: 200px;
        width: 1200vh;
        align-items: center;
        background-color: red;
    }
</style>
<!-- SELECT Bootstrap -->
<div class="centertop">
    <select class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Prix</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>

    <select class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Marque</option>
        <option value="1">Merco</option>
        <option value="2">Féfé</option>
        <option value="3">Lambo</option>
    </select>
    <select class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Carburant</option>
        <option value="1">Essence SP 97</option>
        <option value="2">Diesel</option>
        <option value="3">Hydrogène</option>
        <option value="4">Electrique</option>
    </select>
    <select class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Transmission</option>
        <option value="1">Manuelle</option>
        <option value="2">Automatique</option>
    </select>
    <select class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Siège</option>
        <option value="1">2</option>
        <option value="2">3</option>
        <option value="3">4</option>
        <option value="4">5</option>
        <option value="5">6</option>
        <option value="6">7</option>
    </select>
    <!-- GRID bootstrap-->

    <div class="container text-center">
        <div class="row">
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
        </div>
        <div class="row">
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
        </div>
        <div class="row">
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
            <div class="col">PICTURE'S GAMOS</div>
        </div>
    </div>
</div>
</div>
</div>

<?php

?>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="#">
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}    

header {
    text-align: center;
    padding: 20px 0;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 30px;
}

.car-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.car-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.car-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.car-image {
    width: 100%;
    height: auto;
    max-height: 150px;
    object-fit: cover;
    margin-bottom: 15px;
    border-radius: 8px;
}

.car-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #007BFF;
    margin: 15px 0;
}

.car-details-button {
    text-decoration: none;
    color: white;
    background-color: #ff6600;
    padding: 10px 20px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    font-size: 1rem;
    font-weight: bold;
}

.car-details-button:hover {
    background-color: #cc5200;
}
    </style>
    
    <title>Voitures Disponibles</title>
</head>
<body>
<header>
    <h1>Voitures Disponibles</h1>
    <?php if (!empty($availableCars)): ?>
        <div class="car-grid">
            <?php foreach ($availableCars as $car): ?>
                <div class="car-card">
                    <h2><?php echo htmlspecialchars($car->getMarque()); ?></h2>
                    <img src="<?php echo htmlspecialchars($car->getImagePath()); ?>" alt="<?php echo htmlspecialchars($car->getMarque()); ?>" class="car-image">
                    <p class="car-price">Prix Jours: <?php echo htmlspecialchars($car->getPrix()); ?> €</p>
                    <a href="/cars/page?id=<?php echo $car->getId(); ?>" class="car-details-button">Voir Détails</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune voiture disponible pour cette période.</p>
    <?php endif; ?>
</header>
</body>
</html>
>>>>>>> 4e6ec1bd350f560e1b8516ca4250ec15805490d0
