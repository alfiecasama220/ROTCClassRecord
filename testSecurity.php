<?php

// Define project directory
$projectDir = __DIR__;

// Helper function to display messages
function showMessage($message, $type = "info") {
    $color = [
        "info" => "\033[34m",  // Blue
        "success" => "\033[32m", // Green
        "warning" => "\033[33m", // Yellow
        "danger" => "\033[31m"  // Red
    ];
    echo $color[$type] . $message . "\033[0m" . PHP_EOL;
}

showMessage("Starting Laravel Security Check...\n", "info");

// Check for environment exposure
if (file_exists($projectDir . '/.env')) {
    showMessage("[WARNING] .env file found in the root directory. Ensure it's not publicly accessible.", "warning");
}

// Check debug mode
$envPath = $projectDir . '/.env';
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    if (preg_match('/APP_DEBUG=true/', $envContent)) {
        showMessage("[DANGER] APP_DEBUG is enabled. Set it to false in production environments.", "danger");
    } else {
        showMessage("[SUCCESS] APP_DEBUG is disabled.", "success");
    }
} else {
    showMessage("[INFO] .env file not found.", "info");
}

// Check for outdated packages
showMessage("\nChecking for outdated packages (requires Composer)...", "info");
exec('composer outdated 2>&1', $output, $returnVar);
if ($returnVar === 0 && !empty($output)) {
    showMessage("[INFO] Outdated packages detected:", "warning");
    echo implode("\n", $output) . PHP_EOL;
} else {
    showMessage("[SUCCESS] All packages are up-to-date.", "success");
}

// Check if public directory index exists
if (file_exists($projectDir . '/public/index.php')) {
    showMessage("[INFO] Public directory structure looks correct.", "success");
} else {
    showMessage("[DANGER] public/index.php is missing. Ensure your web server points to the public directory.", "danger");
}

showMessage("\nLaravel Security Check Completed.", "info");
?>
