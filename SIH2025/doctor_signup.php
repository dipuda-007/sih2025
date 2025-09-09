<?php
include 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Sign Up</title>
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

    .signup-container {
      background: white;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      width: 380px;
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

    .login-text {
      margin-top: 22px;
      font-size: 14px;
      color: #475569;
    }

    .login-text a {
      color: #2563eb;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .login-text a:hover {
      color: #1e3a8a;
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <?php
 
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $upassword=$_POST['upassword'];
    $specialist=$_POST['specialist'];
    $sql="SELECT * FROM `doctorlogin` WHERE `username` = '$username'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==0){
      if($password==$upassword){
        $sql1="INSERT INTO `doctorlogin` ( `name`, `email`, `password`, `username`,`specialist`) VALUES ( '$name', '$email', '$password', '$username','$specialist')";
        $result1=mysqli_query($conn,$sql1);
        if($result1){
          echo '<div class="alert alert-success" role="alert">
  Account created ..............
</div>';
        }
      }
      else{
        echo '<div class="alert alert-warning" role="alert">
  confirm password is not matched with the password
</div>';
      }
    }
    if($num>0){
      echo '<div class="alert alert-danger" role="alert">
  username already exist
</div>';
    }
  }
 
  ?>
    <h2>Doctor Sign Up</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      
      <input type="text" placeholder="Full Name" name="name" class="input-field" required>
      <input type="email" placeholder="Email Address" name="email" class="input-field" required>
      <input type="text" placeholder="Username" name="username" class="input-field" required>
      <input type="password" placeholder="Password" name="password" class="input-field" required>
      <input type="text" placeholder="specialist" name="specialist" class="input-field" required>
      <input type="password" placeholder="Confirm Password" name="upassword" class="input-field" required>
      <button type="submit" class="btn">Sign Up</button>
    </form>
    <div class="login-text">
      Already have an account? <a href="doctor_login.php">Login</a>
    </div>
  </div>

</body>
</html>