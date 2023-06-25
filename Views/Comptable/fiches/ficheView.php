<div class="container">

    <?= header_title("Voir la fiche n°".$fiche['ID']) ?>

    <div class="row">

        <center>
            <h3>ETAT DE FRAIS ENGAGES</h3>
        </center>

    </div>

    <br>

    <div class="row ">

        <div class="col-md-1 lead">
            <p>Visiteur</p>
        </div>

        <div class="col-sm-11">

            <div class="row">

                <div class="col-md-2 lead">
                    <p>Nom </p>
                </div>

                <div class="col-md-6 lead">
                    <p>  <?= $user['NOM'] ?></p>
                </div>

            </div>

            <div class="row">

                <div class="col-md-2 lead">
                    <p>Prenom</p>
                </div>

                <div class="col-md-6 lead">
                    <p>  <?= $user['PRENOM'] ?></p>
                </div>

            </div> <!-- !.row -->

        </div>

    </div>

    <br>

    <div class="row ">

        <div class="col-md-1 lead">
            <p>Date</p>
        </div>

        <div class="col-sm-10 lead">
            <p> le <?= $fiche['DATEFICHE'] ?> </p>
        </div>

    </div>

    <br>

    <div class="row ">

        <div class="col-md-1 lead">
            <p>Montant</p>
        </div>

        <div class="col-sm-10 lead">
            <p> <?= $fiche['MONTANT'] ?> € </p>
        </div>

    </div>

    <br>

    <form class="" action="index.php?url=modifier/fiche/comptable" method="post">

        <div class="row ">



              <div class="col-md-1 lead">
                  <p>Etat</p>
              </div>

              <div class="col-sm-5 lead">
                  <select class="form-control" name="etat_fiche">

                      <?php foreach ($etats as $etat): ?>
                          <?php if ($etat['ID'] == $fiche['ID_ETAT']): ?>
                              <option value="<?= $etat['ID'] ?>" selected><?= $etat['LIBELLE'] ?></option>
                          <?php else: ?>
                              <option value="<?= $etat['ID'] ?>"><?= $etat['LIBELLE'] ?></option>
                          <?php endif ?>
                      <?php endforeach; ?>

                  </select>
              </div>

              <input type="hidden" name="id_fiche" value="<?= $fiche['ID'] ?>">

        </div>

        <div class="row">

          <div class="col-md-2 lead">
              <p>Nombre justificatifs</p>
          </div>

          <div class="col-md-4 lead">
              <input class="form-control" type="number" name="nombre_justificatif" value="<?= $fiche['NBJUSTIFICATIFS'] ?>" placeholder="Entrez le nombre de justificatif">
          </div>

        </div>

        <div class="row">

          <div class="col-sm-10 lead">
                  <input type="submit" class="btn btn-primary" name="Modifier" value="Modifier" />
          </div>

        </div>

    </form>

    <br>

    <div class="row">
        <div class="col-md-10">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Frais Forfaitaires</th>
                  <th>Quantité</th>
                  <th>Montant unitaire</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($frais as $f): ?>
                    <tr>
                        <td><?= $f['LIBELLE'] ?></td>
                        <td class="col-md-3">
                            <?= $f['QUANTITE'] ?>
                        </td>
                        <td id="price"><?= $f['MONTANT'] ?> €</td>
                        <td id="total"><?= $f['QUANTITE']*$f['MONTANT'] ?> €</td>
                    </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
        </div>
    </div>

    <br>

    <div class="row">
        <p class="text-center lead">Autres Frais</p>
    </div>

    <br>

    <div class="row">
        <div class="col-md-11">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Libelle</th>
                  <th>Montant</th>
                </tr>
              </thead>
              <tbody id="autreMontantListe">

                  <?php foreach ($fraisHorsForfait as $fh):?>

                    <tr>
                        <td class="col-md-3">
                            <?= $fh['DATEFRAIS']  ?>
                        </td>
                        <td>
                            <?= $fh['LIBELLE'] ?>
                        </td>
                        <td class="col-md-3">
                            <?= $fh['MONTANT'] ?> €
                        </td>
                    </tr>

                  <?php endforeach;?>

              </tbody>
            </table>
        </div>
    </div>


    <br><br>
</div>
