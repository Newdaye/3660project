<html>
	<h1>Update Conductor</h1>
	<body>
	<h2>Which Conductor to Update</h2>
		<?php
			if(isset($_COOKIE["username"])) {
				$username = $_COOKIE["username"];
				$password = $_COOKIE["password"];
				$conn = new mysqli("vconroy.cs.uleth.ca",$username,$password,$username);

				echo "<form action=\"updateConductor.php\" method=post>";

				$sql=  "select ID, condName from CONDUCTOR";
				$result = $conn->query($sql);
				if($result->num_rows != 0) {
					echo "Conductor Name: <select name=\"ID\">";
					while($val = $result->fetch_assoc()) {
						echo "<option value='$val[ID]'>$val[condName]</option>";
					}
					echo "</select><br><br>";
				}

				echo "<input type=submit name=\"Submit\" value=\"Insert\">";
				echo "</form>";
				echo "<br><br><a href=\"main.php\">Return</a> to Home Page.";
			} else {
				echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>";
			}
		 ?>
	</body>
</html>
