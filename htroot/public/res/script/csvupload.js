function csvprocess(){
    const uploadBtnText = "Feltöltés";
    const uploadBtnDisabledText = "Feldolgozás...";
    var csvfile = document.getElementById("csvupload");
    var csvuploadbtn = document.getElementById("csvuploadbtn");

    if(csvfile.files.length == 1){
        var fd = new FormData();
        fd.append("action", "csvupload");
        fd.append("csvfile", csvfile.files[0]);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'main/processor', true);
        xhr.send(fd);

        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                
            }
        };
    }
    else{
        alert("Nincs mit feltölteni!");
    }
}