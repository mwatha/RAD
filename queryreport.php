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
      <td><a href="index"><img alt="" src="img/my_logo.png"></a></td>
      <td><a href="customer">Customer</a></td>
      <td><a href="items">Items</a></td>
      <td><a href="#">Deliveries</a></td>
      <td><a href="#">Receivings</a></td>
      <td><a href="#">Suppliers</a></td>
      <td><a href="sales">Sales</a></td>
      <td><a href="report">Reports</a></td>
      <td><a href="employees">Employees</a></td>
      <td><a href="my_account">Admin</a></td>
    </tr>
  </table>
  
  </div>


  <?php
      $start_date = $_POST['startdate'].' 00:00:00';
      $end_date = $_POST['enddate'].' 23:59:59';
      $username = $_POST['username'];
      $customer = $_POST['customer_name'];
      $location = $_POST['location_name'];

      if($location and $customer and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND c.customer_name = '$customer'
              AND u.username = '$username'";
      }elseif($location and $customer) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND c.customer_name = '$customer'";
      }elseif($customer and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE c.customer_name = '$customer' AND u.username = '$username'";
      }elseif($location and $username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location' AND u.username = '$username'";
      }elseif($location) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE e.location = '$location'";
      }elseif($username) {
        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE u.username = '$username'";
      }elseif($customer) {

        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id
              WHERE c.customer_name = '$customer'";

      }else{

        $query ="SELECT  c.customer_name,i.name,o.quantity,o.price,location,
              fname,lname, e.date_created FROM encounter e 
              INNER JOIN orders o ON o.encounter_id = e.encounter_id
              AND e.date_created >= '$start_date' AND e.date_created <= '$end_date'
              INNER JOIN customer c ON c.customer_id = e.customer_id
              INNER JOIN item i ON i.item_id = o.item_id
              INNER JOIN users u ON u.user_id = e.user_id";
      }
      $results = mysql_query($query,$db);                               
      $n = mysql_num_rows($results);                                    
      ?>


  <div id = "main-content">

    <div id="content-area">
      <table id="menu-buttons-container">
      <div id="caption-div" style="width:99%;padding:30px 0px 60px 0px;font-size:30px;">
        <div style="width:50%;float:left;">Report<br />
        <span style="font-size:13px;"></span></div>
        <!--div class="header-form">                                                 
          <form id="search_form" method="post" action="index.php">                
            <span>Search:</span>&nbsp;&nbsp;                                      
            <input type="text" size="12" name="search_string" />                  
          </form>                                                                 
        </div -->
      </div>
        <tr>
          <!--td style="vertical-align:top;width:190px;">
            <table>
              <tr>
                <td class="link-button" width="10">+</td>
                <td><input type="button" value="New customer" 
                    name ="add" class="buttons" 
                    onclick="javascript:location='customer_details'"/></td>
              </tr>
              <tr>
                <td class="link-button" width="10">-</td>
                <td><input type="button" value="Delete customer" name="delete" class="buttons" /></td>
              </tr>
            </table>
          </td -->
        <!-- -->
          <td style="vertical-align:top;">
            <table width="99%" style="border-style:solid;border-width:1px;font-size:12px;">
              <tr style="background-color:#6598CC;color:white;">
                <th class="cd-details" style="text-align:left;padding-left:5px;width:140px;">Customer</th>
                <th class="cd-details" style="width:100px;text-align:left;padding-left:5px;">Item</td>
                <th class="cd-details" style="width:80px;text-align:right;padding-right:5px;">Quantity</th>
                <th class="cd-details" style="width:20px;text-align:right;padding-right:5px;">Unit cost</th>
                <th class="cd-details" style="width:20px;text-align:right;padding-right:5px;">Total</th>
                <th class="cd-details" style="width:100px;text-align:left;padding-left:5px;">User</td>
                <th class="cd-details" style="width:100px;text-align:left;padding-left:5px;">Sale outlet</td>
                <th class="cd-details" style="width:100px;text-align:left;padding-left:5px;">Date created</td>
              </tr>
              <?php
                                                                                        
              if($n > 0) {                                                             
                for ($i = 1;$i <= $n;$i++) {                                           
                 $rc = mysql_fetch_row($results);                                       
              ?>                        
               <tr>                                                
               <td><?php echo encrypt($rc[0]); ?></td>                                
               <td><?php echo encrypt($rc[1]); ?></td>                                
               <td style="text-align:right;padding-right:5px;"><?php echo $rc[2]; ?></td>
               <td style="text-align:right;padding-right:5px;"><?php echo $rc[3]; ?></td>
               <td style="text-align:right;padding-right:5px;"><?php echo ($rc[3] * $rc[2]); ?></td>
               <td><?php echo encrypt($rc[5]).' '.encrypt($rc[6]); ?></td>             
               <td><?php echo encrypt($rc[4]); ?></td>                                
               <td><?php echo $rc[7]; ?></td>
               </tr>
              <?php                                                                     
               }                                                                        
             } ?>

              <tr style="background-color:#6598CC;">
                <td colspan="8">&nbsp;</td>
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
</html>
