<?php
    session_start();
    include("functions.php");
?>
<html>
      <head>
            <title>ComputerShop</title>
      </head>
      <body>
<?php
    if($_SESSION['is_admin']==false){
        if(isset($_POST['user'])&& isset($_POST['password'])) {
            if(($_POST['user']== 'admin')&& ($_POST['password']=='admin'))
                $_SESSION['is_admin']=true;
            else
                die("Parola incorecta");
        }
    }

    if ($_SESSION['is_admin']==false){
?>
    <form method="POST" action="admin.php">
    User: <input type="text" name="user"/> <br />
    Parola: <input type="password" name="password"/> <br />
    <input type="submit" value="Log in" />
    </form>
<?php
    } else {
        ConnectDB();

        if (isset($_GET['deluser'])) {
            $query = mysql_query("DELETE FROM useri WHERE ID=\"" . $_GET['deluser'] . "\"");
            if (!$query) {
               die("Query invalid! " . mysql_error());
            }
        }

        $query = mysql_query("SELECT * FROM useri");
        if (!$query) {
            die("Query invalid! " . mysql_error());
        }

        if (mysql_num_rows($query) > 0) {
          echo "<table><tr><th>Nume</th><th>Adresa</th><th>Operatii</th></tr>";

            while($array = mysql_fetch_assoc($query)) {
              echo "<tr><td>" .
                   $array['Nume'] . "</a></td><td>" .
                   $array['Adresa'] . "</td><td>" .
                   "<a href=\"admin.php?deluser=" . $array['ID'] . "\">Sterge utilizator</a></td></tr>";
            }

            echo "</table>";
        }
    }
?>

    </body>
</html>
