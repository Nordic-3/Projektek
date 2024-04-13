<?php
    session_start();
    include_once "osztalyok.php";
    $hibak = [];
    if(isset($_POST["bejel"])){
        $user = new Felhasznalo();
        $user->setCAzon($_POST["azon"]);
        $hiba = $user->betolt();
        $jelszo = $_POST["jelszo"];

        if (trim($user->getCAzon()) === "")  $hibak[] = "ures_cazon";
        if (trim($jelszo) === "")  $hibak[] = "ures_jelszo";
        if (!in_array("ures_cazon", $hibak) && $hiba === -1) $hibak[] = "nincs_dol";
        if ($hiba === 0 && !password_verify($jelszo, $user->getJelszo())) $hibak[] = "nemjo_jelszo";

        if (count($hibak) === 0){
            $_SESSION["user"] = $user;
            if($user->isAdmin()) echo "<script>alert('Sikeres bejelentkezés'); window.location.href = 'osztaly_reszleg_projekt.php';</script>";
            else echo "<script>alert('Sikeres bejelentkezés'); window.location.href = 'fooldal.php';</script>";
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
    <title>Bejelentkezés</title>
</head>
<body>
    <main>
        <div class="doboz">
            <p>Üdvözölöm kedves Kolléga!<br/> Kérem jelentkezzen be vagy, ha új tagunk, kérem regisztráljon <a href="regisztracio.php">itt</a>.</p>
            <form method="post">
                <fieldset>
                    <legend>Bejelentkezés</legend>
                    <label for="azon">Céges azonosító: <br/></label>
                    <input type="text" id="azon" name="azon" placeholder="Céges azonosító" maxlength="6" required><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_cazon", $hibak)) echo "A mező kitöltése kötelező!";
                        if (in_array("nincs_dol", $hibak)) echo "Nincs ilyen azonosítójú munkatársunk!";
                        ?>
                    </div>
                    <label for="jelszo">Jelszó: <br/></label>
                    <input type="password" id="jelszo" name="jelszo" placeholder="Jelszó" required><br/>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures_jelszo", $hibak)) echo "A mező kitöltése kötelező!";
                        if (in_array("nemjo_jelszo", $hibak)) echo "Hibás jelszó!";
                        ?>
                    </div>
                    <input type="submit" value="Bejelentkezés", name="bejel"> <br/>
                </fieldset>
            </form>
        </div>
    </main>
</body>
</html>