<?php
$conn = new mysqli("localhost", "root", "", "student_db");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, email, contact, course) VALUES ('$name', '$email', '$contact', '$course')";
    $conn->query($sql);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; margin: 20px; }
        .container { width: 700px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
        input[type="text"], input[type="email"] {
            width: 95%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="submit"] {
            background: #28a745; color: #fff; border: none; padding: 10px 15px; border-radius: 5px;
        }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; }
        a { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Management System</h2>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contact" placeholder="Contact">
            <input type="text" name="course" placeholder="Course" required>
            <input type="submit" name="submit" value="Add Student">
        </form>

        <table>
            <tr>
                <th>Name</th><th>Email</th><th>Contact</th><th>Course</th><th>Action</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['course']; ?></td>
                    <td><a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete this student?')">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>