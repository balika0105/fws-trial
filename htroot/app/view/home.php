<div class="row justify-content-center">
    <div class="col-12">
        <h1>FWS Fejlesztői próbafeladat</h1>
        <p>
            <i>Készítette: Markgruber Balázs György</i>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3>1. Feladat</h3>
        <p>
            <i>
                CSV Feltöltése, tárolás adatbázisban, XML letöltése
            </i>
        </p>
        <div class="row">
            <div class="col-xs-12 col-4">
                <div class="form-group">
                    <label for="csvupload">CSV Fájl feltöltése</label>
                    <input class="form-control" type="file" name="csvupload" id="csvupload"> <br>
                    <button id="csvuploadbtn" class="form-control btn btn-primary" onclick ="csvprocess()">Feltöltés</button>
                </div>
            </div>
            <div class="col-xs-12 col-4">
                <label for="xmldownloadbtn">XML Fájl letöltése</label>
                <small>
                    <p>
                        <i>
                            Figyelem! Az XML fájl összeállítása adatbázis méretől függően akár PERCEKIG is tarthat!
                        </i>
                    </p>
                </small>
                <button id="xmldownloadbtn" class="form-control btn btn-secondary" onclick="xmldownload()">Letöltés</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h3>2. Feladat</h3>
        <p>A második feladat megoldása egy MySQL lekérdezés, ami a következő:</p>
        <p>
            <code>
            SELECT SUM(sub.smallsum) AS package_sum
FROM(
SELECT (`price_history`.`price` * `product_package_contents`.`quantity`) AS smallsum FROM price_history
INNER JOIN `product_package_contents` ON `price_history`.`product_id` = `product_package_contents`.`product_id`
WHERE `product_package_contents`.`product_package_id` = 2264
GROUP BY `product_package_contents`.`product_id`
ORDER BY ABS(DATEDIFF (`price_history`.`updated_at`, 2023-12-01)) ASC)
AS sub;
            </code>
        </p>
        <p>
            A megoldásban válaszott termékcsomag száma <code>2264</code>, a választott dátum <code>2023-12-01</code>.
        </p>
    </div>
</div>
<script type="text/javascript" src="/public/res/script/csvupload.js"></script>
