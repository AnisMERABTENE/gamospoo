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
