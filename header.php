<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>Magazin Virtual</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="gorotron1.css"/>
</head>
<body>
<div id="container">

<div id="banner">
<div id="bannerLeft"></div>
<div id="bannerRight">
<h1>Mihnea´s ComputerShop</h1>
<!--<h2>.</h2>-->
</div>
</div>

<div id="content">

<div id="leftColumn">

<?php
    if (!isset($_SESSION['user'])) { 
        echo "<form action=\"index.php\" method=\"POST\"><table style=\"width:150px\"><tr><td>Logare Client</td><td><input class=\"inlineinput\" style=\"background-color:#000000; color:##FF0000; width:100%\" type=\"text\" name=\"user\"></td></tr>";
        echo "<tr><td>Parola</td><td><input class=\"inlineinput\" style=\"background-color:#000000; color:##FF0000; width:100%\" type=\"password\" name=\"pass\"></td></tr>";
        echo "<tr><td colspan=\"2\" style=\"text-align:right\"\><input class=\"button\" type=\"submit\" value=\"Log in\" /><td></tr></table></form>";
    } else {
        echo "Bun venit!<br />";
        echo "<form action=\"index.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"logout\" value=\"logout\" />";
        echo "<input class=\"button\" type=\"submit\" value=\"Log out\" /></form>";
    }
    echo "<div>Aveti " . CalcCount() . " obiecte in cos, cost " . CalcValue() . " RON.</div>";
?>
<ul id="nav">
    <li><a href="index.php">Pagina prezentare</a></li>
    <li><a href="buy.php">Cos de cumparaturi</a></li>
</ul>
<div id="leftColumnBottom">
</div>
</div>

<div id="rightColumn">
