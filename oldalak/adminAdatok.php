<?php
include_once "menetkovetesAdmin.php";
include_once "fuggvenyek.php";
$felhasznalo = $_SESSION["user"];
if (isset($_POST["elkuld"])){
    $_SESSION["cazon"] = $_POST["cazon"];
    header("location: adatmodositas.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="../stilus/index.css">
    <link rel = "stylesheet" href="../stilus/menu.css">
    <link rel = "stylesheet" href="../stilus/adatok.css">
    <link rel="icon" href="../icon.png">
    <title>Adatok</title>
</head>
<body>
<?php
$jelenlegi = "adatok";
include_once "header.php";
?>


    <main>
        <div class="doboz" style="margin-top: 25%;">
            <p>Személyes adataim <br/></p>
            <table>
                <tr>
                    <th id="azon">Céges azonosító</th>
                    <td headers="azon"><?php echo $felhasznalo->getCAzon(); ?></td>
                </tr>
                <tr>
                    <th id="nev">Név</th>
                    <td headers="nev"><?php echo $felhasznalo->getNev(); ?></td>
                </tr>
                <tr>
                    <th id="tel">Telefonszám</th>
                    <td headers="tel"><?php echo $felhasznalo->getTelefon(); ?></td>
                </tr>
                <tr>
                    <th id="email">Email cím</th>
                    <td headers="email"><?php echo $felhasznalo->getEmail(); ?></td>
                </tr>
                <tr>
                    <th id="beo">Beosztás</th>
                    <td headers="beo"><?php echo $felhasznalo->getBeosztas(); ?></td>
                </tr>
                <tr>
                    <th id="resz">Részleg</th>
                    <td headers="resz"><?php echo $felhasznalo->getReszlegNev(); ?></td>
                </tr>
                <tr>
                    <th id="fiz">Fizetés</th>
                    <td headers="fiz"><?php echo $felhasznalo->getFizetes(); ?></td>
                </tr>
            </table>
        </div>
        <div class="doboz">
            <p>Dolgozó adatainak módosítása</p>
            <form method="post">
                <fieldset>
                    <legend>Dolgozó céges azonosítója</legend>
                    <select name="cazon">
                        <?php
                        $dolgozo = new Felhasznalo();
                        $cazonok = $dolgozo->ceges_azonositok();
                        foreach ($cazonok as $cazon){
                            if($felhasznalo->getCAzon() === $cazon) continue; //saját magát ne törölje
                            echo "<option value=\"$cazon\">$cazon</option>";
                        }
                        ?>
                    </select><br/>
                    <input type="submit" value="Keresés" name="elkuld">
                </fieldset>
            </form>
        </div>
        <div class="doboz" style="width: 80%;">
            <p>A részlegvezetők átlagfizetése: <?php echo reszleg_atlag();?></p>
            <p style="font-weight: bold;">Legnagyobb fizetésű dolgozó adatai <br/></p>
            <table>
                <tr>
                    <th id="azon">Céges azonosító</th>
                    <th id="nev">Név</th>
                    <th id="tel">Telefonszám</th>
                    <th id="email">Email cím</th>
                    <th id="fiz">Fizetés</th>
                    <th id="beo">Beosztás</th>
                    <th id="rnev">Részleg neve</th>
                    <th id="onev">Osztály neve</th>
                </tr>
                <?php
                $adatok = lenagyobb_fizetes();
                foreach ($adatok as $egysor){
                    echo"<tr><td headers='azon'>". $egysor[0] . "</td><td headers='nev'>".$egysor[1]."</td><td headers='tel'>". $egysor[2] ."</td><td headers='email'>". $egysor[3] ."</td><td headers='fiz'>". $egysor[4] ."</td><td headers='beo'>". $egysor[5] ."</td><td headers='rnev'>". $egysor[6] ."</td><td headers='onev'>". $egysor[7] ."</td></tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>