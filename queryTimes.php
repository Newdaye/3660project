<html>
  <body>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
<?php

if(isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];

    $conn = new mysqli("vconroy.cs.uleth.ca",$username,$password,$username);
    if($mysqli->connect_errno) {
      echo "Connection Error!";
      exit;
    }

    $rid = 0;
    $arrtime = 0;
    $depttime = 0;

    $rid = $_POST['rid'];
    $arrtime = $_POST['arrtime'];
    $depttime = $_POST['depttime'];

    $condcounter = 0;
    $sql = "select * from TIMES";

    if(!empty($rid) or !empty($arrtime) or !empty($depttime))
    {
      $sql .= " where";
    }


    if (!empty($rid))
    {
      if($condcounter > 0)
      {
        $sql .= " and";
      }
      $sql .= " ID='$rid'";
      $condcounter++;
    }

    if (!empty($_POST['arrivesTimes']))
    {
      if($condcounter > 0)
      {
        $sql .= " and";
      }
      $sql .= " arrivals='$arrtime'";
      $condcounter++;
    }

    if (!empty($depttime))
    {
      if($condcounter > 0)
      {
        $sql .= " and";
      }
      $sql .= " departure='$depttime'";
      $condcounter++;
    }

    $result = $conn->query($sql);

    if($conn->query($sql))
    {
      echo "<table class=\"table table-striped table-hover\">";
      echo "<thead><tr>";
      echo "<th scope=\"col\">Route ID</th>";
      echo "<th scope=\"col\">Arrival Time</th>";
      echo "<th scope=\"col\">Departure Time</th>";
      echo "</tr></thead>";
      echo "<tbody>";
    }

    else {
      $err = $conn->errono;
      printf("error: %d", $err);
    }

    while($val = mysqli_fetch_array($result))
    {
      echo "<tr>";
      echo "<th scope=\"row\">$val[ID]</th>";
      echo "<td>$val[arrivals]</td>";
      echo "<td>$val[departure]</td>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "<a href=\"query_Times.php\">Return to Time Table Query</a>";


} else {
    echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>";
  }
?>
