CREATE TABLE gallery_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert your existing images
INSERT INTO gallery_images (filename, alt_text) VALUES
('dessin1.jpg', 'Dessin 1'),
('dessin2.jpg', 'Dessin 2'),
('dessin3.jpg', 'Dessin 3'),
('dessin4.jpg', 'Dessin 4'),
('dessin5.jpg', 'Dessin 5'),
('dessin6.jpg', 'Dessin 6'),
('dessin7.jpg', 'Dessin 7'),
('dessin8.jpg', 'Dessin 8');
