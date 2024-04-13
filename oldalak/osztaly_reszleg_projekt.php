<?php
include_once "menetkovetesAdmin.php";
$felhasznalo = $_SESSION["user"];
$dolgozo = new Felhasznalo();

if (isset($_POST["rtorles"])){
     $reszleg = new Reszleg();
     $reszleg->setReszlegNev($_POST["rnev"]);
    if($reszleg->torles() === 0){
        echo "<script>alert('Sikeres a törlés!'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
    }
    else{
        echo "<script>alert('Nem sikerült a törlés'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
    }
}
$hibak = [];
if (isset($_POST["mentes"])){
    $osztaly = new Osztaly();
    $osztaly->setOsztalyNev($_POST["onev"]);
    $osztaly->setFeladat($_POST["fel"]);


    if (trim($osztaly->getOsztalyNev()) === "")  $hibak[] = "ures_nev";
    if (trim($osztaly->getFeladat()) === "")  $hibak[] = "ures_feladat";

    if (count($hibak) === 0) {
        $osztaly->mentes();
        echo "<script>alert('Sikeresen felvetted az új osztályt'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
    }
}
if (isset($_POST["rmentes"])){
    $osztaly = new Osztaly();
    $reszleg = new Reszleg();
    $reszleg->setReszlegNev($_POST["rnev"]);
    $reszleg->setFeladat($_POST["rfel"]);
    $reszleg->setOsztalyNev($_POST["onev"]);

    if (trim($reszleg->getReszlegNev()) === "")  $hibak[] = "ures_rnev";
    if (trim($reszleg->getFeladat()) === "")  $hibak[] = "ures_feladat";
    if (trim($reszleg->getOsztalyNev()) === "")  $hibak[] = "ures_nev";
    $osztalyok = $osztaly->kulcsok();
    if (!in_array($reszleg->getOsztalyNev(), $osztalyok))  $hibak[] = "nincs_osztaly";
    if (count($hibak) === 0) {
        $reszleg->mentes();
        echo "<script>alert('Sikeresen felvetted az új részleget'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
    }
}
if (isset($_POST["pmentes"])){
    $projekt = new Projekt();
    $projekt->setNev($_POST["pnev"]);
    $projekt->setHatarido($_POST["hatarido"]);
    $projekt->setLeiras($_POST["leiras"]);
    $projekt->setProjektvezeto($_POST["pvezeto"]);

    if (trim($projekt->getNev()) === "")  $hibak[] = "ures_pnev";
    if (trim($projekt->getHatarido()) === "")  $hibak[] = "ures_hatarido";
    if (trim($projekt->getLeiras()) === "")  $hibak[] = "ures_leiras";
    if (trim($projekt->getProjektvezeto()) === "")  $hibak[] = "ures_pvezeto";
    if (count($hibak) === 0) {
        $projekt->mentes();
        echo "<script>alert('Sikeresen felvetted az új projektet'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="../stilus/index.css">
    <link rel = "stylesheet" href="../stilus/menu.css">
    <link rel="icon" href="../icon.png">

    <title>Módosítás</title>
</head>
<body>
<?php
$jelenlegi = "fooldal";
include_once "header.php";
?>
    <main>
        <div class="doboz" style="margin-top: 25%">
            <p style="font-weight: normal;">Kérem adja meg az új osztály adatait.</p>
            <form method="post">
                <fieldset>
                    <legend>Új osztály felvétele</legend>
                    <label for="onev">Osztály neve <br/></label>
                    <input type="text" id="onev" name="onev" placeholder="Osztály neve" ><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_nev", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="fel">Osztály feladata <br/></label>
                    <input type="text" id="fel" name="fel" placeholder="Osztály feladata"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_feladat", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <br/><input type="submit" value="Mentés" name="mentes"><br/>
                </fieldset>
            </form>
        </div>
        <div class="doboz">
            <p style="font-weight: normal;">Kérem adja meg az új részleg adatait.</p>
            <form method="post">
                <fieldset>
                    <legend>Új részleg felvétele</legend>
                    <label for="rnev">Részleg neve <br/></label>
                    <input type="text" id="rnev" name="rnev" placeholder="Részleg neve" ><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_rnev", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="rfel">Részleg feladata <br/></label>
                    <input type="text" id="rfel" name="rfel" placeholder="Részleg feladata"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_feladat", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="onev">Melyik osztályhoz tartozik? <br/></label>
                    <input type="text" id="onev" name="onev" placeholder="Osztály neve" ><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_nev", $hibak)) echo "A mező kitöltése kötelező!";
                        if (in_array("nincs_osztaly", $hibak)) echo "Nem létezik ilyen osztály!";
                        ?>
                    </div>
                    <br/><input type="submit" value="Mentés" name="rmentes"><br/>
                </fieldset>
            </form>
            <form method="post">
                <fieldset>
                    <legend>Részleg törlése</legend>
                    <select name="rnev">
                        <?php
                    $reszleg= new Reszleg();
                    $nevek = $reszleg->kulcsok();
                    foreach ($nevek as $nev){
                        echo "<option value=\"$nev\">$nev</option>";
                    }
                    ?>
                    </select><br/>
                    <br/><input type="submit" value="Törlés" name="rtorles"><br/>
                </fieldset>
            </form>
        </div>
        <div class="doboz">
            <p style="font-weight: normal;">Kérem adja meg az új projekt adatait.</p>
            <form method="post">
                <fieldset>
                    <legend>Új projekt felvétele</legend>
                    <label for="pnev">Osztály neve <br/></label>
                    <input type="text" id="pnev" name="pnev" placeholder="Projekt neve" ><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_pnev", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="hatarido">Projekt határideje <br/></label>
                    <input type="date" id="hatarido" name="hatarido" placeholder="Határidő"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_hatarido", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="leiras">Projekt leírása<br/></label>
                    <input type="text" id="leiras" name="leiras" placeholder="Leírás"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_leiras", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <label for="pvezeto">Projekt vezetője<br/></label>
                    <input type="text" id="pvezeto" name="pvezeto" placeholder="Projekt vezetője"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_pvezeto", $hibak)) echo "A mező kitöltése kötelező!";
                        ?>
                    </div>
                    <br/><input type="submit" value="Mentés" name="pmentes"><br/>
                </fieldset>
            </form>
        </div>
    </main>
</body>
</html>