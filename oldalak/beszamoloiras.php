<?php
include_once "menetkovetes.php";
$id = $_SESSION["id"];
$hibak = [];
$dolgozik = new Dolgozik();
$felhasznalo = $_SESSION["user"];
$dolgozik->setCazon($felhasznalo->getCAzon());
$dolgozik->setId($id);
$betoltotte = $dolgozik->betolt();

if (isset($_POST["elkuld"])){
    $dolgozik->setBeszamolo($_POST["beszamolo"]);
    if ($dolgozik->getBeszamolo() === "") $hibak[] = "ures";

    if (count($hibak) === 0){
        $dolgozik->mentes();
        echo "<script>alert('Köszönjük, hogy megírtad a beszámolót!'); window.location.href = 'beszamoloiras.php';</script>";
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
    <style>
        textarea{
            border: 1px solid black;
            border-radius: 10px;
            width: 90%;
        }
    </style>
    <title>Beszámolók</title>
</head>
<body>
<?php
$jelenlegi = "beszamolok";
include_once "header.php";
?>

    <main>
        <div class="doboz">
            <?php
            $dolgozik_e_rajta = false;
            if($dolgozik->kell_e_beszamolo($felhasznalo->getCAzon(), $dolgozik->getId())){
                echo"<p>Kérem maximum 800 karakterben fogalmazza meg a beszámolóját. <br/></p>";
                $dolgozik_e_rajta = true;
            }
            else{
                echo "<p style='color: red'>A kiválasztott projekten nem dolgozik/dolgozott, ezért nem tud beszámolót írni. <br/></p>";
            }
            ?>
            <form method="post">
                <fieldset>
                    <legend>Kérem írja meg a beszámolóját</legend>
                    <textarea name="beszamolo" rows="5" cols="50" maxlength="800" placeholder="max 800 karakter" <?php if($betoltotte !== -1 || !$dolgozik_e_rajta) echo "readonly";?>><?php if($betoltotte !== -1) echo $dolgozik->getBeszamolo();?></textarea>
                    <div  style="color: red">
                        <?php
                        if (in_array("ures", $hibak)) echo "Nem töltötte ki a mezőt!";
                        ?>
                    </div>
                    <input type="submit" value="Mentés" name="elkuld" <?php if($betoltotte !== -1 || !$dolgozik_e_rajta) echo "disabled";?>>
                </fieldset> 
            </form>
        </div>
        <div class="doboz">
            <p>A kiválasztott projekten az alábbi kollégáink dolgoznak: </p><br/>
            <?php
            $nevek = $dolgozik->nevek();
            foreach ($nevek as $nev){
                echo $nev."<br/>";
            }
            ?>
        </div>
    </main>
</body>
</html>