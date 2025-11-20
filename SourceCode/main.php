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

// Fetch stock items from the database
$stockItemsQuery = "SELECT * FROM Products";
$stockItemsResult = $con->query($stockItemsQuery);

// Check if the query was successful
if (!$stockItemsResult) {
    die("Error fetching stock items: " . $con->error);
}

function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <style>


.calculator {
  border: 1px solid rgb(179, 179, 179);
  border-radius: 0.375rem;
  width: 230px;
  height: 254px;
  font-family: Arial, sans-serif;
  padding: 10px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.output {
  border: 1px solid #ccc;
  border-radius: 0.375rem;
  height: 40px;
  margin-bottom: 10px;
  margin-top: 10px;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 10px;
}

.result {
  font-size: 20px;
}

.buttons {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 5px;
}

button {
  border: none;
  border-radius: 0.375rem;
  padding: 10px;
  background-color: #eee;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #ddd;
}

button:active {
  background-color: #ccc;
}

.bg-green {
  background-color: rgba(0, 177, 29, 0.651);
  color: white;
}

.bg-green:hover {
  background-color: rgba(0, 231, 39, 0.651);
  color: white;
}

.bg-red {
  background-color: rgba(223, 4, 4, 0.651);
  color: white;
}

.bg-red:hover {
  background-color: rgba(255, 1, 1, 0.651);
  color: white;
}





          
          .button {
            outline: 0 !important;
            border: 0 !important;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: all ease-in-out 0.3s;
            cursor: pointer;
          }
          
          .button:hover {
            transform: translateY(-3px);
          }
          
          .icon {
            font-size: 20px;
          }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .container1{
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width: 255px;
            height: 685px;
            margin-right: 40px;
            margin-left: 10px;
        }
        #container {
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width: 9000px;
            height: 685px;
            margin-right: 15px;
        }

        #search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        #search-bar {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 10px;
        }

        #results-container {
            text-align: left;
            max-height: 100px; /* Adjust the maximum height as needed */
            overflow-y: auto;
        }

        .result-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 5px;
            background-color: #fff;
        }

        #cart-container {
            margin-top: 20px;
        }

        #cart-list {
            list-style-type: none;
            padding: 0;
            max-height: 230px; /* Adjust the maximum height as needed */
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            background-color: #fff;
            padding: 10px;
        }

        #total-container {
            margin-top: 10px;
            background-color: #eee;
            padding: 10px;
            border-radius: 4px;
        }

        #payment-container {
            margin-top: 20px;
        
        }

        #payment-input {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 4px;
        }

        #change-container {
            margin-top: 10px;
            background-color: #eee;
            padding: 10px;
            border-radius: 4px;
        }

        .quantity-container {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            margin: 0 5px;
            cursor: pointer;
        }

        #logout-container,
        #receipt-container {
            margin-top: 20px;
            text-align: center;
        }

        button {
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
        .logout-button{
            height: 100px;
            width: 230px;
            margin-right: 100px;
            margin-top: 60px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .manage-button {
            height: 100px;
            width: 230px;
            margin-right: 100px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            margin-top: 45px;
        }
        .sales-button{
            height: 100px;
            width: 230px;
            margin-right: 100px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            margin-top: 40px;
        }
        body{
        background-size: cover;
        background-image: url("logo.jpg");
      }

        #main-content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container1">
    <div class="calculator">
  <div class="output">
    <span class="result"></span>
  </div>
    <div class="buttons">
    <button onclick="appendNumber('1')">1</button>
    <button onclick="appendNumber('2')">2</button>
    <button onclick="appendNumber('3')">3</button>
    <button onclick="appendOperator('+')">+</button>
    <button onclick="appendNumber('4')">4</button>
    <button onclick="appendNumber('5')">5</button>
    <button onclick="appendNumber('6')">6</button>
    <button onclick="appendOperator('-')">-</button>
    <button onclick="appendNumber('7')">7</button>
    <button onclick="appendNumber('8')">8</button>
    <button onclick="appendNumber('9')">9</button>
    <button onclick="appendOperator('*')">*</button>
    <button class="bg-red" onclick="clearInput()">C</button>
    <button onclick="appendNumber('0')">0</button>
    <button class="bg-green" onclick="calculate()">=</button>
    <button onclick="appendOperator('/')">/</button>
  </div>
  <button class="logout-button" onclick = "logout()">Logout</button>  
  <button class="manage-button"  onclick="Manager()">Manage Stock</button>
  <button class="sales-button"></button>
 
</div>


    </div>
    <div id="container">
        <div id="search-container">
            <input type="text" id="search-bar" placeholder="Search for stock items...">
        </div>

        <div id="results-container">
            <!-- Results will be displayed here -->
        </div>

        <div id="cart-container">
            <h2>Shopping Cart</h2>
            <ul id="cart-list"></ul>
            <div id="total-container">
                <strong>Total: M<span id="total">0.00</span></strong>
            </div>

            <div id="payment-container">
                <label for="payment-input">Payment: LSL</label>
                <input type="number" id="payment-input" step="0.01" min="0">
            </div>

            <div id="change-container">
                <strong>Change: M<span id="change">0.00</span></strong>
            </div>

            <div id="receipt-container">
                <button onclick="generateReceipt()">Generate Receipt</button>
            </div>
        </div>
    </div>

    <script>
      
        const stockItems = [
            <?php
            while ($row = $stockItemsResult->fetch_assoc()) {
                echo "{ id: " . $row['BarCode'] . ", name: '" . $row['ItemName'] . "', price: " . $row['SalesPrice'] . " },";
            }
            ?>
        ];

        const searchInput = document.getElementById('search-bar');
        const resultsContainer = document.getElementById('results-container');
        const cartList = document.getElementById('cart-list');
        const totalElement = document.getElementById('total');
        const paymentInput = document.getElementById('payment-input');
        const changeElement = document.getElementById('change');
        const shoppingCart = [];
        

        searchInput.addEventListener('input', handleSearch);
        paymentInput.addEventListener('input', calculateChange);

        function handleSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredItems = stockItems.filter(item => item.name.toLowerCase().includes(searchTerm));

       
            displayResults(filteredItems);
        }

        function addToCart(itemId) {
            const existingItem = shoppingCart.find(item => item.id === itemId);

            if (existingItem) {
           
                existingItem.quantity++;
            } else {
            
                const selectedItem = { ...stockItems.find(item => item.id === itemId), quantity: 1 };
                shoppingCart.push(selectedItem);
            }

            updateCart();
        
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
                updateCart();
            } else {
                
                console.error("Error updating quantity in the database");
            }
        }
    };

    xhr.open("POST", "update_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("item_id=" + itemId + "&action=decrement");
}
        

        function updateCart() {
          
            cartList.innerHTML = '';

            
            shoppingCart.forEach(item => {
                const cartItem = document.createElement('li');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                <div>${item.name} - M${item.price.toFixed(2)}</div>
                <div class="quantity-container">
                    <button class="quantity-btn" onclick="decrementQuantity(${item.id})">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="addToCart(${item.id})">+</button>
                    <button onclick="removeFromCart(${item.id})">Delete</button>
                </div>
            `;
            cartList.appendChild(cartItem);
        });

            // Update the total
            const totalPrice = shoppingCart.reduce((total, item) => total + item.price * item.quantity, 0);
            totalElement.textContent = totalPrice.toFixed(2);

            // Reset payment and change
            paymentInput.value = '';
            changeElement.textContent = '0.00';
        }

        function calculateChange() {
            const payment = parseFloat(paymentInput.value) || 0;
            const totalPrice = shoppingCart.reduce((total, item) => total + item.price * item.quantity, 0);
            const change = payment - totalPrice;

            changeElement.textContent = change.toFixed(2);
        }

        function displayResults(items) {
            // Clear previous results
            resultsContainer.innerHTML = '';

            // Display each result item with "Add to Cart" button
            items.forEach(item => {
                const resultItem = document.createElement('div');
                resultItem.classList.add('result-item');
                resultItem.innerHTML = `<strong>${item.name}</strong> - M${item.price.toFixed(2)} 
                <button onclick="addToCart(${item.id})">Add to Cart</button>`;
                resultsContainer.appendChild(resultItem);
            });
        }

        function decrementQuantity(itemId) {
            const existingItem = shoppingCart.find(item => item.id === itemId);

            if (existingItem && existingItem.quantity > 1) {
                existingItem.quantity--;
                updateCart();
            }
        }

        function removeFromCart(itemId) {
            const itemIndex = shoppingCart.findIndex(item => item.id === itemId);

            if (itemIndex !== -1) {
                const item = shoppingCart[itemIndex];

                
                if (item.quantity > 1) {
                    item.quantity--;
                } else {
                    shoppingCart.splice(itemIndex, 1);
                }

                updateCart();
            }
           
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
             
                updateCart();
            } else {
               
                console.error("Error updating quantity in the database");
            }
        }
    };

    xhr.open("POST", "update_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("item_id=" + itemId + "&action=increment");
}
        

         function generateReceipt() {
      
        if (shoppingCart.length === 0) {
            alert("Your cart is empty. Add items before generating a receipt.");
            return;
        }

     
        let receiptContent = "Receipt:\n\n";
        shoppingCart.forEach(item => {
            receiptContent += `${item.name} - M${item.price.toFixed(2)} x ${item.quantity}\n`;
        });

        receiptContent += `\nTotal: M${totalElement.textContent}\n`;
        receiptContent += `Payment: M${paymentInput.value}\n`;
        receiptContent += `Change: M${changeElement.textContent}\n`;


        alert(receiptContent);

        const fileName = `receipt_${Date.now()}.txt`;
        const blob = new Blob([receiptContent], { type: 'text/plain' });
        const link = document.createElement('a');

        link.href = URL.createObjectURL(blob);
        link.download = fileName;
        link.click();
        URL.revokeObjectURL(link.href);

        // Clear the cart after generating the receipt
        shoppingCart.length = 0;
        updateCart();
    }
    const outputElement = document.querySelector('.result');
  let currentInput = '';

  function appendNumber(number) {
    currentInput += number;
    updateOutput();
  }

  function appendOperator(operator) {
    currentInput += ' ' + operator + ' ';
    updateOutput();
  }

  function clearInput() {
    currentInput = '';
    updateOutput();
  }

  function calculate() {
    try {
      const result = eval(currentInput);
      currentInput = result.toString();
      updateOutput();
    } catch (error) {
      currentInput = 'Error';
      updateOutput();
    }
  }

  function updateOutput() {
    outputElement.textContent = currentInput;
  }

  function Manager()
  {
    window.location.href = 'http://localhost/login.php';
  }
  function logout()
  {
    window.location.href = 'http://localhost/login.php';
  }


    </script>

</body>

</html>
