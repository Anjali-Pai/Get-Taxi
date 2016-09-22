
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>Delete Booking</title> 
		<link rel="stylesheet" type="text/css" href="GetTaxi.css">
  </head> 
  <body>
  <H1>GET-TAXI</H1>
	<H2>GET TAXI</H2>
	<H3>1. Click below button to see your bookings.</H3>

  <form>
<input type="submit" value="Delete" name="submit2"/>

  </form>
	
  </body> 

<?php 

if(isset( $_GET['submit2']) || isset($_GET['delete']))
	{
		if(isset($_GET['reference_id']))
		{	
		$DBConnect = @mysqli_connect("localhost", "root","", "taxi-agency")
			Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ".
			mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
			$SQLstring = "SELECT COUNT(*) FROM Booking where Booking_Number='".$_GET['reference_id']."'";
			$queryResult = @mysqli_query($DBConnect, $SQLstring)
			Or die ("<p>Unable to query the Booking table.</p>"."<p>Error code ".
			mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
			$row = mysqli_fetch_row($queryResult);
			if($row[0] > 0)
			{
				$SQLstring = "DELETE FROM Booking where Booking_Number=".$_GET['reference_id'];
				$queryResult = @mysqli_query($DBConnect, $SQLstring)
				Or die ("<p>Unable to delete the Booking table.</p>"."<p>Error code ".
				mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
				echo "Reference number: <b>" . $_GET['reference_id'] . "</b> has been deleted";
				Delete();
			}
			else
			{
				echo "Please provide valid reference number<br><br><a href=login.php>Sign out</a>";
				exit();
			}
		}
		else
		{
			Delete();
		}
	}

	function Delete()
	{
		//Build the where clause since it requires date formating
		$TodayDate = date('Y-n-j');
		$StartTime = date('H:i:s');
		$EndTime = date('H:i:s',strtotime('+120 minute'));
		$dateClause = " AND B.Pickup_Date = '$TodayDate' AND B.Pickup_Time < '$EndTime' AND B.Pickup_Time > '$StartTime'"; 
		$TableName = "Booking or customer";
	$DBConnect = @mysqli_connect("localhost", "root","", "taxi-agency")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ".
		mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";
		$SQLstring = "SELECT B.Booking_Number,C.Customer_Name,B.Passenger_Name,B.Passenger_Phone,B.Unit_Number,B.Street_Number,
				B.Street_Name,B.Suburb,B.Destination_Suburb,B.Pickup_Date,B.Pickup_Time 
				FROM Booking B,customer C WHERE B.Customer_ID = C.Customer_No AND B.Booking_Status = 'unassigned'".$dateClause;
		//echo $SQLstring; 
		$queryResult = @mysqli_query($DBConnect, $SQLstring)
		Or die ("<p>Unable to query the $TableName table.</p>"."<p>Error code ".
		mysqli_errno($DBConnect). ": ".mysqli_error($DBConnect)). "</p>";
		$row = mysqli_fetch_row($queryResult);
		//Check if there are any bookings 
		if(count($row) > 0)
		{
			echo "<table width='100%' border='1'>";
			echo "<th>Reference #</th><th>Customer name</th><th>Passenger name</th><th>Passenger contact phone</th><th>Pick-up address</th>
			<th>Destination suburb</th><th>Pick-up time</th>";
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
				$dt = $row[9].":".$row[10];
				$dt = date_create_from_format('Y-n-j:H:i:s',$dt);
				$dt = date_format($dt,'d M H:i');
				echo "<td> $dt </td></tr>"; 
				$row = mysqli_fetch_row($queryResult);
			}
			echo "</table><br/><br/>";
			echo "<form><H3>2. Input a reference number below and click \"delete\" button to assign a taxi to that request.</H3><br/>";
			echo "Reference number:<input type=\"text\" name=\"reference_id\"/> <input type=\"submit\" value=\"Delete\" name=\"delete\"/><br><br><a href=login.php>Sign out</a></form>";
		
		}
		else
		{
			echo "<H3> No pickup requests</H3><br><br><a href=login.php>Sign out</a>";
		}

		mysqli_close($DBConnect);

	}

?>

</HTML>
