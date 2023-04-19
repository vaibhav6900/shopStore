<?php
include "config.php";

error_reporting(0);
// when you click on delete

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == 'delete' && isset($_GET['id']) && !empty($_GET['id'])) {
    $del_id = $_GET['id'];
    $query = "DELETE FROM products WHERE id=$del_id";
    $conn->query($query);
    header("location:admin_dashboard.php");
    exit();
}

// when you click on edit
if (isset($_POST['submit']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $sale_price = $_POST['sale_price'];
    $list_price = $_POST['list_price'];
    $quantity = $_POST['quantity'];
    $query = "UPDATE products SET name='$name' , category='$category' , sale_price='$sale_price' ,list_price='$list_price' ,quantity='$quantity' WHERE id = $id";
    $result = $conn->query($query);
    if ($result) {
        $message = "<div class='alert alert-success'> Data Updated successfully !!</div>";
        header("Refresh: 1");
    } else {
        $message = "<div class='alert alert-Danger'> Data Failed to Update  !!</div>";
    }
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

<!--  included by me -->
    <style>
        table.table td .add {
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  
    <title>my store</title>
</head>

<!-- navbar -->
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
<!-- navbar ends -->

<!-- table display -->
<div class="container mt-5">
    <h6><?php echo $message ?></h6>
    <div class="row">
        <a href="admin_insert_product.php" class="badge bg-primary text-white ml-auto p-2 mr-5">
            Add item
        </a>
        <table class="table text-center mt-1 table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sale price</th>
                    <th>List price</th>
                    <th>Quantity</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php
            $query = "SELECT * FROM products";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
                    $id = $rows['id'];
                    $image = $rows['image'];
                    $name = $rows['name'];
                    $category = $rows['category'];
                    $sale_price = $rows['sale_price'];
                    $list_price = $rows['list_price'];
                    $qty = $rows['quantity'];
            ?>
                    <tbody>
                        <tr>
                            <form method="POST" enctype="multipart/form-data">
                                <!-- image -->
                                <td>
                                    <img src="<?php echo $image ?>" name="" class="" style="width:100px">
                                </td>
                                <!-- id -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $id; ?>" disabled>
                                </td>
                                <!-- name -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $name; ?>" disabled>
                                </td>
                                <!-- category -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="category" value="<?php echo $category; ?>" disabled>
                                </td>
                                <!-- sale price -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="sale_price" value="<?php echo $sale_price; ?>" disabled>
                                </td>
                                <!-- list price -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="list_price" value="<?php echo $list_price; ?>" disabled>
                                </td>
                                <!-- quantity -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="quantity" value="<?php echo $qty; ?>" disabled>
                                </td>
                                <!-- action -->
                                <td>
                                    <div class="btn-group">
                                        <button type="submit" name="submit" class="add btn" title="save" data-toggle="tooltip">
                                            <a href="id=<?php echo $id ?>">
                                                <i class="material-icons text-warning">Update</i>
                                            </a>
                                        </button>
                                    <!-- </div> -->
                            </form>
                            <a class="edit btn" title="Edit" data-toggle="tooltip">
                                <i class="material-icons text-warning">Edit</i>
                            </a>
                            <a href="?action=delete&id=<?php echo $id; ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this data ?')" name="submit">
                                <i class="material-icons text-danger">Delete</i>
                            </a>
    </div>
    </td>
    </tr>
    </tbody>
<?php }
            } ?>
</table>
</div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on("click", ".edit", function() {
            $(".edit").css("display", "none");
            var input = $(this).parents("tr").find("input[type ='text']");
            input.each(function() {
                $(this).removeAttr('disabled');
            });
            $(this).parents("tr").find(".add", ".edit").toggle();
        });
    });
</script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>