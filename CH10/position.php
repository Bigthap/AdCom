<?php
require_once "header.php";
require_once "config.php";

// Position Management - Only Level 4 can access
if (isset($_SESSION['level']) && $_SESSION['level'] == 4) {
?>
<h2>Position Management</h2>

<?php
    // Handle Create (Add)
    if (isset($_POST['add_position'])) {
        $name = $_POST['name'];
        $insertQuery = "INSERT INTO position_t (name) VALUES ('$name')";
        $insertResult = mysqli_query($connect, $insertQuery);
        if ($insertResult) {
            echo "<p style='color:green;'>Position added successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Update
    if (isset($_POST['update_position'])) {
        $id = $_POST['position_id'];
        $name = $_POST['name'];
        $updateQuery = "UPDATE position_t SET name='$name' WHERE position_id='$id'";
        $updateResult = mysqli_query($connect, $updateQuery);
        if ($updateResult) {
            echo "<p style='color:green;'>Position updated successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Handle Delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $deleteQuery = "DELETE FROM position_t WHERE position_id='$id'";
        $deleteResult = mysqli_query($connect, $deleteQuery);
        if ($deleteResult) {
            echo "<p style='color:green;'>Position deleted successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($connect) . "</p>";
        }
    }

    // Show Edit Form
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $editQuery = "SELECT * FROM position_t WHERE position_id='$id'";
        $editResult = mysqli_query($connect, $editQuery);
        $editRow = mysqli_fetch_assoc($editResult);
?>
    <h3>Edit Position</h3>
    <form method="post" action="position.php">
        <input type="hidden" name="position_id" value="<?php echo $editRow['position_id']; ?>">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo $editRow['name']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="update_position" value="Update">
                    <a href="position.php">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
    <hr>
<?php
    }

    // Add Form
?>
    <h3>Add New Position</h3>
    <form method="post" action="position.php">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" name="add_position" value="Add">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <hr>

<?php
    // Retrieve - Display all positions
    $userQuery = "SELECT * FROM position_t";
    $result = mysqli_query($connect, $userQuery);

    if (!$result) {
        die("Could not successfully run the query $userQuery " . mysqli_error($connect));
    }

    $numRows = mysqli_num_rows($result);
?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th colspan="2">Action</th>
        </tr>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["position_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td><a href='position.php?edit=" . $row['position_id'] . "'>Edit</a></td>";
        echo "<td><a href='position.php?delete=" . $row['position_id'] . "' onclick=\"return confirm('Are you sure you want to delete this position?');\">Delete</a></td>";
        echo "</tr>";
    }
?>
    </table>
    <p><?php echo $numRows; ?> Records</p>

<?php
} else {
    echo "<h2>Position Management</h2>";
    echo "<h3 class='error'>You are unable to access the data, please try again</h3>";
}

require_once "footer.php";
?>
