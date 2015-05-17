
$('#myModal').on('show.bs.modal', function(e) {
    if (document.getElementById('error_msg'))
        document.getElementById('error_msg').innerHTML = '';
    if (document.getElementById('error_body'))
        document.getElementById("error_body").style.display = "none";
})

function doConfirm(msg)
{
    var msg = (msg ? msg : 'Are you sure you want to delete?');
    var x = confirm(msg);
    if (x)
        return true;
    else
        return false;
}

function xmlRequest(URL, param, div, returnFunc)
{
    var xmlhttp;
    if (param == "")
    {
        document.getElementById(div).innerHTML = "";
        return;
    }
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

function ajaxRequest(URL, param, div, returnFunc)
{
    $.ajax({
        url: URL,
        data: param,
        // THIS MUST BE DONE FOR FILE UPLOADING
        type: 'POST',
        processData: false,
        contentType: false,
        success: function(data) {
            if (typeof returnFunc === 'function') {
                returnFunc(data);
            }
        }
        // ... Other options like success and etc
    })
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;

    return true;
}



function isOnlyNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}



