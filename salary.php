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
    <title>Salary</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
    <style>
        .div1{
            display: flex;
    flex-direction: row;
    align-items: baseline;
    justify-content: space-between;


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
        position: absolute;
        top: 363px;
        right: 527px;
    }
    .input-field1{
      border: 1px solid rgb(211 211 211);
    height: 30px;
    width: 20%;
    border-radius: 2px;
    margin: 10px;
    padding: 5px;
    font-size: 19px;
}
.input-field{
      border: 1px solid rgb(211 211 211);
    height: 30px;
    width: 41%;
    border-radius: 2px;
    margin: 10px;
    padding: 5px;
    font-size: 19px;
}
label{
    padding: 10px;
}
.s1{
   position: relative;
   top: 1px;
   left: 1px;
}
.s2{
    position: relative;
    top: -136px;
    left: 521px;
}
.s3{
   position: relative;
   top: -172px;
   left: 1px;
   height: 300px;
}
.s4{
    position: relative;
    top: -344px;
    left: 521px;
}
form{
    overflow: hidden;
    height: 90%;
}
.navi{
    height:45em;
        position: absolute;
   }
    </style>
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
      echo "<a href=emp_home.php><button>Home</button></a>";
      echo "<a href=emp_list.php><button>Employee List</button></a>";
      echo "<a href=class.php><button>Class</button></a>";
      echo "<button>Salary</button>";
      echo "<a href=salary_report.php><button>Salary Report</button></a>";
      echo "<a href=logout.php><button>Logout</button></a>";
  }
  else
  {
  echo "<a href=emp_home.php><button>Home</button></a>";
  echo "<a href=emp_profile.php><button>My Profile</button></a>";
  echo " <button>Salary</button>";
  echo "<a href=logout.php><button>Logout</button></a>";
  }
  ?>
    </div>
</div>
    <div class="content">
     <p>
      
            
            <?php
            
            echo "<form action=salary.php method=post>";
            $query = "select * from Salary_Class ORDER BY BS DESC";
            $result=mysqli_query($conn,$query);
            echo "<div class=div1 >";
            echo "<input type=text class=input-field1 placeholder='Enter Id' name=id id=id required />";
            echo "<label>"."month:"."<br/>"."</label><input type='text' class=input-field1 id='month' name='month' value=".date('F')." readonly>";
            echo "<label>"."year:"."<br/>"."</label><input type='text' class=input-field1 id='year' name='year' value=".date('Y')." readonly>";
            echo "<label>"."Class:"."<br/>"."</label><select name=class class=input-field1 id=class required />";
            echo "<option value='' selected disabled>Select Class</option>";
            echo "</div>";
            while($row=mysqli_fetch_array($result)) 
            { 
            echo "<option value='$row[Class]'>$row[Class]</option>";
            
            }
          
            echo "<input type=submit class=update_button name=submit id=submit value=submit><br><br>";
            echo "</div>";
            echo "</form>";
            ?>
  
        </p>  
         
         <?php
         echo "<form action=salary.php method=post>";
         if (isset($_POST['submit']))
         {
         $id = $_REQUEST['id'];
         $class = $_REQUEST['class'];
         $month = $_REQUEST['month'];
         $year = $_REQUEST['year'];
         
         $query1="select empid from Salary where empid = '$id' and month = '$month'";
         $result1=mysqli_query($conn,$query1);
         if (mysqli_num_rows($result1)>0) 
         {
         echo "Payment Is Already Generated";
         }
         else
         {
         $query = "select * from rdata where empid='$id'";
         $result=mysqli_query($conn,$query);
         if (mysqli_num_rows($result)>0)
         {
         $row=mysqli_fetch_array($result);

    
         echo "<div class=s1><label>"."Name "."</label><br><input class=input-field type=text value='$row[first_name] $row[last_name]' readonly />";
         echo "<br><label>"."Empid "."</label><br><input class=input-field type=text name=empid id=empid value='$row[empid]' readonly /><br></div>";
        
         echo "<div class=s2><tr><td><label>"."Month "."</label><br><input class=input-field type=text name=month id=month value='$month' readonly /><br>";
         echo "<tr><td><label>"."year "."</label><br><input class=input-field type=text name=year id=year value='$year' readonly /></div><br/>";

         $query = "select * from Salary_Class where class='$class'";
         $result=mysqli_query($conn,$query);
         $row=mysqli_fetch_array($result);
         echo "<div class=s3>";
         echo "<br><label>"."Class "."</label><br><input class=input-field type=text name=class id=class required value='$row[Class]' readonly />";
         echo "<br><label>"."HRA "."</label><br><input class=input-field type=text value='$row[HRA]' readonly />"."<br/>";
         echo "<label>"."TA "."</label><br><input class=input-field type=text value='$row[TA]' readonly />";
         echo "<br><label>"."MA "."</label><br><input class=input-field type=text value='$row[MA]' readonly />"."<br/>";
         echo "<label>"."G.S "."</label><br><input class=input-field type=text value='$row[GS]' readonly />"."<br/>";
         echo "<div class=s4>";
         echo "<label>"."Basic Salary "."</label><br><input class=input-field type=text value='$row[BS]' readonly /><br>";
         echo "<label>"."T.D.S "."</label><br><input class=input-field type=text value='$row[TDS]' readonly /><br>";
         echo "<label>"."P.T "."</label><br><input class=input-field type=text value='$row[PT]' readonly />"."<br/>";
         echo "<label>"."PF "."</label><br><input class=input-field type=text value='$row[PF]' readonly />"."<br/>";
         echo "<label>"."N.S "."</label><br><input class=input-field type=text value='$row[NS]' readonly />"."<br/></div>";
         echo "<input type=submit class=update_button1 name=update id=update value=update><br><br>";
         echo "</form>";
         echo "";
         }
         else 
         {
         echo "No Records!";
         }
         }
         }
         
         ?>
         
         <?php
         echo "<form action=salary.php method=post>";
         if (isset($_POST['update']))
         {
         $empid = $_REQUEST['empid'];
         
         $month = $_REQUEST['month'];
         
         $year = $_REQUEST['year'];
         
         $class =  $_REQUEST['class'];
         
         $sql = "INSERT INTO Salary(empid,month,year,class) VALUES('$empid','$month','$year','$class')";
         
         if(mysqli_query($conn, $sql)){
         echo ("<script LANGUAGE='JavaScript'>
         window.alert('Salary Credited Successfully');
         window.location.href='salary.php';
         </script>");
         }
         
         
         echo "ERROR: Hush! Sorry $sql. "
         . mysqli_error($conn);
         
         }
         
         
         ?>
         
         
   </div>
   
</body>
</html>