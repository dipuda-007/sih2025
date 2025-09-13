<?php
header("Content-Type: application/json");

$apiKey = "AIzaSyBS9maVlbD873V0cSU4OqcSKcFkXNqN02Y";
$endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
$input = $_POST['symptom'] ?? "";

function callGeminiJSON($prompt, $apiKey) {
    global $endpoint;
    $payload = [
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ],
        "generationConfig" => [
            "responseMimeType" => "application/json"
        ]
    ];
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}

// Step 1: generate translation
$trPrompt = "Translate to simple English only. Just return: {\"translated\": \"…\"}";
$rawTr = callGeminiJSON($trPrompt . "\nSymptom: \"{$input}\"", $apiKey);

// Step 2: generate specialist suggestion
$spPrompt = <<<EOD
Given this symptom, return JSON like: {"specialist": "…"}.
Symptom: "{$input}"
Choose only one specialist from:
Cardiologist, Neurologist, Gastroenterologist,
Dermatologist, Pulmonologist, Ophthalmologist,
Orthopedic, Psychiatrist, General Physician.
EOD;
$rawSp = callGeminiJSON($spPrompt, $apiKey);

// parse JSON
$trData = json_decode($rawTr, true);
$spData = json_decode($rawSp, true);

$translated = $trData['translated'] ?? null;
$specialist = $spData['specialist'] ?? null;

$response = [
  "original" => $input,
  "translated" => $translated,
  "specialist" => $specialist
];

// add debug if missing
if ($translated === null || $specialist === null) {
  $response['debug'] = [
    'translation_raw' => $rawTr,
    'specialist_raw' => $rawSp
  ];
}

echo json_encode($response, JSON_PRETTY_PRINT);
