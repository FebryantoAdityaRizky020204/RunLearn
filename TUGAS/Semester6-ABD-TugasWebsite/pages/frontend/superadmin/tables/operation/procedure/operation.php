<?php
require_once dirname(__FILE__) . '/../../Connection.php';

class Operation
{
    public $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function checkOperation($data) {
        $procedure = $data["run_procedure"];
        $procedureResult = null;
        try {
            switch ($procedure) {
                case 'get_animal_visit_history':
                    $animal_id = $data["animal_id"];
                    $procedureResult = $this->conn->fetchAll("CALL get_animal_visit_history($animal_id)");
                    break;
                case 'get_animals_by_type':
                    $animal_type_id = $data["at_id"];
                    $procedureResult = $this->conn->fetchAll("CALL get_animals_by_type($animal_type_id)");
                    break;
                case 'get_visits_by_date_range':
                    $start_date = $data["start_date"];
                    $end_date = $data["end_date"];
                    $procedureResult = $this->conn->fetchAll("CALL get_visits_by_date_range('$start_date', '$end_date')");
                    break;
            }
            $procedureResult = [
                'status' => 'OK',
                'type' => $procedure,
                'data' => $procedureResult
            ];
        } catch(Throwable $e) {
            $procedureResult = [
                'status' => 'ERROR',
                'msg' => $e->getMessage()
            ];
        }
        return [
            'status' => 'PROCEDURE',
            'result' => $procedureResult
        ];
    }
}
