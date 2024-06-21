<?php


// CLIENTS --------------------------------------------------------




echo "CLIENTS";




echo "<table style='border: solid 1px black;'>";
echo "<tr><th>ID</th><th>LastName</th><th>FirstName</th><th>BirthDate</th><th>Card</th><th>CardNumber</th></tr>";

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
$dbname = "colyseum";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, lastName, firstName, birthDate, card, cardNumber FROM colyseum.clients");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


echo "</table>";



// SHOWS -----------------------------------------------------------


echo "SHOWS LIST";




echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Date</th><th>Duration</th><th>Genres</th><th>Performer</th><th>Starting Time</th><th>Title</th></tr>";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql  = "SELECT date, duration, genres.genre, performer, startTime, title
            FROM shows
            JOIN genres ON genres.id = shows.firstGenresId";
  $stmt = $conn->prepare($sql);
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




// FIRST 20 CLIENTS ----------------------------------------------------


echo "FIRST 20 CLIENTS";




echo "<table style='border: solid 1px black;'>";
echo "<tr><th>ID</th><th>LastName</th><th>FirstName</th><th>BirthDate</th><th>Card</th><th>CardNumber</th></tr>";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, lastName, firstName, birthDate, card, cardNumber FROM colyseum.clients WHERE id<21");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


echo "</table>";





// FIDELITY CARD CLIENTS -----------------------------------------------------------



echo "FIDELITY CARD CLIENTS";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>ID</th><th>LastName</th><th>FirstName</th><th>BirthDate</th><th>CardNumber</th></tr>";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, lastName, firstName, birthDate, cardNumber FROM colyseum.clients WHERE Card=1");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


echo "</table>";




// NAMES STARTING BY 'M' ---------------------------------------------------------





echo "CLIENTS WITH M AS STARTING LETTER IN LASTNAME";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>LastName</th><th>FirstName</th></tr>";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT lastName, firstName FROM colyseum.clients WHERE lastName LIKE 'M%'");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


echo "</table>";






// SHOWS ORDERED BY ALPHABETICAL ORDER ----------------------------------------


echo "SHOWS ALPHABETICAL ORDER";
echo "<br>";



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT title, performer, date, startTime FROM colyseum.shows ORDER BY title");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt as $var) {
    echo $var["title"];
    echo $var["performer"];
    echo ", le ";
    echo $var["date"];
    echo " à ";
    echo $var["startTime"];
    echo"<br>";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}





// CLIENTS DISPLAY VERSION STRINGS ----------------------------


echo "<br>";
echo "CLIENTS DISPLAY VERSION STRINGS";
echo "<br>";



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, lastName, firstName, birthDate, card, cardNumber FROM colyseum.clients");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt as $var) {
    echo "Nom : $var[lastName]";
    echo '<br>';
    echo "Prénom : $var[firstName]";
    echo '<br>';
    echo "Date de Naissance : $var[birthDate]";
    echo '<br>';
    if ($var['card'] === 1) {
      echo "Yes";
    } else {
      echo "No";
    }
    echo '<br>';
    echo "Numéro de Carte : $var[cardNumber]";
    echo '<br>';
    echo '
    ------------------------------------
    ';
    echo '<br>';
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}







?>




