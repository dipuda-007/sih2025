<?php
session_start();

$username = $_SESSION['username'];


if (!$username) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>health center Dashboard</title>
<style>
  :root{
    --primary:#6366f1;
    --primary-dark:#4338ca;
    --secondary:#10b981;
    --bg1:#eef2ff;
    --bg2:#e0f2fe;
    --glass:rgba(255,255,255,0.65);
    --text:#0f172a;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    font-family:"Segoe UI",sans-serif;color:var(--text);
    background:linear-gradient(120deg,var(--bg1),var(--bg2));
    overflow-x:hidden;
  }

  /* floating gradient blobs */
  .blob{position:fixed;z-index:-1;filter:blur(70px);opacity:.4;border-radius:50%;}
  .b1{width:600px;height:600px;top:-150px;left:-150px;background:#a5b4fc;animation:floaty 20s ease-in-out infinite alternate;}
  .b2{width:550px;height:550px;bottom:-180px;right:-120px;background:#67e8f9;animation:floaty 25s ease-in-out infinite alternate-reverse;}

  @keyframes floaty{
    0%{transform:translate(0,0) scale(1);}
    100%{transform:translate(60px,-40px) scale(1.15);}
  }

  /* header */
  header{
    display:flex;justify-content:space-between;align-items:center;
    padding:18px 26px;backdrop-filter:blur(12px);
    background:rgba(255,255,255,.7);border-bottom:1px solid rgba(0,0,0,.05);
    animation:slideDown .8s ease forwards;
  }
  @keyframes slideDown{from{opacity:0;transform:translateY(-30px);}to{opacity:1;transform:translateY(0);}}
  .brand{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);}
  .logo{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));box-shadow:0 6px 20px rgba(99,102,241,.5);}

  .userbar{display:flex;align-items:center;gap:14px;}
  .avatar{width:38px;height:38px;border-radius:50%;display:grid;place-items:center;
          font-weight:700;color:white;background:linear-gradient(135deg,#818cf8,#6366f1);}
  .logout{border:none;padding:8px 16px;border-radius:999px;background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:#fff;font-weight:600;cursor:pointer;transition:.3s;}
  .logout:hover{transform:scale(1.05);box-shadow:0 8px 18px rgba(99,102,241,.3);}

  main{max-width:1200px;margin:26px auto;padding:0 20px;}

  /* Hero welcome */
  .hero{
    padding:28px;border-radius:22px;
    background:var(--glass);backdrop-filter:blur(15px);
    box-shadow:0 14px 34px rgba(0,0,0,.08);
    animation:fadeUp .9s ease .2s forwards;opacity:0;transform:translateY(20px);
  }
  .hero h1{font-size:30px;margin-bottom:6px;}
  .hero p{color:#475569;}

  /* grid of sections */
  .grid{margin:30px 0;display:grid;gap:22px;
        grid-template-columns:repeat(auto-fit,minmax(280px,1fr));}

  .card{
    background:rgba(255,255,255,0.9);border-radius:20px;
    padding:20px;box-shadow:0 12px 28px rgba(0,0,0,.07);
    position:relative;overflow:hidden;
    opacity:0;transform:translateY(30px) scale(.95);
    animation:fadeUp .8s ease forwards;
  }
  .card h3{color:var(--primary);margin-bottom:10px;}
  .card p{color:#334155;font-size:14px;}
  .card:hover{transform:translateY(-4px) scale(1.01);transition:.3s;}

  /* card animations with delay */
  .card:nth-child(1){animation-delay:.3s;}
  .card:nth-child(2){animation-delay:.5s;}
  .card:nth-child(3){animation-delay:.7s;}
  .card:nth-child(4){animation-delay:.9s;}
  .card:nth-child(5){animation-delay:1.1s;}
  .card:nth-child(6){animation-delay:1.3s;}

  @keyframes fadeUp{
    from{opacity:0;transform:translateY(30px) scale(.95);}
    to{opacity:1;transform:translateY(0) scale(1);}
  }

  /* footer */
  footer{text-align:center;color:#64748b;font-size:13px;padding:20px 0 40px;}
</style>
</head>
<body>
<div class="blob b1"></div>
<div class="blob b2"></div>

<header>
  <div class="brand">
    <div class="logo"></div>
    ASHA Dashboard
  </div>
  <div class="userbar">
    <div class="avatar"><?php echo strtoupper(substr($username,0,1)); ?></div>
    <div>
      <div style="font-size:12px;opacity:.7;">Health care center</div>
      <div style="font-weight:700;"><?php echo htmlspecialchars($username); ?></div>
    </div>
    <form action="logout.php" method="post"><button class="logout">Logout</button></form>
  </div>
</header>

<main>
  <section class="hero">
    <h1>Welcome back, <?php echo htmlspecialchars($username); ?> 👋</h1>
    <p>Here’s a personalized overview of your health updates and activities.</p>
  </section>

  <section class="grid">
    <div class="card">
      <h3>📝 Patient Reports</h3>
      <p>View detailed reports submitted by patients including symptoms, history, and feedback.</p>
    </div>
    <div class="card">
      <h3>📅 Upcoming Appointments</h3>
      <p>Check scheduled appointments with time, doctor name, and consultation type.</p>
    </div>
    <div class="card">
      <h3>💊 Prescriptions</h3>
      <p>Manage prescribed medicines, refill alerts, and dosage reminders.</p>
    </div>
    <div class="card">
      <h3>🔔 Notifications</h3>
      <p>Get real-time updates about lab reports, messages, and health tips.</p>
    </div>
    <div class="card">
      <h3>📊 Health Stats</h3>
      <p>Visual summary of visits, active patients, and treatment progress.</p>
    </div>
    <div class="card">
      <h3>🆘 Support & Help</h3>
      <p>Need assistance? Reach out to our support team or browse FAQs.</p>
    </div>
  </section>
</main>

<footer>
  © <?php echo date('Y'); ?> ASHA • Designed with ❤ and Animation
</footer>
</body>
</html>