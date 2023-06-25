
<?= header_title("Les fiches de frais") ?>

<div class="row">
    <div class="col-md-10">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>N° fiche</th>
              <th>Visiteur</th>
              <th>Date</th>
              <th>Montant</th>
              <th>Etat</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fiches as $fiche): ?>
                <?php $user = getUser($fiche['ID_USER']) ?>
                <tr>

                    <td><?= $fiche['ID'] ?></td>
                    <td><?= $user['PRENOM'] ?> <?= $user['NOM'] ?></td>
                    <td><?= $fiche['DATEFICHE'] ?></td>
                    <td><?= $fiche['MONTANT'] ?> €</td>
                    <td><?= $fiche['LIBELLE'] ?></td>
                    <td>
                        <a href="?url=fiche&fiche=<?= $fiche['ID'] ?>">Voir la fiche</a>
                    </td>

                </tr>

            <?php endforeach; ?>

          </tbody>
        </table>
    </div>
</div>
