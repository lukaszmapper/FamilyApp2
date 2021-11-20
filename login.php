<!DOCTYPE html>
<?php
    if (isset($_COOKIE['user'])) {
        header("Refresh: 0; url='index.php'");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>FamilyApp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="logo">
            FamilyApp
        </div>
        <div class="login">
            <label>Sign in to your account</label><br>
            <form action = '' method = 'post'>
                <input class="input" type="text" name="login" placeholder="Login">
                <input class="input" type="password" name="pass" placeholder="Password">
                <input class="signin" type="submit" value = 'Sign in'>
            </form> 
            <hr>
            <label>Create a new account</label><br>
            <a href='register.php'><button class="signup">Sign up</button></a>
        <?php
            include 'config.php';
            if (!empty($_POST['login']) && !empty($_POST['pass'])) {
                if ($conn) {
                    $query = "SELECT id, login, pass FROM users";
                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    $j = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["login"] == $_POST['login']) {
                                if ($row["pass"] == sha1($_POST["pass"])) {
                                    $i++;
                                    $id = $row['id'];
                                } else {
                                    echo "Źle wprowadzone hasło";
                                    $j++;
                                }
                            }
                        }
                        if ($i == 1) {
                            echo "Zalogowano";
                            echo "<script>           
                            let f = new FormData();
                            f.append('log', '$id');
                            fetch ('cookies.php', {
                                method: 'POST',
                                body: f
                            });
                            </script>";
                            header("Refresh: 0; url='index.php'");
                        } elseif ($j == 0) {
                            echo "Nie istnieje taki użytkownik";
                        }
                    } else {
                        echo "Nie istnieje taki użytkownik";
                    }
                } else {
                    echo "Nie udalo się połączyć z bazą danych";
                }
            } else {
                if (isset($_POST['login']) || isset($_POST['pass'])) {
                    echo '<p>Wprowadź prawidłowo login i hasło</p>';
                }
            }
        ?>
        </div>
    </body>
</html>