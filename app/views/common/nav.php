<div class="menu">
    <div id="toggleBtn" class="toggleBtn"><i class="fa fa-bars fa-2x"></i></div>
</div>
<div class="sidebar show" id="sidebar">
    <div class="photo">
        <i class="fa fa-user-circle fa-4x"></i>
    </div>
    <div class="info"><span class="nom">Victor MARFIL</span><span class="role">Administrator</span></div>
    <div class="tool">
        <a href="#" class="notif"><i class="fa fa-bell "></i></a>
        <a href="#" class="msg"><i class="fa fa-envelope"></i></a>
        <a href="#" class="setting"><i class="fa fa-cog"></i></a>
        <a href="<?= LOCAL_DIR ?>login/disconnect" class="statut"><i class="fa fa-power-off"></i></a>
    </div>
    <div class="sidebar-container">
        <a href="<?= LOCAL_DIR ?>home/index" class="sidebar-item"><span class="title-item"><i class="fa fa-home fa-2x"></i>Accueil</span></a>
        <div class="sidebar-item drop">
            <span class="title-item"><i class="fa fa-map-marker fa-2x"></i>Intervention</span>
            <div class="submenu">
                <a href="<?= LOCAL_DIR ?>intervention/list" class="submenu-item"><span class="title-item"><i class="fa fa-list fa-2x"></i>Liste</span></a>
                <a href="<?= LOCAL_DIR ?>intervention/add" class="submenu-item"><span class="title-item"><i class="fa fa-plus-circle fa-2x"></i>Ajouter</span></a>
            </div>
        </div>
        <a href="#" class="sidebar-item"><span class="title-item"><i class="fa fa-user fa-2x"></i>Pompier</span></a>
        <a href="<?= LOCAL_DIR ?>vehicule/index" class="sidebar-item"><span class="title-item"><i class="fa fa-car fa-2x"></i>Véhicules</span></a>
        <div class="sidebar-item"><span class="title-item"><i class="fa fa-id-badge fa-2x"></i>Roles</span></div>
    </div>
</div>