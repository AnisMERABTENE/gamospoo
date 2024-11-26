<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Voiture</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($carDetails->getMarque()); ?></h1>
    <img src="<?php echo htmlspecialchars($carDetails->getImagePath()); ?>" alt="<?php echo htmlspecialchars($carDetails->getMarque()); ?>" width="400">
    <p>Prix: <?php echo htmlspecialchars($carDetails->getPrix()); ?> €</p>
    <a href="/reserve?id=<?php echo $carDetails->getId(); ?>">Réserver</a>
</body>
</html>
