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