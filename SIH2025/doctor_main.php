<?php
session_start();

$username = $_SESSION['username'] ;
if (!$username) {
  header("Location: doctor_login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Doctor Dashboard</title>
<style>
  :root{
    --primary:#0ea5e9;
    --primary-dark:#0369a1;
    --bg1:#e0f2fe;
    --bg2:#f0f9ff;
    --glass:rgba(255,255,255,0.65);
    --text:#0f172a;
  }
  *{margin:0;padding:0;box-sizing:border-box}
  body{font-family:"Segoe UI",sans-serif;color:var(--text);
       background:linear-gradient(120deg,var(--bg1),var(--bg2));overflow-x:hidden;}

  .blob{position:fixed;z-index:-1;filter:blur(70px);opacity:.4;border-radius:50%;}
  .b1{width:600px;height:600px;top:-150px;left:-150px;background:#38bdf8;animation:floaty 20s infinite alternate;}
  .b2{width:500px;height:500px;bottom:-150px;right:-100px;background:#bae6fd;animation:floaty 25s infinite alternate-reverse;}
  @keyframes floaty{from{transform:translate(0,0) scale(1);}to{transform:translate(60px,-40px) scale(1.15);}}

  header{display:flex;justify-content:space-between;align-items:center;
          padding:18px 26px;backdrop-filter:blur(12px);
          background:rgba(255,255,255,.7);border-bottom:1px solid rgba(0,0,0,.05);
          animation:slideDown .8s ease;}
  @keyframes slideDown{from{opacity:0;transform:translateY(-30px);}to{opacity:1;transform:translateY(0);}}
  .brand{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);}
  .logo{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));box-shadow:0 6px 20px rgba(14,165,233,.4);}

  .userbar{display:flex;align-items:center;gap:14px;}
  .avatar{width:38px;height:38px;border-radius:50%;display:grid;place-items:center;
          font-weight:700;color:white;background:linear-gradient(135deg,#38bdf8,#0284c7);}
  .logout{border:none;padding:8px 16px;border-radius:999px;background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:#fff;font-weight:600;cursor:pointer;transition:.3s;}
  .logout:hover{transform:scale(1.05);box-shadow:0 8px 18px rgba(14,165,233,.3);}

  main{max-width:1200px;margin:26px auto;padding:0 20px;}
  .hero{padding:28px;border-radius:22px;background:var(--glass);backdrop-filter:blur(15px);box-shadow:0 14px 34px rgba(0,0,0,.08);animation:fadeUp .9s ease .2s forwards;opacity:0;transform:translateY(20px);}
  .hero h1{font-size:30px;margin-bottom:6px;}
  .hero p{color:#475569;}

  .grid{margin:30px 0;display:grid;gap:22px;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));}
  .card{background:rgba(255,255,255,0.9);border-radius:20px;padding:20px;box-shadow:0 12px 28px rgba(0,0,0,.07);opacity:0;transform:translateY(30px) scale(.95);animation:fadeUp .8s ease forwards;}
  .card h3{color:var(--primary);margin-bottom:10px;}
  .card p{color:#334155;font-size:14px;}
  .card:hover{transform:translateY(-4px) scale(1.01);transition:.3s;}
  .card:nth-child(1){animation-delay:.3s;}
  .card:nth-child(2){animation-delay:.5s;}
  .card:nth-child(3){animation-delay:.7s;}
  .card:nth-child(4){animation-delay:.9s;}
  .card:nth-child(5){animation-delay:1.1s;}
  .card:nth-child(6){animation-delay:1.3s;}
  @keyframes fadeUp{from{opacity:0;transform:translateY(30px) scale(.95);}to{opacity:1;transform:translateY(0) scale(1);}}

  footer{text-align:center;color:#64748b;font-size:13px;padding:20px 0 40px;}
</style>
</head>
<body>
<div class="blob b1"></div>
<div class="blob b2"></div>

<header>
  <div class="brand"><div class="logo"></div>ASHA • Doctor</div>
  <div class="userbar">
    <div class="avatar"><?php echo strtoupper(substr($username,0,1)); ?></div>
    <div>
      <div style="font-size:12px;opacity:.7;">Doctor</div>
      <div style="font-weight:700;"><?php echo htmlspecialchars($username); ?></div>
    </div>
    <form action="logout.php" method="post"><button class="logout">Logout</button></form>
  </div>
</header>

<main>
  <section class="hero">
    <h1>Hello Dr. <?php echo htmlspecialchars($username); ?> 👨‍⚕</h1>
    <p>Here’s your professional dashboard with today’s schedule and patient updates.</p>
  </section>

  <section class="grid">
    <div class="card">
      <h3>👥 My Patients</h3>
      <p>See your assigned patients with quick access to their medical history.</p>
    </div>
    <div class="card">
      <h3>📅 Today’s Appointments</h3>
      <p>Check today’s appointments and upcoming consultations in one place.</p>
    </div>
    <div class="card">
      <h3>📝 Prescriptions</h3>
      <p>Review, approve, and generate prescriptions for patients securely.</p>
    </div>
    <div class="card">
      <h3>📊 Analytics</h3>
      <p>Track patient recovery rates, case statistics, and efficiency reports.</p>
    </div>
    <div class="card">
      <h3>💬 Messages</h3>
      <p>Communicate with patients and other doctors in real-time.</p>
    </div>
    <div class="card">
      <h3>⚙ Settings</h3>
      <p>Update your profile, availability hours, and account preferences.</p>
    </div>
  </section>
</main>

<footer>
  © <?php echo date('Y'); ?> ASHA • Doctor Dashboard
</footer>
</body>
</html>