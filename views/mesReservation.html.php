<?php


?>


<h2>Mes Reservations</h2>

<a href="login">page d'accueil</a>


<h2>Réservations en cours :</h2>
<?php if (!empty($reservations['En cours'])): ?>
    
        <?php foreach ($reservations['En cours'] as $reservation): ?>
            <li>
                <strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?> :</strong>
                <?php echo $reservation['prix_total']."€"; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation en cours.</p>
<?php endif; ?>


<h2>Réservations à venir :</h2>
<?php if (!empty($reservations['A venir'])): ?>
   
    <ul>
        <?php foreach ($reservations['A venir'] as $reservation): ?>
            <li>
                <strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?> :</strong>
                <?php echo $reservation['prix_total']."€"; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation à venir.</p>
<?php endif; ?>


<h2>Réservations passées :</h2>
<?php if (!empty($reservations['Passee'])): ?>
    <ul>
        <?php foreach ($reservations['Passee'] as $reservation): ?>
            <li>
                <strong>Réservation du <?= date("d/m/Y", strtotime($reservation['date_debut'])) ?> au <?= date("d/m/Y", strtotime($reservation['date_fin'])) ?>:</strong>
                <?php echo $reservation['prix_total']."€";  ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation passée.</p>
<?php endif; ?>
