<?php
session_start();
// error_reporting(0);
include("includes/config.php");

if($_SESSION['is_login']==1)
{
header("location:homer.php");
}
?>

<?php

$result="";

if(isset($_POST['submit_login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
$query=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' and password='$password'");
$featch_user=mysqli_fetch_assoc($query);
if($featch_user>0)
{

$_SESSION['login_name']=$featch_user['username'];
$_SESSION['user_id']=$featch_user['user_id'];
$_SESSION['full_name']=$featch_user['fullname'];
$_SESSION['is_login']=1;
$status=1;
$userid=$featch_user['user_id'];

$result="تم تسجيل دخولك بنجاح"."
   <a href='homer.php' class='text-primary'>
   &nbsp;
                  إضغط هنا للمتابعة
                </a>
                ";

}
else
{
$result="خطأ في البريد الإلكتروني أو كلمة السر";
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>
        السحابة الرقمية للكلية الأردنية السودانية - تسجيل الدخول
         </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container text-right">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">
                      أدخل البريد الإلكتروني وكلمة السر
                       </h4>

                </div>

            </div>
            
             <span class="text-danger" >
            <?= $result; ?>
               </span>
               
            <form action="" method="post">
            <div class="row">
                <div class="col-md-7">
                     <label>
                         البريد الإلكتروني
                         </label>
                        <input type="email" name="email" class="form-control" required />
                        <label class="mt-2">
                            كلمة السر
                            </label>
                        <input type="password" name="password" class="form-control" required  />
                        <hr />
                        
                         <a href="signup.php" class="btn btn-success btn-green"><span class="fa fa-user"></span> &nbsp;  
                         إنشاء حساب جديد
                         </a>
                         
                         &nbsp;
                         
                            <button type="submit" name="submit_login" class="btn btn-primary"><span class="fa fa-user"></span> &nbsp;تسجيل دخول </button>
                        
                         
                </div>
                </form>
            

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
