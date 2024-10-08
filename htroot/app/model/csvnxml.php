<?php
    class csvnxml{
        public function csvupload(){
            //CSV fájl feldolgozása
            $csvfile = $_FILES["csvfile"];
            if($csvfile != NULL && $csvfile["error"] === UPLOAD_ERR_OK){
                $currentTime = date('Y-m-d_H-i-s');
                $randomNum = rand(1, 1000);
                $targetPath = SITE_ROOT . "/public/tmp/upload_" . $currentTime . "_". $randomNum . ".csv";
                if(move_uploaded_file($csvfile['tmp_name'], $targetPath)){
                    if($fileStream = fopen($targetPath, "r")){
                        //Első sor átugrása példa CSV alapján
                        fgetcsv($fileStream);

                        //Csatlakozás az adatbázishoz
                        include "app/system/connect.php";

                        //MySQL Query összekészítése
                        $sql = "INSERT INTO products (title, price, cat1, cat2, cat3) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE price = VALUES(price), cat1 = VALUES(cat1), cat2 = VALUES(cat2), cat3 = VALUES(cat3)";
                        $query = $conn->prepare($sql);

                        //CSV fájl betöltése a megadott fájl mintája alapján
                        //Csak a fájlútvonal lett megadva, mivel a többi paraméter megfelel az alapbeállításoknak
                        while(($data = fgetcsv($fileStream))){
                            $query->bind_param("sisss", $data[0], $data[1], $data[2], $data[3], $data[4]);
                            if($query->execute()){
                                continue;
                            }
                            else{
                                echo "queryfail";
                                return;
                            }
                        }
                        //Fájl lezárása, akkor is ha hibára futunk
                        fclose($fileStream);
                        //Kapcsolatok lezárása
                        unset($query);
                        $conn->close();

                        //Ideiglenesen tárolt CSV törlése
                        unlink($targetPath);

                        //OK visszajelzése
                        echo "ok";
                        
                    }
                    else{
                        echo "fileopenfail";
                    }
                }
                else{
                    echo "filemovefail";
                }
            }
            else{
                echo "fileuploadfail";
            }
        }

        public function xmldownload(){
            //XML Dokumentum előkészítése
            $xml = new DOMDocument("1.0", "UTF-8");
            $xml->formatOutput = true;
            $root = $xml->createElement("products");
            $xml->appendChild($root);

            //Csatlakozás az adatbázishoz
            include "app/system/connect.php";

            $getallentries = $conn->query("SELECT * FROM products WHERE id > 0");
            while($row = $getallentries->fetch_assoc()){
                //print_r($row);
                $product = $xml->createElement('product');
                $categories = $xml->createElement("categories");

                foreach($row as $key => $value){
                    if($key == "id"){
                        continue;
                    }
                    else if(preg_match('/^cat[1-9]\d*$/', $key)){
                        if($value != ""){
                            $category = $xml->createElement("category", htmlspecialchars($value));
                            $categories->appendChild($category);
                            
                        }
                        $product->appendChild($categories);
                    }
                    else{
                        $child = $xml->createElement($key, htmlspecialchars($value));
                        $product->appendChild($child);
                    }
                }

                $root->appendChild($product);
            }

            //Random név generálása
            $currentTime = date('Y-m-d_H-i-s');
            $randomNum = rand(1, 1000);
            $targetPath = SITE_ROOT . "/public/tmp/export_" . $currentTime . "_". $randomNum . ".xml";

            $xml->save($targetPath);
            
            //Fájl útvonal küldése
            echo "targetpath: " . str_replace(SITE_ROOT, "", $targetPath);
        }
    }
?>