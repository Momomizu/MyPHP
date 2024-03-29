<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Show all rows from Postgres Database";

//Refer to database
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
//your sql query
$sql = "SELECT studentname, course FROM RegisterCourse";

$stmt = $pdo -> prepare($sql);

//execute the query on the server and return the result set
$stmt -> setFetchMode (PFO::FETCH_ASSOC);
$stmt -> execute();
$resultSet = $stmt -> fetchAll();

//display the data
?>
<ul>
	<?php
		foreach ($resultSet as $row) {
			echo "<li>" . $row["studentname"] . '--' . $row["course"] . "</li>";
		}
	?>
</ul>

</body>
</html>