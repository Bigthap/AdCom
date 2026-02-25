<?php include_once "config.php"; ?>
<?php require_once "header.php"; ?>

<div class="login-box">
    <?php
    if (isset($_SESSION['errors_msg'])) {
        echo "<p class='error-msg'>".$_SESSION['errors_msg']."</p>";
        unset($_SESSION['errors_msg']);
    }
    ?>
    <form action="check-login.php" method="post">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-top:10px;">
                    <input type="submit" value="Submit" />
                    <input type="reset" value="Reset" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once "footer.php"; ?>
