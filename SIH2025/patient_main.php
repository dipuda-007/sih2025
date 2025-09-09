<?php
session_start();

$username = $_SESSION['username'];
if (!$username) {
  header("Location: patient_login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patient Dashboard</title>
<style>
  :root{
    --primary:#22c55e;
    --primary-dark:#15803d;
    --bg1:#dcfce7;
    --bg2:#f0fdf4;
    --glass:rgba(255,255,255,0.65);
    --text:#0f172a;
  }
  *{margin:0;padding:0;box-sizing:border-box}
  body{font-family:"Segoe UI",sans-serif;color:var(--text);
       background:linear-gradient(120deg,var(--bg1),var(--bg2));overflow-x:hidden;}

  .blob{position:fixed;z-index:-1;filter:blur(70px);opacity:.4;border-radius:50%;}
  .b1{width:600px;height:600px;top:-150px;left:-150px;background:#86efac;animation:floaty 20s infinite alternate;}
  .b2{width:500px;height:500px;bottom:-150px;right:-100px;background:#bbf7d0;animation:floaty 25s infinite alternate-reverse;}
  @keyframes floaty{from{transform:translate(0,0) scale(1);}to{transform:translate(60px,-40px) scale(1.15);}}

  header{display:flex;justify-content:space-between;align-items:center;
          padding:18px 26px;backdrop-filter:blur(12px);
          background:rgba(255,255,255,.7);border-bottom:1px solid rgba(0,0,0,.05);
          animation:slideDown .8s ease;}
  @keyframes slideDown{from{opacity:0;transform:translateY(-30px);}to{opacity:1;transform:translateY(0);}}
  .brand{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);}
  .logo{width:40px;height:40px;border-radius:12px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));box-shadow:0 6px 20px rgba(34,197,94,.4);}

  .userbar{display:flex;align-items:center;gap:14px;}
  .avatar{width:38px;height:38px;border-radius:50%;display:grid;place-items:center;
          font-weight:700;color:white;background:linear-gradient(135deg,#4ade80,#22c55e);}
  .logout{border:none;padding:8px 16px;border-radius:999px;background:linear-gradient(90deg,var(--primary),var(--primary-dark));color:#fff;font-weight:600;cursor:pointer;transition:.3s;}
  .logout:hover{transform:scale(1.05);box-shadow:0 8px 18px rgba(34,197,94,.3);}

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
  .card:nth-child(7){animation-delay:1.3s;}
  @keyframes fadeUp{from{opacity:0;transform:translateY(30px) scale(.95);}to{opacity:1;transform:translateY(0) scale(1);}}

  footer{text-align:center;color:#64748b;font-size:13px;padding:20px 0 40px;}
</style>
</head>
<body>
<div class="blob b1"></div>
<div class="blob b2"></div>

<header>
  <div class="brand"><div class="logo"></div>ASHA • Patient</div>
  <div class="userbar">
    <div class="avatar"><?php echo strtoupper(substr($username,0,1)); ?></div>
    <div>
      <div style="font-size:12px;opacity:.7;">Patient</div>
      <div style="font-weight:700;"><?php echo htmlspecialchars($username); ?></div>
    </div>
    <form action="logout.php" method="post"><button class="logout">Logout</button></form>
  </div>
</header>

<main>
  <section class="hero">
    <h1>Welcome <?php echo htmlspecialchars($username); ?> 🌿</h1>
    <p>This is your personal health dashboard. Track your appointments, prescriptions, and more.</p>
  </section>

  <section class="grid">
    <div class="card">
      <h3>📅 My Appointments</h3>
      <p>View and manage your upcoming appointments with doctors and health centres.</p>
    </div>
    <div class="card">
      <h3>💊 My Prescriptions</h3>
      <p>Check prescribed medicines, dosage details, and refill reminders.</p>
    </div>
    <div class="card">
      <h3>📝 My Reports</h3>
      <p>Upload or view your test reports and past medical history in one place.</p>
    </div>
    <div class="card">
      <h3>💬 Messages</h3>
      <p>Communicate with your doctor directly and ask health-related questions.</p>
    </div>
    <div class="card">
      <h3>🌱 Health Tips</h3>
      <p>Receive personalized wellness tips, diet advice, and healthy lifestyle suggestions.</p>
    </div>
    <div class="card">
      <h3>⚙ Settings</h3>
      <p>Update your profile, contact details, and security preferences.</p>
    </div>
    <!-- 🔊 Voice Input Section -->
     <div class="card" style="justify-content:space-between;align-items:center;">
<aside class="voice-panel" style=" background:#fff;border-radius:12px;padding:16px;
       box-shadow:0 8px 20px rgba(2,6,23,.06);display:flex;flex-direction:column;gap:10px;max-width:400px">

  <div style="display:flex;justify-content:space-between;align-items:center">
    <div style="font-weight:700">Voice Symptom Input</div>
    <select id="langSelect" style="padding:6px;border-radius:8px;border:1px solid #dbeede;background:#fbfffc">
      <option value="auto">Auto</option>
      <option value="bn-BD">বাংলা</option>
      <option value="en-US">English</option>
      <option value="hi-IN">हिन्दी</option>
    </select>
  </div>

  <div style="gap:8px;align-items:center; margin:10px;">
    <button id="micBtn" style="flex:1;display:flex;align-items:center;justify-content:center;
            padding:12px;border-radius:12px;border:none;
            background:linear-gradient(90deg,#22c55e,#15803d);color:#fff;font-weight:700;cursor:pointer">
      🎤 Start Listening
    </button>
    <div id="indicator" style="font-size:13px;color:#065f46;display:none">Listening…</div>
  </div>

  <textarea id="transcript" placeholder="Your speech will appear here..." readonly
    style="font-family:'Segoe UI',sans-serif ; font-weight:700; width:100%;min-height:100px;padding:10px;border-radius:10px;border:1px solid #e6f4ea;resize:vertical"></textarea>

  <button id="sendBtn" disabled
    style="padding:10px;border-radius:10px;border:none;background:linear-gradient(90deg,#059669,#10b981);
           color:#fff;font-weight:700;cursor:pointer">
    Send to Doctor
  </button>
</aside>
</div>
</section>
<script>
const micBtn = document.getElementById('micBtn');
const indicator = document.getElementById('indicator');
const transcriptEl = document.getElementById('transcript');
const sendBtn = document.getElementById('sendBtn');
const langSelect = document.getElementById('langSelect');

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
if(!SpeechRecognition){
  micBtn.disabled = true;
  micBtn.textContent = "Not Supported";
} else {
  let recognition = new SpeechRecognition();
  recognition.continuous = false;
  recognition.interimResults = true;

  recognition.onstart = () => {
    micBtn.textContent = "Listening...";
    indicator.style.display = "block";
    transcriptEl.value = "";
  };

  recognition.onresult = (event) => {
    let finalText = "";
    let interim = "";
    for (let i = event.resultIndex; i < event.results.length; i++) {
      const text = event.results[i][0].transcript;
      if (event.results[i].isFinal) {
        finalText += text + " ";
      } else {
        interim += text;
      }
    }
    transcriptEl.value = finalText || interim;
    sendBtn.disabled = !finalText.trim();
  };

  recognition.onend = () => {
    micBtn.textContent = "🎤 Start Listening";
    indicator.style.display = "none";
  };

  micBtn.addEventListener("click", () => {
    recognition.lang = (langSelect.value === "auto") ? (navigator.language || "en-US") : langSelect.value;
    recognition.start();
  });
}

sendBtn.addEventListener("click", () => {
  const text = transcriptEl.value.trim();

  if (!text) {
    alert("No voice input detected!");
    return;
  }

  // Backend e pathano
 fetch("process_voice.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "symptom=" + encodeURIComponent(text)
})
.then(res => res.json())   // <-- eta change korlam (আগে text() chilo)
.then(data => {
    console.log("Server response:", data);
    alert("Translated: " + data.english + "\nSuggested Specialist: " + data.specialty);
})
.catch(err => {
    console.error("Error:", err);
    alert("Something went wrong!");
});
});
</script>



  
</main>

<footer>
  © <?php echo date('Y'); ?> ASHA • Patient Dashboard
</footer>
</body>
</html>


