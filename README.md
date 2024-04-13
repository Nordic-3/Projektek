# Vállalat 
# Adatbázisok kötelező feladat 
Egy vállalati nyilvántartó rendszerben tárolják a cég dolgozóinak, osztályainak, részlegeinek és projektjeinek adatait. Az új dolgozóknak regisztrálniuk kell a rendszerbe, majd bejelentkezés után használhatják azt. Az adminok aktualizálhatják az adatokat, a többi dolgozó csak megtekintheti azokat, és beszámolót írhat azon projektekhez, amelyekben részt vesz vagy vett.
Egyed-kapcsolat modell 
 
 A Projekt egyednek van egy ID attribútuma, ami kulcs is, mivel azonosítja a projekteket. A név, leírás, projektvezető attribútumok a nevükhöz híven tárolják a projekt nevét, leírását és projekt vezetőjét. A kik dolgoznak rajta, és beszámolók dolgozóként többértékű attribútumok, mivel egy projekten többen dolgoznak, és minden dolgozónak van beszámolója.
A Dolgozó egyednek a Céges azonosítója attribútum a kulcsa, ezen felül, tárolja a dolgozó nevét, jelszavát, telefonszámát, email címét, fizetését, azt, hogy melyik részlegen dolgozik, illetve a beosztását.
A Részleg egyedet a neve azonosítja egyértelműen, osztály, feladat, illetve részlegvezető attribútumai vannak.
Az Osztály egyedet szintén a neve azonosítja, és feladat, illetve osztályvezető attribútumokkal rendelkezik.
A Projekt és a Dolgozó között több a többhöz kapcsolat van, mert egy dolgozó egyszerre több projekten is dolgozhat, és egy projekten is többen dolgoznak egyszerre. A kapcsolatnak van egy mettől, illetve meddig attribútuma, ami azt tárolja, hogy mettől meddig dolgozott az adott projekten a dolgozó. A részleg és a Dolgozó között 1 a többhöz kapcsolat van, mert egy dolgozó egy részlegre van beosztva, de egy részleghez több dolgozó is be van osztva. Az osztály és a Részleg között szintén egy a többhöz kapcsolat van, mert egy osztálynak több részlege is lehet, de egy részleg csak egy osztályhoz tartozik.

# Relációs adatbázisséma 
 
DOLGOZÓ(Céges azonosító, Név, Jelszó, Telefon, Email, Fizetés, Beosztás, Részlegvezető-e, Osztályvezető-e, Admin-e, részleg.Név)
RÉSZLEG(részleg.Név, Feladat, osztály.Név)
OSZTÁLY(osztaly.Név, Feladat)
PROJEKT(ID, Név, Határidő, Leírás, Projektvezető)
KIK_DOLGOZNAK_RAJTA(ID, ki dolgozik rajta)
DOLGOZIK(Céges azonosító, ID, beszámoló)
Az egyértelműség kedvéért a részleg és osztály sémában a név attribútumoknál jeleztem, hogy melyik sémának a kulcsa. A dolgozó sémában a részleg külső kulcs, a részleg sémában pedig az osztály külső kulcs biztosítja az 1:N kapcsolatot. 
Normalizálás 
 
A fenti relációssémák első normálformában vannak, mert minden attribútumhalmaz atomi.
Egy relációséma 2NF-ben van, ha minden másodlagos attribútum teljesen függ bármely kulcstól. Ennek következményeként, ha a kulcs csak egy attribútumból áll, akkor a séma 2NF-ben van. Ezért a Dolgozó, Részleg, Osztály, Projekt sémák második normálformában vannak. A Kik_dolgoznak_rajta 2NF-ben van, mert nincs másodlagos attribútuma. A Dolgozik séma is 2NF-ben van, mert fennáll a teljes függés, mivel, a céges azonosító és az ID külön-külön nem határozza meg az adott dolgozó által a projekthez írt beszámolót.
A harmadik normálforma definíciójának következményeként a Kik_dolgoznak_rajta 3NF-ben van, mert nincs másodlagos attribútuma. 
A Dolgozó séma 3NF-ben van, mert a {Név, Telefonszám, Email}→{Jelszó, Fizetés, Beosztás, Részlegvezető-e, Osztályvezető-e, Admin-e, részleg.Név} függőség fennáll, ezért {Név, Telefonszám, Email}→{Céges azonosító} függőség is, vagyis nincs tranzitív függőség.
A Projekt harmadik normálformában van, mert a {Név, Leírás} tekinthető szuperkulcsnak, és fennáll a {Név, Leírás}→{ID} és {ID}→{Név, Leírás}→{Határidő, Projektvezető} függés vagyis nem tranzitív.
A Részleg is 3NF-ben van, mert minden részlegnek különböző a feladata, vagyis a {feladat} tekinthető kulcsnak, így a {részleg.Név}→{Feladat}→{osztály.Név} függés fennáll, így a {Feladat}→{részleg.Név} is.
Az osztály szintén 3NF-ben, van, mert a {Feladat} is lehetne kulcs, mivel értelmetlen lenne több osztályt fenntartani ugyan azzal a feladattal, így a {osztaly.Nev}→{Feladat} függés mellett a {Feladat}→{osztaly.nev} is fennáll, ezáltal nem tranzitív.
A Dolgozik 3NF-ben van, mert {Céges azonosító, id}→{Beszámoló} függésen kívül nincs más függés a sémában.
DOLGOZÓ(Céges azonosító, Név, Jelszó, Telefon, Email, Fizetés, Beosztás, Részlegvezető-e, Osztályvezető-e, Admin-e, részleg.Név)
RÉSZLEG(részleg.Név, Feladat, osztály.Név)
OSZTÁLY(osztaly.Név, Feladat)
PROJEKT(ID, Név, Határidő, Leírás, Projektvezető)
KIK_DOLGOZNAK_RAJTA(ID, ki dolgozik rajta)
DOLGOZIK(Céges azonosító, ID, beszámoló)


# Összetett lekérdezések 
 
1.	A felhasználó által kiválasztott projekten dolgozókat listázza ki ABC sorrendben. A ? helyére kerül a felhasználó által választott projekt azonosítója. A lekérdezés az osztalyok.php fileban található a 280. sorban a nevek metódusban, és a beszamoloiras.php fileban van megjelenítve az eredmény.
SELECT nev
FROM kik_dolgoznak_rajta, dolgozo
WHERE id = ? AND ki_dolgozik_rajta = ceges_azonosito
ORDER BY nev;
2.	A legnagyobb fizetésű dolgozó adatait és osztályát listázza ki, ha több van, akkor mindegyiket listázza. Az osztalyok.php fileban található a 3. sorban a legnagyobb_fizetes függvényben, és az adatok.php, illetve adminAdatok.php fileokban van megjelenítve az eredmény.
SELECT dolgozo.ceges_azonosito, dolgozo.nev, dolgozo.telefon, dolgozo.email, dolgozo.fizetes, dolgozo.beosztas, dolgozo.reszleg_nev AS rnev, reszleg.osztaly_nev
FROM dolgozo, reszleg
WHERE dolgozo.reszleg_nev = reszleg.reszleg_nev AND dolgozo.fizetes = (SELECT MAX(fizetes) FROM dolgozo);
3.	Kilistázza, hogy a lejárt határidejű projektekhez kik nem írtak beszámolót, megjeleníti a projekt és dolgozó nevét, email címet. Azokat nem listázza ki, akik azért nem írtak beszámolót, mert nem dolgoztak az adott projekten, ezért felel a WHERE záradékban az utolsó feltétel. A lekérdezés az osztalyok.php-ban található a 32. sorban lévő lejart nevű függvényben, és a beszamolok.php-ban van megjelenítve az eredménye.
SELECT DISTINCT projekt.nev AS pnev, dolgozo.nev AS dnev, dolgozo.email AS email, dolgozo.ceges_azonosito AS cazon, projekt.id AS pid
FROM projekt, dolgozik, dolgozo
WHERE projekt.hatarido < CURDATE()
AND (dolgozo.ceges_azonosito, projekt.id) NOT IN(SELECT DISTINCT dolgozik.ceges_azonosito, dolgozik.id FROM dolgozik)
AND (projekt.id, dolgozo.ceges_azonosito) IN (SELECT id, ki_dolgozik_rajta FROM kik_dolgoznak_rajta);

# Megvalósítás, funkciók 
 
A projekt egy webalkalmazásként lett elkészítve a backend részért PHP a felelős, az adatbázist MySQL-ben valósítottam meg. A HTML CSS részét VS code-ban írtam, a php-t kódokat PhpStorm-ban.
Megvalósított funkciók: 
•	A regisztrált dolgozók be tudnak jelentkezni
•	Bejelentkezés után az adatok menüpontban megtekinthetik az adataikat, a részlegvezetők átlagfizetését és a legnagyobb fizetésű dolgozó adatait.
•	Beszámolók menüpontban láthatják, hogy a lejárt határidejű projektekhez kik nem írtak beszámolót. Válaszhatnak egy projektet, amihez írhatnak beszámolót, ha dolgoznak/dolgoztak rajta, itt láthatják, hogy kik dolgoznak a projekten.
•	Ki tudnak jelentkezni a kijelentkezés menüpontban.
•	A nem regisztrált dolgozók regisztrálni tudnak.
•	Az adminok mind tudják a fent leírtakat.
•	Az admin felvehet új osztályt, részleget, projektet az osztály/részleg/projekt menüben. Törölhet részleget ugyan itt.
•	Az adatok menüben azon felül, hogy látja azokat, amiket a dolgozók, módosíthatja a kiválasztott dolgozó adatait többek közt a fizetését is, illetve, hogy vezeti a részleget vagy osztályt, ahova be van osztva.

# Megjegyzések
 
A bejelentkezéshez céges azonosító és jelszó megadása szükséges. Az adatbázisban az alábbi céges azonosítók léteznek: dolX ahol X helyére 1-12ig léteznek a számok. Admin felhasználóként az alábbi azonosítókkal lehet bejelentkezni: admX, ahol X helyére 1-4ig lehet számot írni. A jelszó minden azonosítóhoz 123456. Egy új dolgozó nem tud adminként regisztrálni, mert nem láttam értelmét, hogy egy újonnan jött dolgozó egyből admin legyen. Ezenfelül a saját fizetését sem ő adja meg, hanem az adminok állítják be.
