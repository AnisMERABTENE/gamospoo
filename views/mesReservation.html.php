<?php


?>


            <div class="main-container">
                    <div class="content-container">
                        <h2>Mes Réservations</h2>
                        <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                    <?php unset($_SESSION['success']); // Supprimer le message de session ?>
                </div>
                     <?php endif; ?>
                    
            <h3>Réservations en cours :</h3>
            <?php if (!empty($reservations['En cours'])): ?>
                <ul>
                    <?php foreach ($reservations['En cours'] as $reservation): ?>
                        <li><strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?> : </strong>
                        <?php echo $reservation['prix_total']."€"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune réservation en cours.</p>
            <?php endif; ?>

            <h3>Réservations à venir :</h3>
<?php if (!empty($reservations['A venir'])): ?>
    <ul>
        <?php foreach ($reservations['A venir'] as $reservation): ?>
            <li>
                <strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?> : </strong>
                <?= $reservation['prix_total']."€" ?>
            
                <form  action="mesreservations" method="POST">
                    <input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation'] ?>">

                    <label for="date_debut">Date de début</label>
                    <input type="date" name="date_debut" value="<?= date('Y-m-d', strtotime($reservation['date_debut'])) ?>" required>

                    <label for="date_fin">Date de fin</label>
                    <input type="date" name="date_fin" value="<?= date('Y-m-d', strtotime($reservation['date_fin'])) ?>" required>

                    <button type="submit" name="updateReservation">Modifier</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation à venir.</p>
<?php endif; ?>


            <h3>Réservations passées :</h3>
            <?php if (!empty($reservations['Passee'])): ?>
                <ul>
                    <?php foreach ($reservations['Passee'] as $reservation): ?>
                        <li><strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?> : </strong>
                        <?php echo $reservation['prix_total']."€"; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune réservation passée.</p>
            <?php endif; ?>
        </div>
    </div>