<?php session_start();       

//require 'encryption.class.php'; 
                                                         
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

<style type="text/css">
html {
    overflow: auto;
}

body {
 font-family: "Lucida Grande",Arial;
 margin: auto;
 padding: 0;
 width: 1020px;
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

.link-button {
  color: #6598CC;
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
      <td><a href="#">Customer</a></td>
      <td><a href="#">Items</a></td>
      <td><a href="#">Deliveries</a></td>
      <td><a href="#">Receivings</a></td>
      <td><a href="#">Suppliers</a></td>
      <td><a href="#">Sales</a></td>
      <td><a href="#">Reports</a></td>
      <td><a href="#">Employees</a></td>
      <td><a href="#">My account</a></td>
    </tr>
  </table>
  
  </div>


  <div id = "main-content">

    <div id="content-area">
      <table id="menu-buttons-container">
        <tr>
          <td>
            <table>
              <tr><td class="link-button">Customer</td></tr>
              <tr><td class="description">Add, Update, Delete  and Search customer</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button">Items</td></tr>
              <tr><td class="description">Add, Update, Delete  and Search items</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button">Deliveries</td></tr>
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
              <tr><td class="link-button">Suppliers</td></tr>
              <tr><td class="description">Add, Update, Delete  and Search suppliers</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button">Sales</td></tr>
              <tr><td class="description">Process sales and returns</td></tr>
            </table>
          </td>
          <td>
            <table>
              <tr><td class="link-button">Reports</td></tr>
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
              <tr><td class="link-button">Employees</td></tr>
              <tr><td class="description">Add, Update, Delete  and Search employees</td></tr>
            </table>
          </td>
          <td colspan="2">
            <table>
              <tr><td class="link-button">My account</td></tr>
              <tr><td class="description">Update user details and change password</td></tr>
            </table>
          </td>
        </tr>
        <!-- -->
      </table>
    </div>

    <div id ="user-details">Welcome&nbsp;
      <span style="color:OrangeRed;"><?php echo $r[2].' '.$r[3]; ?></span>
      &nbsp;|&nbsp;<a href="#">Logout</a>
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
