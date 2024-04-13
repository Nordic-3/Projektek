<?php
include_once "menetkovetes.php";
$felhasznalo = $_SESSION["user"];
use Ds\Set;

if (isset($_POST["elkuld"])){
    $_SESSION["id"] = $_POST["id"];
    header("location: beszamoloiras.php");
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
    <link rel="icon" href="../icon.png">
    <title>Beszámolók</title>
</head>
<body>
<?php
$jelenlegi = "beszamolok";
include_once "header.php";
?>

    <main>
        <div class="doboz">
            <p>Kérem adja meg annak a projektnek az azonosítóját(ID), amelyikhez Beszámolót szeretne írni, vagy megtekinteni, hogy kik dolgoznak/dolgoztak rajta. <br/></p>
            <form method="post">
                <fieldset>
                    <legend>Projekt ID</legend>
                    <select name="id">
                    <?php
                    $projekt = new Projekt();
                    $kulcsok = $projekt->azonositok();
                    foreach ($kulcsok as $kulcs){
                        echo "<option value=\"$kulcs\">$kulcs</option>";
                    }
                    ?>
                    </select><br/>
                    <input type="submit" value="Keresés" name="elkuld">
                </fieldset>
            </form>
        </div>
        <div class="doboz">
            <p>Az alábbi lejárt határidejú projektekhez nem írtak beszámolót a felsorolt kollégáink: </p><br/>
            <table>
                <tr>
                    <th id="projektnev">Projekt neve</th>
                    <th id="dolnev">Munkatársunk neve</th>
                    <th id="email">Email címe</th>
                </tr>
                <?php
                $dolgozik = new Dolgozik();
                $adatok = lejart();
                foreach ($adatok as $egysor){
                    echo"<tr><td headers='projektnev'>". $egysor[0] . "</td><td headers='dolnev'>".$egysor[1]."</td><td headers='email'>". $egysor[2] ."</td></tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>