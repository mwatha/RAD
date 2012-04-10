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

$user_role = "SELECT role FROM user_role WHERE user_id = $user_id LIMIT 1";     
$results = mysql_query($user_role,$db);                                         
$r = mysql_fetch_row($results);                                                 
$n = mysql_num_rows($results);                                                  
                                                                                
if ($n > 0) {                                                                   
  if ($r[0] !="admin") { ?>                                                     
    <script>                                                                    
      document.write('You dont have permission to view this page.');            
      setTimeout("redirectHome();", 4000);                                      
    </script><?php                                                              
    exit;                                                                       
  }                                                                             
}else{ ?>                                                                       
    <script>                                                                    
      document.write('You dont have permission to view this page.');            
      setTimeout("redirectHome();", 4000);                                      
    </script><?php                                                              
    exit;                                                                       
}

                                                                                
if(strlen($_SESSION['username']) > 0) {                                         
  $username = $_SESSION['username'];                                            
  $user_id = $_SESSION['user_id'];                                              
                                                                                
  $query = "SELECT * FROM users WHERE username = '$username'                    
            AND user_id = $user_id ORDER BY user_id DESC LIMIT 1";              
  $results = mysql_query($query,$db);                                           
  $rc = mysql_fetch_row($results);                                               
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

  <div id = "main-content">

    <div id="content-area">
      <table id="menu-buttons-container">
      <div id="caption-div" style="width:99%;padding:30px 0px 60px 0px;font-size:30px;">
        <div style="width:50%;float:left;">User roles</div>
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
          <!-- starts -->
            <form method="post" action="assign_role.php">

    <table style="width:345px;">
      <tr>
        <td>User role</td>
        <td>
          <select id="role" name="select_user_role">
            <option></option>                                                           
            <option value="sales">Sales</option>                                
            <option value="admin">Admin</option>                                
          </select>
        </td>
      </tr>
      <tr>
        <td>User</td>
        <td>
          <select id="user_name" name="user_id">

           <?php                                                               
              $query = "SELECT user_id,username FROM users;";            
              $results = mysql_query($query,$db);                           
              $n = mysql_num_rows($results);                                    

              if($n > 0) { ?>                                                   
                <option value=""></option>                                      
              <?php for($i = 0; $i < $n; $i++) {                                
                $r = mysql_fetch_row($results);                                 
             ?>                                                                 
                <option value="<?php echo $r[0]; ?>"><?php echo encrypt($r[1]); ?></option>
              <?php                                                             
                }                                                               
              }                                                                 
             ?>

          </select>

        </td>

      </tr>

      <tr>                                                                  

        <td>&nbsp;</td>                                                     

        <td style="text-align:left;">                                       

          <input type="button" onclick="javascript:document:location='index';" value="Cancel" />

          <input type="submit" value="Save" />                              

        </td>                                                               

      </tr>

    </table></form>
          <!-- ends -->
          </td>
        <!-- -->
        </tr>
      </table>
    </div>

    <div id ="user-details">Welcome&nbsp;
      <span style="color:OrangeRed;"><?php echo encrypt($rc[2]).' '.encrypt($rc[3]); ?></span>
      &nbsp;|&nbsp;<a href="signout">Logout</a>
      <span style="color:black;float:right;" id ="time"></span>
    </div>

  </div>

</body>

<script>
  
   function displayDateTime() {                                                  
    var displayTime = document.getElementById("time");                          
    var time =  (new Date()).getHours() + ":" + (new Date()).getMinutes();      
    var hr = time.split(":")[0];                                                
    var min = time.split(":")[1];                                               
                                                                                
    if(hr.length < 2)                                                           
      hr = "0" + hr;                                                            
                                                                                
    if(min.length < 2)                                                          
      min = "0" + min;                                                          
                                                                                
    displayTime.innerHTML = hr + ":" + min                                      
    + "&nbsp;|&nbsp;" + dateFormat(new Date(),"dddd, mmmm dS, yyyy");           
  }

  displayDateTime();
  setInterval("displayDateTime();",1000);
</script>
</html>
