<?php
session_start(); 
error_reporting(0);
include 'config.php';
// WHEN I CLICK ON ADD TO CART
if($_SERVER['REQUEST_METHOD']=="POST")
{
 $d=0;
//  if cookies are not empty
 if(!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem']))
 {
  
    foreach($_COOKIE['cartItem'] as $name=>$value)
    {
        $d=$d+1;
    }
    $d=$d+1;
 }
 else{
    $d=$d+1;
 }
 $id=$_POST['hidden-id'];
 $query="SELECT * FROM products WHERE id=$id";
 $res=$conn->query($query);
 if($res->num_rows >0)
 {
    while($row = $res->fetch_assoc())
    {
        $item_id=$row['id'];
        $name=$row['name'];
        $image=$row['image'];
        $price=$row['sale_price'];
        $qty=1; 
        $total_price=$price*$qty;
    }
    // if i have cookies
    if(!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem']))
    {
        foreach($_COOKIE['cartItem'] as $name1=>$value)
        {
            $mycookie= explode("__",$value);
            $found=0;
            if($image== $mycookie[0])
            {
                $found=$found+1;
                $qty1=$mycookie[3]+1;
                $total_price=$mycookie[2]*$qty1;
                
                setcookie("cartItem[$name1]",$image."__".$name."__".$price."__".$qty1."__".$total_price."__".$item_id."__".$total_price,time()+1800);

            }
        }
        // if my cart is not empty and want to set cookie for newly clicked item
        if($found==0)
        {
            setcookie("cartItem[$d]",$image."__".$name."__".$price."__".$qty."__".$total_price."__".$item_id."__".$total_price,time()+1800);
        }
    }
    // if i dont have cookies
    else{
        setcookie("cartItem[$d]",$image."__".$name."__".$price."__".$qty."__".$total_price."__".$item_id."__".$total_price,time()+1800);
    }
 }
 header("Refresh:0");
 
}
// counting total items in cart
if(!empty($_COOKIE['cartItem']))
{
    $total_cartItems=count($_COOKIE['cartItem']);
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
                          
                            <a href="cart.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                <?php if(!empty($total_cartItems))
                                       {echo $total_cartItems;}
                                      else
                                       {echo "0";}; 
                                       ?>
                               </span>
                            </a>
                            <?php if($_SESSION['isloggedIn']=="true")
                            {
                            ?>
                            <a href="user_signup.php" class="btn px-0 ml-3 logout">
                                <i class="fas fa-user-alt text-primary ">Logout</i>
                                
                            </a>
                            <?php } 
                            else{
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
    
      <!-- Carousel Start -->
      <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
     <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->    
   <!-- Product start -->
<div class="container-fluid pt-5 pb-3">
      <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
      
    <div class="row px-xl-5">
        <!-- dynamically adding products from DB -->
    <?php
        $query="SELECT * FROM products";
        $result=$conn->query($query);
        if($result->num_rows >0)
        {
            while($row=$result->fetch_assoc())
            {
                $id=$row['id'];
                $name=$row['name'];
                $image=$row['image'];
                $sale_price=$row['sale_price'];
                $list_price=$row['list_price'];
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
       
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $image?>" alt="image">
                        <div class="product-action"> 
                            
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="product_desc.php?id=<?php echo $id?>"><?php echo $name?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?php echo $sale_price?>.00</h5><h6 class="text-muted ml-2"><del>$<?php echo $list_price?>.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="hidden-id" value="<?php echo $id?>">
                        <button class="btn "><i class="fas fa-shopping-cart text-primary"></i> Add to cart</button>
                        </form>
                     
                      
                    </div>
                </div>
            </div>
            <?php
        }
    }?>
    </div>
    
   
</div>

   <!-- Product end -->
   <?php include "footer.php"; ?>
            <!-- my included js-->
         <script src="user_handler.js"></script>

  
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