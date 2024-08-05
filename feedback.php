
<?php
session_start();
//error_reporting(0);
include("includes/config.php");

?>
	
	
<?php

   $result="";

 

        if(isset($_POST['send_feedback']))
        {
                // Insert data into database 
    
        
        $subject_title=$_POST['subject_title'];
        $subject=$_POST['subject'];

       if($_SESSION['is_login']==1)
        {
        $uid=intval($_SESSION['user_id']);
        $subject_sender=$_SESSION['login_name'];
            }
            else{
            $uid= 0;
            $subject_sender="Guest";
                }
  
      
          $insertQuery="INSERT INTO feedbacks (user_id,username,subject_title,subject) VALUES('$uid','$subject_sender','$subject_title','$subject')";
      
        $insert_query_run = mysqli_query($conn, $insertQuery);
        
        if($insert_query_run)
        {
            $result="تم الإرسال بنجاح.";
          //  header("location:add_file.php?uid=$uid");
        }
        else
        {
            $result="خطأ ، لم يتم الإرسال ، تأكد من البيانات المدخلة وحاول مرة اخرى.";
        }
        
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

    <title>
         الشكاوى والملاحظات
    </title>
    
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
            الشكاوى والملاحظات
                </h1>
                    </div>
                </div>
                
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="">
                    <h5 class="right p-2">
                الرجاء التأكد من ملء جميع حقول البيانات
               </h5>
               
               <hr class="bg-dark">
               
          <div class="form-group text-center">
                        <p class="text-danger"><?= $result; ?></p>
                    </div>   
                
      <form action="" method="post" class="text-right" enctype="multipart/form-data">
          
                  <div class="form-group">
                      <label for="subject_title">
                         عنوان الموضوع 
                         </label>
                      <input type="text" name="subject_title" class="form-control text-right" placeholder="عنوان الموضوع ..." required>
                  </div>
                  
  
                    
    <div class="form-group mb-4">
                      <label for="subject">
                         الموضوع
                      </label>
                      
         <textarea class="form-control text-right" name="subject" rows="6" required>
                  
                      </textarea>
                      
                    </div>    
                      

        

                    <div class="form-group">
                        <input type="submit" name="send_feedback" value="إرسال" class="btn-success btn-block">
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