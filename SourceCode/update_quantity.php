<?php
$servername = "localhost";
$username = "root";
$password = "database";
$dbname = "pos_system";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $itemId = $_POST["item_id"];
    $action = $_POST["action"];

    // Fetch current quantity from the database
    $query = "SELECT quantity FROM Products WHERE BarCode = $itemId";
    $result = $con->query($query);

    if (!$result) {
        die("Error fetching quantity: " . $con->error);
    }

    $row = $result->fetch_assoc();
    $currentQuantity = $row["quantity"];

    // Update quantity based on the action
    if ($action === "decrement" && $currentQuantity > 0) {
        $newQuantity = $currentQuantity - 1;
    } elseif ($action === "increment") {
        $newQuantity = $currentQuantity + 1;
    } else {
        // Invalid action
        die("Invalid action");
    }

    // Update the quantity in the database
    $updateQuery = "UPDATE Products SET quantity = $newQuantity WHERE BarCode = $itemId";
    $updateResult = $con->query($updateQuery);

    if (!$updateResult) {
        die("Error updating quantity: " . $con->error);
    }

    echo "Quantity updated successfully";
} else {
    echo "Invalid request method";
}

$con->close();
?>
