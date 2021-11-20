<!DOCTYPE html>
<?php
    if (isset($_COOKIE['user'])) {
        header("Refresh: 0; url='index.php'");
    }
?>
<html>
    <head>
        <meta name = 'viewport' content = "width=device-width, initial-scale=1.0">
        <meta charset = 'utf-8'>
        <link rel="stylesheet" href="styleRegister.css">
    </head>
    <body>
    <div class="logo">
            FamilyApp
        </div>
        <form action = '' method = 'POST'>
            <label>Login:</label>
            <input type = 'text' name = 'login'  class="input">
            <label>Password:</label>
            <input type = 'password' name = 'pass' class="input"> 
             <label>Family ID:</label>
            <input type = 'number' name = 'family' class="input"> 
            <label>Family Name</label>
            <input type = 'text' name = 'family_name' class="input"> 
            <input type = 'submit' name = 'submit' value = 'Sign Up' class="button">
        <?php
            include 'config.php';
            if (!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['family'])) {
                if ($conn) {
                    $query1 = "SELECT id, family_name FROM families"; 
                    $result = mysqli_query($conn, $query1);
                    $i = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["id"] == $_POST['family']) {
                                $i++;
                            } 
                        }
                    }
                    $family_id = $_POST['family'];
                    if ($i == 0) {
                        $n = $_POST['family_name'];
                        $query2 = "INSERT INTO families VALUES ($family_id, '$n')";
                        if (mysqli_query($conn, $query2)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
                        }  
                    }
                    $log = $_POST['login'];
                    $pass = sha1($_POST['pass']);
                    $query3 = "INSERT INTO users VALUES ('', '$log', '$pass', $family_id)";
                    if (mysqli_query($conn, $query3)) {
                        header("Refresh: 0; url='login.php'");
                    }
                }
            } else {
                if (isset($_POST['login']) || isset($_POST['pass']) || isset($_POST['family']) || isset($_POST['family_name'])) {
                    echo "Wprowadź wszystkie dane";
                }
            }
        ?>
        </form>
    </body>
</html>