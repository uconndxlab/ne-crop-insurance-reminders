<?php
session_start();

// Include the functions.php file
require_once('functions.php');

global $db;

// Now you can use the $db variable
$stmt = $db->prepare("SELECT * FROM users");
$result = $stmt->execute();

$user_id = $_SESSION['user_id'];

// Get user input
$current_password = $_POST['current_password'];
$new_password = $_POST['password'];
$new_password_confirm = $_POST['password_confirm'];

// Fetch the current password for the user from the database
// Assuming you have a PDO instance $db
$stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bindValue(1, $user_id);
$result = $stmt->execute();

// Fetch the result as an associative array
$row = $result->fetchArray(SQLITE3_ASSOC);
$stored_password = $row['password'];

// Verify the current password
if (!password_verify($current_password, $stored_password)) {
    $_SESSION['error'] = "Current password is incorrect";
    header("Location: /profile");
    exit;
}

// Verify the new passwords match
if ($new_password !== $new_password_confirm) {
    $_SESSION['error'] = "New passwords do not match";
    header("Location: /profile");
    exit;
}

// Hash the new password
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update the password in the database
$stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bindValue(1, $hashed_password);
$stmt->bindValue(2, $user_id);
$stmt->execute();

$_SESSION['success'] = "Password changed successfully";
header("Location: /profile");
?>