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
        //echo "Connection successful";
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Management</title>
    <!-- Include Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <style>
      body{
        background-size: cover;
        background-image: url("logo2.jpg");
      }
      .btn btn-primary{
        background-color: #4caf50;
      }
      #content {
        margin-left: 200px;
        padding: 20px;
        overflow-y: auto; /* Add this line to enable vertical scrolling */
        max-height: 80vh; /* Add this line to set a maximum height for the container */
      }
    
      /* Styles for the table */
      .table-container {
        max-height: 400px; /* Set a maximum height for the table container */
        overflow-y: auto; /* Enable vertical scrolling for the table container */
      }

      .form-control {
        display: block;
        width: 400px;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }
      body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
      }

      #sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: -200px;
        background-color: black;
        padding-top: 20px;
        margin-top: 70px;
        transition: 0.5s;
      }

      #sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 18px;
        color: white;
        display: block;
        transition: 0.3s;
      }

      #sidebar a:hover {
        color: #f1f1f1;
      }

      #menu-btn {
        font-size: 25px;
        cursor: pointer;
        position: fixed;
        top: 20px;
        left: 20px;
        color: #818181;
      }

      #content {
        margin-left: 200px;
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <div id="sidebar">
      <a href="#" onclick="showAddStock()">Add Stock</a>
      <a href="#" onclick="showViewStock()">View Stock</a>
      <a href="#" onclick="Logout()">Log Out</a>
      <a href="#" onclick="showSell()">Sell</a>
      <a href="#" onclick="Register()">Register</a>
    </div>

    <div id="content">
      <div id="menu-btn" onclick="toggleSidebar()">&#9776;</div>
      <h2>Stock Management</h2>
      <div id="stock-actions">
        <!-- Content for Add, Edit, Delete, View stock will be dynamically updated here -->
      </div>
    </div>

    <!-- Bootstrap JavaScript and dependencies (optional, but needed for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
      function Logout() {
        window.location.href = "http://localhost/login.php";
      }
      function showSell() {
        window.location.href = 'http://localhost/main.php'; // Corrected typo here
      }

      function Register() {
        window.location.href = 'http://localhost/registercashiers.php';
  
      }

      function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.style.left = sidebar.style.left === "0px" ? "-200px" : "0px";
      }

      function showAddStock() {
        const formHTML = `
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
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-green {
            background-color: black;
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

    `;
        document.getElementById("stock-actions").innerHTML = formHTML;
      }

      function submitAddStockForm() {
        const itemName = document.getElementById("itemName").value;
        const quantity = document.getElementById("quantity").value;
        const category = document.getElementById("category").value;

        // You can perform further actions (e.g., sending data to the server) with the form values here

        // For demonstration purposes, display an alert with the submitted data
        alert(
          `Item Name: ${itemName}\nQuantity: ${quantity}\nCategory: ${category}`
        );

        // Clear the form
        document.getElementById("addStockForm").reset();
      }

      function showEditStock() {
        document.getElementById("stock-actions").innerHTML =
          "<p>Edit Stock Form Goes Here</p>";
      }

      function submitDeleteStockForm() {
        const itemNameToDelete =
          document.getElementById("itemNameToDelete").value;

        // You can perform further actions (e.g., sending data to the server) with the form values here

        // For demonstration purposes, display an alert with the submitted data
        alert(`Item Name to Delete: ${itemNameToDelete}`);

        // Clear the form
        document.getElementById("deleteStockForm").reset();
      }

      function showViewStock() {
    
        window.location.href = 'http://localhost/UpdateProducts.php';
}

      function searchStock() {
        const input = document
          .getElementById("stockSearchInput")
          .value.toUpperCase();
        const table = document.querySelector(".table");
        const rows = table.getElementsByTagName("tr");

        // Loop through all table rows and hide those that don't match the search input
        for (let i = 1; i < rows.length; i++) {
          const itemName = rows[i]
            .getElementsByTagName("td")[0]
            .textContent.toUpperCase();

          if (itemName.includes(input)) {
            rows[i].style.display = "";
          } else {
            rows[i].style.display = "none";
          }
        }
      }
    </script>
  </body>
</html>
