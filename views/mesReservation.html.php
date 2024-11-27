<?php

?>

<div class="main-container">
    <div class="content-container">
        <h2>Mes Réservations</h2>

        <h3>Réservations en cours :</h3>
        <?php if (!empty($reservations['En cours'])): ?>
            <div class="table-container">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations['En cours'] as $reservation): ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($reservation['date_debut'])) ?></td>
                                <td><?= date("d/m/Y", strtotime($reservation['date_fin'])) ?></td>
                                <td><?= $reservation['prix_total']."€" ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Aucune réservation en cours.</p>
        <?php endif; ?>

        <h3>Réservations à venir :</h3>
        <?php if (!empty($reservations['A venir'])): ?>
            <div class="table-container">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Prix total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations['A venir'] as $reservation): ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($reservation['date_debut'])) ?></td>
                                <td><?= date("d/m/Y", strtotime($reservation['date_fin'])) ?></td>
                                <td><?= $reservation['prix_total']."€" ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation'] ?>" />
                                        <button type="submit" name="modifReservation">Modifier la réservation</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Aucune réservation à venir.</p>
        <?php endif; ?>

       
        <h3>Réservations passées :</h3>
        <?php if (!empty($reservations['Passee'])): ?>
            <div class="table-container">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations['Passee'] as $reservation): ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($reservation['date_debut'])) ?></td>
                                <td><?= date("d/m/Y", strtotime($reservation['date_fin'])) ?></td>
                                <td><?= $reservation['prix_total']."€" ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
             </div>
           <?php else: ?>
            <p>Aucune réservation passée.</p>
        <?php endif; ?>
    </div>
</div>


