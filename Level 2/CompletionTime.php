<?php


class CompletionTime
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $regId
     * @param $timeInSeconds
     */
    public function addTime($regId, $timeInSeconds)
    {
        $stmt = $this->conn->prepare('INSERT INTO COMPLETION_TIME(registration_id, time_taken) VALUES (:regId, :timeInSeconds)');
        $data = [
            'regId' => $regId,
            'timeInSeconds' => $timeInSeconds
        ];
        $stmt->execute($data);
    }

    /**
     * @param $specialistId
     * @return int
     */
    public function getAverageTimeBySpecialist($specialistId)
    {
        $stmt = $this->conn->prepare('SELECT AVG(c.time_taken) as avg FROM completion_time c JOIN registration r on r.id = c.registration_id where r.specialist_id = :specialistId');
        $stmt->bindParam(':specialistId', $specialistId, PDO::PARAM_INT);
        $stmt->execute();
        $average = $stmt->fetch()['avg'];
        if (is_null($average)) {
            return 3600; // tam atvejui jeigu nera duomenu
        }
        return $average;
    }
}