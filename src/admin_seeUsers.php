<?php 
include 'config.php';
error_reporting(0);
// when u click on delete
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == 'delete' && isset($_GET['id']) && !empty($_GET['id'])) {
    $del_id = $_GET['id'];
    $query1 = "DELETE FROM users WHERE u_id=$del_id";
    
    $conn->query($query1);
   
    
  
    header("location:admin_seeUsers.php");
    exit();
}
// when you click on edit
if (isset($_POST['submit']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $query = "UPDATE users SET u_id='$id' , username='$name' , email='$email' ,status='$status'  WHERE u_id = $id";
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
       
        <table class="table text-center mt-1 table-bordered">
            <thead>
                <tr>
                  
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php
            $query = "SELECT * FROM users";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
                    $id = $rows['u_id'];
                    $name = $rows['username'];
                    $email = $rows['email'];
                    $status = $rows['status'];
            ?>
                    <tbody>
                        <tr>
                            <form method="POST" enctype="multipart/form-data">
                               
                                <!-- id -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="id" value="<?php echo $id; ?>" disabled>
                                </td>
                                <!-- name -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $name; ?>" disabled>
                                </td>
                                <!-- email -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="email" value="<?php echo $email; ?>" disabled>
                                </td>
                                <!-- status -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="status" value="<?php echo $status; ?>" disabled>
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
                            <a href="?action=delete&id=<?php echo $id; ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Costly operation , there exists relations, do u really wanna delete ?')" name="submit">
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