<?php
// ADMIN INSERT PRODUCT INTO PRODUCTS TABLE 
session_start();

if($_SESSION['admin']=="")
{
    header("location:admin_login.php");
}
include "config.php";
$error="";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
 $pname=$_POST['p_name'];
$pquantity=$_POST['p_qt'];
$psell=$_POST['p_sell'];
$plist=$_POST['p_list'];
$pcategory=$_POST['p_category'];
$uploadfile=$_FILES['image']['name'];
$tmpname=$_FILES['image']['tmp_name'];
$folder="img/$uploadfile";
// DYNAMIC FILE UPLOAD IN IMG FOLDER
move_uploaded_file($tmpname,$folder);

if($pname!="" && $pquantity!="" && $psell!="" && $plist!="" && $pcategory!="" && $folder!="")
{
    $query="INSERT INTO products (name,image,category,sale_price,list_price,quantity) VALUES ('$pname','$folder','$pcategory','$psell','$plist','$pquantity')";
    
    $conn->query($query);
   
    $error ="<div class='alert alert-success'>Product inserted successfully !!!!</div>";
}
else{
    $error ="<div class='alert alert-danger'>Please fill all the fields !!!!</div>"; 
}
}
if(isset($_GET['action']) && $_GET['action']=='logout')
{
    unset($_SESSION['admin']);
    header("location:admin_login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  
    <title>my store</title>
</head>


<div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
           <h1 style="color:#ffd333;">Admin Panel</h1>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>                           
                            <a href="admin_dashboard.php" class="nav-item nav-link">Dashboard</a>
                            <a href="admin_seeUsers.php" class="nav-item nav-link">View Users</a>
                            <a href="admin_seeOrders.php" class="nav-item nav-link">View Orders</a>
                            <a href="top5products.php" class="nav-item nav-link">Top products</a>
                            <a href="top5users.php" class="nav-item nav-link">Top users</a>
                            <a href="top5orders.php" class="nav-item nav-link">Top orders</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                         
                            <a href="admin_insert_product.php?action=logout" class="btn px-0 ml-3">
                                <i class="fas fa-user-alt text-primary"> Logout</i>
                                
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- form -->
    <div class="container mt-5 w-50 p-5 rounded shadow lg" style="background-color:#ffd333;">
    <span class="text-danger"><?php echo $error;?></span>
        <form  method="post" class="text-white" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Product Name</label>
                    <input type="text" name="p_name" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Product Quantity</label>
                    <input type="text" name="p_qt" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row">
                
                <div class="form-group col-md-6">
                    <label for="">Sell price</label>
                    <input type="text" name="p_sell" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                    <label for="">List price</label>
                    <input type="text" name="p_list" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Category</label>
                    <input type="text" name="p_category" class="form-control form-control-sm">
                </div>
            </div>
            <label for="customFile">Product Image</label>
            <input type="file"  name ="image" >
           
            <!-- <input type="submit" class="btn btn-sm text-white shadow bg-dark" value="Add product"> -->
         
            <button type="submit" class="btn btn-dark ">Add</button>
        </form>
    </div>
  
      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
</body>
</html>