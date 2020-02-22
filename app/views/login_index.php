<div class="form-login">
    <form action="<?= LOCAL_DIR ?>login/authenticate" method="post">
        <div class="icon-header"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
        <div class="champ">
            <label for="username"><i class="fa fa-user" aria-hidden="true"></i></label>
            <input type="text" id="username" name="username" placeholder="Identifiant" autocomplete="off" required></div>
        <div class="champ">
            <label for="password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required></div>
        <input type="submit" value="Connexion" id="loginBtn" name="loginBtn">
        <?php
        if (isset($error_message)) {
            echo "<p class='error_message'>" . $error_message . "</p>";
        }
        if (isset($sucess_message)) {
            echo "<p class='sucess_message'>" . $sucess_message . "</p>";
        }
        ?>
    </form>
</div>