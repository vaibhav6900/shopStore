
<!-- top 5 orders -->
<h1>TOP 5 orders based on bill</h1>
<table border=1>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>product id</th>
            <th>User id</th>
            <th>BILL</th>
            <th>ADDRESS</th>
        </tr>
   </thead>
   <tbody>

<?php
include "config.php";
$Query="SELECT *  FROM orders ORDER BY total DESC LIMIT 5";

$res=$conn->query($Query);

if($res->num_rows >0)
{ 
    while($row = $res->fetch_assoc())
    {
        $oid=$row['o_id'];
        $uid=$row['u_id'];
        $pid=$row['p_id'];
        $total=$row['total'];
        $address=$row['ship_address'];?>
        <tr>
        <td> <?php echo $pid;?> </td>
        <td> <?php echo $pid;?> </td>
        <td> <?php echo $uid;?> </td>
        <td> <?php echo $total;?>  </td>
        <td>  <?php echo $address;?> </td>  
        <tr>
   <?php }
}?>
</tbody>
</table>
<br><br>
<a href="admin_dashboard.php"><button>GO BACK TO DASHBOARD</button></a>
<hr>
<!-- product -->





