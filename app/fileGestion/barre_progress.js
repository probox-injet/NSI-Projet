function _(elmt)
{
    return document.getElementById(elmt);
}

function uploadFichier()
{
    var file = _('file').files[0];
    var data = new FormData();
    data.append('file', file);

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abordHandler, false);
    ajax.open("POST", "../../Files_and_Directories/upload/upload.php");
    ajax.send(data);
}

function progressHandler(e)
{
    _('status_bytes').innerHTML = e.loaded + ' bytes uploadé sur ' + e.total;
    var pourcentage = (e.loaded / e.total) * 100;
    _('progressBar').value = Math.round(pourcentage);
    _('status').innerHTML = Math.round(pourcentage) + '% uploadé Patientez...';
}

function completeHandler(e)
{
    _('status').innerHTML = e.target.responseText;
    _('progressBar').value = 0;
}

function errorHandler()
{
    _('status').innerHTML = "L'upload a échoué !";
}

function abordHandler()
{
    _('status').innerHTML = "L'upload a été annulé !";
}
