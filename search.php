<?php
require 'db_connect.php';

$student  = null;
$searched = false;

if (!empty($_GET["student_id"])) {
    $searched   = true;
    $student_id = htmlspecialchars(trim($_GET["student_id"]));

    $stmt = $conn->prepare(
        "SELECT name, email, course, phone
         FROM students WHERE student_id = ?"
    );
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-md p-10 max-w-md w-full">

    <h2 class="text-2xl font-bold text-green-700 mb-6 border-b pb-2">🔍 Search Result</h2>

    <?php if ($student): ?>
        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-2 font-semibold text-gray-600 w-32">Name</td>
                <td class="py-2 text-gray-800"><?= $student["name"] ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 font-semibold text-gray-600">Email</td>
                <td class="py-2 text-gray-800"><?= $student["email"] ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 font-semibold text-gray-600">Course</td>
                <td class="py-2 text-gray-800"><?= $student["course"] ?></td>
            </tr>
            <tr>
                <td class="py-2 font-semibold text-gray-600">Phone</td>
                <td class="py-2 text-gray-800"><?= $student["phone"] ?></td>
            </tr>
        </table>

    <?php elseif ($searched): ?>
        <div class="text-center py-6">
            <div class="text-4xl mb-3">🔎</div>
            <p class="text-gray-500">No student found with that ID.</p>
        </div>
    <?php endif; ?>

    <div class="mt-6">
        <a href="index.html"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition">
            ← Back to Portal
        </a>
    </div>
</div>
</body>
</html>