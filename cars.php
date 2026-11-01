<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Used Car Inventory - Lab 09</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h1>Used Car Dealership Inventory</h1>

    <?php
    require_once("settings.php");

    // Attempt connection to the database
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    // Check if connection was successful
    if (!$conn) {
        echo "<p>Database connection failure.</p>";
    } else {
        $query = "SELECT * FROM cars";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something went wrong with the query.</p>";
        } else {
            // Check if there are any records returned
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Car ID</th>";
                echo "<th>Make</th>";
                echo "<th>Model</th>";
                echo "<th>Price ($)</th>";
                echo "<th>Year of Manufacture</th>";
                echo "</tr>";

                // Loop through and display each record
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                    echo "<td>$" . number_format($row['price'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>There are no cars to display.</p>";
            }

            // Free result set and close connection
            mysqli_free_result($result);
            mysqli_close($conn);
        }
    }
    ?>

</body>
</html>