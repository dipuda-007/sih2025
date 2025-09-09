<?php
include 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      color: #2563eb;
      margin-bottom: 25px;
      font-weight: bold;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
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

    .input-field:focus {
      border-color: #2563eb;
      box-shadow: 0 0 8px rgba(37, 99, 235, 0.5);
      outline: none;
      transform: scale(1.03);
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
    <?php
$existsql=false;
if($_SERVER['REQUEST_METHOD']=='POST'){

    $username=$_POST['username'];
    $password=$_POST['password'];
    
   
   
    $exist="SELECT * FROM `patientlogin` WHERE `username` = '$username' AND `password` = '$password'";
    $result1=mysqli_query($conn,$exist);
    $num=mysqli_num_rows($result1);

    if($num>0){
          echo "<div class='alert alert-success' role='alert'>Log in sucessfully</div>";
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['username']=$username;
          header("location:patient_main.php");
}
 else{   
    echo "<div class='alert alert-danger' role='alert'>Invalid user name or password</div>";
 }
}
   
  
  
 
?>
    <h2>Patient Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      <input type="text" placeholder="Username" name="username" class="input-field" required>
      <input type="password" placeholder="Password" name="password" class="input-field" required>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="signup-text">
      Don’t have an account? <a href="patient_signup.php">Sign up</a>
    </div>
  </div>

</body>
</html>