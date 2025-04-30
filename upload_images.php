<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["room_image"])) {
    $room_id = $_POST['room_id'];
    $target_dir = "uploads/";

    
    $new_filename = uniqid() . "_" . basename($_FILES["room_image"]["name"]);
    $image_path = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES["room_image"]["tmp_name"], $image_path)) {
        $sql = "UPDATE rooms SET image_path = '$image_path' WHERE id = $room_id";
        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully. File Path: $image_path";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}



$result = $conn->query("SELECT id, room_type FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Room Image</title>
</head>
<body>
    <h2>Upload Room Image</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="room_id">Select Room:</label>
        <select name="room_id" required>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">Room <?= $row['id'] ?> - <?= $row['room_type'] ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="room_image">Choose Image:</label>
        <input type="file" name="room_image" required>
        <br><br>
        <button type="submit">Upload</button>
        
        <a href="add_room.php" class="btn btn-primary">Back to Add Room</a>
    </form>
</body>
</html>

<?php $conn->close(); ?>
