<?php 

namespace Michel\Projeto\Models;

class User extends Model {

    protected $name;
    protected $email;
    protected $password;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function save() {
        $statement = self::$conexao->prepare ("INSERT INTO users(usr_name, usr_email, usr_password) VALUES (:usr_name, :usr_email, :usr_password)");
        $statement->bindvalue(':usr_name', $this->name, SQLITE3_TEXT);
        $statement->bindValue(':usr_email', $this->email, SQLITE3_TEXT);
        $statement->bindValue(':usr_password', $this->password, SQLITE3_TEXT);
        return $statement->execute();
    }

    static function searchUserByEmail($email){
        $sttm = self::$conexao->prepare("SELECT id, * FROM users WHERE usr_email = :email;");
        $sttm->bindvalue(':email', $email, SQLITE3_TEXT);
        $result = $sttm->execute();
        $row = $result->fetchArray();
        return $row;
    }

    static function exists ($email, $password) {
        $row = self::searchUserByEmail($email);
        if (isset($row)) {
            return password_verify($password, $row['usr_password']) ? true : false;
        }
        return false;
    }

    static function getIdUser($email){
        $result = self::searchUserByEmail($email);
        if (isset($result)){
            return $result['id'];
        }
        return false;
    }

}