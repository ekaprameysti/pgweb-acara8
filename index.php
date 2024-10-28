<?php 
// Sesuaikan dengan setting MySQL 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pgweb-acara8";
// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

// Proses hapus data jika parameter id ada di URL
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM tabel_penduduk WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error menghapus data: " . $conn->error;
    }
}

// Menampilkan data
$sql = "SELECT * FROM tabel_penduduk"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) { 
    echo "<table border='1px'><tr> 
<th>Kecamatan</th> 
<th>Longitude</th> 
<th>Latitude</th> 
<th>Luas</th> 
<th>Jumlah_Penduduk</th>
<th>Aksi</th>
</tr>"; 

//Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Kecamatan"] . "</td><td>" . $row["Longitude"] . "</td><td>" . $row["Latitude"] . "</td><td>" . $row["Luas"] . "</td><td align='right'>" . $row["Jumlah_Penduduk"] . "</td><td><a href='index.php?delete_id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
    }

// Menutup tabel
    echo "</table>"; 
} else { 
    echo "0 results"; 
} 
$conn->close(); 
?> 