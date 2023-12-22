<?php
ob_start();
?>
<div>
    <nav class="navigation d-flex justify-content-between py-4">
        <button class="navigation__left btn btn-success">
            <a href="?path=bikes.create">
                Enregistrement des vélos
            </a>
        </button>
        <h1 class="navigation__center">Gestion des réservations</h1>
        <div class="navigation__right" id="">
            <button class="btn btn-success">ID : <?= 'XXXXXXX' ?></button>
            <button class="btn btn-outline-danger" type="submit">Déconnexion</button>
        </div>
    </nav>
    <div class="border p-2 shadow">
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="mb-3 d-flex g-3">
                        <input name="search" type="text" class="form-control me-1" placeholder="Recherche Nom, Prénom ou Immatriculation">
                        <button type="submit" class="btn btn-primary ms-1">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Prénom</th>
                    <th>Immatriculation</th>
                    <th>Date de réservation</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <td>
                            <?= $reservation->res_num ?>
                        </td>
                        <td>
                            <?= $reservation->firstname . ' ' . $reservation->lastname ?>
                        </td>
                        <td>
                            <?= $reservation->registration_number ?>
                        </td>
                        <td>
                            <?php
                            $dateTime = new DateTime($reservation->res_date);
                            $dateFormatted = $dateTime->format('d/m/Y à H\hi');
                            ?>
                            <?= $dateFormatted ?>
                        </td>
                        <td>
                            <?php
                            $dateTime = new DateTime($reservation->start_date);
                            $dateFormatted = $dateTime->format('d/m/Y à H\hi');
                            ?>
                            <?= $dateFormatted ?>
                        </td>
                        <td>
                            <?php
                            $dateTime = new DateTime($reservation->end_date);
                            $dateFormatted = $dateTime->format('d/m/Y à H\hi');
                            ?>
                            <?= $dateFormatted ?>
                        </td>
                        <td><?= $reservation->status ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="res_num" value="<?= $reservation->res_num ?>">
                                <button type="submit" class="btn btn-success" name="status" value="accepted">Accepter</button>
                                <button type="submit" class="btn btn-danger" name="status" value="rejected">Refuser</button>
                            </form>
                        </td>
                        <td>
                            <form action="?path=reservations.delete" method="POST" id="form_<?= $reservation->res_num ?>">
                                <input type="hidden" name="res_num" value="<?= $reservation->res_num ?>">
                                <button type="button" data-res_num="<?= $reservation->res_num ?>" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php require __DIR__ . '/../_delete-reservation-modal.php' ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
