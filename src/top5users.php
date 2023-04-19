<!-- top 5 users -->
<h1>TOP 5 USERS based on MONEY SPENT</h1>
<table border=1>
    <thead>
        <tr>
            <th>u ID</th>
            <th>MONEY SPENT</th>
            <th> USER NAME</th>
        </tr>
   </thead>
   <tbody>

<?php
include "config.php";
$productQuery="SELECT * FROM (SELECT orders.u_id as uid ,SUM(orders.total) as total  ,users.username as uname  FROM orders JOIN users ON users.u_id=orders.u_id GROUP BY orders.u_id  LIMIT 5) tmp ORDER BY tmp.total DESC";

$res=$conn->query($productQuery);

if($res->num_rows >0)
{ 
    while($row = $res->fetch_assoc())
    {
        $uid=$row['uid'];
        $total=$row['total'];
        $uname=$row['uname'];?>
        <tr>
        <td> <?php echo $uid;?> </td>
        <td> <?php echo $total;?>  </td>
        <td>  <?php echo $uname;?> </td>  
        <tr>
   <?php }
}?>
</tbody>
</table>
<br><br>
<a href="admin_dashboard.php"><button>GO BACK TO DASHBOARD</button></a>
<hr>

<!-- product -->





