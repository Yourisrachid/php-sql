<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Ville</th><th>Haut</th><th>Bas</th></tr>";

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
$dbname = "weatherapp";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM weatherapp.Météo");
  $sql = "INSERT INTO weatherapp.Météo VALUES ('$city', '$high', '$low')";
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

echo "<form method='post'>
<label for='city'> Enter a city name : </label>
<input type='text' name='city'><br>

<label for='high'> Enter a high temp : </label>
<input type='integer' name='high'><br>

<label for='low'> Enter a low temp : </label>
<input type='integer' name='low'><br>

<button type='submit' value='Submit'> Submit </button></form>";


?>

<?php
if(isset($_POST['submit']))
{
echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php
$servername = "localhost";
$username = "becode";
$password = "becode";
$dbname = "weatherapp";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("INSERT INTO weatherapp.Météo (ville, haut, bas) VALUES (:city, :high, :low)");
$stmt->execute([
  "city" => $_POST["city"],
  "high" => $_POST["high"],
  "low" => $_POST["low"]
]);