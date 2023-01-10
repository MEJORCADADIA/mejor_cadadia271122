<?php 

$path = realpath(dirname(__FILE__));
include_once ($path . "/../lib/Session.php");
Session::init();
include_once ($path . "/../lib/Database.php");
include_once ($path . "/../helper/Format.php");

class Common {
	public readonly Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function insert(string $table, array $data) {
		$query = "INSERT INTO {$table} {$this->prepareInsertData($data)}";
		$result = $this->db->query($query, array_values($data));
		
		return $result;
	}

    public function update(string $table, array $data, string $cond, array $params, $hasModifiedColumn = true, $modifiedColumnName = 'modified') {
        if ($hasModifiedColumn) {
            $data = [...$data, $modifiedColumnName => date('Y-m-d h:i:s')];
        }

        $dataString = $this->prepareUpdateData($data);

        $query = "UPDATE {$table} SET {$dataString} WHERE $cond";
        $result = $this->db->query($query, [...$data, ...$params]);

        return $result;
    }

    public function get(string $table, ?string $cond = null, array $params = [], array $columns = [], ?string $orderBy = null, ?string $order = 'asc')
    {
        $query = "SELECT " . $this->formatColumns($columns) . " FROM $table" . $this->getConditionString($cond) . ($orderBy ? " ORDER BY {$orderBy} {$order}" : "");

        return $this->db->query($query, $params)->fetchAll();
    }

    public function first(string $table, string $cond = null, array $params = [], array $columns = [], ?string $orderBy = null, ?string $order = 'asc')
    {
        $query = "SELECT " . $this->formatColumns($columns) . " FROM $table" . $this->getConditionString($cond) . ($orderBy ? " ORDER BY {$orderBy} {$order}" : ""). " Limit 0,1";

        return $this->db->query($query, $params)->fetch();
    }

    public function delete(string $table, string $cond, array $params, $file = NULL) {
        $query = "DELETE FROM {$table} WHERE {$cond}";
        $result = $this->db->query($query, $params);

        if ($file != NULL) {
            unlink($file);
        }
        return $result;
    }

    public function count(string $table, string $cond = null, array $params = [], array $columns = ['count(id)'])
    {
        $query = "SELECT " . $this->formatColumns($columns) . " FROM $table" . $this->getConditionString($cond);

        return $this->db->query($query, $params)->fetchColumn();
    }

	public function insertId() {
		return $this->db->insertId();
	}

    private function prepareInsertData(array $data): string
    {
        $columns = implode(',', array_keys($data));
        $placeholders = '';

        for ($i=0; $i<count($data); $i++) {
            $placeholders .= '?' . ($i<count($data) - 1 ? ',' : '');
        }

        return "({$columns}) VALUES ({$placeholders})";
    }

    private function prepareUpdateData(array $data): string
    {
        $dataString = '';
        $lastColumn = array_key_last($data);

        foreach ($data as $column => $value) {
            $dataString .= "{$column}=:{$column}" . ($column !== $lastColumn ? ',' : '');
        }

        return $dataString;
    }

    private function formatColumns(array $columns): string
    {
        return count($columns) > 0 ? implode(',', $columns) : "*";
    }

    private function getConditionString(?string $cond): string
    {
        return $cond !== null ? " WHERE $cond" : "";
    }
}

?>