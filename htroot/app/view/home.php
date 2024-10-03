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
                <label for="xmldownload">XML Fájl letöltése</label>
                <button id="xmldownload" class="form-control btn btn-secondary">Letöltés</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/res/script/csvupload.js"></script>