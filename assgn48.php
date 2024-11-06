<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Content in PHP</title>
    <style>
        body { font-family: Arial, sans-serif; }
        nav ul { list-style-type: none; padding: 0; }
        nav ul li { display: inline; margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Welcome to My Dynamic PHP Page</h1>

    <!-- Dynamic Greeting Based on Time -->
    <?php
        $hour = date("H");

        if ($hour < 12) {
            echo "<p>Good Morning!</p>";
        } elseif ($hour < 18) {
            echo "<p>Good Afternoon!</p>";
        } else {
            echo "<p>Good Evening!</p>";
        }
    ?>

    <?php
        echo "<p>Today’s date is: " . date("Y-m-d") . "</p>";
        echo "<p>The time is: " . date("H:i:s") . "</p>";
    ?>

    
    <form action="index.php" method="POST">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST["name"]);
            echo "<h2>Hello, $name!</h2>";
        }
    ?>


    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <?php
                $loggedIn = true; 
                if ($loggedIn) {
                    echo "<li><a href='profile.php'>Profile</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";
                } else {
                    echo "<li><a href='login.php'>Login</a></li>";
                }
            ?>
        </ul>
    </nav>

    <!-- Display Dynamic Content from Database -->
    <h2>Posts</h2>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "my_database";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, content FROM posts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<h3>Post ID: " . $row["id"]. "</h3>";
                echo "<p>" . $row["content"]. "</p>";
            }
        } else {
            echo "<p>No posts found.</p>";
        }

        $conn->close();
    ?>
</body>
</html>
