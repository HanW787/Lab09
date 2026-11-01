<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Car Model</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { margin-top: 20px; }
        label { font-weight: bold; margin-right: 10px; }
        input[type="text"] { padding: 8px; width: 250px; }
        input[type="submit"] { padding: 8px 15px; }
    </style>
</head>
<body>

    <h1>Search for a Car Model</h1>

    <!-- Form uses GET method to send input to search_result.php -->
    <form action="search_result.php" method="GET">
        <label for="model">Car Model:</label>
        <input type="text" id="model" name="model" required>
        <input type="submit" value="Search">
    </form>

</body>
</html>