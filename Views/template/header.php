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

            <div id="wrapper">

                <!-- Navigation -->
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="?url=">lBc - Gestion des frais</a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <!-- Menu de l'utilisateur -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><i class="fa fa-user fa-fw"></i> <?= getUserAuth()['PRENOM'] ?> <?= getUserAuth()['NOM'] ?></li>
                                <li class="divider"></li>
                                <li><a href="?url=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li class="sidebar-search">
                                    <div class="input-group custom-search-form">
                                        <form  action="index.php">
                                            <input type="hidden" name="url" value="fiche">
                                            <input type="text" class="form-control" placeholder="N° de fiche" name="fiche">
                                        </form>
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    </div>
                                    <!-- /input-group -->
                                </li>
                                <li>
                                    <a href="?url="><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Consultations<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?url=fiches">Les fiches</a>
                                        </li>
                                        <li>
                                            <a href="?url=fiches&etat=CL">Les fiches cloturés</a>
                                        </li>
                                        <li>
                                            <a href="?url=fiches&etat=CR">Les fiches non-cloturés</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>

                                <li>
                                    <a href="#"><i class="fa fa-pencil fa-fw"></i> Editions<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="?url=fiches&etat=CR">Les fiches</a>
                                        </li>
                                        <li>
                                            <a href="?url=creation/fiche">Création d'une fiche de frais</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>

                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>

                <div id="page-wrapper">
