<?php include 'db_connect.php';
        
         session_start();
         if (!isset($_SESSION["login"])) {
         header("location: index.html");
         exit;
         }
         
         $empid = $_SESSION["empid"];
         
         if(isset($_FILES['upload'])) 
         { 
         $file_name = $_FILES['upload']['name']; 
         $file_type = $_FILES['upload']['type']; 
         $file_tmp_name = $_FILES['upload']['tmp_name']; 
         $file_size = $_FILES['upload']['size']; 
         
         $target_dir = "uploads/"; 
         
         if(move_uploaded_file($file_tmp_name,$target_dir.$file_name)) 
         { 

         $result=mysqli_query($conn,"select * from rdata where empid='$empid'");
         $row=mysqli_fetch_array($result); 
         $image=$row['Images'];  
         if(!empty($image)){
         unlink($image);
         } 
         
         
         
         $query = "UPDATE rdata SET Images='".$target_dir.$file_name."' WHERE empid='$empid'";
         
         if(mysqli_query($conn, $query)){
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Profile Photo Upadated Successfully');
         window.location.href='emp_profile.php';
         </script>");
         }
         
         else 
         { 
         echo "<p>A system error has been occured</p>".mysqli_error($conn); 
         } 
         } 
         else 
         { 
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Updated successfully');
            window.location.href='emp_profile.php';
            </script>");
         } 
         } 
         
         
        if (isset($_POST['update']))
         {
         $first_name =  $_REQUEST['FIRSTNAME'];
         
         $last_name = $_REQUEST['LASTNAME'];
         
         $email = $_REQUEST['EMAIL'];
         
         $address = $_REQUEST['ADDRESS'];
         
         $department = $_REQUEST['DEPARTMENT'];
         
         $query = " select email from rdata where email = '$email'and empid != '$empid'";
         $fire = mysqli_query($conn,$query);
         
         if (mysqli_num_rows($fire)>0) {
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Email id is already exist');
         history.back()
         </script>");
         }
         
         else {
         $query = "UPDATE rdata SET first_name='$first_name',last_name='$last_name',email='$email',address='$address',department='$department' WHERE empid='$empid'";
         
         if(mysqli_query($conn, $query)){
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Upadated Successfully');
         window.location.href='emp_profile.php';
         </script>");
         }
         else{
         echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
         
         }
         
         }
         }
         
         if (isset($_POST['submit']))
         {
         $oldpassword = $_REQUEST['OLDPASSWORD'];
         $password = $_REQUEST['PASSWORD'];
         
         $oldpassword = md5($oldpassword);
         $password=md5($password);
         
         $query = "select empid from rdata where empid = '$empid' and password = '$oldpassword'";
         $fire = mysqli_query($conn,$query);
         
         if (mysqli_num_rows($fire) === 1) {
         $query = "UPDATE rdata SET password='$password' WHERE empid='$empid'";
         
         if(mysqli_query($conn, $query)){
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Updated successfully');
         window.location.href='emp_profile.php';
         </script>");
         }
         
         else{
         echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
         
         }
         }
         else {
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Password is wrong');
         history.back()
         </script>");
         
         }
         }
         
         mysqli_close($conn);
         
         ?>