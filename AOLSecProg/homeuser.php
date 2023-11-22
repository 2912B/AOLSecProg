<?php
    session_start();

    if($_SESSION['is_login'] !== true){
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNook</title>

    <link rel="stylesheet" href="assets/homeuser.css">
    <link rel="stylesheet" href="assets/tablestyle.css">
    <link rel="stylesheet" href="assets/navbar.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="kiri">
            <a href="">BookNook</a>
        </div>

        <div class="kanan">
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Home User Page -->
    <div class="body">
        <div class="library">Library</div>
        <a href="publishform.php">Publish Book</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <td>Judul Buku</td>
                    <td>Tahun Terbit</td>
                    <td>Genre</td>
                    <td>Jumlah Halaman</td>
                </tr>
            </thead>
            <tbody>
                <?php
                require "config/connectiontable.php";

                $stmt = $data->prepare("SELECT * FROM library");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row["Judul"];?></td>
                        <td><?php echo $row["Tahun_Terbit"];?></td>
                        <td><?php echo $row["Genre"];?></td>
                        <td><?php echo $row["Jumlah_Halaman"];?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>