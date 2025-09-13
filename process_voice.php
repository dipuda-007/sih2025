 <?php
header("Content-Type: application/json");

// Replace with your real Gemini API key
$apiKey = "AIzaSyBS9maVlbD873V0cSU4OqcSKcFkXNqN02Y";

// Gemini endpoint
$endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

// Step 1 – Receive patient input
$input = $_POST['symptom'] ?? "";

// Helper to call Gemini
function callGemini($prompt, $apiKey) {
    global $endpoint;
    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ];
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $resp = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($resp, true);
    return $obj['candidates'][0]['content']['parts'][0]['text'] ?? "";
}

// Step 2 – Translate to English
$translatePrompt = "Translate the following patient symptom into clear English: \"{$input}\"";
$english = callGemini($translatePrompt, $apiKey);

// Step 3 – Detect specialist
$specialtyPrompt = <<<EOD
You are a medical triage assistant. Given this symptom: "{$english}", reply with exactly one doctor specialty from:
Cardiologist, Neurologist, Gastroenterologist, Dermatologist, Pulmonologist, Ophthalmologist, Orthopedic, Psychiatrist, General Physician.
Just reply the specialty name.
EOD;
$specialty = callGemini($specialtyPrompt, $apiKey);

// Output
echo json_encode([
  "original" => $input,
  "english" => trim($english),
  "specialty" => trim($specialty)
]);

?> 


