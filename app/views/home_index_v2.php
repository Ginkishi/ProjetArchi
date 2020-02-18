<?php setlocale(LC_TIME, "fr_FR"); ?>
<div class="home-container">
    <h2 class="home-title"><img class="home-logo" src="../vendors/personal/img/CH-ENF-192_white.png" alt=""> eIntervention</h2>
    <h3 class="datenow"> Aujourd'hui, nous sommes le <?= utf8_encode(strftime(" %A %e %B %Y")); ?></h3>
    <div class="intervention-container">
        <div class="valid-intervention">
            <div class="intervention-title">Interventions validées</div>
            <div class="icon">
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <div class="public-intervention">
            <div class="intervention-title">Dernières interventions</div>
            <div class="icon">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <div class="warning-intervention">
            <div class="intervention-title">Interventions en attente</div>
            <div class="icon">
                <i class="fa fa-hourglass" aria-hidden="true"></i>
            </div>
            <div class="number">53</div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <!-- <div class="fail-intervention">
            <div class="intervention-title">Interventions non validé</div>
            <div class="icon">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div> -->
    </div>
    <div class="cards-container">
        <div class="cards">
            <div class="logo valid"><i class="far fa-check-circle"></i></div>
            <div class="body">
                <div class="title">10</div>
                <div class="subtitle">Intervention validée</div>
            </div>
        </div>
        <div class="cards">
            <div class="logo wait"><i class="fas fa-clock"></i></div>
            <div class="body">
                <div class="title">5</div>
                <div class="subtitle">Intervention en attente</div>
            </div>
        </div>
        <div class="cards">
            <div class="logo fail"><i class="far fa-times-circle"></i></div>
            <div class="body">
                <div class="title">2</div>
                <div class="subtitle">Intervention refusée</div>
            </div>
        </div>
        <div class="cards">
            <div class="logo info"><i class="fas fa-info"></i></div>
            <div class="body">
                <div class="title">50</div>
                <div class="subtitle">Nouvelle informations</div>
            </div>
        </div>
        <div class="cards">
            <div class="logo msg"><i class="far fa-envelope"></i></div>
            <div class="body">
                <div class="title">50</div>
                <div class="subtitle">Nouveaux messages</div>
            </div>
        </div>
    </div>
</div>