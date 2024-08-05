
<?php
session_start();
//error_reporting(0);
include("includes/config.php");

if($_SESSION['is_login'])
{
header("location:index.php");
}

?>
	
	
<?php

   $result="";

        if(isset($_POST['signup']))
{
                // Insert data into database 

        $fullname=$_POST['fullname'];
        $phonenumber=$_POST['phonenumber'];
        $address=$_POST['address'];
            $email=$_POST['email'];
            $gender=$_POST['gender'];
            $acad_no=$_POST['acad_no'];
            $dept=$_POST['dept'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $cpassword=$_POST['cpassword'];
            $role=$_POST['role'];
            $statue=$_POST['statue'];
            $reg_date=date('Y-m-d');
      
        $email_query = "SELECT * FROM users WHERE email='$email' ";
        $email_query_run = mysqli_query($conn, $email_query);

  if(mysqli_num_rows($email_query_run) > 0)
    {
      $result="البريد الإلكتروني مسجل بالموقع ، الرجاء إدخال بريد إلكتروني جديد";
    }
    else
    {
        if($password === $cpassword)
        {
    
    $insertQuery="INSERT INTO users(fullname,phonenumber,address,email,gender,acad_no,dept,username,password,role,statue,reg_date) VALUES('$fullname','$phonenumber','$address','$email','$gender','$acad_no','$dept','$username','$password','$role','$statue','$reg_date')";
        

        if(mysqli_query($conn,$insertQuery))
        {
            $result="تم تسجيلك بنجاح";
        }
        else{
            $result="خطأ !!! ، الرجاء التأكد من صحة البيانات والمحاولة مرة أخرى";
        }

        }
        else 
        {
        $result="كلمة السر غير متطابقة";
        }
    }
}

    function test_input($data){
        $data=trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript">
       
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>السحابة الرقمية للكلية الأردنية السودانية - تسجيل مستخدم جديد</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/rtl/bootstrap-rt5l.min.css" rel="stylesheet" />
    <link href="assets/css/InfoStyl5ecss.css" rel="stylesheet" />
</head>
<body>

    <?php include('includes/header.php');?>
          <!-- HEADER END-->

          <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container text-right">
              <div class="row">
                    <div class="col-md-12">
            <h1 class="page-head-line">
                بياناتك الشخصية
                </h1>
                    </div>
                </div>
                
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="">
                    <h5 class="text-center p-2">
                الرجاء التأكد من صحة جميع البيانات المدخلة
               </h5>
               
               <hr class="bg-dark">
               
          <div class="form-group text-center">
                        <p class="text-danger"><?= $result; ?></p>
                    </div>   
                
                              <form action="" method="post" class="text-right">
                  <div class="form-group">
                      <label for="fullname">الإسم الكامل(رباعي)</label>
                      <input type="text" name="fullname" class="form-control text-right" placeholder="الإسم كامل" required>
                  </div>
                  
<!--
        <div class="form-group mb-4">
                      <label for="file">الصورة الشخصية</label>
                      <input type="file" name="file" class="form-control" placeholder="الصورة الشخصية" required>
                    </div>    
                      
-->

                    <div class="form-group">
             <label for="phonenumber">رقم الهاتف</label>
                      <input type="number" name="phonenumber" class="form-control text-right" placeholder="رقم الهاتف" required>
                  </div>         
                  
                    <div class="form-group">
             <label for="address">العنوان</label>
                      <input type="text" name="address" class="form-control text-right" placeholder="العنوان" required>
                  </div>         
                  
                    <div class="form-group">
      <label for="email">البريد الإلكتروني</label>
                      <input type="email" name="email" class="form-control text-right" placeholder="البريد الإلكتروني" required>
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
                      <input type="text" name="acad_no" class="form-control text-right" placeholder="الرقم الأكاديمي" required>
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
       <label for="username">إسم المستخدم</label>
                      <input type="text" name="username" class="form-control" placeholder="إسم المستخدم" required>
                    </div>    
                    
                    <div class="form-group mb-4">
       <label for="password">كلمة السر</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>  
                    
                           <div class="form-group mb-4">
       <label for="cpassword">تأكيد كلمة السر</label>
                      <input type="password" name="cpassword" class="form-control" required>
                    </div>  

<input type="hidden" name="role" value="1">
<input type="hidden" name="statue" value="1">




                    <div class="form-group">
                        <input type="submit" name="signup" value="تسجيل جديد" class="btn-success btn-block">
                    </div>
                    
                    <div class="form-group text-center">
                        <span>
                             هل لديك حساب بالفعل ؟ جرب 
                        </span>
                        <a href="index.php" class="text-primary">
                            تسجيل الدخول
                            </a>
                    </div>
                      
    
                                                        
               </form>
                
                            
                    </div>
                  </div>
                </div>
                            
                            </div>
            </div>
        
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>

    
</body>
</html>