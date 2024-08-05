
<?php
session_start();
//error_reporting(0);
include("includes/config.php");

?>
	
	
<?php

   $result="";
   $targetDir = "admin/uploaded_files/"; 
 

        if(isset($_POST['upload_file']))
        {
                // Insert data into database 
        $uid=intval($_GET['uid']);
        $file_title=$_POST['file_title'];
        $shared=$_POST['shared'];
        $file_name=$_FILES['file_to_upload']['name'];
       // $final_file_name=str_replace(' ','-',$file_name);
       
         $file_loc = $targetDir.$file_name; 
        
        $uploaded_date = date('Y-m-d',time());
      
      $allowed_extension = array('doc','docx','ppt','pptx','pdf');
      
      $file_extension = pathinfo($file_name,PATHINFO_EXTENSION);
      
      // $file_size = $_FILES['file_to_upload']['Size'];
      $temp_file_size = $_FILES['file_to_upload']['size'];
      $file_size = ($temp_file_size / 1024) / 1024;
      
      if(!in_array($file_extension,$allowed_extension))
      {
          $result = "صيغة الملف غير مدعومة ، تأكد من صيغة الملف ومن ثم حاول مرة اخرى.";
      }
      else
      {
      if(file_exists($targetDir.$file_name))
      {
          $result = "تم رفع الملف من قبل ، تأكد من الملف وحاول مرة اخرى.";
      }
      else
      {
          $insertQuery="INSERT INTO uploaded_files(file_title,file_name,file_size,file_loc,uploaded_date,user_id,is_shared) VALUES('$file_title','$file_name','$file_size','$file_loc','$uploaded_date','$uid','$shared')";
      
        $insert_query_run = mysqli_query($conn, $insertQuery);
        
        if($insert_query_run)
        {
            move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $targetDir.$file_name);
            $result="تم رفع الملف بنجاح.";
          //  header("location:add_file.php?uid=$uid");
        }
        else
        {
            $result="خطأ ، لم يتم رفع الملف ، تأكد من معلومات الملف وحاول مرة اخرى.";
        }
        
        }
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
        إضافة ملف
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
                معلومات الملف 
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
                
      <form action="" method="post" class="text-right" enctype="multipart/form-data">
          
                  <div class="form-group">
                      <label for="file_title">
                         عنوان الملف
                         </label>
                      <input type="text" name="file_title" class="form-control text-right" placeholder="عنوان الملف" required>
                  </div>
                  
        <div class="form-group mb-4">
                      <label for="file_name">
                          الملف
                      </label>
                   <input type="file" name="file_to_upload" class="form-control" required>
                    </div>
                    
    <div class="form-group mb-4">
                      <label for="book_cat">
                          هل تريد مشاركة الملف مع بقية اعضاء الموقع
                      </label>
                      
         <select class="form-control text-right" name="shared" required>
          
                      <option value="1">
                        نعم
                      </option>
                      <option value="0">
                        لا
                      </option>
                  
                      </select>
                      
                    </div>    
                      

        
        <input type="hidden" name="r" value="1">
        <input type="hidden" name="s" value="1">

                    <div class="form-group">
                        <input type="submit" name="upload_file" value="رفع الملف للسحابة" class="btn-success btn-block">
                    </div>
                    
                    <div class="form-group text-center">
                        <a href="my_files.php" class="text-primary">
                            قائمة ملفاتك
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