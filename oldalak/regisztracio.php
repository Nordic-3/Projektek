<?php
include_once "osztalyok.php";
include_once "fuggvenyek.php";

function kotelezoMezo($hibak, $uzenet){
    if (in_array($uzenet, $hibak)) echo "A mező kitöltése kötelező!";
}

$hibak = [];

if (isset($_POST["elkuld"])) {
    $user = new Felhasznalo();
    $reszleg = new Reszleg();
    $reszleg->setReszlegNev($_POST["resz"]);
    $user->setNev($_POST["nev"]);
    $user->setJelszo($_POST["jelszo"]);
    $jelszo_check = $_POST["jelszo1"];
    $user->setTelefon($_POST["tel"]);
    $user->setEmail($_POST["email"]);
    $user->setReszlegNev($_POST["resz"]);
    $user->setBeosztas($_POST["beo"]);


    if (trim($user->getNev()) === "")  $hibak[] = "ures_nev";
    if (trim($user->getJelszo()) === "") $hibak[] = "ures_jelszo";
    if (trim($jelszo_check) === "") $hibak[] = "ures_jelszo_check";
    if ($user->getJelszo() !== "" && strlen($user->getJelszo()) < 6) $hibak[] = "rovid_jelszo";
    if ($jelszo_check !== "" && $user->getJelszo() !== $jelszo_check) $hibak[] = "jelszo_nem_egyezik";
    if ($user->getTelefon() === "") $hibak[] = "ures_telefon";
    if ($user->getEmail() !== "" && !filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) $hibak[] = "ervenytelen_email";
    if ($user->getEmail() === "") $hibak[] = "ures_email";
    if ($user->getReszlegNev() === "") $hibak[] = "ures_reszleg";
    if ($user->getBeosztas() === "") $hibak[] = "ures_beosztas";

    if (count($hibak) === 0) {
        $user->setJelszo(password_hash($user->getJelszo(), PASSWORD_DEFAULT));
        $user->adatMentes();
        $uzenet = "Sikeres regisztráció! A céges azonosítód: ".$user->getCAzon()." Egy admin munkatársunk hamarosan feltölti a hiányzó adataidat.";
        echo "<script>alert('$uzenet'); window.location.href = 'index.php';</script>";
        unset($user);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="../stilus/index.css">
    <link rel="icon" href="../icon.png">
    <title>regisztráció</title>
</head>
<body>
    <main>
        <div class="doboz">
            <p>Üdvözlöm kedves Kolléga!</br/> Kérlem az alábbi adatok megadásával regisztráljon a rendszerünkbe. Amennyiben már megtette, <a href="index.php">itt</a> tud bejelentkezni.</p>
            <form method="post">
                <fieldset>
                    <legend>Regisztráció</legend>
                    <label for="nev">Teljes neve: <br/></label>
                    <input type="text" id="nev" name="nev" placeholder="neve" value="<?php if (isset($_POST["nev"])) echo $_POST["nev"] ?>" required><br/>
                    <div  style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_nev");
                        ?>
                    </div>
                    <label for="jelszo">Hozzon létre egy jelszót: <br/></label>
                    <input type="password" id="jelszo" name="jelszo" placeholder="Jelszó" required><br/>
                    <div style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_jelszo");
                        if (in_array("rovid_jelszo", $hibak)) echo "A jelszónak legalább 6 karakternek kell lennie.";
                        if (in_array("jelszo_nem_egyezik", $hibak)) echo "A jelszavak nem egyeznek!";
                        ?>
                    </div>
                    <label for="jelszo1">Jelszó újra: <br/></label>
                    <input type="password" id="jelszo1" name="jelszo1" placeholder="Jelszó újra" required><br/>
                    <div  style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_jelszo_check");
                        if (in_array("jelszo_nem_egyezik", $hibak)) echo "A jelszavak nem egyeznek!";
                        ?>
                    </div>
                    <label for="tel">Telefonszáma: <br/></label>
                    <input type="tel" id="tel" name="tel" placeholder="Telefonszám" value="<?php if (isset($_POST["tel"])) echo $_POST["tel"]; ?>" required><br/>
                    <div style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_telefon");
                        ?>
                    </div>
                    <label for="email">Email címe: <br/></label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>" required><br/>
                    <div  style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_email");
                        if (in_array("ervenytelen_email", $hibak)) echo "Érvénytelen az email formátuma!";
                        ?>
                    </div>
                    <label for="resz">Melyik részlegen dolgozik? <br/></label>
                    <select name="resz" id="resz">
                        <?php
                        $reszlegek = reszlegek();
                        foreach ($reszlegek as $reszleg){
                            echo "<option value=\"$reszleg\">$reszleg</option>";
                        }
                        ?>
                    </select>
                    <div  style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_reszleg");
                        ?>
                    </div>
                    <label for="beo">Milyen beosztásban? <br/></label>
                    <input type="text" id="beo" name="beo" placeholder="Beosztás" value="<?php if (isset($_POST["beo"])) echo $_POST["beo"]; ?>" required><br/>
                    <div  style="color: red">
                        <?php
                        kotelezoMezo($hibak, "ures_beosztas");
                        ?>
                    </div>
                    <input type="submit" value="Regisztráció" name="elkuld">
                </fieldset>
            </form>
        </div>
    </main>
</body>
</html>