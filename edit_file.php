<?php
session_start();
include('includes/config.php');
//:error_reporting(0);
?>

<?php

    /*
        if(!in_array($file_extension,$allowed_extension))
      {
          $result = "صيغة الملف غير مدعومة ، تأكد من صيغة الملف ومن ثم حاول مرة اخرى.";
      }
    
    */

    $result="";
    $targetDir = "admin/uploaded_files/"; 

    $uid=intval($_SESSION['user_id']);
    $file_id=intval($_GET['file_id']);
    
    $featch_file=mysqli_query($conn,"SELECT * FROM uploaded_files WHERE file_id='$file_id' AND user_id='$uid'");
    
    $file_row=mysqli_fetch_assoc($featch_file);

    if(isset($_POST['update_file']))
    {
        
        $file_title=$_POST['file_title'];
          $shared=$_POST['shared'];
        
        $new_file_name = $_FILES['file_to_update']['name'];
        $new_file_size = $_FILES['file_to_update']['size'];
        
        $old_file_name=$_POST['old_file'];
        $old_file_size=$_POST['old_size'];
        
      
      $allowed_extension = array('doc','docx','ppt','pptx','pdf');
      
      $file_extension = pathinfo($new_file_name,PATHINFO_EXTENSION);

      if(!empty($new_file_name))
        {
            $update_file_name = $new_file_name;
            $update_file_size = ($new_file_size / 1024) / 1024;
            
        }
        else
        {
            $update_file_name = $old_file_name;
            $update_file_size = $old_file_size;
          
        }
        
         // $final_new_file_name=str_replace(' ','-',$update_file_name);
       //   $file_size = ($update_file_size / 1024) / 1024;
          
            $update_date = date('Y-m-d',time());
            
         $file_loc = $targetDir.$update_file_name; 
      
         if(file_exists($targetDir . $_FILES['file_to_update']['name']) AND !empty($new_file_name))
      {
          $result = "تم رفع الملف من قبل ، تأكد من الملف وحاول مرة اخرى.";
      }
      else if(!empty($new_file_name) AND !in_array($file_extension,$allowed_extension))
      {
          $result = "صيغة الملف غير مدعومة ، تأكد من صيغة الملف ومن ثم حاول مرة اخرى.";
      }
      else
      {
            $UpdateQuery="UPDATE uploaded_files SET file_title='$file_title',file_name='$update_file_name',file_size='$update_file_size',file_loc='$file_loc',uploaded_date='$update_date',is_shared='$shared' WHERE file_id='$file_id' AND user_id='$uid'";
            
            $UpdateQuery_run = mysqli_query($conn,$UpdateQuery);
            
         if($UpdateQuery_run)
        {
            
        if(!empty($new_file_name))
        {
            
     move_uploaded_file($_FILES["file_to_update"]["tmp_name"], $targetDir.$new_file_name);
 
         unlink($targetDir.$old_file_name);
 
        }
        
       $result="تم تعديل بيانات الملف بنجاح";
        
        }
      else
      {
            $result="خطأ !!! ، الرجاء مراجعة البيانات والمحاولة مرة أخرى";
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
    <title>
        تعديل ملف
    </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
    
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
                      <input type="text" name="file_title" class="form-control text-right" value="<?=$file_row['file_title']; ?>"  required>
                  </div>
                  
        <div class="form-group mb-4">
                      <label for="file_name">
                          الملف
                      </label>
                   <input type="file" name="file_to_update" class="form-control">
                    </div>
                    
                                             
    <div class="form-group mb-4">
                      <label for="book_cat">
                          هل تريد مشاركة الملف مع بقية اعضاء الموقع
                      </label>
                      
         <select class="form-control text-right" name="shared" required>
             
                                <?php
              if($file_row['is_shared'] == 1)
    {
        echo '
           <option value="1">
                        نعم
                      </option>
                      
                <option value="0">
                        لا
                      </option>
        ';
    }
    else if($row['is_shared'] == 0)
        {
        echo '
             <option value="0">
                        لا
                      </option>
           
           <option value="1">
                        نعم
                      </option>
        ';
    }
                             
                              ?>
                              
                 </select>
                    </div>    
                      
             <input type="hidden" name="old_file" class="form-control" value="<?=$file_row['file_name']; ?>">
        
       
        <input type="hidden" name="old_size" class="form-control" value="<?=$file_row['file_size']; ?>">

                    <div class="form-group">
                        <input type="submit" name="update_file" value="تعديل الملف" class="btn-success btn-block">
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
  
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


</body>
</html>

