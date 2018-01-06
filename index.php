<?php
    session_start();
    include("functions.php");
    ConnectDB();

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $result = mysql_query('SELECT 1 FROM useri WHERE Nume="' . mysql_real_escape_string($_POST['user']) . '" AND Parola="' . mysql_real_escape_string($_POST['pass']) . '"');
        if ($result && (mysql_num_rows($result) == 1)) {
            $_SESSION['user'] = $_POST['user'];
        }
    } else if (isset($_POST['logout'])) {
        unset($_SESSION['user']);
        unset($_SESSION['comps']);
    }

    include("header.php");
?>
      <p>
      <form method="GET" action="search.php">
        <table><tr><td>
        <div class="label">Nume:</div>
        <input class="input" type="text" name="Nume" value="<?php if (isset($_GET['Nume'])) echo $_GET['Nume'];?>" />
        </td><td>
        <div class="label">Producator:</div>
        <input class="input" type="text" name="Producator" value="<?php if (isset($_GET['Producator'])) echo $_GET['Producator'];?>" />
        </td><td>
        <div class="label">Categorie:</div>
        <input class="input" type="text" name="categorie" value="<?php if (isset($_GET['categorie'])) echo $_GET['categorie'];?>"/>
        </td></tr></table>
        <input class="button" type="submit" value="Cauta" />
      </form>
<?php
     $where = '';
     if (isset($_GET['Nume']) && ($_GET['Nume'] != '')) {
        $where = "WHERE Nume = '" . mysql_real_escape_string($_GET['Nume']) . "' ";
     }
     if (isset($_GET['Producator']) && ($_GET['Producator'] != '')) {
        if ($where != '') {
           $where .= 'AND ';
        } else {
           $where = 'WHERE ';
        }
        $where .= "Producator = '" . mysql_real_escape_string($_GET['Producator']) . "' ";
     }
     if (isset($_GET['categorie']) && ($_GET['categorie'] != '')) {
        if ($where != '') {
           $where .= 'AND ';
        } else {
           $where = 'WHERE ';
        }
        $where .= "Categorie = '" . mysql_real_escape_string($_GET['categorie']) . "' ";
     }

     $text = "SELECT * FROM produse " . $where;
     $query = mysql_query($text);
     if (!$query) {
        echo $text;
        die("Query invalid! " . mysql_error());
     }

     if (mysql_num_rows($query) > 0) {
        echo "Am gasit " . mysql_num_rows($query) . " inregistrari! <br />";
        echo "<table class=\"searchtable\"><tr><th>Nume</th><th>Producator</th><th>Categorie</th></tr>";

        while($array = mysql_fetch_assoc($query)) {
            echo "<tr><td><a href=\"comp.php?comp=" . $array['ID'] . "\">" .
                 $array['Nume'] . "</a></td><td>" .
                 $array['Producator'] . "</td><td>" .
                 $array['Categorie'] . "</td></tr>";
        }

        echo "</table>";
     } else {
        echo "Nu am gasit nici un rezultat! <br />";
     }
     echo "</p>";
     readfile("footer.html");
?>