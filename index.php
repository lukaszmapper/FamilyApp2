<html>
    <head>
        <meta charset="utf-8">
        <title>FamilyApp</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleMain.css">
    </head>
    <body>

    <div class="header">
      <a onclick="hideMenu()"
        ><img class="menu-icon" src="img/menu_icon.svg" width="50px" alt="menu"/></a>
      <h1 class="title">FamilyApp</h1>
    </div>
    <div class="dropdown">
      <div class="menu-hiden dropdown-content" id="menu">
        <div class="menu-content">
          <p class="user-name">Szymon Karpiel</p>
          <div>
          <?php
            if (!isset($_COOKIE['user'])) {
                header("Refresh: 0; url=login.php");
            } else {
                echo "<form action = 'logout.php' method='post'>
                      <input class = 'log-in-out' type = 'submit' value = 'Wyloguj' name = 'logout'> 
                      </form>";
            }

        ?>
          </div>
        </div>
      </div>
    </div>
        <div class="main">
            <?php
            include 'config.php';
            if ($conn) {
                $id = $_COOKIE['user'];
                $query = "SELECT title, description, dt FROM quests WHERE user_id = $id";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['title'];
                        $description = $row['description'];
                        $dt = $row['dt'];
                        echo "<div class = 'element'>
                              <h2 class = 'element-title'>$title</h2>
                              <p class = 'element-description'>$description</p>
                              <p class = 'element-time'>Termin: $dt</p>
                              </div>";
                              $i++;
                              if ($i != mysqli_num_rows($result)) {
                                  echo "<hr>";
                              }
                    }
                    
                }
            }
            ?>
        </div>
        <script>
      function hideMenu() {
        let menu = document.getElementById("menu");
        menu.classList.toggle("menu-hiden");
        console.log("menu");
      }
    </script>
    <footer>
      <a href = 'chat.php'><p><img src="img/chat_icon.svg" alt="chat">Chat</p></a>
      <a href = 'add.php'><p><img src="img/tasks_icon.svg" alt="tasks">Tasks</p></a>
      <p><img src="img/home_icon.svg" alt="family">Family</p>
    </footer>
    </body>
</html>