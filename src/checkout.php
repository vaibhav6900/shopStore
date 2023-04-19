<?php
session_start();
include "config.php";
// WITHOUT LOGIN U CAN'T ORDER
if ($_SESSION['isloggedIn'] == "false" || empty($_SESSION['isloggedIn'])) {
    header("location:user_signup.php");
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
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>my store</title>


</head>

<body>
    <!-- navbar starts -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <h1 style="color:#ffd333;">Shopping cart</h1>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">

                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">


                            <?php if ($_SESSION['isloggedIn'] == "true") {
                            ?>
                                <a href="user_login.php" class="btn px-0 ml-3 logout">
                                    <i class="fas fa-user-alt text-primary ">Logout</i>

                                </a>
                            <?php } else {
                            ?>

                                <a href="user_signup.php" class="btn px-0 ml-3 signup">
                                    <i class="fas fa-user-alt text-primary "> Sign up</i>

                                </a>
                            <?php  } ?>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- checkout section -->
    <div class="container-fluid">

        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        
                       
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" id="mobile">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="Gomti Nagar" id="address">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" type="text" placeholder="India" id="country">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="Lucknow" id="city">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="Uttar Pradesh" id="state">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pin Code</label>
                            <input class="form-control" type="text" placeholder="226012" id="pincode">
                        </div>
                        
                       
                    </div>
                </div>
               
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php
                        $grandsum=0;
                        if (!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem'])) {

                            foreach ($_COOKIE['cartItem'] as $name1 => $value) {
                                $mycookie = explode("__", $value);
                                $grandsum=$grandsum+$mycookie[4];
                             ?>
                             <div class="d-flex justify-content-between">
                                <p><?php echo $mycookie[1]?></p>
                                <p><?php echo $mycookie[4]?></p>
                            </div>  
                           <?php }
                        }?>  

                    </div>

                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo $grandsum?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        
                       
                        
                        <button class="btn btn-block btn-primary font-weight-bold py-3 placeOrder">Place Order</button>
                    </div>
                </div>
                   
            </div>
        </div>
    </div>
    <div class='text center alert alert-Success container mt-5 bg-success text-white orderplaced' style="display:none;">
      Your order has been placed succesfully!!!
     </div>
    <script>
          $(document).ready(function(){
            $(".placeOrder").on('click',function(){
               let mobile=$("#mobile").val();
               let address=$("#address").val();
               let country=$("#country").val();
               let city=$("#city").val();
               let state=$("#state").val();
               let pincode=$("#pincode").val();
                if(mobile=="" || address=="" || country=="" || city=="" || state=="" || pincode=="")
                {
                    alert("Please fill all fields");
                    return;
                }
               

                $.ajax({
                    url:"placeorder.php",
                    method:"POST",
                    data:{
                        mobile:mobile,
                        address:address,
                        country:country,
                        city:city,
                       state:state,
                       pin:pincode
                    },
                    success:function(res){
                     
                      $(".orderplaced").css("display","block");
                      $(".orderplaced").fadeOut(5000);
                    }
                });
            })
        });
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>