<?php


class Login
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function getId($username)
    {
        $stmt = $this->conn->prepare('SELECT ID FROM LOGIN WHERE USERNAME = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['ID'];
    }

    /**
     * @param $username
     * @return mixed
     */
    public function getPassword($username)
    {
        $stmt = $this->conn->prepare('SELECT PASSWORD FROM LOGIN WHERE USERNAME = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['PASSWORD'];
    }
}