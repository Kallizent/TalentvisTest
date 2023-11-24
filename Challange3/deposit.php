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
<h1>Deposit Menu</h1>

    <form method="post">
      <input type="hidden" name="action" value="deposit">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>

        <button type="submit">Submit</button>
    </form>
    
<br>
<button  onclick="window.location.href = 'main.php'">Back to Main</button>
</body>
</html>