<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "datanike";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$searchKeyword = "";
if (isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $sql = "SELECT * FROM websites WHERE title LIKE '%$searchKeyword%'";
} else {
    $sql = "SELECT * FROM websites";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tugas datanike</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        form {
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>

<h2>Search Website Data</h2>
<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by title..." value="<?php echo htmlspecialchars($searchKeyword); ?>">
    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>URL</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td><a href='" . htmlspecialchars($row['url']) . "' target='_blank'>" . htmlspecialchars($row['url']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>"; 
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>