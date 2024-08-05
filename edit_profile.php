<?php
session_start();
include('includes/config.php');
//:error_reporting(0);
?>

<?php

  $result="";

    $uid=$_GET['uid'];
    $featch_user=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$uid'");
    $row=mysqli_fetch_assoc($featch_user);

    if(isset($_POST['edit_pro']))
    {

          $fullname=$_POST['fullname'];
            $phonenumber=$_POST['phonenumber'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $gender=$_POST['gender'];
            $acad_no=$_POST['acad_no'];
            $dept=$_POST['dept'];
            $username=$_POST['username'];
      

     $UpdateQuery="UPDATE users SET fullname='$fullname',phonenumber='$phonenumber',address='$address',email='$email',gender='$gender',acad_no='$acad_no',dept='$dept',username='$username' WHERE user_id='$uid'";
     


        if(mysqli_query($conn,$UpdateQuery))
        {
            $result="تم تعديل البيانات بنجاح";
        }
        else{
            $result="خطأ !!! ، الرجاء مراجعة البيانات والمحاولة مرة أخرى";
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
    <title>تعديل الصفحة الشخصية</title>
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
				<h3>بياناتي الشخصية</h3>
				<hr>
			</div>
			<!-- Form START -->
			
	             <form action="" method="post" enctype="multipart/form-data" class="text-right">
                  <div class="form-group">
           <label for="fullname">الإسم الكامل</label>
                      <input type="text" name="fullname" class="form-control text-right" value="<?=$row['fullname']; ?>" required>
                  </div>
                                             
                    <div class="form-group">
             <label for="phonenumber">رقم الهاتف</label>
                      <input type="number" name="phonenumber" value="<?=$row['phonenumber']; ?>" class="form-control text-right" required>
                  </div>         
                    
                    <div class="form-group mb-4">
            <label for="address">العنوان</label>
         <input type="text" name="address" class="form-control text-right" value="<?=$row['address']; ?>" required>
                    </div>    
                    
                    <div class="form-group mb-4">
              <label for="email">البريد الإلكتروني</label>
                      <input type="email" name="email" class="form-control text-right" value="<?=$row['email']; ?>" required>
                    </div>    
                    
                     <div class="form-group mb-4">
         <label for="gender">النوع</label>

<div class="form-check">
       <label class="form-check-label mx-4" for="gender1">ذكر</label>
       
    <input type="radio" class="form-check-input" name="gender" id="gender1" value="male" checked>
  </div>
  
  <div class="form-check">
          <label class="form-check-label mx-4" for="gender2">أنثى</label>
      
    <input type="radio" class="form-check-input" name="gender" id="gender2" value="female">
  </div>

                    </div>  
                    
                    <div class="form-group mb-4">
       <label for="acad_no">الرقم الأكاديمي</label>
                      <input type="text" name="acad_no" class="form-control text-right" value="<?=$row['acad_no']; ?>" required>
                    </div>    
                    
                    <div class="form-group mb-4">
       <label for="dept">القسم العلمي</label>
                   
                     <select class="form-control text-right" name="dept" required>
                                            <?php
    $select_dept="SELECT * FROM department";

             $result_dept=mysqli_query($conn,$select_dept);

          while($featch_dept=mysqli_fetch_assoc($result_dept)){       
    ?>
                      <option value="<?= $featch_dept['dept_no']; ?>">
                        <?= $featch_dept['dept_name']; ?>
                      </option>
                        <?php } ?>
                      </select>
                 
                    </div>    
                    
                    <div class="form-group mb-4">
       <label for="username">اسم المستخدم</label>
                      <input type="text" name="username" class="form-control text-right" value="<?=$row['username']; ?>" required>
                    </div>    
                    
                    
                    <div class="form-group">
                        <input type="submit" name="edit_pro" value="حفظ" class="btn-primary btn-block">
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

