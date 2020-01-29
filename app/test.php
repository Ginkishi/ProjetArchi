<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <style>
    body {
        position: relative;
    }

    .txtb {
        border-bottom: 1px solid grey;
        position: relative;
        margin: 30px 0;
        margin-bottom: 75px;
    }

    .txtb input {
        font-size: 24px;
        color: rgb(0, 132, 255);
        border: none;
        width: 100%;
        outline: none;
        background: none;
        padding: 0 5px;
        height: 50px;
    }

    .txtb span::before {
        content: attr(data-placeholder);
        color: black;
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        transition: 0.5s;
        z-index: -1;
    }

    .txtb span::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 0px;
        transform: translateY(50%);
        width: 0%;
        height: 5px;
        background: linear-gradient(120deg, #3498db, #8e44ad);
        transition: 0.5s;
    }

    .txtb .focus+span::before {
        top: -10px;
    }

    .txtb .focus+span::after {
        width: 100%;
        top: 48px;
    }
    </style>

    <body>
        <div class="txtb"><input type="text"><span data-placeholder="Nom"></span></div>
        <div class="txtb"><input type="text"><span data-placeholder="Prénom"></span></div>
        <div class="txtb"><input type="text"><span data-placeholder="Email"></span></div>
        <div class="txtb"><input type="text"><span data-placeholder="Identifiant"></span></div>
        <div class="txtb"><input type="password"><span data-placeholder="Mot de passe"></span></div>
        <div class="txtb"><input type="password"><span data-placeholder="Confirmation du mot de passe"></span></div>
        <script>
        var label = document.querySelectorAll(".txtb input");
        label.forEach(element => {
            element.addEventListener("focus", (e) => {
                e.target.classList.add("focus");
            });
            element.addEventListener("blur", (e) => {
                e.target.classList.remove("focus");
            });

        });
        </script>
    </body>

</html>