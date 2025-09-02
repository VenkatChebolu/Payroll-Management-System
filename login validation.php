<?php include 'db_connect.php';
        
        $empid = $_REQUEST['EMPID'];
        
        $password = $_REQUEST['PASSWORD'];
        
        $password = md5($password);
        
        $query = "select empid from rdata where empid = '$empid' and password = '$password'";
        $fire = mysqli_query($conn,$query);
        
        if (mysqli_num_rows($fire) === 1) {
        session_start(); 	
        $_SESSION["empid"] = $empid;
        $_SESSION["login"] = "true";
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Login successful');
        window.location.href='emp_home.php';
        </script>");
        }
        else
        {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Username or Password is not correct');
        history.back()
        </script>");
   
        }
       ?>
       
       </body>
       </html>
      
      
      