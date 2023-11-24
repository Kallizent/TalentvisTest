<?php
session_start();
class FinancialStatement {
    public $username;
    public $password;
    public $balance;
    public $transactionHistory;    

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->balance = 0;
        $this->transactionHistory = [];
    }

    public function deposit($amount) {
        $this->balance += $amount;
        $this->addTransaction('Deposit', $amount);
        $_SESSION['notification'] = "{$amount} cash successfully deposit";
    }

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            $_SESSION['notification'] = "Your balance is insufficient";
        } else {
            $this->balance -= $amount;
            $this->addTransaction('Withdraw', $amount);
            $_SESSION['notification'] = "{$amount} cash successfully withdrawn";
        }
    }

    public function checkBalance() {
        return "{$this->username} balance: {$this->balance}";
    }
    
    public function transfer($amount, $recipient) {
        if ($amount > $this->balance) {
            $_SESSION['notification'] = "Your balance is insufficient";
        } else {
            $this->balance -= $amount;
            $recipient->balance += $amount;
            $this->addTransaction('Transfer Credit', $amount, "Transfer to {$recipient->username}");
            $recipient->addTransaction('Transfer Debit', $amount, "Transfer from {$this->username}" );
            $_SESSION['notification'] = "Transfer successfully";
        }
    }

    private function addTransaction($type, $amount, $description = "") {
        $Type = explode(" ",$type);
        $transaction = [
            'time' => date('Y-m-d H:i:s'),
            'type' => $Type[0],
            'debit' => ($type == 'Deposit' || $type == 'Transfer Debit') ? $amount : '',
            'credit' => ($type == 'Withdraw' || $type == 'Transfer Credit') ? $amount : '',
            'balance' => $this->balance,
            'description' => $description,
        ];
        $this->transactionHistory[] = $transaction;
    }

    public function showTransactionHistory() {
        return $this->transactionHistory;
    }
}

class Users {
    private $users;

    public function __construct() {
        $this->users = [];
    }

    public function CheckUser(){
        return $this->users;
    }
    public function GetUserByUsername($username){
        return $this->users[$username];
    }
    public function addUser($username, $password) {
        $this->users[$username] = new FinancialStatement($username, $password);
    }

    public function loginUser($username, $password) {
        if (isset($this->users[$username]) && $this->users[$username]->password == $password) {
            return $this->users[$username];
        } else {
            
            return null;
        }
    }
}

// Initialize or retrieve FinancialStatement object from session
if (!isset($_SESSION['Challange3'])) {
    
    $_SESSION['Challange3'] = new Users();
}

$SessionDB = $_SESSION['Challange3'];


// Check if User already Added
if (count($SessionDB->checkUser()) === 0) {
    $SessionDB->addUser('Feon', 'password1');
    $SessionDB->addUser('Vira', 'password2');
}



// Handling user actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //CRUD
    if (isset($_POST['action'])) 
    {
        $financialStatement = $_SESSION['UserLogin'];
        switch ($_POST['action']) {
            case 'deposit':
                $amount = $_POST['amount'];
                $financialStatement->deposit($amount);
                header("location: Main.php", true, 301);
                break;

            case 'withdraw':
                $amount = $_POST['amount'];
                $financialStatement->withdraw($amount);
                header("location: Main.php", true, 301);
                break;

            case 'check_balance':
                $balance = $financialStatement->checkBalance();
                $_SESSION['notification'] = $balance;
                break;

            case 'transfer':
                $receiver = $SessionDB->GetUserByUsername($_POST['receiver']);
                $financialStatement->transfer($_POST['amount'],$receiver);
                header("location: Main.php", true, 301);
                break;                
        }
    }else 
        //LOGIN
        if(isset($_POST['username']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // print_r($password);
            if($SessionDB->loginUser($username, $password) != null){
                $_SESSION['UserLogin'] = $SessionDB->loginUser($username, $password);
                header("location: Main.php", true, 301);
                exit();
            }else{
                $_SESSION['notification'] = "username or password is incorrect";
            }
        }else
            //LOGOUT 
            if(isset($_POST['Logout']))
            {
                unset($_SESSION['UserLogin']);
                header("location: Index.php", true, 301);
                exit();
            }
}
?>
