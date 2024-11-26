<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voitures</title>
    <link rel="stylesheet" href="/css/admin_cars.css">
    
</head>
<body>
    <div class="container">
        <h1 class="title">Gestion des Voitures</h1>

        <div class="add-car-form">
            <h2 class="subtitle">Ajouter une Voiture</h2>
            <form action="/adminCars/page" method="POST" enctype="multipart/form-data" class="form">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="marque">Marque :</label>
                    <input type="text" id="marque" name="marque" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="number" step="0.01" id="prix" name="prix" required>
                </div>
                <div class="form-group">
                    <label for="image">Photo :</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>

        <h2 class="subtitle">Liste des Voitures</h2>
        <table class="car-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car->getId()); ?></td>
                            <td><?php echo htmlspecialchars($car->getMarque()); ?></td>
                            <td><?php echo htmlspecialchars($car->getPrix()); ?> €</td>
                            <td>
                                <img src="<?php echo htmlspecialchars($car->getImagePath()); ?>" alt="Voiture" class="car-image">
                            </td>
                            <td>
                                <form action="/adminCars/page" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="car_id" value="<?php echo $car->getId(); ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                                <button class="btn btn-secondary" onclick="openModal('modal-<?php echo $car->getId(); ?>')">Modifier</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div id="modal-<?php echo $car->getId(); ?>" class="modal">
                            <div class="modal-content">
                                <h2>Modifier la Voiture</h2>
                                <form action="/adminCars/page" method="POST" enctype="multipart/form-data" class="form">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="car_id" value="<?php echo $car->getId(); ?>">
                                    <input type="hidden" name="current_image_path" value="<?php echo htmlspecialchars($car->getImagePath()); ?>">
                                    <div class="form-group">
                                        <label for="marque-<?php echo $car->getId(); ?>">Marque :</label>
                                        <input type="text" id="marque-<?php echo $car->getId(); ?>" name="marque" value="<?php echo htmlspecialchars($car->getMarque()); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prix-<?php echo $car->getId(); ?>">Prix :</label>
                                        <input type="number" step="0.01" id="prix-<?php echo $car->getId(); ?>" name="prix" value="<?php echo htmlspecialchars($car->getPrix()); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image-<?php echo $car->getId(); ?>">Photo :</label>
                                        <input type="file" id="image-<?php echo $car->getId(); ?>" name="image" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                                <button class="btn btn-danger close-btn" onclick="closeModal('modal-<?php echo $car->getId(); ?>')">Fermer</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucune voiture disponible.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Ouvrir le modal
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        // Fermer le modal
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
</body>
</html>
