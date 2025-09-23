<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);
    $uploadDir = 'uploads/';
    
    // Create directory if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Handle image upload
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $targetFile = $uploadDir . time() . '_' . $imageName;
    $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($imageType, $allowedTypes)) {
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Save report to file (or DB)
            $log = "Location: $location\nDescription: $description\nImage: $targetFile\nDate: " . date('Y-m-d H:i:s') . "\n\n";
            file_put_contents('reports.txt', $log, FILE_APPEND);

            echo "<h2 style='color: green; font-family: sans-serif;'>✅ Thank you! Your report has been submitted successfully.</h2>";
            echo "<a href='index.html' style='text-decoration:none;color:#00796b;'>⟵ Go back</a>";
        } else {
            echo "<h2 style='color: red;'>❌ Error uploading the image. Try again.</h2>";
        }
    } else {
        echo "<h2 style='color: red;'>❌ Invalid file type. Only JPG, PNG, GIF, or WEBP allowed.</h2>";
    }
} else {
    echo "<h2>🚫 Access Denied</h2>";
}
?>
