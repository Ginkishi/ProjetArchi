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
</div>