
<?php
session_start();
include('includes/config.php');
//error_reporting(0);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
   ملفاتي
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
    
    
    
<section>
    <div class="container mt-3">
        <div class="row">
          
              <div class="col-md-12 mb-2">
                <a href="add_file.php?uid=<?= $_SESSION['user_id']; ?>" class="btn btn-primary btn-block">
                     إضافة ملف 
                </a>
              </div>
          
                         <?php
            $uid=$_SESSION['user_id'];
             $targetDir = "admin/uploaded_files/"; 
            
            
      if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }
 
	$total_records_per_page = 6;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 
 
	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM uploaded_files WHERE user_id='$uid'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
 
    $result = mysqli_query($conn,"SELECT * FROM uploaded_files WHERE user_id='$uid' LIMIT $offset, $total_records_per_page");
    while($row = mysqli_fetch_array($result))
    {
                       ?>
          
            <div class="col-sm-4 col-lg-3">
                <div class="text-center mt-3">
                    
            <i class="file-icon fa fa-file"></i>
                    
                    <h4 class="h5 mb-2">
                      <?= $row['file_title']; ?>
                      </h4>
                      
                    <div class="product-rating mb-2">
                        
                        <span class="">
                       حجم الملف :
                        </span>
                        
                        <span class="text-info">
                             <?= $row['file_size']; ?>
                        </span>
                        <span class="text-info">
                        ميغابايت
                        </span>
                    </div>
                    <div class="product-rating mb-2">
                        
                        <span class="">
                       تاريخ رفع الملف :
                        </span>
                        <span class="text-info">
                             <?= $row['uploaded_date']; ?>
                        </span>
                    </div>
                    
                    <div class="product-rating mb-2">
                    
                               <span class="text-info">
               <a class="btn btn-danger" href="delete_file.php?file_id=<?= $row['file_id']; ?>&old_file_name=<?= $row['file_name']; ?>">
                   حذف
             </a>
                        </span>
                        
                        <span class="">
             <a class="btn btn-primary" href="edit_file.php?file_id=<?= $row['file_id']; ?>">
                 تعديل
             </a>
                        </span>
                        
                    </div>
                    
                </div>
            </div>
            
               <?php }  ?>
            
             </div>

   <div class="row">
            <div class="pagination justify-content-center mx-auto">
        <span class="page-item page-item disabled">
        صفحة
    <?php echo $page_no." من ".$total_no_of_pages; ?>
            </span>
        </div>
 
<ul class="pagination justify-content-center mx-auto">
    
    
     

	<li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'"; } ?> >

	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?> class='page-link'>
	    التالي
	    <i class='fa fa-angle-left'></i>
	    </a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'>
		<a href='?page_no=$total_no_of_pages' class='page-link'>
		النهاية
		<i class='fa fa-angle-double-left'></i>
		</a></li>";
		} ?>
    
     
    
    
       
       
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
		echo "<li><a class='page-link'>...</a></li>";
		echo "<li><a href='?page_no=$second_last' class='page-link'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>$total_no_of_pages</a></li>";
		}
 
	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item'><a class='page-link'>...</a></li>";
	   echo "<li class='page-item'><a href='?page_no=$second_last' class='page-link'>$second_last</a></li>";
	   echo "<li class='page-item'><a href='?page_no=$total_no_of_pages' class='page-link'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item'><a href='?page_no=1' class='page-link'>1</a></li>";
		echo "<li class='page-item'><a href='?page_no=2' class='page-link'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
 
        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
    
    <?php if($page_no >= $total_no_of_pages){
		echo "<li class='page-item'>
		<a href='?page_no=1' class='page-link'>
		<i class='fa fa-angle-double-right'></i>
		البداية </a></li>";
		} ?>
    
	<li <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?> >
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?> class="page-link">
	    <i class='fa fa-angle-right'></i>
	    السابق
	    </a>
	</li>
        
		
</ul>
 
 </div>
 


            
        </div>
    
</section>
    
    
    
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>

