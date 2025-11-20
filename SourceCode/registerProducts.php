<?php
    include 'connected.php';
    if (isset($_POST['enter']))
    {

        $BarCode=$_POST['BarCode'];
        $ItemName=$_POST['ItemName'];
        $BoughtFrom=$_POST['BoughtFrom'];
        $DateBought=$_POST['DateBought'];
        $CostPrice=$_POST['CostPrice'];
        $SalesPrice=$_POST['SalesPrice'];
        $Quantity=$_POST['Quantity'];
        
        
        //insert query
        $sql="INSERT INTO products (BarCode,ItemName,BoughtFrom,DateBought,CostPrice,SalesPrice,Quantity) VALUES('$BarCode','$ItemName','$BoughtFrom',
        '$DateBought','$CostPrice','$SalesPrice','$Quantity')";

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
    <title>Adding Stock-Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 500px;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-green {
            background-color: #4CAF50;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 style="text-align: center;">Stock-Products Form</h2>
        
        <form method='post'>
            <div class="form-group">
                <label class="form-label">Bar Code</label>
                <input type="number" class="form-control" placeholder="Enter product's barcode" name="BarCode">
            </div>

            <div class="form-group">
                <label class="form-label">Item Name</label>
                <input type="text" class="form-control" placeholder="Enter product's name" name="ItemName">
            </div>

            <div class="form-group">
                <label class="form-label">Bought From</label>
                <input type="text" class="form-control" placeholder="Enter the place the item was bought from" name="BoughtFrom">
            </div>

            <div class="form-group">
                <label class="form-label">Date Bought</label>
                <input type="date" class="form-control" name="DateBought">
            </div>

            <div class="form-group">
                <label class="form-label">Cost Price</label>
                <input type="number" class="form-control" placeholder="Enter the cost of the item when bought" name="CostPrice">
            </div>

            <div class="form-group">
                <label class="form-label">Sales Price</label>
                <input type="number" class="form-control" placeholder="Enter the sales price for the item" name="SalesPrice">
            </div>

            <div class="form-group">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" placeholder="Enter the quantity of the item" name="Quantity">
            </div>

            <button class="btn btn-green" name="enter">ENTER</button>
        </form>
    </div>

</body>
</html>
