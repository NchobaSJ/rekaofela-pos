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
        echo "Connection successful";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
</head>
<body>

<div class="container my-5"> <!-- Wrap the table with a container -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Item Name</th>
            <th scope="col">Barcode</th>
            <th scope="col">Bought From</th>
            <th scope="col">Date Bought</th>
            <th scope="col">Cost Price</th>
            <th scope="col">Operations</th>

          </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM `Food`";
        $result=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
          $ItemName = $row['ItemName'];
          $BarCode= $row['BarCode'];
          $BoughtFrom= $row['BoughtFrom'];
          $DateBought= $row['DateBought'];
          $CostPrice= $row['CostPrice'];
          echo '</tr>
              <td>'.$ItemName.'</td>
              <td>'.$BarCode.'.</td>
              <td>'.$BoughtFrom.'</td>
              <td>'.$DateBought.'</td>
              <td>'.$CostPrice.'</td>
              <td>
            <a href="#"> Update</a>
            <a href="#"> Delete</a>
             </td>
              </tr>';
        }


        ?>
        

        <tbody>
        </div>
    </table>

</body>
</html>
