<?php
$conn = new mysqli("localhost", "root", "", "college");

if ($conn->connect_error) {
    $status = "error";
    $message = "Connection failed: " . $conn->connect_error;
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST["name"]));
        $email = htmlspecialchars(trim($_POST["email"]));

        if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
            if ($conn->query($sql) === TRUE) {
                $status = "success";
                $message = "Registration Done";
            } else {
                $status = "error";
                $message = "Database Error: " . $conn->error;
            }
        } else {
            $status = "error";
            $message = "Invalid name or email ❌";
        }
    } else {
        $status = "error";
        $message = "Invalid request method.";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #2c2c54, #1e1e2f);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #f0f0f0;
    }
    .container {
      background: #2a2a3b;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0px 6px 18px rgba(0,0,0,0.6);
      text-align: center;
      width: 350px;
    }
    h2 {
      margin-bottom: 20px;
    }
    .success h2 {
      color: #28a745;
    }
    .error h2 {
      color: #dc3545;
    }
    a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      background: #6c63ff;
      color: #fff;
      font-weight: bold;
      transition: 0.3s;
    }
    a:hover {
      background: #574bff;
    }
  </style>
</head>
<body>
  <div class="container <?php echo $status; ?>">
    <h2><?php echo $message; ?></h2>
    <a href="index.html">Go Back</a>
  </div>
</body>
</html>