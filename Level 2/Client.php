<?php

class Client
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $id
     * @param $name
     */
    public function setName($id, $name)
    {
        $stmt = $this->conn->prepare('UPDATE CLIENT SET name = :name where id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getName($id)
    {
        $stmt = $this->conn->prepare('SELECT NAME FROM CLIENT WHERE id = :id');
        $data = [
            'id' => $id
        ];
        $stmt->execute($data);
        $data = $stmt->fetch();
        return $data['NAME'];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function addClient($name)
    {
        $stmt = $this->conn->prepare('INSERT INTO CLIENT(name) VALUES (:name)');
        $data = [
            'name' => $name
        ];
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }


}
