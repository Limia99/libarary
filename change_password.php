<?php
session_start();
include('includes/config.php');
//:error_reporting(0);
?>

<?php

  $result="";
  $old_pass=$_POST['old_pass'];
  $new_pass=$_POST['new_pass'];
  $cpass=$_POST['cpass'];

    $uid=$_SESSION['user_id'];

    if(isset($_POST['change_pass']))
    {

     $pass_query = "SELECT * FROM users WHERE password='$old_pass' AND user_id='$uid' ";
    $pass_result = mysqli_query($conn, $pass_query);

  if(mysqli_num_rows($pass_result) <= 0)
    {
      $result="كلمة السر القديمة خاطئة";
    }
    else
    {
        if($new_pass === $cpass)
        {

     $UpdateQuery="UPDATE users SET password='$new_pass' WHERE user_id='$uid'";
     

        if(mysqli_query($conn,$UpdateQuery))
        {
            $result="تم تعديل كلمة السر بنجاح";
        }
        else{
            $result="خطأ !!! ، الرجاء مراجعة البيانات والمحاولة مرة أخرى";
        }
        }
        else 
        {
        $result="كلمة السر غير متطابقة";
        }
      
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
    <title>تعديل كلمة السر</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
    
    <!-- MENU SECTION END-->
    
<div class="container">

<div class="row">

		<div class="col-12">
			<!-- Page title -->
			<div class="my-5 text-right">
				<h3>كلمة السر الخاصة بك</h3>
				<hr>
			</div>
			<!-- Form START -->
			
	             <form action="" method="post" enctype="multipart/form-data" class="text-right">
                  <div class="form-group">
           <label for="old_pass">كلمة السر القديمة</label>
                      <input type="password" name="old_pass" class="form-control" value="" required>
                  </div>
                                             
                    <div class="form-group">
             <label for="new_pass">كلمة السر الجديدة</label>
                      <input type="text" name="new_pass" value="" class="form-control" required>
                  </div>
                  
                    <div class="form-group">
             <label for="cpass">تأكيد كلمة السر الجديدة</label>
                      <input type="text" name="cpass" value="" class="form-control" required>
                  </div>         
                    
                    
                    <div class="form-group">
                        <input type="submit" name="change_pass" value="حفظ" class="btn-primary btn-block">
                    </div>
                    
                    <div class="form-group text-center">
                        <a href="profile.php?uid=<?= $_SESSION['user_id']; ?>" class="text-dark lead">
                            الرجوع للصفحة الشخصية
                            </a>
                    </div>
                       
                    <div class="form-group text-center">
                        <p class="lead text-danger"><?= $result; ?></p>
                    </div>   
                                                        
               </form>
			
			<!-- Form END -->
		</div>
	</div>
	</div>

    
  <?php include('includes/footer.php');?>
  
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


</body>
</html>

