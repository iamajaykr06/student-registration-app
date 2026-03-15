<?php
require 'db_connect.php';

$success    = false;
$student_id = "";
$name       = "";
$error_msg  = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $student_id = htmlspecialchars(trim($_POST["student_id"]));
    $name       = htmlspecialchars(trim($_POST["name"]));
    $email      = htmlspecialchars(trim($_POST["email"]));
    $course     = htmlspecialchars(trim($_POST["course"]));
    $phone      = htmlspecialchars(trim($_POST["phone"]));

    $stmt = $conn->prepare(
        "INSERT INTO students (student_id, name, email, course, phone)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssss", $student_id, $name, $email, $course, $phone);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $error_msg = "Student ID already exists or a database error occurred.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-md p-10 max-w-md w-full text-center">

    <?php if ($success): ?>
        <div class="text-5xl mb-4">✅</div>
        <h2 class="text-2xl font-bold text-green-700 mb-2">Student record inserted successfully.</h2>
        <p class="text-gray-500 mb-6"><strong><?= $student_id ?></strong> — <?= $name ?> has been registered.</p>
    <?php else: ?>
        <div class="text-5xl mb-4">❌</div>
        <h2 class="text-2xl font-bold text-red-600 mb-2">Registration Failed</h2>
        <p class="text-gray-500 mb-6"><?= $error_msg ?></p>
    <?php endif; ?>

    <a href="index.html"
       class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg transition">
        ← Back to Portal
    </a>
</div>
</body>
</html>