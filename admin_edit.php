<?php
include("connect.php"); 
?>
<?php
error_reporting(0);
$conn=mysqli_connect('localhost','root','','sms2')or die("Connection error");
?>
<?php
session_start();
if (!isset($_SESSION['username']) || ($_SESSION['password'] == '')) {
    header("location:index.php");
    exit();
    
}
?>
<?php
$id = $_GET['id'];
    $select = "SELECT * FROM 
            admin 
             WHERE admin_id= $id";
             
             $result = mysqli_fetch_array(mysqli_query($conn,$select));
    $qry=mysqli_query($conn,$select);
        if($qry)
        {
        while($rec = mysqli_fetch_array($qry)){
        $fname = "$rec[fname]";
        $lname = "$rec[lname]";
        $uname = "$rec[username]";
        $email = "$rec[email]";
        }
        }
        //diri na mah submit ang data. lantawun nia kung mai onud ang every txtbox
    if (isset($_POST['update'])){
        if (($_POST['fname'] == '')or($_POST['lname'] == '')or($_POST['username'] == '')or ($_POST['email'] == '')or ($_POST['password'] == ''))
            {
            echo "You Must Fill All";
            }
    else{ //dri namn is ang mga "name=tenant_id" nga ara sa mga input type.
        $f = addslashes("$_POST[fname]");
        $l = addslashes("$_POST[lname]");
        $un = addslashes("$_POST[username]");
        $email = addslashes("$_POST[email]");
        $pw = addslashes("$_POST[password]");
        //dri nah mah edit xng data
        mysqli_query($conn,"UPDATE admin SET fname ='$f', lname ='$l',
        username ='$un',email ='$email',password ='$pw' WHERE admin_id = '$id'")or die('Connection error'); 
            
}
?>
<script>
alert('Updated Successfully');
window.location = "manage_account.php";
</script>
<?php
}?>
<?php
SESSION_START();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>school management system</title>
    <link rel="shortcut icon" href="assets/img/title.gif" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/loader.css" rel="stylesheet" />
    <script src="assets/js/canvasjs.min.js"></script>
    <!--*****jquery -3.2.1.js file supports the use of dropdown***-->
    <script src="assets/js/jquery-3.2.1.js"></script>


</head>
<!--<style type="text/css">
    body{
        margin-right: 10px;
        margin-left: 10px;
        }
</style>

-->

<body >
<!--end of heading section--> 
<ul class="nav navbar-right top-nav">                        
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
  <?php
        //Check to see if the user is logged in.if not redirect user to the loging page.
        
        if(isset($_SESSION['fname']))
        { 
        echo   "Current user: ".$_SESSION['fname']. "&nbsp;".$_SESSION['lname']. " ";
        }else{
          echo "<script type='text/javascript'>
                    alert( 'You must Log in to use the system');
                    </script>";
                echo "<script>
                    window.location = 'index.php'
                  </script>";
        }
        ?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
      <li><a href="manage_account.php"><i class="fa fa-users fa-lg"></i>&nbsp;View User</a></li>
      <li><a href="register_form.php"><i class="fa fa-users fa-lg"></i>&nbsp;Add New User</a></li>
      <li class="divider"></li>
      <li><a href="session_logout.php"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a></li>
  </ul>
</div>
  </ul>
<!--************************************************-->
<div style="
    font-family:Nyala, Arial;
    text-align: left; 
    background-color: #526F35;
    padding: 20px; 
    color:white;
    width: 100%;
    height: 150px;">
    <!--This codes to load the image loader--> 
    <div id="loading">
            <img id="loading-image" src="assets/img/loader.gif" alt="Loading..." />
    </div>
<!--this is the heading section-->   
    <h2>
            <?php
            $sql="SELECT * FROM companyinfo";
            $result=mysqli_query($db,$sql) or die("error getting data");
            $num_rows=mysqli_num_rows($result);
             while($row=mysqli_fetch_array($result))
                    {
                    echo '<image style="height:82px; width:82px;" src="data:image;base64,'. $row['clogo'].' "> ';
                    $cname = $row['cname'];
                     $cemail = $row['cemail'];
                      $ccontact = $row['ccontact'];
                       $clocation = $row['clocation'];
                    }?>
                    <?php 
                    echo $cname;
                    ?>

    <div style="float:right; font-size:20px;text-align:right;">
    
    <img src="assets/img/mail2.png">Email: <?php  echo $cemail; ?><br>
    <img src="assets/img/call1.png">Contact:<?php  echo $ccontact; ?><br>
    <img src="assets/img/location.png">Location: <?php  echo $clocation; ?>
    
    </div> 
   </h2>
</div>
    <div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="homepage.php" >Administration <img src="assets/img/details.png"></a></li>
            <li ><a href="students.php" >Students <img src="assets/img/student48.png"></a></li>
            <li><a href="staff.php">Staff Member <img src="assets/img/staff48.png"></a></li>
            <li><a href="course.php" >Courses <img src="assets/img/course.png"></a></li>
            <li><a href="departments.php" >Departments <img src="assets/img/department.png"></a></li>
            <li><a href="markstep1.php" >Exams <img src="assets/img/update.png"></a></li>
            <li><a href="hostel.php" >Hostel <img src="assets/img/details.png"></a></li>
            <li><a href="sms.php">SMS <img src="assets/img/details.png"></a></li>
            <!--<li><a href="tab-8" role="tab" data-toggle="tab">Hostel <img src="assets/img/details.png"></a></li>
            <li><a href="tab-7" role="tab" data-toggle="tab">Parents <img src="assets/img/details.png"></a></li>-->
            
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                
                <p>
                    <div class="table-responsive"  >
<!--****************************************************************************-->
                        
<div class="container-fluid">
       <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Edit User</div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table">
                            <!--------------------form------------------->
                                <form method="post">
                                    <tbody>
                                        <tr>
                                        <center>
                                         
                                      <div class="form-group input-group">
                                      <label class="col-sm-2 control-label">Firstname</label>
                                      <input type="text"  class="form-control" id="fname" name="fname" value="<?php echo $fname?>" placeholder="Firstname"required autofocus>
                                      </div>
                                      
                                        <div class="form-group input-group">
                                        <label class="col-sm-2 control-label">Lastname</label>
                                        <input type="text"  class="form-control" id="lname" name="lname" value="<?php echo $lname?>" placeholder="Lastname"required>
                                       </div>
                                       
                                       <div class="form-group input-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <input type="text"  class="form-control" id="username" name="username" value="<?php echo $uname?>" placeholder="Username"required>
                                       </div>

                                       <div class="form-group input-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <input type="text"  class="form-control" id="email" name="email" value="<?php echo $email?>" placeholder="Username"required>
                                       </div>
                                       
                                       <div class="form-group input-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <input type="password"  class="form-control" id="password" name="password" placeholder="Password"required>
                                       </div>
                                       
                                       
                               
                                            <div class="col-md-11">
                                                 <button name="update" class="btn btn-success">Update</button>
                                                 <a button id="cancel" name="cancel" class="btn btn-danger" href="manage_account.php" >Cancel</button></a>
                                             </div>
                                             <br>
                                             <br>
                                             <br>
                                             <br>
                                   
                                    </tr>
                                    </tbody>
                                    </div>
                                    </center>
                                 </form>      
                                    
                            </div>                          
                        </div>                     
                    </div>                   
                </div>
            </div>
        </div>  

  <!--*********************************************************************************-->  
    <div class="col-md-12" style="background-color:#526F35; position:fixed;bottom:0px;">
        <p class="text-center text-danger" style="color:white;" >@J. Muthama Tel: +254729734768</p>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/affix.js"></script>
    <script src="assets/js/alert.js"></script>
    <script src="assets/js/alert1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/bootstrap-wysihtml5.js"></script>
    <script src="assets/js/button.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/chosen.jquery.min.js"></script>
    <script src="assets/js/ckeditor.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/color.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/DT_bootstrap.js"></script>
    <script src="assets/js/dynamic.js"></script>
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.dialog.js"></script>
    <script src="assets/js/jquery.hoverdir.js"></script>
    <script src="assets/js/jquery.jgrowl.js"></script>
    <script src="assets/js/jquery.knob.js"></script>
    <script src="assets/js/jquery.uniform.min.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-1.11.0.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-ui-1.10.3.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="assets/js/myjquery.js"></script>
    <script src="assets/js/myjquery1.js"></script>
    <script src="assets/js/npm.js"></script>
    <script src="assets/js/popover.js"></script>
    <script src="assets/js/profile.js"></script>
    <script src="assets/js/raphael-min.js"></script>
    <script src="assets/js/sb-admin-2.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/scrollspy.js"></script>
    <script src="assets/js/tab.js"></script>
    <script src="assets/js/tooltip.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/wysihtml5-0.3.0.js"></script>
    <script src="assets/js/slideshow.js"></script>

    <script language="javascript" type="text/javascript">
     $(window).load(function()
      {
        $('#loading').hide();
      });
</script>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
</body>

</html>