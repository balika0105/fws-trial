function csvprocess(){
    const uploadBtnText = "Feltöltés";
    const uploadBtnDisabledText = "Feldolgozás...";
    var csvfile = document.getElementById("csvupload");
    var csvuploadbtn = document.getElementById("csvuploadbtn");

    if(csvfile.files.length == 1){
        var fd = new FormData();
        fd.append("action", "csvupload");
        fd.append("csvfile", csvfile.files[0]);

        csvuploadbtn.innerHTML = uploadBtnDisabledText;
        csvuploadbtn.classList.add("disabled");

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'main/processor', true);
        xhr.send(fd);

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                switch(this.responseText){
                    case "ok":
                        csvuploadbtn.classList.remove("btn-primary");
                        csvuploadbtn.classList.add("btn-success");
                        csvuploadbtn.innerHTML = "Feltöltve!";

                        setTimeout(function(){
                            csvuploadbtn.classList.add("btn-primary");
                            csvuploadbtn.classList.remove("btn-success");
                            csvuploadbtn.innerHTML = uploadBtnText;
                            csvuploadbtn.classList.remove("disabled");
                        }, 1000);
                        
                        break;
                    default:
                        console.log(this.responseText);
                        csvuploadbtn.innerHTML = uploadBtnText;
                        csvuploadbtn.classList.remove("disabled");
                        alert("Hiba történt a feldolgozásban!");
                        break;
                }   
            }
        };
    }
    else{
        alert("Nincs mit feltölteni!");
    }
}

function xmldownload(){
    const downloadBtnText = "Letöltés";
    const downloadBtnDisabledText = "Feldolgozás folyamatban...";
    var xmldownloadbtn = document.getElementById("xmldownloadbtn");

    xmldownloadbtn.innerHTML = downloadBtnDisabledText;
    xmldownloadbtn.classList.add("disabled");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.startsWith("targetpath: ")){
                var split = this.responseText.split(" ");
                window.open(split[1], "_blank");
                xmldownloadbtn.classList.remove("btn-secondary");
                xmldownloadbtn.classList.add("btn-success");
                xmldownloadbtn.innerHTML = "Feldolgozás sikeres!";

                setTimeout(function(){
                    xmldownloadbtn.classList.add("btn-secondary");
                    xmldownloadbtn.classList.remove("btn-success");
                    xmldownloadbtn.innerHTML = downloadBtnText;
                    xmldownloadbtn.classList.remove("disabled");
                }, 1000);
            }
            else{
                console.log(this.responseText);
                xmldownloadbtn.innerHTML = downloadBtnText;
                xmldownloadbtn.classList.remove("disabled");
                alert("Hiba történt a feldolgozásban!");
            }  
        }
    };
    var params = "action=xmldownload";
    xhr.open("POST", "/main/processor", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
}