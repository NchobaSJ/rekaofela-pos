<?php
    include 'connected.php';
    if (isset($_POST['enter']))
    {

        $employeeID=$_POST['EMP_num'];
        $fname=$_POST['FNAME'];
        $Lname=$_POST['LNAME'];
        $contacts=$_POST['Contacts'];
        $placeOfResidence=$_POST['PlaceOfResidence'];
        $email=$_POST['email'];
        
        //insert query
        $sql="INSERT INTO cashiers(EMP_num,FNAME,LNAME,Contacts,
        PlaceOfResidence, email) VALUES('$employeeID','$fname','$Lname','$contacts',
        '$placeOfResidence','$email')";

        $result=mysqli_query($con,$sql);
        if($result){
            echo 'Added successfully';

        }else{
            die(mysqli_error($con));
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .cashier {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-green {
            background-color: #4CAF50;
        }

        .btn-lg {
            font-size: 16px;
        }
        .back-btn{
            position: absolute;
            top: 5px;
            right: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div>
    <button class="back-btn" onclick="goBack()">Back</button>
    </div>
       
        <form method= 'post'>
        <div class ="cashier">
            <label class="form-label">Employee ID</label>
            <input type= "number" class="form-control" placeholder="Enter Cashier's Employee ID" name =
            "EMP_num">
        <form method= 'post'>
        <div class ="cashier">
            <label class="form-label">First name</label>
            <input type= "text" class="form-control" placeholder="Enter Cashier's First name" name ="FNAME">
        </div>
   
        
        <div class ="cashier">
        <form method= 'post'>
            <label class="form-label">Last name</label>
            <input type= "text" class="form-control" placeholder="Enter Cashier's Last name" name ="LNAME">


    <form method= 'post'>
        <div class ="cashier">
            <label class="form-label">Contacts</label>
            <input type= "text" class="form-control" placeholder="Enter Cashier's contact numbers" name ="Contacts">


    <form method= 'post'>
        <div class ="cashier">
            <label class="form-label">Place of residence</label>
            <input type= "text" class="form-control" placeholder="Enter Cashier's place of residence" name ="PlaceOfResidence">
        </div>

        <form method= 'post'>
        <div class ="cashier">
            <label class="form-label">Email</label>
            <input type= "text" class="form-control" placeholder="Enter email" name ="email">
        
        <button class="btn btn-green btn-lg" name = "enter">ENTER</button>
        
        </form>
        <script>
            function goBack(){
                window.history.back();
            }
        </script>
        
</body>    
</html>