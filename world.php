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
      <th>Continent</th>
      <th>Year of Independence</th>
      <th>Head of State</th>
    </tr>
    <?php foreach ($result as $row): ?>
      <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['continent'] ?></td>
      <td><?= $row['independence_year'] ?></td>
      <td><?= $row['head_of_state'] ?></td>
      </tr>
    <?php endforeach; ?>
</table>

