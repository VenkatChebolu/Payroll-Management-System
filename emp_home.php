<?php include 'db_connect.php';
                
             session_start();
             $empid = $_SESSION["empid"];
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
    <title>Employee Home</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
</head>
<body>
<div class="header">
       <h1>Payroll Management System</h1>
    </div>
    
     <div class="container"></div>
    
       
    <div class="navi">
      <?php 
      if($empid==880980000)
      {
      echo "<button  class=active class=button Checked>Home</button>";
      echo "<a href=emp_list.php><button class=button>Employee List</button></a>";
      echo "<a href=class.php><button class=button>Class</button></a>";
      echo "<a href=salary.php><button class=button>Salary</button></a>";
      echo "<a href=salary_report.php><button class=button>Salary Report</button></a>";
      echo "<a href=logout.php><button class=button>Logout</button></a>";
  }
  else
  {
  echo "<button>Home</button>";
  echo "<a href=emp_profile.php><button>My Profile</button></a>";
  echo "<a href=salary_report.php><button>Salary Report</button></a>";
  echo "<a href=logout.php><button>Logout</button></a>";
  }
  ?>
    </div>
</div>
    <div class="content">
     <p>
       </br></br></br>
            <?php  if (isset($_SESSION["empid"])) {
             $empid = $_SESSION["empid"];

            $query = "select * from rdata where empid='$empid'";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_array($result)) 
            { 
            if($empid==880980000)
            {
            echo "<b style=padding-left:10px; >"."<h2>"."Welcome ".$row['first_name']."</br>"; 
            }
            
            else {
            echo "<h2>"."<div class=details >"."<div class=nm >"."welcome ",$row['first_name']; 
            echo ' ';
            echo $row['last_name']. "</br>"; 
            echo $row['empid']."</br>"."</div>"."</div>";
            }

           
            }
            }
            ?>
  
        </p>  
         
   </div>
</body>
</html>