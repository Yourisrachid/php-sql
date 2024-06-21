<?php

// Read the Hike 


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Name</th><th>Difficulty</th><th>Distance(km)</th><th>Duration</th><th>Height Difference(m)</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "becode";
$password = "becode";
$dbname = "reunions_island";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, name, difficulty, distance, duration, height_difference FROM reunions_island.hiking");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

echo "<input type='button' name='Insert_Ad' value='Create a hike' onclick='location.href=`http://localhost/php-sql/hiking/create.php`'>";


?>





<?php

// Add a hike


$servername = "localhost";
$username = "becode";
$password = "becode";
$dbname = "weatherapp";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("INSERT INTO reunions_island.hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference)");
$stmt->execute([
  "name" => $_POST["name"],
  "difficulty" => $_POST["difficulty"],
  "distance" => $_POST["distance"],
  "duration" => $_POST["duration"],
  "height_difference" => $_POST["height_difference"]
]);

?>