<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voitures Disponibles</title>
</head>
<body>
    <h1>Voitures Disponibles</h1>
    <?php if (!empty($availableCars)): ?>
        <ul>
            <?php foreach ($availableCars as $car): ?>
                <li>
                    <h2><?php echo htmlspecialchars($car->getMarque()); ?></h2>
                    <img src="<?php echo htmlspecialchars($car->getImagePath()); ?>" alt="<?php echo htmlspecialchars($car->getMarque()); ?>" width="200">
                    <p>Prix: <?php echo htmlspecialchars($car->getPrix()); ?> €</p>
                    <a href="/cars/page?id=<?php echo $car->getId(); ?>">Voir Détails</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune voiture disponible pour cette période.</p>
    <?php endif; ?>
</body>
</html>
