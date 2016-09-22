<?php
						require'connect.inc.php';

						if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password']) &&isset($_POST['credit_card'])&&isset($_POST['phone'])&&isset($_POST['passwordc']))
						{
						   $name=$_POST['name'];
						   $email=$_POST['email'];
						   $password=$_POST['password'];
						   $credit_card=$_POST['credit_card'];
						   $phone=$_POST['phone'];
						   $passwordc=$_POST['passwordc'];
						   



						   if(!empty($name)&&!empty($loginid)&&!empty($password)&&!empty($credit_card)&&!empty($phone)&&!empty($passwordc))
						    {
						      $query="SELECT `register` FROM `users` WHERE `register` LIKE '$register'";
						        
						      if(mysql_num_rows(mysql_query($query))!=0)
						      {
						        echo 'Enter a Different LoginID.';
						      }
						      else
						      {
						        $query= "INSERT INTO `register` VALUES ('$name' , '$email' , '$password' , '$credit_card' , '$phone' , '$passwordc')";
						      
						        if (mysql_query($query))
						        {
						          echo 'Registeration Successful';
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