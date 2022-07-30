<?php 

namespace Michel\Projeto\Models;

use Michel\Projeto\Models\Book;

class Lendings extends Model {

    protected $userId;
    protected $idBook;

    public function __construct($userId, $idBook)
    {
        $this->userId = $userId;
        $this->idBook= $idBook;
    }

    public function save() {
        $stmt = self::$conexao->prepare('INSERT INTO lendings(len_id_book, len_id_user) VALUES (:bookId, :userId);');
        $stmt->bindvalue(':bookId', $this->idBook, SQLITE3_INTEGER);
        $stmt->bindvalue(':userId', $this->userId, SQLITE3_INTEGER);
        return $stmt->execute();
    }

    static function existsLending($idBook) {
        $stmt = self::$conexao->prepare('SELECT * FROM lendings WHERE len_id_book = :bookId;');
        $stmt->bindvalue(':bookId', $idBook, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        if(isset($row)){
            return $row['len_id_book'] == $idBook ? true : false;
        }
        return false;
    }

    static function listLendings($userId){
        $stmt = self::$conexao->prepare('SELECT users.usr_name AS "username", books.boo_title AS "title" FROM lendings INNER JOIN users ON users.id = len_id_user INNER JOIN books ON books.id = len_id_book WHERE users.id = :userId;');
        $stmt->bindvalue(':userId', $userId, SQLITE3_INTEGER);
        $results = $stmt->execute();
        return $results;
    }

}