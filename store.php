<?php
include_once 'database.php';
function checkemail($str)
{
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
}
if (isset($_POST['submit1'])) {

    $email1 = $_POST['email1'];
    if(!checkemail($email1)){
        echo "<script type='text/javascript'>alert('Invalid email address!');</script>";
     }
     else{
        echo "<script type='text/javascript'>alert('Accunt Created successfully!');</script>";
     }

}

//$connection = $this->openConnection();
$sql = ("INSERT INTO costumer_table (username,email,password,mobile_number,address)
    VALUES ('$username1','$email1','$password1','$mobile_number','$address')");
if (mysqli_query($conn, $sql)) {
    echo "<script type='text/javascript'>alert('Accunt Created successfully!');</script>";
    header('location: login.php');

} else {
    $error = ("Error: " . $sql . "" . mysqli_error($conn));
    echo "<script type='text/javascript'>alert('$error');</script>";
}
mysqli_close($conn);

class myStore
{
    private $server = "mysql:host=localhost;dbname=gs_201";
    private $user = "root";
    private $password = "";
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    protected $con;

    //connections
    public function openConnection()
    {
        try {
            $this->con = new PDO(
                $this->server,
                $this->user,
                $this->password,
                $this->options
            );

            //echo "Connection Success";
            echo "\n";

            return $this->con;
        } catch (PDOException $error) {
            echo "Erro connection:" . $error->getMessage();
        }
    }
    public function closeConnection()
    {
        $this->$con = null;
    }

    public function getUsers()
    {
        $connection = $this->openConnection();
        $statement = $connection->prepare("SELECT * FROM costumer_table");
        $statement->execute();
        $users = $statement->fetchAll();
        $usersCount = $statement->rowCount();

        if ($usersCount > 0) {
            return $users;
        } else {
            return 0;
        }
    } // get user
    public function login()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($_POST['email']) & empty($data['password1'])) {

                die(header('location:login.php'));

            }

            $connection = $this->openConnection();
            $connect = $connection->prepare("SELECT * FROM `costumer_table` WHERE email = ? AND  password= ?");
            $connect->execute([$email, $password]);

            $user = $connect->fetch();
            $total = $connect->rowCount();

            if ($total >= 1) {
                header('location: ./Gs-storeManagement/index.html');
            } else if (!empty($email & $password) & $total >= 0) {
                echo "<script type='text/javascript'>alert('Invalid email or password!');</script>";
            }
            // if(empty($email & $password)){

            // }

        }
    }

}

$myStore = new myStore();
