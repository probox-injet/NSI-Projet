function e()
{
    var myFile = new File(["Salut"], "text.txt", { type: "text/plain;charset=utf-8" });
    saveAs(myFile);

    var data = new FormData();
    data.append("upFile", myFile);

    var xml = new XMLHttpRequest();
    xml.open("POST", "upload.php");
    xml.onload = function(){
        console.log(this.response);
    }

    xml.send(data);
}