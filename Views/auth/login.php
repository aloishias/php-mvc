<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>lBc - Gestion des frais de déplacement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap Core CSS -->
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="Assets/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="Assets/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <center>

            <?= header_title("Connexion") ?>

        </center>

         <div class="container">

           <div class="row">
             <div class="col-md-3"></div>

             <div class="col-md-6">
               <form method='POST' action='?url=login'>

                 <div class="form-group">
                   <label for="login">Login</label>
                   <input type="text" class="form-control" id="login" placeholder="Entrez votres login" name='login' <?= isset($_GET['login']) ? "value=".$_GET['login'] : "" ?>>
                 </div>

                 <div class="form-group">
                   <label for="mdp">Mot de passe</label>
                   <input type="password" class="form-control" id="mdp" placeholder="Mot de passe" name='mdp'>
                 </div>

                 <?php if (isset($_GET['err']) && $_GET['err'] == 1): ?>
                    <p>Votre login ou votre mot de passe est incorrect</p>
                 <?php endif; ?>
                 <br>
                 <button type="submit" class="btn btn-primary">S'identifier</button>
               </form>
             </div>

           </div>
         </div>
    </body>
</html>
