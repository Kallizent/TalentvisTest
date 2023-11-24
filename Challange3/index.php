<!DOCTYPE html>
<html>
<body>

<?php
include 'Finance.php';
if (isset($_SESSION['UserLogin'])) {
    
    header("location: Main.php", true, 301);
    exit();
}
?>
<h1>Login Menu</h1>

    <form method="post">
        <label for="username">Username</label> 
        <input style="margin:5px;" type="text" name="username" id="username" required> <br>
        <label for="password">Password</label>
        <input style="margin:5px;" type="password" name="password" id="password" required>

        <button type="submit">Submit</button>
    </form>
    
<br>
<?php
if (isset($_SESSION['notification'])) {
?>
<h2><?=$_SESSION['notification']?></h2>

<?php 
unset($_SESSION['notification']);
}
?>

</body>
</html>