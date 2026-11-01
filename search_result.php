<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Results</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #0066cc; }
    </style>
</head>
<body>

    <h1>Search Results</h1>

    <?php
    require_once("settings.php");

    // Connect to database
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure.</p>";
    } else {
        // Check if the model parameter is set in the URL
        if (isset($_GET['model'])) {
            // Sanitize user input to prevent SQL injection
            $model = mysqli_real_escape_string($conn, $_GET['model']);
            
            // SQL query using LIKE to search for matching car models (partial matches included)
            $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "<p>Something went wrong with the query.</p>";
            } else {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
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
                    echo "<p>🚫 No matching cars found.</p>";
                }
                mysqli_free_result($result);
            }
        } else {
            echo "<p>Please enter a model to search.</p>";
        }

        mysqli_close($conn);
    }
    ?>

    <br>
    <a href="search_form.php">Back to Search</a>

</body>
</html>