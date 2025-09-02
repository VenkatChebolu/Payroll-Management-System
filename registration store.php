<?php include 'db_connect.php';


        $first_name =  $_REQUEST['FIRSTNAME'];

        $last_name = $_REQUEST['LASTNAME'];
        
        $empid = $_REQUEST['EMPID'];
        
        $email = $_REQUEST['EMAIL'];

        $gender =  $_REQUEST['GENDER'];

        $address = $_REQUEST['ADDRESS'];
        
        $department = $_REQUEST['DEPARTMENT'];
       
        $password = $_REQUEST['PASSWORD']; 
        
        $password=md5($password);
        
        $query = " select email from rdata where email = '$email'";
        $fire = mysqli_query($conn,$query);
  
        if (mysqli_num_rows($fire)>0) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Email id is already exist');
        history.back()
        </script>");
        }
        else
        {
        
        $query = " select empid from rdata where empid = '$empid'";
        $fire = mysqli_query($conn,$query);
        if ($empid > 880980000 and $empid <880980101 ){
        if (mysqli_num_rows($fire)>0) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Empid is already exist');
        history.back()
        </script>");
        }
        else
        {

        $sql = "INSERT INTO rdata (first_name,last_name,empid,email,gender,address,department,password)  VALUES ('$first_name', 

            '$last_name','$empid','$email','$gender','$address','$department','$password')";

        if(mysqli_query($conn, $sql)){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Account created successfully');
        window.location.href='index.html';
        </script>");
        }
        
        else{
        
        echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
        
        }
        }
        }
        else{
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Invalid Empid');
        history.back()
        </script>");
        }
        }

        mysqli_close($conn);

        ?>
    
    