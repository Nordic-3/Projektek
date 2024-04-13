<?php
include_once "menetkovetesAdmin.php";
$felhasznalo = $_SESSION["user"];
$cazon = $_SESSION["cazon"];
$dolgozo = new Felhasznalo();
$dolgozo->setCAzon($cazon);
$dolgozo->betolt();
if (isset($_POST["torles"])){
    if($dolgozo->torles() === 0){
        echo "<script>alert('Sikeres a törlés!'); window.location.href = 'adminAdatok.php';</script>";
        unset($dolgozo);
    }
    else{
        echo "<script>alert('Nem sikerült a törlés'); window.location.href = 'adminAdatok.php';</script>";
    }
}
$hibak = [];
if (isset($_POST["mentes"])){
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $reszlegnev = $_POST["resz"];
    $beosztas = $_POST["beo"];
    $fizetes = $_POST["fiz"];
    $rvezeto = $_POST["rvezeto"] === "igen";
    $ovezeto = $_POST["ovezeto"] === "igen";
    $admin = $_POST["admin"] === "igen";
    $reszleg = new Reszleg();
    $reszleg->setReszlegNev($reszlegnev);

    if (trim($tel) !== "") $dolgozo->setTelefon($tel);
    if (trim($email) !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) $hibak[] = "ervenytelen_email";
    if (trim($email) !== "" && filter_var($email, FILTER_VALIDATE_EMAIL)) $dolgozo->setEmail($email);
    if (trim($reszlegnev) !== "" && $reszleg->betolt() === -1) $hibak[] = "nem_letezik";
    if (trim($reszlegnev) !== "") $dolgozo->setReszlegNev($reszlegnev);
    if (trim($beosztas) !== "") $dolgozo->setBeosztas($beosztas);
    if (trim($fizetes) !== "") $dolgozo->setFizetes(intval($fizetes));
    if ($dolgozo->getReszlegvezetoe() !== $rvezeto) $dolgozo->setReszlegvezetoe($rvezeto ? 1 : 0);
    if ($dolgozo->getOsztalyvezetoe() !== $ovezeto) $dolgozo->setOsztalyvezetoe($ovezeto ? 1 : 0);
    if ($dolgozo->isAdmin() !== $admin) $dolgozo->setAdmin( $admin ? 1 : 0);

    if (count($hibak) === 0) {
        $dolgozo->frissites();
        echo "<script>alert('Sikeres adatmodósítás'); window.location.href = 'adatmodositas.php';</script>";
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
$jelenlegi = "adatok";
include_once "header.php";
?>
    <main>
        <div class="doboz">
            <p style="font-weight: normal;">Kérlem adja meg az új adatokat.</p>
            <form method="post">
                <fieldset>
                    <legend>Módosítás</legend>
                    <label for="caz">Céges azonosítója <br/></label>
                    <input type="text" id="caz" name="caz" value="<?php  echo $dolgozo->getCAzon(); ?>" readonly><br/>
                    <label for="tel">Telefonszáma: <br/></label>
                    <input type="tel" id="tel" name="tel" placeholder="Telefonszám" value="<?php  echo $dolgozo->getTelefon(); ?>"><br/>
                    <label for="email">Email címe: <br/></label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php  echo $dolgozo->getEmail(); ?>"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ervenytelen_email", $hibak)) echo "Érvénytelen az email formátuma!";
                        ?>
                    </div>
                    <label for="resz">Melyik részlegen dolgozik? <br/></label>
                    <input type="text" id="resz" name="resz" placeholder="Részleg" value="<?php  echo $dolgozo->getReszlegNev(); ?>"><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("nem_letezik", $hibak)) echo "Nincs ilyen részlegünk.";
                        ?>
                    </div>
                    <label for="beo">Milyen beosztásban? <br/></label>
                    <input type="text" id="beo" name="beo" placeholder="Beosztás" value="<?php  echo $dolgozo->getBeosztas(); ?>"><br/>
                    <label for="fiz">Mennyi a fizetése? <br/></label>
                    <input type="number" id="fiz" name="fiz" placeholder="fizetés" value="<?php  echo $dolgozo->getFizetes(); ?>"><br/>
                    <label for="rvezeto">Részlegvezető?<br/></label>
                    <select id="rvezeto" name="rvezeto">
                        <option value="igen" <?php if($dolgozo->getReszlegvezetoe()) echo"selected"; ?>>Igen</option>
                        <option value="nem" <?php if(!$dolgozo->getReszlegvezetoe()) echo"selected"; ?>>Nem</option>
                    </select><br/>
                    <label for="ovezeto">Osztályvezető?<br/></label>
                    <select id="ovezeto" name="ovezeto">
                        <option value="igen" <?php if($dolgozo->getOsztalyvezetoe()) echo"selected"; ?>>Igen</option>
                        <option value="nem" <?php if(!$dolgozo->getOsztalyvezetoe()) echo"selected"; ?> >Nem</option>
                    </select><br/>
                    <label for="admin">Admin?<br/></label>
                    <select id="admin" name="admin">
                        <option value="igen" <?php if($dolgozo->isAdmin()) echo"selected"; ?>>Igen</option>
                        <option value="nem" <?php if(!$dolgozo->isAdmin()) echo"selected"; ?> >Nem</option>
                    </select><br/>
                    <br/><input type="submit" value="Mentés" name="mentes"><br/>
                    <input type="submit" value="Dolgozó törlése" name="torles">
                </fieldset>
            </form>
        </div>
    </main>
</body>
</html>