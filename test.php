<?php
// Path to Composer's autoload file (adjust if needed)
require_once 'vendor/autoload.php';

// Check if PHPMailer class is available
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "PHPMailer is installed and available!";
} else {
    echo "PHPMailer is not installed or not available.";
}
?>
