<html>
  <head>
    <meta charset="utf-8" />
    <title>FamilyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleFamily.css" />
  </head>
  <body>
    <div class="header">
      <a href = 'index.php'><h1 class="title">FamilyApp</h1></a>
    </div>
    <div class="main">
        <div class ='container'>
            <h3>Członkowie twojej rodziny</h3>
        </div>
        <?php
            include 'config.php';
            if ($conn) {
                $id = $_COOKIE['user'];
                $query = "SELECT family_id FROM users WHERE id = $id";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $family_id = $row['family_id'];
                        echo "<div class = 'container'>
                        Family Id: $family_id
                        </div>";
                    }
                }
                $query2 = "SELECT login, id FROM users WHERE family_id = $family_id";
                $result2 = mysqli_query($conn, $query2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $id2 = $row['id'];
                        $login = $row['login'];
                        echo "<div class='container'>
                        <div class='use'><p>Login: $login</p>
                        <p>User Id: $id2</p>
                        </div>
                      </div>";
                    }
                }
            }
        ?>
    
    </div>
  </body>
</html>