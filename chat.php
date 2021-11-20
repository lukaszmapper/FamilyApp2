<html>
    <head>
        <meta charset="utf-8">
        <title>FamilyApp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleMain.css">
    </head>
    <body>
        <?php
            if (!isset($_COOKIE['user'])) {
                header("Refresh: 0; url = login.php");
            }
        ?>
        <div class="logo">

        <div class="header">
            <div class="dropdown">
            <img class="menu_icon" src="img/menu_icon.svg" width="50px" alt="menu">
            <div class="dropdown_content menu-hiden">
                <p class="user_name">Szymon Karpiel</p>
                <p class="logInOut">Logout</p>
            </div>
            <h1 class="title">FamilyApp</h1>
            </div>
        </div>
        <div class = 'mainCzat'>

        </div>
        <div class = 'wyslij'>
            <div class = 'formularz'>
                <input type = "text" id = 'inputCzat' name = "tekst" autocomplete = "off" placeholder = "Wpisz wiadomość...">
                <button type = "button" id = 'send'></button>
            </div>
        </div>
        
    </body>