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
    <link rel="stylesheet" href="style.css">
    <title>Update</title>
    <style>
  
      .content{
      padding-left: 15%;
      padding-top: 2px;
      
     
      }
     
      button{
        border-radius: 3px;
        border: 1px solid gray;
        height: 55px;
        width: 100%;
        font-size: 15px;
      }
     button:hover{
      color: #ffffff;
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

     .input-field{
      border: 1px solid rgb(211 211 211);
    height: 36px;
    width: 100%;
    border-radius: 2px;
    margin: 10px;
    padding: 5px;
    font-size: 19px;
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
    .div1{
      position: relative;
    left: 17%;
    top: 6.5vh;
    width: 39%;
    
    }
    .div2{
        
      position: relative;
    right: -59%;
    top: -350px;
    width: 39%;
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
}
.image-upload>input {
  background-color: white;
  display: none;
}
#input{
    display:none;
}
#p{
    
    position: fixed;
    top: 147px;
    left: 22px;
}
.table_pro{
  position: relative;
    /* top: -6%; */
    left: 44%;
    height: 30%;
    width: 18.6%;
    border-radius: 5px;

    
}
img{
   border: 5px solid white;
    width:  150px;
    height: 150px;
    object-fit: cover;
  border-radius: 100%;
    /* margin: 1px; */
    margin-top: 20px;
    margin-left: -90px;
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
    
       
    <div class="navi">
       
    <a href=emp_home.php><button>Home</button></a>
    <a href=emp_profile.php><button>My Profile</button></a>
    <a href=salary_report.php><button>Salary Report</button></a>
    <a href=logout.php><button>Logout</button></a>
  
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
            
             echo "<div class=table_pro>";
             echo "<form action=datamodify.php  method=post enctype=multipart/form-data> 
             <p id=p> 
                 <div class=image-upload></div>
                 <label for=input> <center  >";
            if(empty($image)){    
            echo "<img src='src/Avatar.jpg' id='output' height=150 width=150 />";
            } 
            else{
            echo "<img src='$image'; id='output' height=150 width=150 />";
            }
            echo "</center>
             
             </label>
                         <input id=input type=file name=upload accept=image/* onchange=preview()>
                         <input type=submit value=update class=update_pss_button >
             </div>
             </p> 
             
             </form> ";
             echo "</div>";
            
                echo "<form action=datamodify.php method=post>";
                echo "<div class=div1 >"."<label>"."First Name:"."<br/>"."</label>"."<input class=input-field type=text name=FIRSTNAME id=FIRSTNAME required value='$row[first_name]' />"."<br/>"; 
                echo "<label>"."Last Name:"."<br/>"."</label>"."<input class=input-field type=text name=LASTNAME id=LASTNAME required value='$row[last_name]' />"."<br/>"; 
                echo "<label>"."Email:"."<br/>"."</label>"."<input class=input-field type=text name=EMAIL id=EMAIL required value='$row[email]' />"."<br/>";  
                echo "<label>"."Department:"."<br/>"."</label><select name=DEPARTMENT id=DEPARTMENT class=input-field required  value='$row[department]' />
            <option value='$row[department]' selected>$row[department]</option>
            <option value='DESIGN'>DESIGN</option>
            <option value='CODING'>CODING</option>
            <option value='TESTING'>TESTING</option>
            <option value='HUMAN RESOURCE'>HUMAN RESOURCE</option>
            <option value=MAINTANANCE>MAINTANANCE</option>
            </select>"."<br/>";
            echo "<label>"."Address:"."<br/>"."</label>"."<input class=input-field type=text name=ADDRESS id=ADDRESS required value='$row[address]' />"."<br/>"; 
    
            echo "<input  class=update_button type=submit id=update name=update value=Update >"."</div>";
            echo "</form>";
            
            }
            }
            ?>
            
            
             <form action="datamodify.php" method="post" style="height:0;">
            <?php
            echo "<div class=div2 >"."<h1>"."Change Password"."</h1>"."<br/>"."<label>"."Old Password:"."<br/>"."</label>"."<input class=input-field type=password name=OLDPASSWORD id=OLDPASSWOR  required >"."<br/>"; 
            echo "<label>"."New Password:"."<br/>"."</label>"."<input class=input-field type=password name=PASSWORD id=PASSWORD onkeydown=key(); required >"."<br/>"; 
            echo "<label>"."Confirm New Password:"."<br/>"."</label>"."<input class=input-field type=password name=PASSWORD id=CPASSWORD onkeydown=key(); required >"."<br/>"; 
            
            echo "<input class=update_pss_button type=submit id=submit name=submit value=Update Password onclick=passwordverify(); >"."</div>";
            
            
           ?>
           
           </form>
           
           <script>
           
           function preview() {
           var image = document.getElementById('output');
           image.src = URL.createObjectURL(event.target.files[0]);
           }
           
           function passwordverify() {
           var pw1 = document.getElementById("PASSWORD").value;
           var pw2 = document.getElementById("CPASSWORD").value;
           if (pw1 != "" && pw2 != "") {
           if (pw1 != pw2) {
           alert("PASSWORD DID NOT MATCH");
           document.getElementById("submit").disabled = true;
           } else {
           document.getElementById("submit").disabled = false;
           checkpassword();
           }
           }
           }
           
           function key() {
           document.getElementById("submit").disabled = false;
           }
           
           function checkpassword() {
           
           var chk_pw = document.getElementById('PASSWORD').value;
           var pw_val =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
           if(chk_pw!='')
           {
           if(!pw_val.test(chk_pw))
           {
           alert("Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character")
           document.getElementById("submit").disabled = true;
           } else 
           {  
           document.getElementById("submit").disabled = false;
           }  
           }
           }
           </script>
           
            
            
            </p>
        
        
         
   </div>
</body>
</html>


            