<?php
include 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Centre Login</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #93c5fd, #dbeafe);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      width: 350px;
      text-align: center;
      animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      color: #2563eb;
      margin-bottom: 25px;
      font-weight: bold;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center; /* Center input boxes */
    }

    .input-field {
      width: 90%;
      padding: 12px 14px;
      margin: 12px 0;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s ease;
    }
     .input-field:hover {
      border-color: #2563eb;
      box-shadow: 0 0 8px rgba(37, 99, 235, 0.5);
      outline: none;
      transform: scale(1.03); /* Smooth expand */
    }

    .input-field:focus {
      border-color: #2563eb;
      box-shadow: 0 0 8px rgba(37, 99, 235, 0.5);
      outline: none;
      transform: scale(1.03); /* Smooth expand */
    }

    .btn {
      width: 95%;
      padding: 12px;
      margin-top: 18px;
      background: #2563eb;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn:hover {
      background: linear-gradient(90deg, #2563eb, #1d4ed8);
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(0,0,0,0.2);
    }

    .signup-text {
      margin-top: 22px;
      font-size: 14px;
      color: #475569;
    }

    .signup-text a {
      color: #2563eb;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .signup-text a:hover {
      color: #1e3a8a;
    }
  </style>

</head>
<body>

  <div class="login-container">
    <h2>Health Centre Login</h2>
      <?php
$existsql=false;
if($_SERVER['REQUEST_METHOD']=='POST'){

    $username=$_POST['username'];
    $password=$_POST['password'];
    
   
   
    $exist="SELECT * FROM `healthcenterlogin` WHERE `username` = '$username' AND `password` = '$password'";
    $result1=mysqli_query($conn,$exist);
    $num=mysqli_num_rows($result1);

    if($num>0){
          echo "<div class='alert alert-success' role='alert'>Log in sucessfully</div>";
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['username']=$username;
          header("location:health_center_main.php");
}
 else{   
    echo "<div class='alert alert-danger' role='alert'>Invalid user name or password</div>";
 }
}
   
  
  
 
?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      <input type="text" placeholder="Username" name="username" class="input-field" required>
      <input type="password" placeholder="Password" name="password" class="input-field" required>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="signup-text">
      Don’t have an account? <a href="health_signup.php">Sign up</a>
    </div>
  </div>

</body>
</html>