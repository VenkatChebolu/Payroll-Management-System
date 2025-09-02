<?php include 'db_connect.php';
                
                session_start();
                if (!isset($_SESSION["login"])) {
                header("location: index.html");
                exit;
                }
       ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css" > 
    <style>
        
      
      
     
    
      .content{
      padding-left: 15%;
      padding-top: 2px;
      display: flex;
      align-items: left;
      flex-direction: column;
      
      }
    
     .logout{
     right: 6px;
    top: 44px;
    width: 60px;
    height: 26px;
    position: absolute;
    border-radius: 10px;
    border: 1px solid gray;
    
     }
  .nm{
 
    font-family: ui-monospace;
    font-size: 30px;
    padding-left: 20px;
}
 table{
  position: absolute;
    left: 22%;
    height: 75%;
    width: 69%;
    border: 1px solid transparent;
    top: 22%;
    padding-top: 212px;
    padding-bottom: 46px;
    border-radius: 5px;
    box-shadow: 0px 0px 20px black;
    
   
    
}

td{
  padding-right: 0px;
  padding-left:150px

}
.update_pss_button{
  height: 35px;
    width: 120px;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: #17a1bb;
    margin: 10px;
    padding: 5px;
    color: #ffff;
    position: fixed;
    top: 90%;
    left: 49%;
}
img {
  
    float: left;
    width:  150px;
    height: 150px;
    object-fit: cover;
    border-radius: 100%;
    position: relative;
    top: 80px;
    left: 400px;
   border: 5px solid white;
  
}


.imageup{
  width:180px;
  height: 180px;
  border-radius: 100%;
}


        </style>
</head>
<body>
<div class="header">
       <h1>Payroll Management System</h1>
    </div>
    
     <div class="container"></div>
    
       
    <div class="navi">
  
       <a href=emp_home.php><button location.herf=emp_home.php>Home</button></a>
       <button>My Profile</button>
       <a href=salary_report.php><button>Salary Report</button></a>
       <a href=logout.php><button>Logout</button></a>
       
    </div>
</div>
    <div class="content">
     <p>
       
            <?php  if (isset($_SESSION["empid"])) {
            $empid = $_SESSION["empid"];

            $query = "select * from rdata where empid='$empid'";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_array($result)) 
            { 
             $image=$row['Images'];
            
             echo "<div class=imageup>";
             echo "<form action=photo.php  method=post enctype=multipart/form-data>" ;
             
             if(empty($image)){    
             echo "<img src='src/Avatar.jpg' height=150 width=150 />";
             } 
             else{
             echo "<img src='$image'; height=100 width=150 />";
             }
             echo "
             </form>
             </div> ";
            
            
            
             echo "<table>";
            echo "<tr><td><b>"."Name "."</b></td><td>".$row['first_name']; 
            echo ' ';
            echo $row['last_name']."</br>"."</td></tr>"; 
            echo "<tr><td><b>"."Empid "."</b></td><td>".$row['empid']."</br>"."</td></tr>";
            echo "<tr><td><b>"."Email "."</b></td><td>".$row['email']."</br>"."</td></tr>";
            echo "<tr><td><b>"."Gender "."</b></td><td>".$row['gender']."</br>"."</td></tr>"; 
            echo "<tr><td><b>"."Department "."</b></td><td>".$row['department']."</br>"."</td></tr>";
            echo "<tr><td><b>"."Address "."</b></td><td>".$row['address']."</br>"."</td></tr>";
            echo "</table>";

            echo "<br>"."<a href=update.php><input class=update_pss_button details type=submit id=submit name=submit value=Update Password ></a>";
            
            
            }   
            }
            ?>
  
        </p>  
         
   </div>
</body>
</html>