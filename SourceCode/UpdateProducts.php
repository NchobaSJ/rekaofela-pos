<?php
$servername = "localhost";
$username = "root";
$password = "database";
$dbname = "pos_system";

$con = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
   // echo "Connection successful";
}

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}


if (isset($_POST['update'])) {
    $updatedBarCode = sanitize($_POST['updatedBarCode']);
    $updatedItemName = sanitize($_POST['updatedItemName']);
    $updatedBoughtFrom = sanitize($_POST['updatedBoughtFrom']);
    $updatedDateBought = sanitize($_POST['updatedDateBought']);
    $updatedCostPrice = sanitize($_POST['updatedCostPrice']);
    $updatedSalesPrice = sanitize($_POST['updatedSalesPrice']);
    $updatedQuantity = sanitize($_POST['updatedQuantity']);

    if ($updatedQuantity > 0) {
      
        $updateSql = "UPDATE Products SET ItemName='$updatedItemName', BoughtFrom='$updatedBoughtFrom', DateBought='$updatedDateBought', 
                      CostPrice='$updatedCostPrice', SalesPrice='$updatedSalesPrice', Quantity='$updatedQuantity' WHERE BarCode='$updatedBarCode'";

        if ($con->query($updateSql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $con->error;
        }
    } else {
        // If quantity is 0, delete the record
        $deleteSql = "DELETE FROM Products WHERE BarCode='$updatedBarCode'";
        if ($con->query($deleteSql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $con->error;
        }
    }
}

// Delete functionality
if (isset($_GET['delete'])) {
    $deleteBarCode = sanitize($_GET['delete']);

    // Check the current quantity
    $quantitySql = "SELECT Quantity FROM Products WHERE BarCode='$deleteBarCode'";
    $quantityResult = mysqli_query($con, $quantitySql);
    $quantityRow = mysqli_fetch_assoc($quantityResult);
    $currentQuantity = $quantityRow['Quantity'];

    if ($currentQuantity > 1) {
        // If quantity is greater than 1, decrement it by one
        $updateQuantitySql = "UPDATE Products SET Quantity = Quantity - 1 WHERE BarCode='$deleteBarCode'";
        if ($con->query($updateQuantitySql) === TRUE) {
            echo "Quantity decremented successfully";
        } else {
            echo "Error decrementing quantity: " . $con->error;
        }
    } else {
        // If quantity is 1 or 0, delete the entire item
        $deleteSql = "DELETE FROM Products WHERE BarCode='$deleteBarCode'";
        if ($con->query($deleteSql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $con->error;
        }
    }
}
?>

<!-- Rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>

    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            margin: 5% auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: black;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            background-color: black;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #45a049;
        }

        #updateForm {
            display: none;
        }

        #updateForm input {
            margin: 5px 0;
        }
        .back-btn{
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div><a href ="http://localhost/UpdateProducts.php"><button>Refresh</button></a></div>
    <button class="back-btn" onclick="goBack()">Back</button>
    

<div class="container my-5">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Barcode</th>
            <th scope="col">ItemName</th>
            <th scope="col">BoughtFrom</th>
            <th scope="col">DateBought</th>
            <th scope="col">CostPrice</th>
            <th scope="col">SalesPrice</th>
            <th scope="col">Quantity</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM Products";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $BarCode = $row['BarCode'];
            $ItemName = $row['ItemName'];
            $BoughtFrom = $row['BoughtFrom'];
            $DateBought = $row['DateBought'];
            $CostPrice = $row['CostPrice'];
            $SalesPrice = $row['SalesPrice'];
            $Quantity = $row['Quantity'];

            echo '<tr>
                            <td>' . $BarCode . '</td>
                            <td>' . $ItemName . '</td>
                            <td>' . $BoughtFrom . '</td>
                            <td>' . $DateBought . '</td>
                            <td>' . $CostPrice . '</td>
                            <td>' . $SalesPrice . '</td>
                            <td>' . $Quantity . '</td>
                            <td>
                                <a href="?delete=' . $BarCode . '">Delete</a>
                                <a href="#" onclick="updateRecord(\'' . $BarCode . '\', \'' . $ItemName . '\', \'' . $BoughtFrom . '\', \'' . $DateBought . '\', 
                                \'' . $CostPrice . '\',\'' . $SalesPrice . '\',\'' . $Quantity . '\')">Update</a>
                            </td>
                          </tr>';
        }
        ?>
        </tbody>
    </table>

    <!-- Update form -->
    <div id="updateForm">
        <form method="post" action="">
            <input type="hidden" name="updatedBarCode" id="updatedBarCode">
            ItemName: <input type="text" name="updatedItemName" id="updatedItemName"><br>
            BoughtFrom: <input type="text" name="updatedBoughtFrom" id="updatedBoughtFrom"><br>
            DateBought: <input type="text" name="updatedDateBought" id="updatedDateBought"><br>
            CostPrice: <input type="text" name="updatedCostPrice" id="updatedCostPrice"><br>
            SalesPrice: <input type="text" name="updatedSalesPrice" id="updatedSalesPrice"><br>
            Quantity: <input type="text" name="updatedQuantity" id="updatedQuantity"><br>
            <input type="submit" name="update" value="Update">
        </form>
    </div>

    <script>
        function updateRecord(BarCode, ItemName, BoughtFrom, DateBought, CostPrice,SalesPrice,Quantity) {
            document.getElementById("updatedBarCode").value = BarCode;
            document.getElementById("updatedItemName").value = ItemName;
            document.getElementById("updatedBoughtFrom").value = BoughtFrom;
            document.getElementById("updatedDateBought").value = DateBought;
            document.getElementById("updatedCostPrice").value = CostPrice;
            document.getElementById("updatedSalesPrice").value = SalesPrice;
            document.getElementById("updatedQuantity").value = Quantity;

            document.getElementById("updateForm").style.display = "block";
        }

        function goBack(){
                window.history.back();
            }
    </script>
</div>

</body>
</html>
