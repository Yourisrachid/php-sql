<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a client</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="./clients.php">Clients List</a>
	<h1>Ajouter</h1>
	<form action="./clients.php" method="post">
		<div>
			<label for="firstName">Firstname :</label>
			<input type="text" name="firstName" value="">
		</div>
        <div>
			<label for="lastName">Lastname :</label>
			<input type="text" name="lastName" value="">
		</div>

        <div>
			<label for="birthDate">Enter a birth date</label>
			<input type="date" name="birthDate" value="">
		</div>

		<div>
			<label for="card">Fidelity Card ?</label>
			<select name="card">
				<option value="1">Yes</option>
				<option value="0" selected>No</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
