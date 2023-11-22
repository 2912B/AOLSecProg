<?php
    session_start();
    session_regenerate_id();

    if($_SESSION['is_admin'] !== true){
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/homeuser.css">
    <link rel="stylesheet" href="assets/tablestyle.css">
    <link rel="stylesheet" href="assets/navbar.css">
    <title>BookNook</title>
</head>
<body>
    <!-- NavBar -->
    <nav class="navbar">
        <div class="kiri">
            <a href="">BookNook</a>
        </div>

        <div class="kanan">
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Home Admin Table -->
    <div class="body">
        <div class="library">Library</div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Judul Buku</td>
                    <td>Tahun Terbit</td>
                    <td>Genre</td>
                    <td>Jumlah Halaman</td>
                    <td>Action</td>
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
                        <td><?php echo $row["Book_ID"];?></td>
                        <td><?php echo $row["Judul"];?></td>
                        <td><?php echo $row["Tahun_Terbit"];?></td>
                        <td><?php echo $row["Genre"];?></td>
                        <td><?php echo $row["Jumlah_Halaman"];?></td>
                        <td>
                        <span class="action_btn">
                            <a href="edit.php?Book_ID=<?php echo $row["Book_ID"]; ?>">Edit</a>
                            <a href="delete.php?Book_ID=<?php echo $row["Book_ID"]; ?>">Hapus</a>
                        </span>
                    </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
