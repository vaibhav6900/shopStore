<!-- top 5 products -->
<h1>TOP 5 PRODUCTS based on quantity sold</h1>
<table border=1>
    <thead>
        <tr>
            <th>P ID</th>
            <th>SOLD QT</th>
            <th> PRODUCT NAME</th>
        </tr>
   </thead>
   <tbody>

<?php
include "config.php";
$productQuery="SELECT * FROM (SELECT orders.p_id as pid ,SUM(orders.quantity) as qt  ,products.name as pname  FROM orders JOIN products ON products.id=orders.p_id GROUP BY orders.p_id  LIMIT 5) tmp ORDER BY tmp.qt DESC";

$res=$conn->query($productQuery);

if($res->num_rows >0)
{ 
    while($row = $res->fetch_assoc())
    {
        $pid=$row['pid'];
        $qt=$row['qt'];
        $pname=$row['pname'];?>
        <tr>
        <td> <?php echo $pid;?> </td>
        <td> <?php echo $qt;?>  </td>
        <td>  <?php echo $pname;?> </td>  
        <tr>
   <?php }
}?>
</tbody>
</table>
<br><br>
<a href="admin_dashboard.php"><button>GO BACK TO DASHBOARD</button></a>
<hr>
<!-- product -->





