<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style2.css" />

<style>
body{
  background-size: cover;
  background-image: url("logo.jpg");
}
.login {
  width: 400px;
  padding: 20px;
  background: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

h1 {
  margin-top: 0;
}

label {
  display: block;
  margin-bottom: 10px;
  text-align: left;
  justify-content: center;
  align-items: center;


}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

input[type="submit"] {
  width: 100%;
  background: #4CAF50;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

input, select {
  padding: 10px;
  margin-bottom: 20px;
  box-sizing: border-box;
  width: 100%;
}
</style>

  </head>
  <body>


    <div class="login">
      <h1>Login</h1>
      <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $servername = "localhost";
          $username = "root";
          $password = "Lebona";
          $dbname = "pos_system";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $email = $_POST['email'];
          $password = $_POST['password'];
          $role = $_POST['role'];

          $sql = "SELECT * FROM cashiers WHERE email = '$email' AND password = '$password' AND role = '$role'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $_SESSION['role'] = $role;
            if ($role == 'manager') {
              header("Location: manager.php");
            } else {
              header("Location: main.php");
            }
          } else {
            echo "Invalid credentials";
          }

          $conn->close();
        }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="manager">Manager</option>
            <option value="staff">Staff</option>
        </select>
        
        <input type="submit" value="Login" />
      </form>
    </div>
  </body>
</html>
