function addProduct(sid) {
    var productID = document.getElementById("product").value;
    
    var xmlHttp = new XMLHttpRequest();
    if (xmlHttp==null)
     {
         alert ("Browser does not support HTTP Request");
         return;
     }
    var url="addproduct.php";
    url=url+"?pid="+productID+"&sid="+sid;
    xmlHttp.onreadystatechange=function()
    {
        stateChange2(xmlHttp,"addproductlist");
    };
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
    //document.getElementById("addproductlist").id="freightaccountdo";
}
/*
function afteradd() {
    document.getElementById("addproductlist").id="";
    var tr=document.createElement("tr");
    tr.setAttribute("id", "addproductlist");
    document.getElementById("orderproduct").appendChild(tr);
}
*/
function stateChange2(xmlhttp, div)
{ 
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
    { 
        //document.getElementById(div).innerHTML=xmlhttp.responseText ;
        //alert(xmlhttp.responseText);
        //$("#div ").html("<p>2</p>"); 
        
        //alert($("#product").val());
        //alert($("#orderproduct tr:last td").find("input").val());
        if ($("#orderproduct tr:last td").eq(0).text() == $("#product").val()) {
            //var val = $("#orderproduct tr:last td").find("input").val() + 1;
            //$("#orderproduct tr:last td").find("input").val(val);
        }
        else {
            if(xmlhttp.responseText){
                $("#orderproduct").append(xmlhttp.responseText);
                
                countafteradd();
            }
            else 
            alert("Inventory insufficient, add failed");           
        }
    } 
}

function countafteradd() {
    var num = $(".num").children("input").val();
    var price = $(".price").children("input").val();
    counttotalprice(num,price);
}

function countoneitemtotalprice(id) {
    var num = $("#number"+id).val();
    var price = $("#price"+id).val();
    //alert(num * price);
    $("#totalprice"+id).text(num * price);
    //document.getElementById("price"+id)
    //alert(1);
    counttotalprice(num,price);
    //$("#totalprice").text(totalprice + num * price);
}

function removeitem(id) {
    $("#"+id).remove();
}

var totalprice = 0;
function counttotalprice(num,price) {
    totalprice  += num * price;
    var tp = new Number(totalprice);
    tp.toFixed(2);
    $("#totalprice").text(tp);
}

function checknum(id){
    var inv = $("#inv"+id).text();
    var num = $("#number"+id).val();
    if (inv<= num) {
        alert("Input a number less than inventory!");
    }
    else
        countoneitemtotalprice(id);
}