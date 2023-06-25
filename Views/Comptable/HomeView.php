<?= header_title("Tableau de bord") ?>

<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pencil fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($stats['CR']) ? $stats['CR']['nb'] : 0 ?></div>
                        <div>Fiches en saisie</div>
                    </div>
                </div>
            </div>
            <a href="?url=fiches&etat=CR">
                <div class="panel-footer">
                    <span class="pull-left">Voir en détails</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list-alt fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($stats['CL']) ? $stats['CL']['nb'] : 0 ?></div>
                        <div>Fiches de frais cloturées</div>
                    </div>
                </div>
            </div>
            <a href="?url=fiches&etat=CL">
                <div class="panel-footer">
                    <span class="pull-left">Voir en détails</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($stats['VA']) ? $stats['VA']['nb'] : 0 ?></div>
                        <div>Fiches validées</div>
                    </div>
                </div>
            </div>
            <a href="?url=fiches&etat=VA">
                <div class="panel-footer">
                    <span class="pull-left">Voir en détails</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($stats['RB']) ? $stats['RB']['nb'] : 0 ?></div>
                        <div>Fiches remboursées</div>
                    </div>
                </div>
            </div>
            <a href="?url=fiches&etat=RB">
                <div class="panel-footer">
                    <span class="pull-left">Voir en détails</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= totalFiches() ?></div>
                        <div>Liste des fiches</div>
                    </div>
                </div>
            </div>
            <a href="?url=fiches">
                <div class="panel-footer">
                    <span class="pull-left">Voir en détails</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
