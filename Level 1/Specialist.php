<?php


class Specialist
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
        $stmt = $this->conn->prepare('UPDATE SPECIALIST SET name = :name where id = :id');
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
        $stmt = $this->conn->prepare('SELECT NAME FROM SPECIALIST WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['NAME'];
    }

    /**
     * @return mixed
     */
    public function getSpecialistList()
    {
        $stmt = $this->conn->prepare('SELECT id, name FROM specialist');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $loginId
     * @return mixed
     */
    public function getIdFromLoginId($loginId)
    {
        $stmt = $this->conn->prepare('SELECT ID FROM SPECIALIST WHERE LOGIN_ID = :login_id');
        $stmt->bindParam(':login_id', $loginId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['ID'];
    }
}