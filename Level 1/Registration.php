<?php


class Registration
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $clientId
     * @param $specialistId
     */
    public function addRegistration($clientId, $specialistId)
    {
        $data = [
            'client_id' => $clientId,
            'specialist_id' => $specialistId,
            'registered_at' => date('Y-m-d H:i:s')
        ];
        $stmt = $this->conn->prepare('INSERT INTO REGISTRATION (client_id, specialist_id, registered_at) 
                values(:client_id, :specialist_id, :registered_at)
        ');
        $stmt->execute($data);
    }

    /**
     * @return mixed
     */
    public function getRegistrations()
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION ORDER BY REGISTERED_AT LIMIT 10');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRegistrationsByUser($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION WHERE SPECIALIST_ID = :specialistId ORDER BY REGISTERED_AT');
        $stmt->bindParam(':specialistId', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     */
    public function deleteRegistration($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM REGISTRATION WHERE ID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param $specId
     * @param $regId
     * @return mixed
     */
    public function doesRegBelongToSpecialist($specId, $regId)
    {
        $stmt = $this->conn->prepare('SELECT count(id) as count FROM REGISTRATION WHERE SPECIALIST_ID = :specId AND id = :regId');
        $data = [
            'specId' => $specId,
            'regId' => $regId
        ];
        $stmt->execute($data);
        return $stmt->fetch()['count'];
    }
}