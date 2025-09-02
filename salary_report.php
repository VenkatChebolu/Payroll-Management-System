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
  <title>Salary Report</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="table.css">
  <style>
 
    .update_pss_button1 {
      height: 45px;
      width: 120px;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: #17a1bb;
      margin: 10px;
      padding: 5px;
      color: #ffff;
      position: relative;
      top: 1px;
      left: 86.5%;
    }


    .salary-slip {
      margin: 15px;
    }

    .empDetail {
      width: 100%;
      text-align: left;
      border: 2px solid black;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .head {
      margin: 10px;
      margin-bottom: 50px;
      width: 100%;
    }

    .companyName {
      text-align: center;
      font-size: 25px;
      font-weight: bold;
    }

    .salaryMonth {
      text-align: center;
    }

    .table-border-bottom {
      border-bottom: 1px solid;
    }

    .table-border-right {
      border-right: 1px solid;
    }

    .myBackground {
      padding-top: 10px;
      text-align: left;
      border: 1px solid black;
      height: 40px;
    }

    .myAlign {
      text-align: center;
      border-right: 1px solid black;
    }

    .myTotalBackground {
      padding-top: 10px;
      text-align: left;
      background-color: #EBF1DE;
      border-spacing: 0px;
    }

    .align-4 {
      width: 25%;
      float: left;
    }

    .tail {
      margin-top: 35px;
    }

    .align-2 {
      margin-top: 25px;
      width: 50%;
      float: left;
    }

    .border-center {
      text-align: center;
    }

    .border-center th,
    .border-center td {
      border: 1px solid black;
    }

    th,
    td {
      padding-left: 6px;
      padding: 10px;
    }

    .tfoot,
    .tbody {
      border: 2px solid black;
      margin: 5px;
    }
    .update_button{
    height: 34px;
    width: 100px;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: #17a1bb;
    margin: 10px;
    padding: 5px;
    color: #fff;
    }
   
  </style>

  <script src="canvas.js"></script>

  <script>
    function downloadimage() {
      /*var container = document.getElementById("image-wrap");*/
      /*specific element on page*/
      var container = document.getElementById("payslip"); /* full page */
      html2canvas(container, {
        allowTaint: true
      }).then(function(canvas) {

        var link = document.createElement("a");
        document.body.appendChild(link);
        link.href = canvas.toDataURL('image/jpeg', 1.0);
        link.download = "payslip";
        link.target = '_blank';
        link.click();

      });
    }
  </script>


</head>

<body>
  <div class="header">
    <h1>Payroll Management System</h1>
  </div>

  <div class="container"></div>


  <div class="navi">
    <?php
    if ($empid == 880980000) {
      echo "<a href=emp_home.php><button class=button>Home</button></a>";
      echo "<a href=emp_list.php><button class=button>Employee List</button></a>";
      echo "<a href=class.php><button class=button>Class</button></a>";
      echo "<a href=salary.php><button class=button>Salary</button></a>";
      echo "<button class=button>Salary Report</button>";
      echo "<a href=logout.php><button class=button>Logout</button></a>";
    } else {
      echo "<a href=emp_home.php><button class=button>Home</button></a>";
      echo "<a href=emp_profile.php><button>My Profile</button></a>";
      echo " <button>Salary Report</button>";
      echo "<a href=logout.php><button>Logout</button></a>";
    }
    ?>
  </div>
  </div>
  <div class="content">
    <p>

      <?php if (isset($_SESSION["empid"])) {
        $empid = $_SESSION["empid"];

        if (!isset($_POST['btn'])) {
          echo "<form action=salary_report.php method=post>";

          if ($empid == 880980000) {
            $sql = "SELECT * FROM Salary";
          } else {
            $sql = "select * from Salary where empid='$empid'";
          }
          $result = mysqli_query($conn, $sql);
          echo "<div class=table-wrapper ><table class=fl-table>
            <tr><th width=100>Empid</th><th>Payment Id</th><th>Month</th><th>Year</th><th>Class</th><th>Reciept</th>";
          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["empid"] . "</td><td>" . $row["payment_id"] . "</td><td>" . $row["month"] . "</td><td>" . $row["year"] . "</td><td>" . $row["class"] . "</td><td><button type=submit name=btn id=btn class=update_button value='$row[payment_id]' >View Receipt</button></td></tr>";
            }
          }
          echo "</table></div>";
          echo "</form>";
        }

        if (isset($_POST['btn'])) {
          $pi = $_REQUEST['btn'];

          $query = "select * from Salary where payment_id='$pi'";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['empid'];
            $class = $row['class'];

            $query1 = "select * from rdata where empid='$id'";
            $result1 = mysqli_query($conn, $query1);
            while ($rdata = mysqli_fetch_array($result1)) {
              $query2 = "select * from Salary_Class where Class='$class'";
              $result2 = mysqli_query($conn, $query2);
              while ($class1 = mysqli_fetch_array($result2)) {
                $total_d = $class1['TDS'] + $class1['PT'] + $class1['PF'];
                echo "<div id=payslip class=salary-slip>";
                echo "<table class=empDetail>";
                echo "<tr height=50px style='background-color: #c2d69b'>
                  <td colspan='8' class=companyName >Salary Receipt</td>
                  </tr><tr>";
                echo "<th >Payment Id : </th><td colspan=2>$row[payment_id]</td>
                      <th >Month : </th><td colspan=2>$row[month] </td>
                      <th> Year : </th><td>$row[year]</td></tr>";
                echo "<tr><th >Name : </th><td colspan=2>$rdata[first_name] $rdata[last_name]";
                echo "<th colspan=>Department : </th><td>$rdata[department]</td></tr><tr>";
                echo "<th >EmpId : </th><td colspan=2>$id</td>";

                echo "<th colspan=>Salary class : </th><td colspan = 2>$class1[Class]
                <th> Basic Salary:</th><td >$class1[BS] 
                </td>
                      
                      </tr>";
                echo "<tbody class=tbody><trclass=myBackground><th colspan=3>Allowances</th><th class=table-border-right>
                       Amount (Rs.)
                      </th><th colspan=3>Deductions</th>
                      <th >
                      Amount (Rs.)
                      </th>
                      </tr></tbody>";
                echo "<tr><td  colspan=3 >Madical Allowance  </td><td class=myAlign > $class1[MA]</td>
                <td colspan=3>Tax Deduction At Source</td><td>$class1[TDS]</td></tr><tr>
                
                <td colspan=3>
                House Rent Allowance
                </td><td class=myAlign>
                $class1[HRA]
                  </td>
                  <td colspan=3>Professional Tax</td><td>$class1[PT]</td></tr><tr>
                  <td colspan=3>
                  Travel Allowance
                  </td>
                  <td class=myAlign>
                  $class1[TA]</td>
                  <td colspan=3>
                  Provident Fund
                  </td><td>$class1[PF]</td></tr><tr>
                  
                   <td colspan=3>
                    Gross Salary
                    </td><td class=myAlign>
                    $class1[GS]
                   </td>
                   <td colspan=3>Total Deduction</td><td>$total_d</td></tr>
                   <tfoot class=tfoot><tr style=background-color:lightgray;>
                   <th colspan=4></td>
                   <th colspan=3>Net Salary </th><td>$class1[NS]</td></tr></tfoot>";



                echo "</table>";
                echo "</div>";

                echo "<button class=update_pss_button1 onclick=downloadimage() class=clickbtn>Download Payslip</button>";
              }
            }
          }
        }
      }



      ?>

    </p>

  </div>
</body>

</html>