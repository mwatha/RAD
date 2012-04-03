<?php session_start();       
require 'encryption.php'; ?>
<script>                                                                        
  function redirectLogin() {                                                    
    document.location = "login.php";                                            
  }                                                                             
                                                                                
  function redirectHome() {                                                     
    document.location = "index.php";                                            
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

.link-button a {
  color: #6598CC;
 }

.link-button {
  width: 100%;
}

.description {
  font-size: 12px;
}
</style>

</head>



<body>

  <div id = "menu-bar-div">

  <table id = "menu-bar">
    <tr>
      <td><a href="#"><img alt="" src="img/my_logo.png"></a></td>
      <td><a href="customer.php">Customer</a></td>
      <td><a href="items.php">Items</a></td>
      <td><a href="deliveries.php">Deliveries</a></td>
      <td><a href="receivings.php">Receivings</a></td>
      <td><a href="suppliers.php">Suppliers</a></td>
      <td><a href="sales.php">Sales</a></td>
      <td><a href="reports.php">Reports</a></td>
      <td><a href="employees.php">Employees</a></td>
      <td><a href="my_account.php">My account</a></td>
    </tr>
  </table>
  
  </div>


  <div id = "main-content">

    <div id="content-area">
      <table id="menu-buttons-container">
        <tr>
          <td>
            <table>
              <tr><td class="link-button"><a href="customer.php">Customer</a></td></tr>
              <tr><td class="description">Add, Update, Delete  and Search customer</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button"><a href="items.php">Items</a></td></tr>
              <tr><td class="description">Add, Update, Delete  and Search items</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button"><a href="deliveries.php">Deliveries</a></td></tr>
              <tr><td class="description">Add, Update, Delete  and Search deliveries</td></tr>
            </table>
          </td>
        </tr>
        <!-- -->
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <!-- -->
        <tr>
          <td>
            <table>
              <tr><td class="link-button"><a href="suppliers.php">Suppliers</a></td></tr>
              <tr><td class="description">Add, Update, Delete  and Search suppliers</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button"><a href="sales.php">Sales</a></td></tr>
              <tr><td class="description">Process sales and returns</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button"><a href="reports.php">Reports</a></td></tr>
              <tr><td class="description">View and generate reports</td></tr>
            </table>
          </td>
        </tr>
        <!-- -->
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <!-- -->
        <tr>
          <td>
            <table>
              <tr><td class="link-button"><a href="employees.php">Employees</a></td></tr>
              <tr><td class="description">Add, Update, Delete  and Search employees</td></tr>
            </table>
          </td>
          <td colspan="2">
            <table>
              <tr><td class="link-button"><a href="my_account.php">My account</a></td></tr>
              <tr><td class="description">Update user details and change password</td></tr>
            </table>
          </td>
        </tr>
        <!-- -->
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
</html>
