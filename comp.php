<?php
    session_start();
    include("functions.php");
    ConnectDB();
    include("header.php");

    if (!isset($_GET['comp'])) {
        die("Acces invalid!");
     }

     $query=mysql_query("SELECT * FROM produse where ID= ". $_GET['comp']);
     if (!$query) {
          die("Query invalid! " . mysql_error());
     }

     if (mysql_num_rows($query)<1){
        die("Acces invalid");
     }
     $array=mysql_fetch_assoc($query);
     echo '<p><span class="numeprodus"> ' . $array['Nume'] . ',&nbsp;</span>';
     echo '<span class="producatorcomp">' . $array['Producator'] . "</span></p><br />";

     $query = mysql_query("SELECT * FROM versiuni WHERE IDProdus = " . $_GET['comp']);
     if (!$query) {
          die("Query invalid! " . mysql_error());
     }

     function stoc($disp){
        if($disp>=5)
            return "In stoc";
        if($disp>0)
            return "Stoc limitat";
        return "La comanda";
     }

     echo "<table><tr><th>Procesor</th><th>An productie</th><th>Pret</th><th>Disponibilitate</th><th></th></tr>";
     while ($array = mysql_fetch_assoc($query)) {
         echo "<tr><td>" . $array['Procesor'] . "</td><td>" .
                           $array['An'] . "</td><td>" .
                           number_format($array['Pret'], 2) . " RON</td><td>" .
                           stoc($array['Disp']) . "</td><td>\n";
         echo "<form action=\"buy.php\" method=\"POST\">\n";
         echo "<input class=\"inlineinput\" type=\"text\" name=\"quant\" value=\"1\" />\n";
         echo "<input class=\"inlinebutton\" type=\"submit\" value=\"Cumpara\" />\n";
         echo "<input type=\"hidden\" name=\"addcomp\" value=\"" . $array['ID'] . "\" />\n";
         echo "</form>\n";
         echo "</td></tr>\n";
     }
     echo "</table>";

    readfile("footer.html");
?>
