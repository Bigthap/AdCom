<?php
// System User Management - Only Level 4 can access
if (isset($_SESSION['level']) && $_SESSION['level'] == 4) {
?>
<h2>System User Management</h2>

<?php
    // Handle Create (Add)
    if (isset($_POST['add_user'])) {
        $employee_id = $_POST['employee_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];
        $insertQuery = "INSERT INTO systemuser (employee_id, username, password, level) VALUES ('$employee_id', '$username', '$password', '$level')";
        $insertResult = mysqli_query($connect, $insertQuery);
        if ($insertResult) {
            echo "<p style='color:green;'>User added successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Update
    if (isset($_POST['update_user'])) {
        $id = $_POST['user_id'];
        $employee_id = $_POST['employee_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];
        $updateQuery = "UPDATE systemuser SET employee_id='$employee_id', username='$username', password='$password', level='$level' WHERE user_id='$id'";
        $updateResult = mysqli_query($connect, $updateQuery);
        if ($updateResult) {
            echo "<p style='color:green;'>User updated successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $deleteQuery = "DELETE FROM systemuser WHERE user_id='$id'";
        $deleteResult = mysqli_query($connect, $deleteQuery);
        if ($deleteResult) {
            echo "<p style='color:green;'>User deleted successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Show Edit Form
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $editQuery = "SELECT * FROM systemuser WHERE user_id='$id'";
        $editResult = mysqli_query($connect, $editQuery);
        $editRow = mysqli_fetch_assoc($editResult);

        // Get employee list for dropdown
        $empQuery = "SELECT employee_id, firstname, lastname FROM employee";
        $empResult = mysqli_query($connect, $empQuery);
?>
    <h3>Edit System User</h3>
    <form method="post" action="index.php?page=systemuser">
        <input type="hidden" name="user_id" value="<?php echo $editRow['user_id']; ?>">
        <table>
            <tr>
                <td>Employee:</td>
                <td>
                    <select name="employee_id">
                    <?php while ($emp = mysqli_fetch_assoc($empResult)) { ?>
                        <option value="<?php echo $emp['employee_id']; ?>" <?php if ($emp['employee_id'] == $editRow['employee_id']) echo 'selected'; ?>>
                            <?php echo $emp['firstname'] . " " . $emp['lastname']; ?>
                        </option>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $editRow['username']; ?>"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="text" name="password" value="<?php echo $editRow['password']; ?>"></td>
            </tr>
            <tr>
                <td>Level:</td>
                <td><input type="number" name="level" min="1" max="4" value="<?php echo $editRow['level']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="update_user" value="Update">
                    <a href="index.php?page=systemuser">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
    <hr>
<?php
    }

    // Get employee list for Add form dropdown
    $empQuery2 = "SELECT employee_id, firstname, lastname FROM employee";
    $empResult2 = mysqli_query($connect, $empQuery2);
?>
    <h3>Add New System User</h3>
    <form method="post" action="index.php?page=systemuser">
        <table>
            <tr>
                <td>Employee:</td>
                <td>
                    <select name="employee_id">
                    <?php while ($emp = mysqli_fetch_assoc($empResult2)) { ?>
                        <option value="<?php echo $emp['employee_id']; ?>">
                            <?php echo $emp['firstname'] . " " . $emp['lastname']; ?>
                        </option>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="text" name="password" required></td>
            </tr>
            <tr>
                <td>Level:</td>
                <td><input type="number" name="level" min="1" max="4" value="1" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="add_user" value="Add">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <hr>

<?php
    // Retrieve - Display all system users
    $userQuery = "SELECT s.*, e.firstname, e.lastname FROM systemuser s LEFT JOIN employee e ON s.employee_id = e.employee_id";
    $result = mysqli_query($connect, $userQuery);

    if (!$result) {
        die("Could not successfully run the query $userQuery " . mysqli_error($connect));
    }

    $numRows = mysqli_num_rows($result);
?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["level"] . "</td>";
        echo "<td><a href='index.php?page=systemuser&edit=" . $row['user_id'] . "'>Edit</a></td>";
        echo "<td><a href='index.php?page=systemuser&delete=" . $row['user_id'] . "' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a></td>";
        echo "</tr>";
    }
?>
    </table>
    <p><?php echo $numRows; ?> Records</p>

<?php
} else {
    echo "<h2>System User Management</h2>";
    echo "<h3 class='error'>You are unable to access the data, please try again</h3>";
}
?>
