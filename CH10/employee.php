<?php
require_once "header.php";
require_once "config.php";

// Employee Management
// Retrieve: Level 1,2,3,4 (Level 1 & 4 cannot see salary)
// Create: Level 2
// Update: Level 3
// Delete: Level 3

if (isset($_SESSION['level']) && in_array($_SESSION['level'], [1, 2, 3, 4])) {
    $level = $_SESSION['level'];
?>
<h2>Employee Management</h2>

<?php
    // Handle Create (Add) - Only Level 2
    if (isset($_POST['add_employee']) && $level == 2) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $salary = $_POST['salary'];
        $insertQuery = "INSERT INTO employee (firstname, lastname, salary) 
                         VALUES ('$firstname', '$lastname', '$salary')";
        $insertResult = mysqli_query($connect, $insertQuery);
        if ($insertResult) {
            echo "<p style='color:green;'>Employee added successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Update - Only Level 3
    if (isset($_POST['update_employee']) && $level == 3) {
        $id = $_POST['employee_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $salary = $_POST['salary'];
        $updateQuery = "UPDATE employee SET firstname='$firstname', lastname='$lastname', 
                        salary='$salary' WHERE employee_id='$id'";
        $updateResult = mysqli_query($connect, $updateQuery);
        if ($updateResult) {
            echo "<p style='color:green;'>Employee updated successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Delete - Only Level 3
    if (isset($_GET['delete']) && $level == 3) {
        $id = $_GET['delete'];
        $deleteQuery = "DELETE FROM employee WHERE employee_id='$id'";
        $deleteResult = mysqli_query($connect, $deleteQuery);
        if ($deleteResult) {
            echo "<p style='color:green;'>Employee deleted successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Show Edit Form - Only Level 3
    if (isset($_GET['edit']) && $level == 3) {
        $id = $_GET['edit'];
        $editQuery = "SELECT * FROM employee WHERE employee_id='$id'";
        $editResult = mysqli_query($connect, $editQuery);
        $editRow = mysqli_fetch_assoc($editResult);
?>
    <h3>Edit Employee</h3>
    <form method="post" action="employee.php">
        <input type="hidden" name="employee_id" value="<?php echo $editRow['employee_id']; ?>">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="firstname" value="<?php echo $editRow['firstname']; ?>"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" value="<?php echo $editRow['lastname']; ?>"></td>
            </tr>
            <tr>
                <td>Salary:</td>
                <td><input type="number" name="salary" value="<?php echo $editRow['salary']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="update_employee" value="Update">
                    <a href="employee.php">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
    <hr>
<?php
    }

    // Add Form - Only Level 2
    if ($level == 2) {
?>
    <h3>Add New Employee</h3>
    <form method="post" action="employee.php">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="firstname" required></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" required></td>
            </tr>
            <tr>
                <td>Salary:</td>
                <td><input type="number" name="salary" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="add_employee" value="Add">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <hr>
<?php
    }

    // Retrieve - Display all employees (All levels can view)
    $userQuery = "SELECT * FROM employee";
    $result = mysqli_query($connect, $userQuery);

    if (!$result) {
        die("Could not successfully run the query $userQuery " . mysqli_error($connect));
    }

    $numRows = mysqli_num_rows($result);

    // Level 1 & 4 cannot see salary, Level 2 & 3 can see salary
    $showSalary = ($level == 2 || $level == 3);
?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <?php if ($showSalary) { ?>
            <th>Salary</th>
            <?php } ?>
            <?php if ($level == 3) { ?>
            <th colspan="2">Action</th>
            <?php } ?>
        </tr>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["employee_id"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        if ($showSalary) {
            echo "<td>" . $row["salary"] . "</td>";
        }
        if ($level == 3) {
            echo "<td><a href='employee.php?edit=" . $row['employee_id'] . "'>Edit</a></td>";
            echo "<td><a href='employee.php?delete=" . $row['employee_id'] . "' onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a></td>";
        }
        echo "</tr>";
    }
?>
    </table>
    <p><?php echo $numRows; ?> Records</p>

<?php
} else {
    echo "<h2>Employee Management</h2>";
    echo "<h3 class='error'>You are unable to access the data, please try again</h3>";
}

require_once "footer.php";
?>
