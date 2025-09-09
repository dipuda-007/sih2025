<?php
include 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Selection</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #dbeafe, #eff6ff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      display: flex;
      gap: 40px;
    }

    .card {
      background: white;
      padding: 35px 25px;
      border-radius: 18px;
      box-shadow: 0 6px 14px rgba(0,0,0,0.08);
      text-align: center;
      width: 220px;
      cursor: pointer;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .card:hover {
      transform: translateY(-12px);
      box-shadow: 0 14px 28px rgba(37, 99, 235, 0.2);
    }

    .card h2 {
      margin-bottom: 18px;
      font-size: 22px;
      font-weight: 500;/* Bold Heading */
      color: #2563eb;
      transition: color 0.3s ease;
    }

    .card:hover h2 {
      color: #1e3a8a;
    }

    .card button {
      padding: 10px 20px;
      background: #2563eb;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      /*font-weight: normal; Button normal */
      transition: background 0.4s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card button:hover {
      background: linear-gradient(90deg, #2563eb, #1d4ed8);
      transform: scale(1.08);
      box-shadow: 0 6px 14px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Health Centre</h2>
      <button onclick="redirectTo('health')">Continue</button>
    </div>
    <div class="card">
      <h2>Doctor</h2>
      <button onclick="redirectTo('doctor')">Continue</button>
    </div>
    <div class="card">
      <h2>Patient</h2>
      <button onclick="redirectTo('patient')">Continue</button>
    </div>
  </div>

  <script>
    function redirectTo(role) {
      if(role === 'health') {
        window.location.href = "health_login.php";
      }
      else if(role === 'doctor') {
        window.location.href = "doctor_login.php";
      }
      else if(role === 'patient') {
        window.location.href = "patient_login.php";
      }
    }
  </script>
</body>
</html>