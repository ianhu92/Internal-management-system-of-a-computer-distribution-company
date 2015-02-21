function productstat(pid,sid)
{ 
    var xmlHttp = new XMLHttpRequest();
    if (xmlHttp==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="productstat.php";
    url=url+"?pid="+pid+"&sid="+sid;
    xmlHttp.onreadystatechange=function()
    {
        stateChange(xmlHttp,"topcustomer");
    };
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function profitstat(pid,sid)
{
    var xmlHttp = new XMLHttpRequest();
    if (xmlHttp==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="salesporfitstat.php";
    url=url+"?pid="+pid+"&sid="+sid;
    xmlHttp.onreadystatechange=function()
    {
        stateChange(xmlHttp,"saleprofit");
    };
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function topcate(sid){
    var xmlHttp = new XMLHttpRequest();
    if (xmlHttp==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="topcate.php";
    url=url+"?sid="+sid;
    xmlHttp.onreadystatechange=function()
    {
        stateChange(xmlHttp,"topcate");
    };
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function topprod(sid){
    var xmlHttp = new XMLHttpRequest();
    if (xmlHttp==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="topprod.php";
    url=url+"?sid="+sid;
    xmlHttp.onreadystatechange=function()
    {
        stateChange(xmlHttp,"topprod");
    };
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}
function stateChange(xmlhttp, div)
{ 
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
    { 
        $("#"+div).append(xmlhttp.responseText);     
    } 
}
