<!DOCTYPE html>
<html>
<body>

<?php
include 'Finance.php';
?>
<h1>Deposit Menu</h1>

    <form method="post">
      <input type="hidden" name="action" value="deposit">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>

        <button type="submit">Submit</button>
    </form>
    
<br>
<button  onclick="window.location.href = 'index.php'">Back to Main</button>
</body>
</html>