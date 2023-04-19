<!-- inserting order in orders table -->
<?php
session_start();
include 'config.php';
$city= $_POST['city'];
$mobile= $_POST['mobile'];
$country= $_POST['country'];
$pin= $_POST['pin'];
$state= $_POST['state'];
$address= $_POST['address'];
$useremail=$_SESSION['user'];

if(!empty($useremail))
{
    $query1="SELECT * FROM `users` where `email`='$useremail'";
    
     $res1 = $conn->query($query1);
    
     if($res1->num_rows >0)
     { 
        
        while($row = $res1->fetch_assoc())
        {
            $u_id=$row['u_id'];
        
        }
     }
     if (!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem'])) {

        foreach ($_COOKIE['cartItem'] as $name1 => $value) {
            $mycookie = explode("__", $value);
       
            $query2="INSERT INTO orders (p_id,u_id,ship_address,price,quantity,total,status) VALUES ('$mycookie[5]','$u_id','$address','$mycookie[2]','$mycookie[3]','$mycookie[4]','pending')";
            
             $conn->query($query2);
             $del_cookie .= setcookie("cartItem[$name1]","",time()-1800);
        }
    }
    
        
}
