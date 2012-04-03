<?php
require 'encryption.php'; 

$search_string = encrypt($_GET["str"]);

$db = mysql_pconnect("localhost","root","letusout");                            
mysql_select_db("supply_concepts", $db);


$query = "SELECT * FROM customer WHERE customer_name LIKE '%$search_string%'";
$results = mysql_query($query,$db);
$n = mysql_num_rows($results);     

$html = "";
                             
if ($n > 0) {                                                   
  for($i=0;$i < $n ; $i++) {                                    
    $r = mysql_fetch_row($results);
    if ($html == "") {
      $html = $r[0].';'.encrypt($r[1]);
    }else{
      $html = $html.','.$r[0].';'.encrypt($r[1]);
    }
  }
}

echo $html;
exit;

/*
<td><input type="checkbox" name="customer" /></td>              
<td><?php echo encrypt($record[1]); ?></td>                     
<td><?php echo encrypt($record[2]); ?></td>                     
<td><?php echo encrypt($record[3]); ?></td>                     
<td><?php echo encrypt($record[4]); ?></td>                     
<td><a href="/customer_details/<?php echo $record[0]; ?>">Edit</a></td>
*/
?>

