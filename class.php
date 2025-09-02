<?php include 'db_connect.php';
                
           session_start();
           if (!isset($_SESSION["login"])) {
           header("location: index.html");
           exit;
           }
           
           if (isset($_SESSION["empid"])) {
           $empid = $_SESSION["empid"];
           }
       ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
    <link rel="stylesheet" type="text/css" href="table.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    
    th, td {
    padding: 0px;
    text-align: center;
    }
    .input-field{
      border: 1px solid rgb(211 211 211);
    height: 36px;
    width: 100%;
    border-radius: 2px;
    margin: 10px;
    padding: 5px;
    font-size: 19px;
}
.div1{
    position: fixed;
    left: 17%;
    top: 22.5vh;
    width: 39%;

    }
    .div2{
        
        position: fixed;
    right: 3%;
    top: 22.5vh;
    width: 39%;
}
.update_button{
        height: 34px;
        width: 90px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: #17a1bb;
        margin: 10px;
        padding: 5px;
        color: #fff;
}
.update_button1{
        height: 34px;
        width: 90px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: #17a1bb;
        margin: 10px;
        padding: 5px;
        color: #fff;
        position: fixed;
    top: 548px;
    left: 683px;

    }
    </style>
    
    <script>
    function add() {
    var bs = document.getElementById("bs");
    var hra = document.getElementById("hra");
    var ta = document.getElementById("ta");
    var ma = document.getElementById("ma");
    var tds = document.getElementById("tds");
    var pt = document.getElementById("pt");
    var pf = document.getElementById("pf");
    
    var BS = parseFloat(bs.value);
    if (isNaN(BS)) BS = 0;
    var HRA = parseFloat(hra.value);
    if (isNaN(HRA)) HRA = 0;
    var TA = parseFloat(ta.value);
    if (isNaN(TA)) TA = 0;
    var MA = parseFloat(ma.value);
    if (isNaN(MA)) MA = 0;
    var TDS = parseFloat(tds.value);
    if (isNaN(TDS)) TDS = 0;
    var PT = parseFloat(pt.value);
    if (isNaN(PT)) PT = 0;
    var PF = parseFloat(pf.value);
    if (isNaN(PF)) PF = 0;
    var gross = BS + HRA +TA + MA;
    var net= gross - (TDS + PT + PF);
    document.getElementById("gs").value = gross;
    document.getElementById("ns").value = net;
    
    }
    </script>
</head>

<body>
<div class="header">
       <h1>Payroll Management System</h1>
    </div>
    
     <div class="container"></div>
    
       <div class="navi">
       
       <a href=emp_home.php><button>Home</button></a>
       <a href=emp_list.php><button>Employee List</button></a>
       <a href=class.php><button>Class</button></a>
       <a href=salary.php><button>Salary</button></a>
       <a href=salary_report.php><button>Salary Report</button></a>
       <a href=logout.php><button>Logout</button></a>
       </div>
    
</div>
    <div class="content">
     <p>
       </br></br></br>
            <?php

            if (isset($_POST['table']))
            {
            echo "<form action=class.php method=post>";
            echo "<div class=div1>";
            echo "<label>"."class:"."</label>"."<input class=input-field type=text name=class id=class required /><br/>"; 
            echo "<b>Allowances</b><br><br>";
            echo "<label>"."House Rent Allowance:"."</label>"."<input class=input-field type=number name=hra id=hra oninput=add() required />"."<br/>"; 
            echo "<label>"."Travel Allowance:"."</label>"."<input class=input-field type=number name=ta id=ta oninput=add() required />"."<br/>"; 
            echo "<label>"."Medical Allowance:"."</label>"."<input class=input-field type=number name=ma id=ma oninput=add() required />"."<br/>";  
            echo "<label>"."Gross Salary:"."</label>"."<input class=input-field type=number name=gs id=gs readonly/>"."<br/></div>";  
            echo "<div class=div2>";
            echo "<label>"."Basic Salary:"."</label>"."<input class=input-field type=number name=bs id=bs oninput=add() required />"."<br/>"; 
            echo "<b>Deductions</b><br><br>";
            echo "<label>"."Tax Deduction At Source:"."</label>"."<input class=input-field type=number name=tds id=tds oninput=add() required />"."<br/>";  
            echo "<label>"."Professional tax:"."</label>"."<input class=input-field type=number name=pt id=pt oninput=add() required />"."<br/>";  
            echo "<label>"."Employee Provident Fund:"."</label>"."<input class=input-field type=number name=pf id=pf oninput=add() required />"."<br/>";
            echo "<label>"."Net Salary:"."</label>"."<input class=input-field type=number name=ns id=ns readonly/>"."<br/></div>"; 
            echo "<br><br>";
            echo "<input  class=update_button1 type=submit id=update name=update value=Update >";
            echo "<br><br>";
            echo "</form>";
            }

            if (!isset($_POST['table']))
            {
            $sql = "SELECT * FROM Salary_Class ORDER BY BS DESC ";
            $result = mysqli_query($conn, $sql);
            echo "<form action=class.php method=post>";
            echo "<table class=fl-table><thead>
            <tr><th >Class</th><th>Basic Salary</th><th>House Rent Allowance</th><th>Travel Allowance</th><th>Medical Allowance</th><th>T.D.S</th><th>Professional Tax</th><th>Provident Fund</th><th>Gross Salary</th><th>Net Salary</th><th>Delete class</th></tr></thead>";
            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
            echo "<tbody><tr><td>".$row["Class"]."</td><td>".$row["BS"]."</td><td>".$row["HRA"]."</td><td>".$row["TA"]."</td><td>".$row["MA"]."</td><td>".$row["TDS"]."</td><td>".$row["PT"]."</td><td>".$row["PF"]."</td><td>".$row["GS"]."</td><td>".$row["NS"]."</td><td><button type=submit name=btn id=btn class=update_button value='$row[Class]' style='background-color: red;'>Delete</button></td></tr>";
            }
            }
            echo "</tbody></table>";
            echo "<input type=submit class=update_button id=table name=table value='Create Class'>";
            echo "</form>";
            }
            
            ?>
            
            <?php
            
            if (isset($_POST['update']))
            {
            $class =  $_REQUEST['class'];
            
            $bs = $_REQUEST['bs'];
            
            $hra = $_REQUEST['hra'];
            
            $ta = $_REQUEST['ta'];
            
            $ma =  $_REQUEST['ma'];
            
            $tds = $_REQUEST['tds'];
            
            $pt = $_REQUEST['pt'];
            
            $pf = $_REQUEST['pf'];
            
            $gs = $_REQUEST['gs'];
            
            $ns = $_REQUEST['ns'];
            
            $query = "select Class from Salary_Class where Class = '$class'";
            $fire = mysqli_query($conn,$query);
            if (mysqli_num_rows($fire)>0) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('$class is already exist');
            window.location.href='class.php';
            </script>");
            }
            else
            {
            
            $sql = "INSERT INTO Salary_Class VALUES ('$class', 
            
            '$bs','$hra','$ta','$ma','$tds','$pt','$pf','$gs','$ns') ";
            
            if(mysqli_query($conn, $sql)){
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Created Successfully');
            window.location.href='class.php';
            </script>");
            }
            
            else{
            
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
            
            }
            }
            }
            
            ?>
            
            <?php
            
            if(isset($_POST['btn']))
            {
            $id =  $_REQUEST['btn'];
            $sql = "DELETE FROM Salary_Class WHERE Class='$id'";
            if(mysqli_query($conn,$sql))
            {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Deleted Successfully');
            window.location.href='class.php';
            </script>");
            }
            else
            {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Not Deleted');
            window.location.href='class.php';
            </script>");
            }
            }
            ?>
            
            
        </p>  
         
   </div>
   
   
</body>
</html>