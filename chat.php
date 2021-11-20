<html>
  <head>
    <meta charset="utf-8" />
    <title>FamilyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleChat.css" />
  </head>
  <body>
    <div class="header">
    <h1 class = 'title'>FamilyApp</h1>
    </div>
    <div class = 'main' id = 'main'>
    </div>
    <div class="send-container">
      <div class="send">
        <div class="form">
          <input
            type="text"
            id="inputCzat"
            name="tekst"
            autocomplete="off"
            placeholder="Type a message..."
            class="input"
          />
          <button type="button" id="send" class="button">Send</button>
        </div>
      </div>
    </div>
    <?php 
        include 'config.php';
        if ($conn) {
            $id = $_COOKIE['user'];
            $query = "SELECT login, family_id FROM users WHERE id = $id";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $nick = $row['login'];
                    $family_id = $row['family_id'];
                }
            }
        }
    ?>
    <script>
        let family_id = <?php echo $family_id; ?>;
        function send() {
            let nick = <?php echo "'$nick'"; ?>;
            let wiadomosc = document.getElementById('inputCzat').value;
            console.log('bruh');
                if (wiadomosc != '') {
                    
                    let formData = new FormData();
                    formData.append('tekst', wiadomosc);
                    formData.append('nick', nick);
                    formData.append('family_id', family_id);
                    fetch ('save.php', {
                        method: 'POST',
                        body: formData
                    }).then(function (response) {
                        return response.text(); 
                    }).then(function (response) {
                        document.getElementById('main').innerHTML += response;
                        document.getElementById('inputCzat').value = '';
                        document.getElementById('main').scrollTop = document.getElementById('main').scrollHeight;
                    });
                }
            }
            document.getElementById('send').addEventListener('click', send);
            function read() {
                let fd = new FormData();
                fd.append('family_id', family_id);
                fetch('read.php', {
                    method: 'POST',
                    body: fd
                }).then(function (response) {
                    return response.text();
                }).then(function (response) {
                        let i = document.getElementById('main').childElementCount;
                        document.getElementById('main').innerHTML = response;
                        let j = document.getElementById('main').childElementCount;
                        if(i < j) {
                            document.getElementById('main').scrollTop = document.getElementById('main').scrollHeight;
                        }
                });
            }
            setInterval(read, 1000);
            document.getElementById('inputCzat').addEventListener('keydown', function (x) {
                if (x.key === 'Enter') {
                   wyslij();
                }
            });
    </script>
  </body>
</html>
