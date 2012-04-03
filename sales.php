<?php session_start();       
require 'encryption.php'; ?>

<script type="text/javascript">

var item_name = {};
var item_price = {};
var selected_customer_email = null;
var selected_customer_name = null;

function getCustomers() {
var str = document.getElementById("search_string").value;
var customerList = document.getElementById("customer_list");

if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}else{// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    var results = xmlhttp.responseText.split(",");
    if(results.length < 1 || results == 'undefined'){
      return;
    }

    if(!results[0].match(/;/))
      return;

    var html = "<table>";
    for(var i = 0; i < results.length;i++){
      var customer_id = results[i].split(';')[0];
      var customer_name = results[i].split(';')[1];
      html += "<tr><td class='customer_list'><a href='#' onclick='select(" + customer_id + ")'>" + customer_name + "</a></td></tr>";
    }
    html+="</table>"
    customerList.innerHTML = html;
  }
}

xmlhttp.open("GET","getcustomers.php?str="+str,true);
xmlhttp.send();
}

  function select(customer_id) {
    var salesDetails = document.getElementById("sales_details");
    var searchItem = document.getElementById("search_item");
    total =  document.getElementById('total_amount');
    total.innerHTML = "<td colspan='7'>&nbsp;</td>";

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        var results = xmlhttp.responseText;
        var html = "<tr>";

        selected_customer_email = results.split(';')[2];
        selected_customer_name = results.split(';')[1];
        if(selected_customer_name == '' || selected_customer_name == null){
          return;
        }
        html += "<td class='cname' style='text-align:left;padding-left:5px;'>" + selected_customer_name + "</td>";
        html += "<td style='text-align:center;'>" + selected_customer_email + "</td>";
        html += "<td style='text-align:center;' class='blank_item'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_price'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_quantity'>&nbsp;</td>";
        html += "<td style='text-align:center;' class='blank_total'>&nbsp;</td>";
        
        salesDetails.innerHTML = html;

        html = "<table style='width:100%;'><tr><td colspan='6' style='text-align:right;padding-right:10px;'>";
        html += "Search Item&nbsp;";
        html +="<input type='text' id='search_item_id' name='search_item' onkeyup='searchItem();' />";
        html += "&nbsp;<button onclick='addItem();'>Add Item</button></td></tr></table>";
        searchItem.innerHTML = html;
      }
    }

    xmlhttp.open("GET","getsalesdetails.php?customer_id="+customer_id,true);
    xmlhttp.send();
  }

  function searchItem() {
    var itemList = document.getElementById("item_list_results");
    var searchItem = document.getElementById("search_item_id").value;

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        var results = xmlhttp.responseText.split(",");
        var html = "<table style='width:100%;'>";
        item_name = {};
        item_price = {};
        for(var i = 0; i < results.length;i++){
          var item_id = results[i].split(';')[0];
          var name = results[i].split(';')[1];
          var price = results[i].split(';')[2];
        
          if(price == '' || price == null){
            return;
          }

          html += "<tr>";
          html += "<td style='text-align:left;padding-left:10px;'>" + name + "</td>";
          html += "<td style='text-align:left;padding-left:10px;'><span style='color:purple'>Unit price</span>&nbsp;" + price + " MK</td>";
          html += "<td style='text-align:center;'><button onclick='selectItem(" + item_id + ")'>Add</button></td>";
          html += "</tr>";
          item_name[item_id] = name;
          item_price[item_id] = price;
        }
        html+="</table>"
        itemList.innerHTML = html;
      }
    }

    xmlhttp.open("GET","getitems.php?name="+searchItem,true);
    xmlhttp.send();

  }

  function selectItem(item_id) {
    document.getElementById("item_list_results").innerHTML = null;
    itemPriceTD = document.getElementsByClassName('blank_price');
    itemNameTD = document.getElementsByClassName('blank_item');
    itemQuantityTD = document.getElementsByClassName('blank_quantity');
    itemTotalTD = document.getElementsByClassName('blank_total');
    quantityValues = document.getElementsByClassName('quantity_values');

    /* starts */
    var addNewRow = false;
    for(var i = 0; i < itemNameTD.length; i++){
      if(itemNameTD[i].innerHTML != "&nbsp;"){
        addNewRow = true;
        break;
      }
    }
   
    if(addNewRow){

      newTable =  "<td colspan='6'><table id='sales_details_table'>";
      for(var i = 0; i < itemNameTD.length; i++){
        newTable += "<tr><td class='cname' style='text-align:left;padding-left:5px;width:140px;font-size:12px;'>" + selected_customer_name + "</td>";
        newTable += "<td style='text-align:center;width:100px;font-size:12px;'>" + selected_customer_email + "</td>";
        newTable += "<td style='text-align:center;width:80px;font-size:12px;' class='blank_item'>" + itemNameTD[i].innerHTML + "</td>";
        for(var x = 0; x < itemPriceTD.length; x++){
          newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_price'>" + itemPriceTD[i].innerHTML + "</td>";
          break;
        }
        for(var x = 0; x < itemQuantityTD.length; x++){
          name = quantityValues[i].name;
          id = quantityValues[i].id;
          value = quantityValues[i].value;
          selected_item_id = quantityValues[i].id.split("quantity")[0];
          sQty = "<input type='text' class='quantity_values' name='" + name + "' id='" + id + "' size=2 onkeyup='calcualateQ(" + selected_item_id + ");' value='" + value +"' />";
          newTable += "<td style='text-align:center;width:10px;font-size:12px;' class='blank_quantity'>" + sQty + "</td>";
          break;
        }
        for(var x = 0; x < itemTotalTD.length; x++){
          newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_total'>" + itemTotalTD[i].innerHTML + "</td></tr>";
          break;
        }
      }
      
      var newRow = document.getElementById("sales_details");
      newTable += "<tr><td class='cname' style='text-align:left;padding-left:5px;width:140px;font-size:12px;'>" + selected_customer_name + "</td>";
      newTable += "<td style='text-align:center;width:100px;font-size:12px;'>" + selected_customer_email + "</td>";
      newTable += "<td style='text-align:center;width:80px;font-size:12px;' class='blank_item'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_price'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:10px;font-size:12px;' class='blank_quantity'>&nbsp;</td>";
      newTable += "<td style='text-align:center;width:20px;font-size:12px;' class='blank_total'>&nbsp;</td></tr></table></td>";
      newRow.innerHTML = newTable;
      itemPriceTD = document.getElementsByClassName('blank_price');
      itemNameTD = document.getElementsByClassName('blank_item');
      itemQuantityTD = document.getElementsByClassName('blank_quantity');
    }

    /* ends */
 
    for(var i = 0; i < itemNameTD.length; i++){
      if(itemNameTD[i].innerHTML == "&nbsp;"){
        itemNameTD[i].innerHTML = item_name[item_id];
      }
    }
    
    for(var i = 0; i < itemPriceTD.length; i++){
      if(itemPriceTD[i].innerHTML == "&nbsp;"){
        itemPriceTD[i].innerHTML = item_price[item_id];
      }
    }
    
    
    for(var i = 0; i < itemQuantityTD.length; i++){
      if(itemQuantityTD[i].innerHTML == "&nbsp;"){
        itemQuantityTD[i].innerHTML = "<input type='text' class='quantity_values' name='quantity"+ item_id + "' id='quantity" + item_id + "' size=2 onkeyup='calcualateQ(" + item_id + ");' value='' />";
      }
    }

    for(var i = 0; i < itemTotalTD.length; i++){
      if(itemTotalTD[i].innerHTML == "&nbsp;"){
        itemTotalTD[i].innerHTML = "<label class='item_total' id='label_" + item_id + "'></label>";
      }
    }

/*
        html += "<td style='text-align:left;padding-left:5px;'>" + name + "</td>";
        html += "<td style='text-align:center;'>" + email + "</td>";
        html += "<td class='blank_item'>&nbsp;</td>";
        html += "<td class='blank_price'>&nbsp;</td>";
        html += "<td class='blank_quantity'>&nbsp;</td>";
        html += "<td class='blank_total'>&nbsp;</td>";
  */      
  }

  function calcualateQ(item_id) {
    quantity = document.getElementById("quantity" + item_id).value;
    label = document.getElementById("label_" + item_id);
    label.innerHTML = (parseFloat(item_price[item_id]))*(parseFloat(quantity));
    totals = document.getElementsByClassName("item_total");
  
    total = 0;

    for(var i=0;i<totals.length;i++){
      total+=parseFloat(totals[i].innerHTML);
    }
    var t = ""
    t += "<td colspan='7'>";
    t += "<span style='text-align:right;padding-right:10px;float:right;font-weight:bold;font-size:15px;'>";
    t += total + "</span>";

    t += "<span style='text-align:left;padding-left:10px;float:left;font-weight:bold;font-size:15px;'>";
    t +="Total</span>";
    document.getElementById("total_amount").innerHTML = t + "</td>";
  }

  function addItem() {
    document.location="item_details";
  }

  function redirectLogin() {                                                    
    document.location = "login.php";                                            
  }                                                                             
                                                                                
  function redirectHome() {                                                     
    document.location = "index.php";                                            
  }                          
  
  
  function processOrder() {
    itemPriceTD = document.getElementsByClassName('blank_price');               
    itemNameTD = document.getElementsByClassName('blank_item');                 
    customerName = document.getElementsByClassName('cname');         
    itemTotalTD = document.getElementsByClassName('item_total');               
    quantityValues = document.getElementsByClassName('quantity_values');

    selectItems = {}

    for(var i = 0; i < itemTotalTD.length; i++) {
      if(itemTotalTD[i].innerHTML.length > 0){
        name = itemNameTD[i].innerHTML;                                        
        price = itemPriceTD[i].innerHTML;
        quantity = quantityValues[i].value;         
        cname = customerName[i].innerHTML;                             
        selected_item_id = quantityValues[i].id.split("quantity")[0];

        selectItems[name] = quantity + ";" + price + ";" + cname;
      }
    }

    var str = "";

    for(key in selectItems) {
      if(str==""){
        str = key + ";" + selectItems[key];
      }else{
        str+= "," + key + ";" + selectItems[key];
      }
    }

    submitForm = document.getElementById("orders");                        
                                                                                
    newElement = document.createElement("input");                               
    newElement.setAttribute("name","orders");      
    newElement.setAttribute("type","hidden");                                   
    newElement.value = str;                                               
    submitForm.appendChild(newElement);

    submitForm.submit();                                                        
    return;

  }                                                   
</script>


<?php
         
if($_SESSION['user_id'] == null) { ?>                                           
  <script>redirectLogin();</script><?php                                        
}else{                                                                          
  $user_id = $_SESSION['user_id'];                                              
} 
                                                
$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db); 

if(strlen($_SESSION['username']) > 0) {
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $query = "SELECT * FROM users WHERE username = '$username'                
            AND user_id = $user_id ORDER BY user_id DESC LIMIT 1";                               
  $results = mysql_query($query,$db);                                             
  $r = mysql_fetch_row($results);
}

?>
<html>
<head>

<script type="text/javascript" src="javascript/dateformat.js"></script>
<script type="text/javascript" src="javascript/encryption.js"></script>

<style type="text/css">
html {
    overflow: auto;
}

body {
 font-family: "Lucida Grande",Arial;
 margin: auto;
 padding: 0;
 width: 1020px;
 height: 70%;
}

#sales_details_table {
  width: 100%;
}

.customer_list a {
  color: purple;
  font-size: small;
}

#menu-bar {
  margin-left: 15px;
  margin-right: 15px;
  margin-top: 10px;
  padding-top: 25px;
  width: 100%;
  color: white;
}

#menu-bar-div {
  width: 100%; 
  height: 100px; 
  background-color: #6598CC; 
 -moz-border-radius: 37px 37px 0px 0px;
  margin-top: 10px;
}

#main-content {
  background-color: #6598CC;
  border-color: #6598CC;
  border-radius: 0 0 37px 37px;
  border-style: solid;
  border-top: 1px solid #6598CC;
  border-bottom: 35px solid #6598CC;
  height: auto;
  margin-top: 10px;
  width: 99.5%;
  margin-bottom: 30px;
}

#content-area {
  width: 98%; 
  height: auto; 
  background-color: white; 
  padding-left: 20px;
  height: 80%;
  overflow: auto;
}

#user-details {
  background-color: #D0D8DF;
  margin-top: 30px;
  padding: 20px 10px 20px 10px;
}

#user-details a {
 color: black;
 text-decoration: none; 
}

#menu-bar a {
 color: white;
 text-decoration: none; 
}

#menu-buttons-container {
  width: 100%;
  text-align: center;
}

.link-button {
  color: #6598CC;
  width: 10%;
  font-size: 40px;
  text-align: center;
}

.buttons {
  font-size: 12px;
  width: 110px;
}

.header-form {
  font-size: 16px;
  width: 30%;
  float: right;
  text-align: right;
}
</style>

</head>



<body>

  <div id = "menu-bar-div">

  <table id = "menu-bar">
    <tr>
      <td><a href="#"><img alt="" src="img/my_logo.png"></a></td>
      <td><a href="customer">Customer</a></td>
      <td><a href="items">Items</a></td>
      <td><a href="deliveries">Deliveries</a></td>
      <td><a href="receivings">Receivings</a></td>
      <td><a href="suppliers">Suppliers</a></td>
      <td><a href="sales">Sales</a></td>
      <td><a href="reports">Reports</a></td>
      <td><a href="employees">Employees</a></td>
      <td><a href="my_account">My account</a></td>
    </tr>
  </table>
  
  </div>


  <div id = "main-content">

    <div id="content-area">
      <table id="menu-buttons-container">
      <div id="caption-div" style="width:99%;padding:30px 0px 60px 0px;font-size:30px;">
        <div style="width:50%;float:left;">Sales</div>
      </div>
        <tr>
        <!-- -->
          <td style="vertical-align:top;">
            <table width="99%" style="border-style:solid;border-width:1px;font-size:12px;">
              <tr id="search_item">
                <td colspan="6" style="text-align:left;padding-left:10px;">&nbsp;</td>
              </tr>
              <tr style="background-color:#6598CC;color:white;">
                <th class="cd-details" style="text-align:left;padding-left:5px;width:140px;">Customer name</th>
                <th class="cd-details" style="width:100px;">E-mail</td>
                <th class="cd-details" style="width:80px;">Item</th>
                <th class="cd-details" style="width:20px;">Price</th>
                <th class="cd-details" style="width:10px;">Quantity</th>
                <th class="cd-details" style="width:20px;">Total</th>
              </tr>
              <tr id="sales_details"><td colspan="6" style="text-align:center;">
                <table id="sales_details_table">
                  <tr><td style="text-align:center;">Select customer</td></tr>
                </table></td>
              </tr>
              <tr style="background-color:#6598CC;">
                <td colspan="7">&nbsp;</td>
              </tr>
              <tr id="total_amount">
                <td colspan="7">&nbsp;</td>
              </tr>
              <tr style="background-color:wheat;">
                <td colspan="7" id = "item_list_results"></td>
              </tr>
            </table>
          </td>
          <td style="vertical-align:top;width:190px;">
            <table>
              <tr>
                <td colspan="2">
                  <span>Type customer's name:</span>&nbsp;&nbsp;                      
                  <input type="text" size="12" id="search_string" name="search_string" onkeyup="getCustomers();"/>                
                  <br />
                  <span id="customer_list">&nbsp;</span>
                </td>
              </tr>
              <tr>
                <td class="link-button" width="10">+</td>
                <td><input type="button" value="New customer" 
                    name ="add" class="buttons" 
                    onclick="javascript:location='customer_details'"/></td>
              </tr>
              <tr>
                <td class="link-button" width="10">&nbsp;</td>
                <td><input type="button" value="Process order" 
                    name ="add" class="buttons" 
                    onclick="processOrder();"/></td>
              </tr>
            </table>
          </td>
        <!-- -->
        </tr>
      </table>
    </div>

    <div id ="user-details">Welcome&nbsp;
      <span style="color:OrangeRed;"><?php echo encrypt($r[2]).' '.encrypt($r[3]); ?></span>
      &nbsp;|&nbsp;<a href="signout">Logout</a>
      <span style="color:black;float:right;" id ="time"></span>
    </div>

  </div>

</body>

<script>
  
  function displayDateTime() {
    var displayTime = document.getElementById("time");
    displayTime.innerHTML = (new Date()).getHours() + ":" + (new Date()).getMinutes() 
    + "&nbsp;|&nbsp;" + dateFormat(new Date(),"dddd, mmmm dS, yyyy");
  }

  displayDateTime();
  setInterval("displayDateTime();",1000);
</script>

<form id="orders" method="post" action="createorder.php" type="hidden">
</form>

</html>
