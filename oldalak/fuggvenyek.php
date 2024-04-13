<?php

function reszlegek(){
    $adatok = array();
    $ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
    if (mysqli_select_db($ab, 'vallalat')) {
        $sql = "SELECT reszleg_nev FROM reszleg;";
        $eredmeny = $ab->query($sql);
        if ($eredmeny->num_rows > 0) {
            while ($sor = $eredmeny->fetch_assoc()) {
                $adatok[] = $sor["reszleg_nev"];
            }
        }
    }
    mysqli_close($ab);
    return $adatok;
}

function lenagyobb_fizetes(){
    $adatok = array();
    $ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
    if (mysqli_select_db($ab, 'vallalat')) {
        $sql = "SELECT dolgozo.ceges_azonosito, dolgozo.nev, dolgozo.telefon, dolgozo.email, dolgozo.fizetes, dolgozo.beosztas, dolgozo.reszleg_nev AS rnev, reszleg.osztaly_nev FROM dolgozo, reszleg WHERE dolgozo.reszleg_nev = reszleg.reszleg_nev AND dolgozo.fizetes = (SELECT MAX(fizetes) FROM dolgozo);";
        $eredmeny = $ab->query($sql);
        if ($eredmeny->num_rows > 0) {
            while ($sor = $eredmeny->fetch_assoc()) {
                $adatok[] = [$sor["ceges_azonosito"], $sor["nev"], $sor["telefon"], $sor["email"], $sor["fizetes"], $sor["beosztas"], $sor["rnev"], $sor["osztaly_nev"]];
            }
        }
    }
    mysqli_close($ab);
    return $adatok;
}
function reszleg_atlag(){
    $atlag = 0;
    $ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
    if (mysqli_select_db($ab, 'vallalat')) {
        $sql = "SELECT AVG(fizetes) AS fiz FROM dolgozo WHERE reszlegvezeto_e = 1";
        $eredmeny = $ab->query($sql);
        if ($eredmeny->num_rows > 0) {
            $atlag = $eredmeny->fetch_assoc()["fiz"];
        }
    }
    mysqli_close($ab);
    return $atlag;
}

function lejart(){
    $adatok = [];
    $ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
    if (mysqli_select_db($ab, 'vallalat')){
        $sql = "SELECT DISTINCT projekt.nev AS pnev, dolgozo.nev AS dnev, dolgozo.email AS email, dolgozo.ceges_azonosito AS cazon, projekt.id AS pid FROM projekt, dolgozik, dolgozo WHERE projekt.hatarido < CURDATE() AND (dolgozo.ceges_azonosito, projekt.id) NOT IN(SELECT DISTINCT dolgozik.ceges_azonosito, dolgozik.id FROM dolgozik) AND (projekt.id, dolgozo.ceges_azonosito) IN (SELECT id, ki_dolgozik_rajta FROM kik_dolgoznak_rajta);";
        $elokeszites = mysqli_prepare($ab, $sql);
        mysqli_stmt_execute($elokeszites);
        $eredmeny = mysqli_stmt_get_result($elokeszites);
        if ($eredmeny->num_rows > 0) {
            while ($sor = $eredmeny->fetch_assoc()) {
                $adatok[] = [$sor["pnev"], $sor["dnev"], $sor["email"], $sor["cazon"], $sor["pid"]];
            }
        }
    }
    mysqli_close($ab);
    return $adatok;
}
