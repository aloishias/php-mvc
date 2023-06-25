<div class="container">

    <?= header_title("Création d'une fiche de frais") ?>

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

    <form method="post">

    <br>

    <div class="row ">

        <div class="col-md-1 lead">
            <p>Date</p>
        </div>

        <div class="col-sm-10">
            <input type="date" name="date_fiche" class="form-control" placeholder="Date au format (AAAA-MM-JJ)" required>
        </div>

    </div>

    <br>

    <?php if (isset($_GET['err'])): ?>

        <div class="alert alert-danger alert-dismissable col-md-11">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Attention !</strong> <?= $_GET['err'] ?>
        </div>

        <br>

    <?php endif; ?>


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
                            <input type="number" name="nb_utilisation[<?=$f['ID']?>]" class="form-control saisieMontant" value="0" required/>
                        </td>
                        <td id="price"><?= $f['MONTANT'] ?></td>
                        <td id="total">0</td>
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

                  <!-- Ici seront les lignes des autre frais -->

              </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5"> </div>
        <div class="col-md-10">
        <button type="button" id="ajouterLn" class="btn btn-info">Ajouter une ligne</button>

        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-5"> </div>
        <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Terminer</button>

        </div>
    </div>

    </form>

    <br><br>
</div>

<?php $scripts = '<script src="Assets/js/FFcreation.js"></script>'; ?>
