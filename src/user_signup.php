<?php
session_start();
include "config.php";
$username="";
$password="";
$confirm_password="";
$message="";
$email="";

// user registration 
if($_SERVER['REQUEST_METHOD']=="POST")
{

   
    if(empty(trim($_POST['username'])))
    {
        $message="Username cannot be empty";
    }
    if(empty(trim($_POST['password'])))
    {
        $message="Password cannot be empty";
    }
    if(empty(trim($_POST['email'])))
    {
        $message="Email cannot be empty";
    }
    else{
        $email=$_POST['email'];
        $query="SELECT u_id from users WHERE email='$email'";
        $result=$conn->query($query);
        if($result->num_rows >0)
        {
            $message="Email already exist !!! ";
        }
    }
    if($_POST['password']!=$_POST['confirm_password'])
    {
        $message="Password is not matching";
    }
    if($message=="")
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $query="INSERT INTO users (username,password,email,status) VALUES ('$username','$password','$email','pending')";

        $conn->query($query);
        $_SESSION['user']=$email;
        header("location:user_login.php");
    }
    else{
      $ $message="Signup failed !! Can't redirect";
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Registration Page</title>
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary mb-4">
        <a class="navbar-brand" href="#">Registration form</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       
    </nav>
    <!-- form -->
    <div class="container ">
        <div class="container-header "><h1>Sign up<h1></div>
        <h2 style="color:red; font-family:Arial;"><?php echo $message ?></h2>
    <form action="" method="post">
    <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" name="username" id="exampleInputName" placeholder="Enter Username">
            
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2"  name="confirm_password"placeholder="Confirm Password">
        </div>
      
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    </div>
    <div class="container mt-2">
        <h5>Already a user ? <a href="user_login.php">Login</a></h5>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>