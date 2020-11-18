<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country=filter_var($_REQUEST['country'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$context=filter_var($_REQUEST['context'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$searchby = "none";

if ($context != "cities"){
  if ($country != null || $country != ""){
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $searchby = "con";
    }else{
      $stmt = $conn->query("SELECT * FROM countries");
      if ($stmt != null || $stmt != ""){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $searchby = "con";
      }else{
        $searchby = "none";
        $result = "Not found.";
    }
  }
}


if ($context == "cities"){
  if ($country != null || $country != ""){
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$country%'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $searchby = "cit";
  }else{
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code;");
    if ($stmt != null || $stmt != ""){
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
      $result = "Not found.";
    }
  }
}
?>

<?php if ($searchby == "con"):?>
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
<?php endif; ?>

<?php if ($searchby == "cit"): ?>
  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
    <?php foreach ($result as $row): ?>
      <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['population'] ?></td>
      </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<?php if ($searchby == "none" && $result == "Not found."): ?>
  <p><?= $result ?></p>
<?php endif; ?>