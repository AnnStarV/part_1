<?
    class Database {
        const servername = "127.0.0.1";
        const database = "task_db";
        const username = "root";
        const password = "";

        function connect(){
            mysql_connect(Database::servername, Database::username, Database::password) or die("error_1");
            mysql_select_db(Database::database) or die("error_2");
        }

        function insert(){
            if(isset($_POST['submit'])){
                $sql =  "INSERT INTO tab_users (`lastname`, `firstname`, `age`, `address`, `phone_number`, `email`) VALUES ('".$_POST['lastname']."','".$_POST['firstname']."',".(int)$_POST['age'].",'".$_POST['address']."', '".$_POST['phone_number']."', '".$_POST['email']."')";
                $array = array(
                    'firstname' => $_POST['firstname'], 
                    'lastname' => $_POST['lastname'], 
                    'age' => $_POST['age'], 
                    'address' => $_POST['address'], 
                    'phone_number' => $_POST['phone_number'],
                    'email' => $_POST['email']
                );
                $json = json_encode($array);
                
                if(mysql_query($sql)){
                    $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'success'."\n\n" ;
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
                }
                else{
                    $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'fail'."\n\n" ;
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
                }

                header('Location: http://part_1 ');
            }
        }
    };

    $inst = new Database();
    $inst -> connect();
    $inst -> insert();
?>