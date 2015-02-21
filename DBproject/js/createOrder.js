$(document).ready(function() {
    $("#placeorder").click(function(){
        var url = "orderprocess.php";
        var orderdate = $('#date').text();
        var employeeID = $('#employeeID').text();
        var customerID = $('#customer').val();
        var countrow = $('#orderproduct tr').length - 1;
        var str ="{'orderdate':'"+orderdate+"','employeeID':'"+employeeID+"','customerID':'"+customerID+"','countrow':'"+countrow;
        var i = 0;
        $('#orderproduct tr').each(function(){
            var pid = $(this).children('.productid').text();
            //var pname = $(this).children('.productname').text();
            var price = $(this).children('.price').children('input').val();
            var num = $(this).children('.num').children('input').val();
            //str += "','pid"+i+"':'"+pid+"','pname"+i+"':'"+pname+"','price"+i+"':'"+price+"','num"+i+"':'"+num;
            str += "','pid"+i+"':'"+pid+"','price"+i+"':'"+price+"','num"+i+"':'"+num;
            i++;
            /*if ($(this).children('.productname').text()) {
                alert($(this).children('.productname').text());
            }
            else if ($(this).children('input').val()){
                alert($(this).children('input').val());
            }
            */

        });
        
        //alert(customerID);
        
        str += "'}";
        //alert(str);
        var data = eval('('+str+')');
        
        $.post("orderprocess.php", {'data':data}, function(res) {//注意jquery的$.post的第2个参数必须是键值对形式
            alert(res);
            window.location.href='createorder.php';
        });
    });
});


/*function placeorder(){
       var url = "placeorder.php";
       var orderdate = $('#date').text();
       var employeeID = $('#employeeID').text();
       var countnumber = $('#orderproduct tr').length;
       alert(countnumber);
}
*/