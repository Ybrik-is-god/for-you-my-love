<?php
require 'config.php';

// Get all images
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'get_images') {
    $result = $conn->query("SELECT * FROM gallery_images ORDER BY created_at DESC");
    $images = [];
    
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    
    header('Content-Type: application/json');
    echo json_encode($images);
    exit;
}

// Add image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add_image') {
    $filename = $conn->real_escape_string($_POST['filename']);
    $alt_text = $conn->real_escape_string($_POST['alt_text']);
    
    $query = "INSERT INTO gallery_images (filename, alt_text) VALUES ('$filename', '$alt_text')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true, 'message' => 'Image added!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
    exit;
}

// Delete image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete_image') {
    $id = intval($_POST['id']);
    
    $query = "DELETE FROM gallery_images WHERE id = $id";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true, 'message' => 'Image deleted!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
    exit;
}

$conn->close();
?>
