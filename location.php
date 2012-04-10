<?php session_start();                                                          
require 'encryption.php'; ?>                                                    
<script>                                                                        
  function redirectLogin() {                                                    
    document.location = "login.php";                                            
  }                                                                             
                                                                                
  function redirectHome() {                                                     
    document.location = "index.php";                                            
  }   

  function logLocation() {                                                        
    var l = document.getElementById("location");                                  
    if (l.value == "")                                                            
      return                                                                      
                                                                                  
    document.location="index?location=" + l.value;                                
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

#content-login-area {
  background-color: #6598CC;
  border-radius: 37px 37px 37px 37px;
  height: 160px;
  left: 520px;
  position: absolute;
  top: 30%;
  width: 375px;
}

#content-login-area table {
  padding: 15px;
  width: 99%;
  color: white;
}

#content-login-area table a {
  color: black;
}
</style>

</head>



<body>

  <div id = "menu-bar-div">

  <table id = "menu-bar">
    <tr>
      <td><a href="#"><img alt="" src="img/my_logo.png"></a></td>
      <!--td><a href="#">Customer</a></td>
      <td><a href="#">Items</a></td>
      <td><a href="#">Deliveries</a></td>
      <td><a href="#">Receivings</a></td>
      <td><a href="#">Suppliers</a></td>
      <td><a href="#">Sales</a></td>
      <td><a href="#">Reports</a></td>
      <td><a href="#">Employees</a></td>
      <td><a href="#">My account</a></td -->
      <td>
        <h1>Welcome to the Supply concept Point Of Sale System.</h1>
      </td>
    </tr>
  </table>
  
  </div>


  <div id = "main-content">

    <div id="content-area">
      <!-- start -->
        <div id="content-login-area">
          <table>
            <tr>
              <td>Select user location</td>
              <td>
                <select id="location" onchange="logLocation();">
                  <option></option>
                  <option value="Desk 1">Desk One</option>
                  <option value="Desk 2">Desk Two</option>
                  <option value="Desk 3">Desk Three</option>
                  <option value="Desk 4">Desk Four</option>
                </select>
              </td>
            </tr>
          </table>
        </div>
      <!-- end -->
    </div>

    <div id ="user-details">Welcome&nbsp;                                       
      <span style="color:OrangeRed;"><?php echo encrypt($r[2]).' '.encrypt($r[3]); ?></span>
      &nbsp;|&nbsp;<a href="signout">Logout</a>                                 
      <span style="color:black;float:right;" id ="time"></span>                 
    </div>
  </div>

</body>


</html>
