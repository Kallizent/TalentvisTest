<!DOCTYPE html>
<html>
<body>

<?php
include 'Finance.php';
?>
<h1>Withdraw Menu</h1>

    <form method="post">
      <input type="hidden" name="action" value="withdraw">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>

        <button type="submit">Submit</button>
    </form>

<br>
<button  onclick="window.location.href = 'index.php'">Back to Main</button>
</body>
</html>