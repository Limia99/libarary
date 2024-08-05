
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
   المكتبة الرقمية السحابية
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
    
    <div class="container-fluid mt-3">
    <div id="myCarousel" class="carousel carousel-dark slide mb-2" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators text-center">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/1.jpg" class="container-images" alt="">
      <div class="carousel-caption">
        <h3>
            مرحبا بك في
        </h3>
        <p>
            السحابة الرقمية للكلية الأردنية السودانية للعلوم والتكنولوجيا
        </p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/2.jpg" class="container-images" alt="">
      <div class="carousel-caption">
        <h3>
          مساحتك الخاصة
        </h3>
        <p>
        لحفظ ملفاتك بأمان 
        </p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/3.jpg" class="container-images"alt="">
      <div class="carousel-caption">
        <h3>
            مساحة تخزينية
        </h3>
        <p>
            غير محدودة
        </p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  
  <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
  
</div>
    </div>



    <div class="container-fluid">
        <div class="main-banner">
      
          <div class="row">
            <div class="col-lg-6">
              <div class="right-image">
                <img src="assets/img/about-dec-v1.png" alt="">
              </div>
            </div>
          </div>
          
            <div class="col-lg-6 align-self-center">
              <div class="left-content">
                <div class="row">
                  <div class="col-lg-12">
                    <h3>
                        إحصل على مساحتك التخزينية الخاصة بك الآن
                    </h3>
                    <h2>
                        نحن نقدم لك مساحة تخزينية غير محدودة
                        </h2>
                    <p>
                        عبارة عن موقع سحابي رقمي ، يسمح للمستخدمين بتخزين ملفاتهم الخاصة وحفظها ؛ مع إمكانية مشاركتها مع بقية مستخدمين الموقع بكل سهولة ، ويتيح للمستخدمين ، الوصول لملفاتهم الخاصة ، في اي وقت ؛ ومن اي مكان ، عن طريق اي جهاز متصل بشبكة الأنترتت .
                        </p>
                  </div>
                  <div class="col-lg-12">
                    <div class="">
                      <a href="index.php" class="start">إحصل على مساحتك الخاصة الآن</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    </div>
  </div>


<section>
    <div class="container mt-3">
        <div class="row">
          
          
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
 
	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM uploaded_files WHERE is_shared='1'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
 
    $result = mysqli_query($conn,"SELECT * FROM uploaded_files WHERE is_shared='1' LIMIT $offset, $total_records_per_page");
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
                        
                        <span class="">
           <a class="btn-rounded" href="<? echo $row['file_loc']; ?>">
                 تنزيل الملف
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

