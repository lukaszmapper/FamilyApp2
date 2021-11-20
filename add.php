<html>
  <head>
    <meta charset="utf-8" />
    <title>FamilyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleAdd.css" />
  </head>
  <body>
    <div class="logo">
      <h1 class="title"><a href="index.php">FamilyApp</a></h1>
    </div>
    <div class="main">
      <form action = '' method = 'post'>
        <label>Title</label>
        <input name = 'title' class="input" required/>
        <label>Description</label>
        <textarea name = 'desc' maxlength="240"></textarea>
        <label>Time</label>
        <div>
            <input class="input" name = 'time' type="time"/>
            <input class="input" name = 'date' type="date"/>
        </div>
            <label>User</label>
            <input class="input" type='text' name = 'a' id = 'a' value = '' onclick='show()' readonly>
            <?php
                include 'config.php';
                $id1 = $_COOKIE['user'];
                $query1 = "SELECT family_id, id FROM users WHERE id = '$id1'";
                $result1 = mysqli_query($conn, $query1);
                if (mysqli_num_rows($result1) > 0) {
                  while($row = mysqli_fetch_assoc($result1)) {
                      $family_id = $row['family_id'];
                  }
                }
                $query2 = "SELECT login FROM users WHERE family_id = $family_id";
                $result2 = mysqli_query($conn, $query2);
                if (mysqli_num_rows($result2) > 0) {
                  $i = 0;
                  echo "<div id='list' class='list' style = 'opacity: 0;'>";
                  while($row = mysqli_fetch_assoc($result2)) {
                      $i++;
                      $login = $row['login'];
                      echo "<input class = 'add-user' onclick='user(event)' type = 'text' value = '$login' id = 'i$i' readonly>";
                  }
                  echo "</div>";
                }
            ?>
            <input class = 'submit' type = 'submit' value = 'Send'>
      </form>
      <?php
        if (!empty($_POST['title']) && !empty($_POST['desc']) && !empty($_POST['time']) && !empty($_POST['date']) && !empty($_POST['a'])) {
          $title = $_POST['title'];
          $desc = $_POST['desc'];
          $datetime = $_POST['date'] . " " . $_POST['time'];
          $a = $_POST['a'];
          $query4 = "SELECT id FROM users WHERE login = '$a'";
          $result4 = mysqli_query($conn, $query4);
          if (mysqli_num_rows($result4) > 0) {
            while($row = mysqli_fetch_assoc($result4)) {
                $id2 = $row['id'];
            }
          }
          $query3 = "INSERT INTO quests VALUES ('', '$title', '$desc', '$datetime', '$id2')";
          if (mysqli_query($conn, $query3)) {
            echo "New record created successfully";
            header("Refresh: 0; url = index.php");
          } else {
            echo "bruh";
          }
        } else {
          if (isset($_POST['title']) || isset($_POST['desc']) || isset($_POST['time']) || isset($_POST['date']) || isset($_POST['a'])) {
            echo "Wprowadź wszystkie dane";
          }
        }
      ?>
    </div>
    <script>
        function user(event) {
            document.getElementById('a').value = document.getElementById(event.target.id).value;
        }
        function show() {
            document.getElementById('list').style.opacity = 1;
        }
    </script>
  </body>
</html>
