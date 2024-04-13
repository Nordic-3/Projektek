
<header>
        <nav>
            <ul>
                <li>
                    <a <?php if($jelenlegi !== "fooldal") echo 'style="color: #bee3fd"'; else echo'aria-current="page"';?> <?php if ($felhasznalo->isAdmin()) echo 'href="osztaly_reszleg_projekt.php"'; else{echo 'href="fooldal.php"';}?>> <?php if($felhasznalo->isAdmin()) echo"Osztály/Részleg/Projekt"; else{ echo "Főoldal";} ?></a>
                </li>
                <li>
                    <a <?php if($jelenlegi !== "beszamolok") echo 'style="color: #bee3fd"'; else echo'aria-current="page"';?> href="beszamolok.php">Beszámolók</a>
                </li>
                <li>
                    <a <?php if($jelenlegi !== "adatok") echo 'style="color: #bee3fd"'; else echo'aria-current="page"'; if ($felhasznalo->isAdmin()) echo 'href="adminAdatok.php"'; else{echo 'href="adatok.php"';}?> >Adatok</a>
                </li>
                <li>
                    <a  style="color: #bee3fd" href="kijelentkezes.php">Kijelentkezés</a>
                </li>
            </ul>
        </nav>
    </header>