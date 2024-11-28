<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Détails Voiture</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($carDetails->getMarque()); ?></h1>
    <img src="<?php echo htmlspecialchars($carDetails->getImagePath()); ?>" alt="<?php echo htmlspecialchars($carDetails->getMarque()); ?>" width="400">
    <p>Prix par jour : <?php echo htmlspecialchars($carDetails->getPrix()); ?> €</p>
    
    <?php
    $startDate = new DateTime($_SESSION['start_date']);
    $endDate = new DateTime($_SESSION['end_date']);
    $days = $startDate->diff($endDate)->days + 1; // Inclure le dernier jour
    $totalPrice = $carDetails->getPrix() * $days; // Calculer le prix total sans assurance
    ?>
    
    <!-- Affichage du prix total sans assurance -->
    <p id="total-price">Prix total : <?php echo htmlspecialchars($totalPrice); ?> €</p>

    <!-- Formulaire de réservation -->
    <form method="POST" action="/Reserve/home">
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($carDetails->getId()); ?>">
        <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($_SESSION['start_date']); ?>">
        <input type="hidden" name="end_date" value="<?php echo htmlspecialchars($_SESSION['end_date']); ?>">

        <label for="insurance">
            <input type="checkbox" name="insurance" id="insurance"> Ajouter une assurance (+10€)
        </label>

        <button type="submit">Réserver</button>
    </form>

    <!-- Script pour gérer le prix total dynamique -->
    <script>
        document.getElementById('insurance').addEventListener('change', function () {
            const basePrice = <?php echo $totalPrice; ?>; // Prix sans assurance
            const insuranceCost = 10; // Coût de l'assurance
            const totalPrice = this.checked ? basePrice + insuranceCost : basePrice;
            document.getElementById('total-price').textContent = "Prix total : " + totalPrice + " €";
        });
    </script>
</body>
</html>
