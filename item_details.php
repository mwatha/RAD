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

#content-area table {
  width: 100%;
  padding-top: 25px;
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
      <td><a href="my_account.php">Admin</a></td>
    </tr>
  </table>
  
  </div>


  <div id = "main-content">

    <div id="content-area">
      <!-- start -->
      <form action="createitem.php" method="post">
        <table>
          <caption style="text-align:left;font-size:30px;">Item details</caption>
          <tr>
            <td>Item name</td>
            <td><input type="text" name="name" /></td>
          </tr>
          <tr>
            <td>Unit price</td>
            <td><input type="text" name="price" /></td>
          </tr>
          <tr>
            <td>Quantity</td>
            <td><input type="text" name="quantity" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td style="text-align:left;">
              <input type="button" onclick="javascript:document:location='customer.php';" value="Cancel" />
              <input type="submit" value="Save" />
            </td>
          </tr>
        </table>
      </form>
      <!-- end -->
    </div>

    <div id ="user-details">Welcome&nbsp;user:&nbsp;<span>please login to continue<span></div>

  </div>

</body>


</html>