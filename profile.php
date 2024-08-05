<?php
session_start();
include('includes/config.php');
//:error_reporting(0);
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>الصفحة الشخصية</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
    
    <!-- MENU SECTION END-->
    
<div class="container bootdey flex-grow-1 container-p-y">

            <div class="row align-items-center py-3 mb-3">
              <div class="col-md-12">
                <a href="edit_profile.php?uid=<?= $_SESSION['user_id']; ?>" class="btn btn-primary btn-block">
                    تعديل الصفحة الشخصية
                </a>
              </div>
            </div>


            <div class="card">
              
              <hr class="border-light m-0">
              <div class="card-body">

                <table class="table user-view-table m-0">
                  <tbody>
                      
            <?php
             $uid=$_GET['uid'];

      $sql="SELECT * FROM users WHERE user_id='$uid'";
             $result=mysqli_query($conn,$sql);
             if(mysqli_num_rows($result)>0)
             {
             while($row=mysqli_fetch_assoc($result))
             {                  
                 
                       ?>
                       
                    <tr>
                    
                      <td> <?= $row['fullname']; ?></td>
                        <td class="text-right">الإسم كامل</td>
                    </tr>
                    <tr>
                
                      <td> <?= $row['phonenumber']; ?></td>
                            <td class="text-right">رقم الهاتف</td>
                    </tr>
                    <tr>
               
                    <td> <?= $row['address']; ?></td>
                           <td class="text-right">العنوان</td>
                    </tr>
                    <tr>
      
                      <td> <?= $row['email']; ?></td>
                     <td class="text-right">البريد الإلكتروني</td>
                    </tr>
                    <tr>
                 
                      <?php
                      if($row['gender']=='male')
                      {
                          echo '
                      <td>ذكر</td>
                      ';
                      }
                   else if($row['gender']=='female')
                      {
                          echo '
                      <td>أنثى</td>
                      ';
                      }
                      ?>
                      
                           <td class="text-right">النوع</td>
                      
                    </tr>
                    <tr>
              
                    <td> <?= $row['acad_no']; ?></td>
                            <td class="text-right">الرقم الأكاديمي</td>
                    </tr>
                    <tr>
            
                      <td> 
                            <?php
          $select_dept="SELECT * FROM department WHERE dept_no='".$row['dept']."'";

     $result_dept=mysqli_query($conn,$select_dept);
         
while($featch_dept=mysqli_fetch_assoc($result_dept))
            {     
         
                           echo $featch_dept['dept_name'];
                             ;
                               }  ?>
                      </td>
                                <td class="text-right">القسم العلمي</td>
                    </tr>
                    <tr>
               
                      <td> <?= $row['username']; ?></td>
                             <td class="text-right">إسم المستخدم</td>
                    </tr>
                    
                      <?php }} ?>
                    
                  </tbody>
                </table>


              </div>
            </div>

          </div>

    
  <?php include('includes/footer.php');?>
  
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


</body>
</html>

