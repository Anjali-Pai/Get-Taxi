<?php
require'connect.php';

if(isset($_POST['txtun'])&&isset($_POST['txtpw'])&&isset($_POST['p']) &&isset($_POST['s']))
{
$name=$_POST['txtun'];
$loginid=$_POST['txtpw'];
$pass=$_POST['p'];
$cpass=$_POST['s'];

 if(!empty($name)&&!empty($loginid)&&!empty($pass)&&!empty($cpass)&&!empty($place)&&!empty($phone)&&!empty($email))
 {
 $query="SELECT `txtun` FROM `login` WHERE `txtun` LIKE '$loginid'";
						        
if(mysql_num_rows(mysql_query($query))!=0)
 {
 echo 'Enter a Different LoginID.';
 }
   else
 {
$query= "INSERT INTO `local booking` VALUES ('$City' , '$pickuparea' , '$droparea' , '$date' , '$time' , '$firstname', '$lastname' , '$contact', '$email', '$car choice')";
						      
 if (mysql_query($query))
{
 echo 'Successfully submitted';
 } 
 else
  {
  echo mysql_error();
 }
}
}
else
{
echo "empty";
 }
}
?>