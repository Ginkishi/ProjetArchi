<?php
require_once(CLASSES . DS . "gestionnaireGrade.php");
?>
<div class="menu">
    <div id="toggleBtn" class="toggleBtn"><i class="fa fa-bars fa-2x"></i></div>
    <div class="darkbtn"><label><input type="checkbox" id="darkbtn"><span class="check"></span></label></div>
</div>
<div class="sidebar show" id="sidebar">
    <div class="photo">
        <i class="fa fa-user-circle fa-4x"></i>
    </div>
    <div class="info"><span class="nom"><?= $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></span><span class="role"><?= $_SESSION['grade'] ?></span></div>
    <div class="tool">
        <!-- <a href="#" class="notif"><i class="fa fa-bell "></i></a>
        <a href="#" class="msg"><i class="fa fa-envelope"></i></a> -->
        <a href="<?= LOCAL_DIR ?>pompier/profil" class="setting"><i class="fa fa-cog"></i></a>
        <a href="<?= LOCAL_DIR ?>login/disconnect" class="statut"><i class="fa fa-power-off"></i></a>
    </div>
    <div class="sidebar-container">
        <a href="<?= LOCAL_DIR ?>home/index" class="sidebar-item"><span class="title-item"><i class="fa fa-home fa-2x"></i>Accueil</span></a>
        <div class="sidebar-item drop">
            <span class="title-item"><i class="fa fa-map-marked-alt fa-2x"></i>Intervention</span>
            <div class="submenu">
                <?php
                if (GestionnaireGrade::aLesDroitsLecture()) {
                ?>
                <a href="<?= LOCAL_DIR ?>intervention/listAll" class="submenu-item"><span class="title-item"><i class="fa fa-list fa-2x"></i>Liste</span></a>
                <?php
                }
                if (GestionnaireGrade::aLesDroitsAjout()) {
                ?>
                <a href="<?= LOCAL_DIR ?>intervention/add" class="submenu-item"><span class="title-item"><i class="fa fa-plus-circle fa-2x"></i>Ajouter</span></a>
                <?php
                }
                ?>
                <?php
                if (GestionnaireGrade::aLesDroitsExportation()) {
                ?>
                <a href="<?= LOCAL_DIR ?>intervention/export" class="submenu-item disabled"><span class="title-item"><i
                            class="fa fa-file-download fa-2x"></i>Exportation</span></a>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- <a href="#" class="sidebar-item"><span class="title-item"><i class="fa fa-user-tie fa-2x"></i>Pompier</span></a> -->
        <?php
        if (GestionnaireGrade::aLesDroitsLecture()) {
        ?>
        <a href="<?= LOCAL_DIR ?>vehicule/index" class="sidebar-item"><span class="title-item"><i class="fa fa-car fa-2x"></i>Véhicules</span></a>
        <?php
        }
        ?>
        <!-- <div class="sidebar-item"><span class="title-item"><i class="far fa-id-badge fa-2x"></i>Roles</span></div> -->
    </div>
</div>