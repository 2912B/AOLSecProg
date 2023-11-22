CREATE TABLE users (
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Password VARCHAR(100) NOT NULL
);

CREATE TABLE library (
    Book_ID INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(100) NOT NULL,
    Tahun_Terbit VARCHAR(50) NOT NULL,
    Genre VARCHAR(50) NOT NULL,
    Jumlah_Halaman INT NOT NULL
);

INSERT INTO users VALUES 
(1, 'admin', 'admin@gmail.com', 'admin123'),
(2, 'Benny', 'benny@gmail.com', 'benny123');

INSERT INTO library VALUES 
(1, 'Harry Potter', '2000', 'Fantasy', '500');


