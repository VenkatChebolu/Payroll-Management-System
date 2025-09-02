<?php

        $conn = mysqli_connect("localhost:3306", "root", "", "payroll_management");

        if($conn === false){

            die("ERROR: Could not connect. "

                . mysqli_connect_error());

        }
?>