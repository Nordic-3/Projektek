<?php
include_once "menetkovetes.php";
$felhasznalo = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="../stilus/index.css">
    <link rel = "stylesheet" href="../stilus/menu.css">
    <link rel="icon" href="../icon.png">
    <title>Főoldal</title>
</head>
<body>
<?php
$jelenlegi = "fooldal";
include_once "header.php";
?>
    <main>
        <div class="doboz">
            <p style="font-weight: bold;">Köszöntöm a rendszerünkben <?php echo $felhasznalo->getNev(); ?></p>
            <p> Legfrissebb híreink: <br/><br/> Munkahelyi Egészségmegőrzési Program <br/> Kezdetét veszi az új egészségmegőrzési program, amelynek keretében számos eseményt és workshopot szervezünk a munkatársak egészségének javítása érdekében. </p>
            <p>Innovációs Verseny Indul a Kreatív Ötletekért <br/> Szeretettel várjuk az ötleteket az innovációs versenyre, ahol a legjobb ötletekért izgalmas díjakat és elismeréseket kaphatnak a résztvevők.</p>
        </div>
    </main>
</body>
</html>