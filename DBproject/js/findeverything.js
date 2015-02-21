
function showCustomer(str)
{ 
    var xmlHttp1 = new XMLHttpRequest();
    if (xmlHttp1==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="getcustomer.php";
    url=url+"?cname="+str;
    xmlHttp1.onreadystatechange=function()
    {
        stateChange(xmlHttp1,"customerList");
    };
    xmlHttp1.open("GET",url,true);
    xmlHttp1.send(null);
}

function showProduct(str)
{ 
    var xmlHttp2 = new XMLHttpRequest();
    if (xmlHttp2==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="getproduct.php";
    url=url+"?pname="+str;
    xmlHttp2.onreadystatechange=function()
    {
        stateChange(xmlHttp2,"productList");
    };
    xmlHttp2.open("GET",url,true);
    xmlHttp2.send(null);
}

function stateChange(xmlhttp, div)
{ 
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
     { 
        document.getElementById(div).innerHTML=xmlhttp.responseText ;
     } 
}

function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
     {
         // Firefox, Opera 8.0+, Safari
         xmlHttp=new XMLHttpRequest();
     }
    catch (e)
     {
     //Internet Explorer
     try
      {
          xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
     catch (e)
      {
          xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
     }
    return xmlHttp;
}