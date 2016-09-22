<html>
<head>
<title>BILL</title> 
		<link rel="stylesheet" type="text/css" href="GetTaxi.css">
  </head> 
  <body bgcolor="LightGoldenRodYellow">
  <H1>GET-TAXI</H1>
	<H2>Generated Bill</H2>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
</script>
</head>
<body>
</html>

<?php

$con=mysqli_connect("localhost","root","","taxi-agency");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="SELECT * FROM booking";

if ($result=mysqli_query($con,$sql))
  {
  mysqli_data_seek($result,1);

  // Fetch row
  $row=mysqli_fetch_row($result);

  printf ("BILL");
echo nl2br("\n");
printf("Your status: %s \n\n", $row[0]);
echo nl2br("\n");
printf("Street: %s \n\n", $row[0]);
echo nl2br("\n");
printf("BILL AMOUNT:Rs.");
echo(rand() . "<br>");
echo(rand(0,0));
$SQLstring = "SELECT B.Booking_Number,C.Customer_Name,B.Passenger_Name,B.Passenger_Phone,B.Unit_Number,B.Street_Number,
				B.Street_Name,B.Suburb,B.Destination_Suburb,B.Pickup_Date,B.Pickup_Time 
				FROM Booking B,customer C WHERE B.Customer_ID = C.Customer_No AND B.Booking_Status = 'assigned'"; 

$queryResult = @mysqli_query($con, $SQLstring)
		Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ".
		mysqli_errno($con). ": ".mysqli_error($DBConnect)). "</p>";
		$row = mysqli_fetch_row($queryResult);
		//Check if there are any bookings 
			echo "<table width='100%' border='1'>";
			
			while ($row) 
			{	 
			
				echo "<tr><td>{$row[0]}</td>"; 
				echo "<td>{$row[1]}</td>"; 
				echo "<td>{$row[2]}</td>";
				echo "<td>{$row[3]}</td>";
				if(empty($row[4]))
					$address = $row[5]." ".$row[6].",".$row[7];
				else
					$address = $row[4]."/".$row[5]." ".$row[6].",".$row[7];
				echo "<td>$address</td>";
				echo "<td>{$row[8]}</td>";
				$row = mysqli_fetch_row($queryResult);
			}
			echo "</table><br/><br/>";
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);
?>
<html>
<head>
<title></title> 
</head>
<body>
<a href="booking.php">Logout</a>
</body>
</html>

