<!DOCTYPE html>
<html>
<body>

<?php
include 'Finance.php';
if (!isset($_SESSION['UserLogin'])) {
    $_SESSION['notification'] = "Need to login first";
    header("location: Index.php", true, 301);
    exit();
}
?>
<h1>Withdraw Menu</h1>

    <form method="post">
      <input type="hidden" name="action" value="withdraw">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>

        <button type="submit">Submit</button>
    </form>

<br>
<button  onclick="window.location.href = 'Main.php'">Back to Main</button>
</body>
</html>