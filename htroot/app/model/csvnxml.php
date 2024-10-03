<?php
    class csvnxml{
        public function csvupload(){
            //CSV fájl feldolgozása
            $csvfile = $_FILES["csvfile"];
            if($csvfile != NULL && $csvfile["error"] === UPLOAD_ERR_OK){
                $currentTime = date('Y-m-d_H-i');
                $targetPath(SITE_ROOT . "/public/tmp/upload_" . $currentTime . ".csv");
                if(move_uploaded_file($csvfile['tmp_name'], $targetPath)){
                    //CSV fájl betöltése a megadott fájl mintája alapján
                    //Csak a fájlútvonal lett megadva, mivel a többi paraméter megfelel az alapbeállításoknak
                    $loadedcsv = fgetcsv($targetPath);

                    //Csatlakozás az adatbázishoz
                    include "app/system/connect.php";
                }
            }
            
        }
    }
?>