<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country=filter_var($_REQUEST['country'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if ($country != null || $country != "" ){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
else{
  $stmt = $conn->query("SELECT * FROM countries");
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<table>
    <tr>
      <th>Name</th>
    </tr>
    <?php foreach ($result as $row): ?>
      <tr>
      <td><?= $row['name'] ?></td>
      </tr>
    <?php endforeach; ?>
</table>

