

    <?= header_title("Voir la fiche n°".$fiche['ID']) ?>

    <div class="row">

        <center>
            <h3>ETAT DE FRAIS ENGAGES</h3>
        </center>

    </div>

    <br>

    <div class="container">

    </div>

    <div class="row ">

        <div class="col-md-1 lead">
            <p>Visiteur</p>
        </div>

        <div class="col-md-11">

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

    <div class="row">

      <div class="col-md-3 lead">
          <p>Nombre justificatifs</p>
      </div>

      <div class="col-md-4 lead">
          <p><?= !isset($fiche['NBJUSTIFICATIFS']) ? 0 : $fiche['NBJUSTIFICATIFS'] ?></p>
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

    <div class="row">
        <div class="container">
            <div class="col-md-12">
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

    </div>

    <br>

    <div class="row">
        <p class="text-center lead">Autres Frais</p>
    </div>

    <br>

    <div class="row">
        <div class="container">
            <div class="col-md-12">
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


    </div>


    <br><br>
