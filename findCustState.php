<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Simple PHP-MySQL Program</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$manufact = $_POST['manufact'];

$manufact = mysqli_real_escape_string($conn, $manufact);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT c.fname, c.lname, s.description
FROM stores7.customer c JOIN stores7.orders o
     ON c.customer_num = o.customer_num
     JOIN stores7.items i
     ON o.order_num = i.order_num
     JOIN stores7.stock s
     ON i.stock_num = s.stock_num AND i.manu_code = s.manu_code
     JOIN stores7.manufact m
     ON i.manu_code = m.manu_code
WHERE m.manu_name = ";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[firstName]  $row[lastName]  $row[description]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="findCustState.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  