<?php
session_start();

$correct_password = 'YahahahaHayuu';

$show_form = true;
$message = '';
$json_output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';
    if ($input === $correct_password) {
        $show_form = false;

        $legacy_salt_value = "SuperSecretLegacySaltXYZ";

        $metadata = [
            "api_version" => "1.0.1-beta",
            "status" => "operational",
            "last_updated" => "2025-07-29",
            "security_info" => [
                "hashing_algorithm_for_legacy_data" => "MD5",
                "deprecated_hashing_notes" => "MD5 is considered insecure for password storage. This is only for legacy identifiers.",
                "legacy_data_salt_flag" => "WebSec{th3_s4lt_",
                "legacy_data_raw_salt_value" => $legacy_salt_value,
                "how_legacy_hash_is_computed" => "concatenates_secret_then_salt",
                "common_secret_format_hint" => "secret often starts with _ and ends with }",
                "secret_keyword_hint" => "think_about_the_state_of_a_completed_challenge_and_a_broken_hash",
                "secret_character_set_hint" => "consists_of_lowercase_letters_numbers_and_underscores",
                "secret_length_hint" => 13,
                "next_generation_security_module" => "/api/v2/secure_auth.php"
            ],
            "endpoints" => [
                "/api/users",
                "/api/courses",
                "/api/transactions"
            ]
        ];

        header('Content-Type: application/json');
        $json_output = json_encode($metadata, JSON_PRETTY_PRINT);
        echo $json_output;
        exit;
    } else {
        $message = 'Password salah kocak, coba 2000 tahun lagi (bercanda).';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hayolo Ada Password</title>
    <style>
        body {font-family:Arial,Helvetica,sans-serif;background:#f4f4f4;margin:0;padding:30px;}
        .container {max-width:400px;margin:auto;background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.1);}
        h1 {font-size:1.6rem;margin-bottom:1rem;}
        input[type=password] {width:100%;padding:8px;margin:10px 0;border:1px solid #ccc;border-radius:4px;}
        button {background:#007bff;color:#fff;padding:10px 15px;border:none;border-radius:4px;cursor:pointer;}
        button:hover {background:#0056b3;}
        .msg {color:#d00;margin-top:10px;}
    </style>
</head>
<body>
<?php if ($show_form): ?>
    <div class="container">
        <h1>🔐 Hayolo Ada Password</h1>
        <form method="POST" action="">
            <label for="pwd">Enter password:</label>
            <input type="password" id="pwd" name="pwd" required>
            <button type="submit">Submit</button>
        </form>
        <?php if ($message): ?>
            <div class="msg"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
</body>
</html>