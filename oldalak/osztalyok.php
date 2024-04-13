<?php

class Felhasznalo{
    private $c_azon;
    private $nev;
    private $jelszo;
    private $telefon;
    private $email;
    private $fizetes = 0;
    private $beosztas;
    private $reszlegvezetoe = 0;
    private $osztalyvezetoe = 0;
    private $admine = 0;
    private $reszleg_nev;
    private $ab;

    public function __construct(){
        $this->ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
        mysqli_query($this->ab, 'SET NAMES utf8');
        mysqli_query($this->ab, "SET character_set_results=utf8");
        mysqli_set_charset($this->ab, 'utf8');
    }
    public function adatMentes(){
        $this->c_azon = $this->cAzonGeneralas();
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "INSERT INTO dolgozo VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "sssssisiiis", $this->c_azon, $this->nev,
                $this->jelszo, $this->telefon, $this->email, $this->fizetes, $this->beosztas, $this->reszlegvezetoe,
                $this->osztalyvezetoe, $this->admine, $this->reszleg_nev);
            if ($this->ab->query($sql) === FALSE) {
                die("Nem sikerült az adatbázisba menteni az adatokat.". mysqli_error($this->ab));
            }
        }
    }

    public function betolt(){
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT * FROM dolgozo WHERE ceges_azonosito = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "s", $this->c_azon);
            mysqli_stmt_execute($elokeszites);
            $eredmeny = mysqli_stmt_get_result($elokeszites);
            if($eredmeny->num_rows > 0){
                $oszlop = $eredmeny->fetch_assoc();
                $this->nev = $oszlop["nev"];
                $this->jelszo = $oszlop["jelszo"];
                $this->telefon = $oszlop["telefon"];
                $this->email = $oszlop["email"];
                $this->fizetes = $oszlop["fizetes"];
                $this->beosztas = $oszlop["beosztas"];
                $this->reszlegvezetoe = $oszlop["reszlegvezeto_e"];
                $this->osztalyvezetoe = $oszlop["osztalyvezeto_e"];
                $this->admine = $oszlop["admin_e"];
                $this->reszleg_nev = $oszlop["reszleg_nev"];
                return 0;
            }
            else{
                return -1;
            }
        }
    }
    public function ceges_azonositok(){
        $cazon = array();
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "SELECT ceges_azonosito FROM dolgozo ORDER BY CAST(SUBSTRING(ceges_azonosito, 4) AS UNSIGNED);";
            $eredmeny = $this->ab->query($sql);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $cazon[] = $sor["ceges_azonosito"];
                }
            }
        }
        return $cazon;
    }
    public function torles(){
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "DELETE FROM dolgozo WHERE ceges_azonosito = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "s", $this->c_azon);
            mysqli_stmt_execute($elokeszites);
            return 0;
        }
        return -1;
    }
    public function frissites(){
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "UPDATE dolgozo SET telefon = ?, email = ?, fizetes = ?, beosztas = ?, reszlegvezeto_e = ?, osztalyvezeto_e = ?, admin_e = ?, reszleg_nev = ? WHERE ceges_azonosito = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "ssisiiiss", $this->telefon, $this->email, $this->fizetes, $this->beosztas, $this->reszlegvezetoe, $this->osztalyvezetoe, $this->admine, $this->reszleg_nev, $this->c_azon);
            mysqli_stmt_execute($elokeszites);
            return 0;
        }
        return -1;
    }
    private function cAzonGeneralas(){
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT ceges_azonosito FROM dolgozo ORDER BY CAST(SUBSTRING(ceges_azonosito, 4) AS UNSIGNED) DESC LIMIT 1;";
        }
        $eredmeny = $this->ab->query($sql);
        if ($eredmeny->num_rows > 0) {
            $oszlop = $eredmeny->fetch_assoc();
            $utolso_azon = $oszlop["ceges_azonosito"];
            $utolso_szam = intval(substr($utolso_azon, 3));
            $uj_szam = $utolso_szam + 1;
            return "dol" . $uj_szam;
        }
        else {
            return "dol1";
        }
    }
    ///////////getterek setterek\\\\\\\\\\\\\
    public function getCAzon(){
        return $this->c_azon;
    }
    public function getNev(){
        return $this->nev;
    }
    public function getJelszo(){
        return $this->jelszo;
    }
    public function getTelefon(){
        return $this->telefon;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFizetes(){
        return $this->fizetes;
    }
    public function getBeosztas(){
        return $this->beosztas;
    }
    public function getReszlegvezetoe(){
        return $this->reszlegvezetoe != 0;
    }
    public function getOsztalyvezetoe(){
        return $this->osztalyvezetoe != 0;
    }
    public function getReszlegNev(){
        return $this->reszleg_nev;
    }
    public function setTelefon($telefon){
        $this->telefon = $telefon;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setFizetes($fizetes){
        $this->fizetes = $fizetes;
    }
    public function setBeosztas($beosztas){
        $this->beosztas = $beosztas;
    }
    public function setReszlegvezetoe($reszlegvezetoe){
        $this->reszlegvezetoe = $reszlegvezetoe;
    }
    public function setOsztalyvezetoe($osztalyvezetoe){
        $this->osztalyvezetoe = $osztalyvezetoe;
    }
    public function setReszlegNev($reszleg_nev){
        $this->reszleg_nev = $reszleg_nev;
    }
    public function setCAzon($c_azon){
        $this->c_azon = $c_azon;
    }
    public function setNev($nev){
        $this->nev = $nev;
    }
    public function setJelszo($jelszo){
        $this->jelszo = $jelszo;
    }
    public function setAdmin($admin){
        $this->admine = $admin;
    }
    public function isAdmin(){
        return $this->admine != 0;
    }

}

class Dolgozik{
    private $cazon;
    private $id;
    private $beszamolo;
    private $ab;

    public function __construct(){
        $this->ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
        mysqli_query($this->ab, 'SET NAMES utf8');
        mysqli_query($this->ab, "SET character_set_results=utf8");
        mysqli_set_charset($this->ab, 'utf8');
    }

    public function mentes(){
        $this->cazon = mysqli_real_escape_string($this->ab, $this->cazon);
        $this->id = mysqli_real_escape_string($this->ab, $this->id);
        $this->beszamolo = mysqli_real_escape_string($this->ab, $this->beszamolo);
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "INSERT INTO dolgozik VALUES ('$this->cazon', '$this->id', '$this->beszamolo')";
            if ($this->ab->query($sql) === FALSE) {
                die("Nem sikerült az adatbázisba menteni az adatokat.". mysqli_error($this->ab));
            }
        }
    }
    public function betolt(){
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT * FROM dolgozik WHERE ceges_azonosito = ? AND id = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "si", $this->cazon, $this->id);
            mysqli_stmt_execute($elokeszites);
            $eredmeny = mysqli_stmt_get_result($elokeszites);
            if($eredmeny->num_rows > 0){
                $oszlop = $eredmeny->fetch_assoc();
                $this->beszamolo = $oszlop["beszamolo"];
                return 0;
            }
            else{
                return -1;
            }
        }
    }
    public function kell_e_beszamolo($cazon, $id){
        $dolgozik = $this->dolgozik_rajta();
        if(in_array([$id,$cazon], $dolgozik)){
            return true;
        }
        return false;
}
    public function nevek(){
        $nevek = [];
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT nev FROM kik_dolgoznak_rajta, dolgozo WHERE id = ? AND ki_dolgozik_rajta = ceges_azonosito ORDER BY nev;";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "i", $this->id);
            mysqli_stmt_execute($elokeszites);
            $eredmeny = mysqli_stmt_get_result($elokeszites);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $nevek[] = $sor["nev"];
                }
            }
        }
        return $nevek;
    }

    private function dolgozik_rajta(){
        $dolgozik = [];
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT id, ki_dolgozik_rajta FROM kik_dolgoznak_rajta;";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_execute($elokeszites);
            $eredmeny = mysqli_stmt_get_result($elokeszites);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $dolgozik[] = [$sor["id"], $sor["ki_dolgozik_rajta"]];
                }
            }
        }
        return $dolgozik;
    }
    ///////////getterek setterek\\\\\\\\\\\\\
    public function getCazon(){
        return $this->cazon;
    }
    public function setCazon($cazon){
        $this->cazon = $cazon;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getBeszamolo(){
        return $this->beszamolo;
    }
    public function setBeszamolo($beszamolo){
        $this->beszamolo = $beszamolo;
    }
}

class Osztaly{
    private $osztaly_nev;
    private $feladat;
    private $ab;

    public function __construct(){
        $this->ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
        mysqli_query($this->ab, 'SET NAMES utf8');
        mysqli_query($this->ab, "SET character_set_results=utf8");
        mysqli_set_charset($this->ab, 'utf8');
    }

    public function mentes(){
        $this->osztaly_nev = mysqli_real_escape_string($this->ab, $this->osztaly_nev);
        $this->feladat = mysqli_real_escape_string($this->ab, $this->feladat);
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "INSERT INTO osztaly VALUES ('$this->osztaly_nev', '$this->feladat')";
            if ($this->ab->query($sql) === FALSE) {
                die("Nem sikerült az adatbázisba menteni az adatokat.". mysqli_error($this->ab));
            }
        }
    }
    public function kulcsok(){
        $kulcsok= array();
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "SELECT osztaly_nev FROM osztaly";
            $eredmeny = $this->ab->query($sql);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $kulcsok[] = $sor["osztaly_nev"];
                }
            }
        }
        return $kulcsok;
    }
    ///////////getterek setterek\\\\\\\\\\\\\
    public function getOsztalyNev(){
        return $this->osztaly_nev;
    }
    public function setOsztalyNev($osztaly_nev){
        $this->osztaly_nev = $osztaly_nev;
    }
    public function getFeladat(){
        return $this->feladat;
    }
    public function setFeladat($feladat){
        $this->feladat = $feladat;
    }
}

class Projekt{
    private $id;
    private $nev;
    private $hatarido;
    private $leiras;
    private $projektvezeto;
    private $ab;

    public function __construct(){
        $this->ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
        mysqli_query($this->ab, 'SET NAMES utf8');
        mysqli_query($this->ab, "SET character_set_results=utf8");
        mysqli_set_charset($this->ab, 'utf8');
    }
    public function azonositok(){
        $kulcsok = array();
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "SELECT id FROM projekt";
            $eredmeny = $this->ab->query($sql);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $kulcsok[] = $sor["id"];
                }
            }
        }
        return $kulcsok;
    }
    public function mentes(){
        $this->nev = mysqli_real_escape_string($this->ab, $this->nev);
        $this->hatarido = mysqli_real_escape_string($this->ab, $this->hatarido);
        $this->leiras = mysqli_real_escape_string($this->ab, $this->leiras);
        $this->projektvezeto = mysqli_real_escape_string($this->ab, $this->projektvezeto);
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "INSERT INTO projekt (nev, hatarido, leiras, projektvezeto) VALUES ('$this->nev', '$this->hatarido', '$this->leiras', '$this->projektvezeto')";
            if ($this->ab->query($sql) === FALSE) {
                die("Nem sikerült az adatbázisba menteni az adatokat.". mysqli_error($this->ab));
            }
        }
    }

    ///////////getterek setterek\\\\\\\\\\\\\
    public function getId(){
        return $this->id;
    }
    public function getNev(){
        return $this->nev;
    }
    public function setNev($nev){
        $this->nev = $nev;
    }
    public function getHatarido(){
        return $this->hatarido;
    }
    public function setHatarido($hatarido){
        $this->hatarido = $hatarido;
    }
    public function getLeiras(){
        return $this->leiras;
    }
    public function setLeiras($leiras){
        $this->leiras = $leiras;
    }
    public function getProjektvezeto(){
        return $this->projektvezeto;
    }
    public function setProjektvezeto($projektvezeto)
    {
        $this->projektvezeto = $projektvezeto;
    }
}

class Reszleg{
    private $reszleg_nev;
    private $feladat;
    private $osztaly_nev;
    private $ab;

    public function __construct(){
        $this->ab = mysqli_connect('localhost', 'root','') or die("Hibás csatlakozás!");
        mysqli_query($this->ab, 'SET NAMES utf8');
        mysqli_query($this->ab, "SET character_set_results=utf8");
        mysqli_set_charset($this->ab, 'utf8');
    }
    public function betolt(){
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "SELECT * FROM reszleg WHERE reszleg_nev = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "s", $this->reszleg_nev);
            mysqli_stmt_execute($elokeszites);
            $eredmeny = mysqli_stmt_get_result($elokeszites);
            if($eredmeny->num_rows > 0){
                $oszlop = $eredmeny->fetch_assoc();
                $this->feladat = $oszlop["feladat"];
                $this->osztaly_nev = $oszlop["osztaly_nev"];
                return 0;
            }
            else{
                return -1;
            }
        }
    }
    public function torles(){
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "DELETE FROM reszleg WHERE reszleg_nev = ?";
            $elokeszites = mysqli_prepare($this->ab, $sql);
            mysqli_stmt_bind_param($elokeszites, "s", $this->reszleg_nev);
            mysqli_stmt_execute($elokeszites);
            return 0;
        }
        return -1;
    }
    public function mentes(){
        $this->reszleg_nev = mysqli_real_escape_string($this->ab, $this->reszleg_nev);
        $this->feladat = mysqli_real_escape_string($this->ab, $this->feladat);
        $this->osztaly_nev = mysqli_real_escape_string($this->ab, $this->osztaly_nev);
        if (mysqli_select_db($this->ab, 'vallalat')){
            $sql = "INSERT INTO reszleg VALUES ('$this->reszleg_nev', '$this->feladat', '$this->osztaly_nev')";
            if ($this->ab->query($sql) === FALSE) {
                die("Nem sikerült az adatbázisba menteni az adatokat.". mysqli_error($this->ab));
            }
        }
    }
    public function kulcsok(){
        $kulcsok= array();
        if (mysqli_select_db($this->ab, 'vallalat')) {
            $sql = "SELECT reszleg_nev FROM reszleg";
            $eredmeny = $this->ab->query($sql);
            if ($eredmeny->num_rows > 0) {
                while ($sor = $eredmeny->fetch_assoc()) {
                    $kulcsok[] = $sor["reszleg_nev"];
                }
            }
        }
        return $kulcsok;
    }
    ///////////getterek setterek\\\\\\\\\\\\\
    public function getReszlegNev(){
        return $this->reszleg_nev;
    }
    public function setReszlegNev($reszleg_nev){
        $this->reszleg_nev = $reszleg_nev;
    }
    public function getFeladat(){
        return $this->feladat;
    }
    public function setFeladat($feladat){
        $this->feladat = $feladat;
    }
    public function getOsztalyNev(){
        return $this->osztaly_nev;
    }
    public function setOsztalyNev($osztaly_nev){
        $this->osztaly_nev = $osztaly_nev;
    }
}