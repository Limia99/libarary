
<?php
session_start();
include('includes/config.php');
// error_reporting(0);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
      مكتبة الكلية الأردنية السودانية للعلوم والتكنولوجيا
    </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- LOGO HEADER END-->
<?php 
 include('includes/header.php');
 ?>
    <!-- MENU SECTION END-->
    <div class="cont6ent-wrapper">
        <div class="container-fluid pt-4">
                <div class="row" >
                  <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <div class="panel panel-default">
                          
                        <div class="panel-body">
                          
                       <form name="search_verify" method="post">
   <div class="input-group">
    <input type="text" class="form-control" id="search_word" name="search_word" placeholder="أبحث عن كتاب ..." required />
       <div class="input-group-append"> 
       <button name="submit" class="btn btn-success">
            <i class="fa fa-search search-icon"></i>
       </button>
  </div>
 </div>
</form>

                            </div>
                            </div>
                    </div>
                  
                </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    
    
                <div class="row container-fluid" >
                  
                       <?php
                        
             $category=$_GET['category'];
                        
         $sql="SELECT * FROM books WHERE book_cat='$category' Limit 8";
             $result=mysqli_query($conn,$sql);
             if(mysqli_num_rows($result)>0)
             {
               while($row=mysqli_fetch_assoc($result)){                       
                       ?>
                  
                  <div class="col-md-3 mb-3">
                    
                  <div class="card text-right">
                    
                    <img src="admin/book_images/<?= $row['book_image']; ?>" class="card-img-top card4y-img">
                 
                 
                  <div class="card-body">
                  <h3 class="">
                    <a href="view_pdf.php?id=<?= $row['book_id']; ?>" class="text-prinary text-right"><?= $row['book_title']; ?></a>
                    </h3>
                    
            <p class="h4"><?= $row['author']; ?></p>
                  
                  <h4><?= $row['book_cat']; ?></h4>
                  </div>
                  </div>
                 
                  </div>
                  
                    <?php } }
                    else
                    {
                      echo '
                      <div class="text-center h4 mx-auto">
                      <span class="">
                     لا توجد كتب في هذا التصنيف حالياً
                      </span>
                      </div>
                    ';
                    }
                    ?>
            
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

