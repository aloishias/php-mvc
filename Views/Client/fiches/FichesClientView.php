
<?= header_title("Mes fiches de frais") ?>

<div class="row">
    <div class="col-md-10">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>N° fiche</th>
              <th>Date</th>
              <th>Montant</th>
              <th>Etat</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fiches as $fiche): ?>

                <tr>

                    <td><?= $fiche['ID'] ?></td>
                    <td><?= $fiche['DATEFICHE'] ?></td>
                    <td><?= $fiche['MONTANT'] ?> €</td>
                    <td><?= $fiche['LIBELLE'] ?></td>
                    <td>
                        <a href="?url=fiche&fiche=<?= $fiche['ID'] ?>">Voir la fiche</a>
                    </td>
                    <?php if ($fiche['ID_ETAT'] == 'CR'): ?>
                        <td>
                            <a href="?url=modifier/fiche&fiche=<?= $fiche['ID'] ?>">Modifier la fiche</a>
                        </td>
                        <td>
                            <a class="text-danger" href="?url=supprimer/fiche&fiche=<?= $fiche['ID'] ?>" onclick="return confirm('Etes vous sûr ?')">Supprimer la fiche</a>
                        </td>
                    <?php endif; ?>

                </tr>

            <?php endforeach; ?>

          </tbody>
        </table>
    </div>
</div>
