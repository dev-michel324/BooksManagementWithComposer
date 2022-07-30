<?php 

namespace Michel\Projeto\Models;

use Michel\Projeto\Models\User;

class Book extends Model {

    protected $title;
    protected $year;
    protected $author;
    protected $userId;

    public function __construct($title, $year, $author, $userId)
    {
        $this->title = $title;
        $this->year = $year;
        $this->author = $author;
        $this->userId = $userId;
    }

    public function save() {
        $statement = self::$conexao->prepare("INSERT INTO books(boo_title, boo_year, boo_autor, boo_id_user) VALUES (:title, :yearBook, :autor, :userId)");
        $statement->bindvalue(':title', $this->title, SQLITE3_TEXT);
        $statement->bindvalue(':yearBook', $this->year, SQLITE3_INTEGER);
        $statement->bindvalue(':autor', $this->author, SQLITE3_TEXT);
        $statement->bindvalue(':userId', $this->userId, SQLITE3_TEXT);
        return $statement->execute();
    }

    static function getIdFromBook($title, $author){
        $stmt = self::$conexao->prepare('SELECT id, * FROM books WHERE boo_title = :title AND boo_autor = :author;');
        $stmt->bindvalue(':title', $title, SQLITE3_TEXT);
        $stmt->bindvalue(':author', $author, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        if (isset($row)){
            return $row['id'];
        }
        return false;
    }

    static function exists ($title, $author) {
        $stmt = self::$conexao->prepare('SELECT * FROM books WHERE boo_title = :boo_title AND boo_autor = :boo_autor');
        $stmt->bindvalue(':boo_title', $title, SQLITE3_TEXT);
        $stmt->bindvalue(':boo_autor', $author, SQLITE3_TEXT);
        $results = $stmt->execute();
        $row = $results->fetchArray();
        if (isset($row)){
            return $row["boo_title"] == $title ? true : false;
        }
        return false;
    }

    static function listAllBooksOrFromUser($userId = null){
        if (isset($userId)){
            $sttm = self::$conexao->prepare("SELECT books.*, users.usr_name FROM books INNER JOIN users ON users.id = :userId WHERE books.boo_id_user = :user.id");
            $sttm->bindvalue(':userId', $userId, SQLITE3_INTEGER);
            $result = $sttm->execute();
            return $result;
        }
        $results = self::$conexao->query('SELECT books.*, users.usr_email AS "email" FROM books INNER JOIN users ON users.id = books.boo_id_user ORDER BY boo_year;');
        return $results;
    }
}