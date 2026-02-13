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
    
<section>
        <h2>Why I love you</h2>
        <p>
            I love you for the little moments, the big bursts of laughter, the silences that speak volumes, and the sweetness you bring to my life. Every day by your side is a gift I cherish. I love when you are telling me that I'm the most important thing to your eyes and that I know I can trust you.
        </p>
    </section>

    <section>
        <h2>Our story</h2>
        <p>
            This site is simply a reflection of what I feel: something sincere, unique, and filled with love. No matter the path, as long as it's traveled with you.
        </p>
    </section>

    <section>
        <h2>A message for you</h2>
        <p>
            Thank you for being you. Thank you for existing. Thank you for sharing your love. Today, tomorrow, and for a long time to come. Btw sorry in advance but you are stuck with me >:3
        </p>
        <div class="signature">— With all my love</div>
    </section>

    <section>
        <h2>A little button, for a big heart</h2>
        <button id="loveBtn" onclick="toggleLove()">Click here 💖</button>
        <div id="surprise" class="hidden">
            <p class="love-text">I love you more than words can say 💙</p>
            <img src="love.gif" alt="Gif d'amour" class="love-gif">
            <audio id="loveSound" src="Love_Sound.mp3"></audio>
            <div class="volume-control">
                <label for="volume">Volume</label>
                <input type="range" id="volume" min="0" max="1" step="0.01" value="0.7" oninput="setVolume(this.value)">
            </div>
        </div>
    </section>

    <footer>
        Made with all my heart for you and only you :3
    </footer>

    <div class="secret-message">
        <button id="secretBtn">💌 Psst… Click here</button>
    </div>

    <div id="secretContent" class="hidden">
        <p>Here is the secret content! 💙</p>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Watch the video</a>
    </div>
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

