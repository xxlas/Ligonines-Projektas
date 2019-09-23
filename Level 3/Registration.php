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
     * @return bool|string
     * @throws Exception
     */
    public function addRegistration($clientId, $specialistId)
    {

        $url = substr(bin2hex(random_bytes(32)), 0, 8); // sugeneruojam random url
        $data = [
            'client_id' => $clientId,
            'specialist_id' => $specialistId,
            'registered_at' => date('Y-m-d H:i:s'),
            'info_url' => $url
        ];
        $stmt = $this->conn->prepare('INSERT INTO REGISTRATION (client_id, specialist_id, info_url, registered_at) 
                values(:client_id, :specialist_id, :info_url, :registered_at)
        ');
        $stmt->execute($data);
        return $url;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRegistration($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION WHERE ID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @return mixed
     */
    public function getRegistrations()
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION WHERE IS_COMPLETED = 0 ORDER BY REGISTERED_AT LIMIT 10');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRegistrationsByUser($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION WHERE SPECIALIST_ID = :specialistId AND IS_COMPLETED = 0 ORDER BY REGISTERED_AT');
        $stmt->bindParam(':specialistId', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     */
    private function deleteRegistration($id)
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

    /**
     * @param $id
     * @param $status
     */
    public function updateCompletionStatus($id, $status)
    {
        $stmt = $this->conn->prepare('UPDATE REGISTRATION SET is_completed = :status WHERE ID = :id');
        $data = [
            'status' => $status,
            'id' => $id
        ];
        $stmt->execute($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRegistrationTimestamp($id)
    {
        $stmt = $this->conn->prepare('SELECT registered_at FROM REGISTRATION WHERE ID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['registered_at'];
    }

    /**
     * @param $initTime
     * @return false|int
     */
    public function getTimestampDifference($initTime)
    {
        return strtotime(date('Y-m-d H:i:s')) - strtotime($initTime);
    }

    /**
     * @param $clientId
     * @param $specId
     * @return array
     */
    public function getAverageWaitingTimeByClient($clientId, $specId)
    {
        $comp = new CompletionTime($this->conn);
        $time = self::getIndexOfClientAtSpecialist($specId, $clientId) * $comp->getAverageTimeBySpecialist($specId);
        return $this->timestampToHoursAndMinutes($time);
    }

    /**
     * @param $specId
     * @param $clientId
     * @return false|int|string
     */
    public function getIndexOfClientAtSpecialist($specId, $clientId)
    {
        $stmt = $this->conn->prepare("
            SELECT r.client_id as client, ROW_NUMBER() OVER(ORDER BY r.registered_at) as rownum
            FROM registration r where r.is_completed = 0 and r.specialist_id = :specId 
            order by r.registered_at
        ");
        $stmt->bindParam(':specId', $specId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return array_search($clientId, array_column($data, 'client')) + 1;
    }

    public function timestampToHoursAndMinutes($timestamp)
    {
        $hours = floor($timestamp / 3600);
        $minutes = round(($timestamp % 3600) / 60);
        return array('minutes' => $minutes, 'hours' => $hours);
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getRegistrationByUrl($url)
    {
        $stmt = $this->conn->prepare('SELECT * FROM REGISTRATION WHERE INFO_URL = :url AND IS_COMPLETED = 0');
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param $specId
     * @param $day
     * @return mixed
     */
    public function getAverageTimeAndCountBySpecialistPerDay($specId, $day)
    {
        $stmt = $this->conn->prepare('
             select count(c.time_taken) as count, avg(c.time_taken) as average from registration r 
             left join completion_time c on c.registration_id = r.id 
             where cast(r.registered_at as date) = :day and r.specialist_id = :specId group by r.specialist_id
        ');
        $data = [
            'day' => $day,
            'specId' => $specId
        ];
        $stmt->execute($data);
        return $stmt->fetch();
    }

    /**
     * @param $specId
     * @return mixed
     */
    public function getActiveClientCountBySpecialist($specId)
    {
        $stmt = $this->conn->prepare('SELECT COUNT(id) as count FROM REGISTRATION WHERE SPECIALIST_ID = :specId AND IS_COMPLETED = 0');
        $stmt->bindParam(':specId', $specId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['count'];
    }

    /**
     * @param $specId
     * @param $place
     * @return mixed
     */
    public function getRegistrationByPlaceInQue($specId, $place)
    {
        $stmt = $this->conn->prepare('
            SELECT * FROM (SELECT r.*, ROW_NUMBER() OVER(ORDER BY r.registered_at) as quenum
            FROM registration r 
            where r.is_completed = 0 and r.specialist_id = :specId
            order by r.registered_at) as tbl1 where quenum = :place
        ');
        $data = [
            'specId' => $specId,
            'place' => $place
        ];
        $stmt->execute($data);
        return $stmt->fetch();
    }

    /**
     * @param $regId
     * @param $date
     */
    public function updateRegistrationDate($regId, $date)
    {
        $stmt = $this->conn->prepare('UPDATE REGISTRATION SET REGISTERED_AT = :date WHERE ID = :id');
        $data = [
            'date' => $date,
            'id' => $regId
        ];
        $stmt->execute($data);
    }
}
