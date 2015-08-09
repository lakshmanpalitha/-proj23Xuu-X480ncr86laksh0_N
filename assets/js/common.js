var URL = baseurl;
function doConfirm(msg)
{
    var msg = (msg ? msg : 'Are you sure you want to delete?');
    var x = confirm(msg);
    if (x)
        return true;
    else
        return false;
}

function xmlRequest(URL, param, returnFunc)
{
    var xmlhttp
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {

            if (typeof returnFunc === 'function') {
                returnFunc(xmlhttp.responseText);
            }
        }
    }
    xmlhttp.open("POST", URL, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    try {
        xmlhttp.send(param);//here a xmlhttprequestexception number 101 is thrown 
    } catch (err) {
        alert('XMLHttprequest error: " + err.description + "');
        //this prints "XMLHttprequest error: undefined" in the body.
    }
}

function ajaxRequest(URL, param, returnFunc)
{
    overlayEnable();
    jQuery.ajax({
        url: URL,
        data: param,
        type: 'POST',
        timeout: 10000,
        async: true,
        success: function(data) {
            try {
                if (typeof returnFunc === 'function') {
                    if (data) {
                        returnFunc(JSON.parse(data));
                    } else {
                        returnFunc();
                    }
                }
            }
            catch (err) {
                overlayDisable();
                alert(err.message);
                return false;
            }
            overlayDisable();
        },
        error: function(request, status, error) {
            overlayDisable();
            alert(request.responseText);
        }

    })
}
function overlayEnable() {
    if (document.getElementById("overlay")) {
        document.getElementById("overlay").style.display = "block";
    }
    if (document.getElementById("waitingDiv")) {
        document.getElementById("waitingDiv").style.display = "block";
    }
    return true;
}
function overlayDisable() {
    if (document.getElementById("overlay")) {
        document.getElementById("overlay").style.display = "none";
    }
    if (document.getElementById("waitingDiv")) {
        document.getElementById("waitingDiv").style.display = "none";
    }
    return true;
}

function errorModal(error) {
    try {
        jQuery('#error_display_container').html(error);
        jQuery('#error_display').modal('show', {backdrop: 'static'});
    }
    catch (err) {
        alert(err.message);
        return false;
    }
}

