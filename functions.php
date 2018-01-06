<?php

    function ConnectDB() {
        if (!mysql_connect("127.0.0.1", "ComputerShop", "comp")) {
            die("Nu se poate realiza conexiunea la baza de date!");
        }

        if (!mysql_select_db("compShop")) {
            die("Nu se poate selecta din baza de date!");
        }
    }

    function Addcomp($comp, $count) {
        if (isset($_SESSION['comps'][$comp])) {
            $_SESSION['comps'][$comp] += $count;
        } else {
            $_SESSION['comps'][$comp] = $count;
        }
    }

    function Remcomp($comp, $count) {
        if ((isset($_SESSION['comps'][$comp]) && ($_SESSION['comps'][$comp] >= $count))) {
            $_SESSION['comps'][$comp] -= $count;
            if ($_SESSION['comps'][$comp] == 0) {
                unset($_SESSION['comps'][$comp]);
            }
        }
    }

    function CalcValue() {
        $price = 0;
        if (isset($_SESSION['comps'])) {
            $query = mysql_query("SELECT * FROM catalog WHERE id_caracteristici IN (" . implode(",", array_keys($_SESSION['comps'])) . ")");
            if ($query) {
                while ($array = mysql_fetch_assoc($query)) {
                    $price += $_SESSION['comps'][$array['id_caracteristici']] * $array['Pret'];
                }
            }
        }
        return number_format($price, 2);
    }

    function CalcCount() {
        if (isset($_SESSION['comps'])) {
            return count($_SESSION['comps']);
        }
        return  0;
    }
?>
