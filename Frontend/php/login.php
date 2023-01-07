<?php 
require "../connection/dbconnection.php";
$Error=[];

if (isset($_POST['sign_up']))
{
  $username=$_POST['iname'];
  $userpassword=password_hash($_POST['ipassword'],PASSWORD_DEFAULT);
  $useremail=$_POST['email'];

  if(!$username)
  {
    $Error="Username is reqiured.";
  }
  if(!$userpassword)
  {
    $Error="Userpassword is reqiured.";
  }
  if(!$useremail)
  {
    $Error="Email is reqiured.";
  }

  if(empty($Error))
  {
    $query="INSERT INTO user_log (Username,Userpassword,Email) VALUES('$username','$userpassword','$useremail')";
    $result=mysqli_query($connection,$query);
    echo "<script>alart('Registed successfully')</script>";
  }
}


if (isset($_POST['sign_in']))
{

  $upassword=$_POST['upassword'];
  $query="SELECT * FROM user_log WHERE Email='$_POST[uemail]'";
  $result=mysqli_query($connection,$query);
  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      $row=mysqli_fetch_assoc($result);
      if(password_verify($upassword,$row['Userpassword']))
      {
        session_start();
        $_SESSION['UserID']=$_POST['uemail'];
        header('location: user.php');
        exit();
      }
      else
      {
        echo "<script>alert('Incorrect Email and Password')</script>";
      }
    }
    else{
      echo "<script>alert('Account is not registered')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="" method="post" autocomplete="off" class="sign-in-form">
              <div class="logo">
                <img src="../resourse/eshop.webp" alt="easyclass" class="log img" />
                <h4>E-SHOP</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a>
              </div>
              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="email"
                    name="uemail"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    name="upassword"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" name="sign_in" value="Sign In" class="sign-btn" />

                <p class="text">
                  Forgotten your password or you login datails?
                  <a href="#">Get help</a> signing in
                </p>
              </div>
            </form>

            <form action="" autocomplete="off" method="post" class="sign-up-form">
              <div class="logo">
                <img src="../resourse/logo.png" alt="easyclass" />
                <h4>E-shop</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle ">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    name="iname"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    name="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    name="ipassword"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" name="sign_up"value="Sign Up" class="sign-btn" />

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="../resourse/image1.png" class="image img-1 show" alt="" />
              <img src="../resourse/image2.png" class="image img-2" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="../js/login.js"></script>
  </body>
</html>
