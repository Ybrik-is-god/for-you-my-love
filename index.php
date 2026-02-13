<?php
require 'config.php';

// Fetch images from database
$result = $conn->query("SELECT * FROM gallery_images ORDER BY created_at DESC");
$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>for you 💙</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- ... (header and other sections remain the same) ... -->

    <section>
        <h2>Gallery of Love 💙</h2>
        <button onclick="openAddImageModal()">➕ Add Image</button>
        <div class="album" id="gallery">
            <?php foreach ($images as $image): ?>
                <div class="gallery-item" data-id="<?php echo $image['id']; ?>">
                    <img src="<?php echo htmlspecialchars($image['filename']); ?>" 
                         alt="<?php echo htmlspecialchars($image['alt_text']); ?>">
                    <button class="delete-btn" onclick="deleteImage(<?php echo $image['id']; ?>)">❌</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Modal for adding images -->
    <div id="addImageModal" class="modal hidden">
        <div class="modal-content">
            <span class="close" onclick="closeAddImageModal()">&times;</span>
            <h3>Add New Image</h3>
            <form id="addImageForm">
                <input type="text" id="filename" placeholder="Image filename (e.g., dessin9.jpg)" required>
                <input type="text" id="altText" placeholder="Alt text" required>
                <button type="submit">Add Image</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
