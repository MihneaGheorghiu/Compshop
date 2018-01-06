<?php
    session_start();
    include("functions.php");
    ConnectDB();

    if (isset($_POST["addcomp"]) && isset($_POST["quant"])) {
        $query = mysql_query("SELECT Disp FROM caracteristici WHERE ID=" . $_POST["addcomp"]);
        if (!$query || (mysql_num_rows($query) == 0)) {
            echo "Produsul nu exista in baza de date!";
        } else {
            $quant = mysql_fetch_assoc($query);
            if ($quant['Disp'] < $_POST["quant"]) {
                
            } else {
                addcomp($_POST["addcomp"], $_POST["quant"]);
            }
        }
    }

    if (isset($_POST["remcomp"]) && isset($_POST["quant"])) {
        remcomp($_POST["remcomp"], $_POST["quant"]);
    }

    $query = mysql_query("SELECT * FROM catalog WHERE id_caracteristici IN (" . implode(",", array_keys($_SESSION['comps'])) . ")");
    if ($query) {
        while ($array = mysql_fetch_assoc($query)) {
            $prices[$array['id_caracteristici']] = $array;
        }
    } else {
        mysql_error();
    }

    include("header.php");

    if (isset($_SESSION['comps']) && count($_SESSION['comps'])) {
        $pret = 0;
        $cant = 0;
        echo "<table><tr><th>Nume</th><th>PRoducator</th><th>Cantitate</th><th>Pret/Unitate </th><th>Pret</th></tr>";
        foreach ($_SESSION['comps'] as $key => $value) {
            echo "<tr><td><a href=\"comp.php?comp=" . $prices[$key]['id_carte'] . "\">" . $prices[$key]['Titlu'] . "</a>" . 
                "</td><td>" . $prices[$key]['Producator'] .
                "</td><td style=\"text-align:right\">" . number_format($value, 0) .
                "</td><td style=\"text-align:right\">" . number_format($prices[$key]['Pret'], 2) .
                "</td><td style=\"text-align:right\">" . number_format($prices[$key]['Pret'] * $value, 2) . "</td><td>";
            echo "<form action=\"buy.php\" method=\"POST\">\n";
            echo "<input type=\"submit\" value=\"Sterge\" />\n";
            echo "<input type=\"text\" style=\"width:30px;\" name=\"quant\" value=\"1\" />\n";
            echo "<input type=\"hidden\" name=\"remcomp\" value=\"" . $prices[$key]['id_caracteristici'] . "\" />\n";
            echo "</td></tr>";
            $pret += $prices[$key]['Pret'] * $value;
            $cant += $value;
        }
    
        echo "<th colspan=\"2\" style=\"text-align:left\">Total</th>";
        echo "<th style=\"text-align:right\">" . number_format($cant, 0) . "</th><th></th>";
        echo "<th style=\"text-align:right\">" . number_format($pret, 2) .  "</th></table>";
    } else {
        echo "Cosul dumneavoastra este gol";
    }
    readfile("footer.html");
?>
