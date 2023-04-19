<?php
session_start(); 
// ON PLACING ORDER REMOVE CART FROM COOKIE
include 'config.php';
$del_cookie="";
if (!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem'])) {
    foreach ($_COOKIE['cartItem'] as $name1 => $value) {
        if(isset($_POST["delete$name1"]))
        {
            $del_cookie .= setcookie("cartItem[$name1]","",time()-1800);
            header("Refresh:0");
        }
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
                                <?php if(!empty($_COOKIE['cartItem']))
                                       {echo count($_COOKIE['cartItem']);}
                                      else
                                       {echo "0";}; 
                                       ?>
                               </span>
                            </a>
                            <?php if($_SESSION['isloggedIn']=="true")
                            {
                            ?>
                            <a href="user_login.php" class="btn px-0 ml-3 logout">
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
    <!-- table -->
    <div class="">
        <table class="table container text-center table-responsive">
            <?php   
             @$d=0;
             if(!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem']))
             {
                @$d=$d+1;
             }
             if(@$d==0)
             {
                echo "<div class='text center alert alert-danger container mt-5'>
                No Record Found !!!
                </div>";
             }
             else{

             
             ?>
               <h1 class="container text-center text-white bg-warning mt-5 rounded shadow">
                Product Details
               </h1>
               <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
               </thead>
               <tbody>
                <?php
                foreach($_COOKIE['cartItem'] as $name1=>$value)
                {
                    $mycookie=explode("__",$value);
                    $_SESSION['p_id']=$mycookie[5];
                
                
                ?>
                <form  method="post">
                    <tr>
                       <td>
                        <img src="<?php echo $mycookie[0]?>" style="width :100px; height: 100px;">
                       </td>
                       <td>
                        <input type="text" id="" class="form-control form-control-sm text-center" value="<?php echo $mycookie[1] ?>" name="p_name" disabled>
                       </td>
                       <td>
                       <input type="text" id="" class="form-control form-control-sm text-center" value="<?php echo $mycookie[2] ?>" name="p_price" disabled>
                       </td>
                       <input type="hidden" id="pprice" value="<?php echo $mycookie[2]?>">
                       <input type="hidden" id="pid" value="<?php echo $mycookie[5]?>">
                       <td>
                        <input type="number" id="" class="form-control form-control-sm text-center itemQty" min="1" value="<?php echo $mycookie[3]?>">
                       </td>
                       <td>
                       <input type="text" id="" class="form-control form-control-sm text-center total" value="<?php echo $mycookie[4] ?>" name="p_totalprice" disabled>
                       </td>
                       <td>
                        <button type="submit" name="delete<?php echo $name1?>" class="btn"><i class="fa fa-trash"></i></button>
                       </td>
                    </tr>
                </form>
                <?php } ?>
               </tbody>
        </table>
        <?php }
        // else statement ends here
        $g_total=0;
        if(!empty($_COOKIE['cartItem']) && is_array($_COOKIE['cartItem']))
        {
            foreach($_COOKIE['cartItem'] as $name1 => $value)
            {
                $mycookie = explode("__",$value);
                $g_total= $g_total+$mycookie[4];
            }
            $_SESSION['pay_amount']=$g_total;
            if($g_total==0)
            {?>
              <input type="hidden" value="<?php echo $g_total?>" id="grandtotal">
              <?php }
              else {  ?>
                <div class="float-right">
                    <span class="text-success">Total amount : $</span>
                    <input type="text" value="<?php echo $g_total?>" id="grandtotal" class="p-2 bg-dark text-white border-0 rounded shadow mb-5" name="total" disabled style="margin-right: 120px;">
                    
                </div>
                <a href="checkout.php" class="btn btn-sm btn-info mt-2 " style="margin-left: 120px;">Checkout</a>
                <?php }
         }       
                ?>
            

            
        
        
    </div>
    <script>
        $(document).ready(function(){
            $(".itemQty").on('change',function(){
                let ele=$(this).closest('tr');
                let pid=ele.find("#pid").val();
                let pprice=ele.find("#pprice").val();
                let new_qty=ele.find(".itemQty").val();
                if(new_qty=="" || new_qty<1)
                {
                    alert("amount cant be less than 1");
                    return;
                }
                let total=pprice*new_qty;
                let newtotal=ele.find('.total').val(total);
                console.log(newtotal.val());
                let sum_total=0;
                $(".total").each(function(){
                   sum_total=sum_total+parseInt($(this).val()); 
                });
                $("#grandtotal").val(sum_total);
                let amount_pay=$("#grandtotal").val();

                $.ajax({
                    url:"grandtotal.php",
                    method:"POST",
                    data:{
                        pid:pid,
                        pprice:pprice,
                        pqty:new_qty,
                        total:newtotal.val(),
                        grandTotal:amount_pay
                    },
                    success:function(res){
                      console.log(res);
                      
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