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
    <title>Employee List</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
    <link rel="stylesheet" type="text/css" href="table.css" >
    <style>
   /* th, td {
    padding: 10px;
    text-align: center;
    } */
    </style>
</head>
<body>
<div class="header">
       <h1>Payroll Management System</h1>
    </div>
    
     <div class="container"></div>
    
       
    <div class="navi">
      
      <a href=emp_home.php><button>Home</button></a>
      <button>Employee List</button>
      <a href=class.php><button>Class</button></a>
      <a href=salary.php><button>Salary</button></a>
      <a href=salary_report.php><button>Salary Report</button></a>
      <a href=logout.php><button>Logout</button></a>

    </div>
</div>
    <div class="content">
     <p>
  </br></br></br>
      <h2 style=padding-left:10px;>Employees list</h2></br>
            <?php  if (isset($_SESSION["empid"])) {
            $empid = $_SESSION["empid"];
           $a = 1;
           $sql = "SELECT first_name, last_name, gender, empid, department,address FROM rdata where empid!=880980000";
           $result = $conn->query($sql);
           
           if ($result->num_rows > 0) {
           echo "<table class=fl-table><thead><tr><th>Sl.No</th><th>Name</th><th>Gender</th><th>Empid</th><th>Department</th><th>Address</th></tr> </thead>";
           while($row = $result->fetch_assoc()) {
           echo "<tbody><tr><td>" . $a . "</td><td>" . $row["first_name"]." ".$row["last_name"] . "</td><td>" . $row["gender"]. "</td><td>" . $row["empid"]. "</td><td>" . $row["department"]. "</td><td>" . $row["address"]. "</td></tr></tbody>";
           $a+=1;
           }
           echo "</table>";
           } else {
           echo "0 results";
           }
           
            
            }
            ?>
  
        </p>  
         
   </div>
</body>
</html>