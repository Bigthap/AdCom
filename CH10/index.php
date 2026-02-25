<?php require_once "header.php"; ?>
<?php require_once "config.php"; ?>

<?php
// Dynamic page routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'position':
        include 'pages/position_content.php';
        break;
    case 'department':
        include 'pages/department_content.php';
        break;
    case 'employee':
        include 'pages/employee_content.php';
        break;
    case 'systemuser':
        include 'pages/systemuser_content.php';
        break;
    default:
        // Home page
        echo '<img src="Camt.Png" alt="CMU CAMT Logo" />';
        break;
}
?>

<?php require_once "footer.php"; ?>
