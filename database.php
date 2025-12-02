<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // set charset
        $this->conn->set_charset("utf8mb4");
    }

    private function getConfig() {
        include_once("config.php");
        $this->host     = $config['host'] ?? 'localhost';
        $this->user     = $config['username'] ?? 'root';
        $this->password = $config['password'] ?? '';
        $this->db_name  = $config['db_name'] ?? '';
    }

    // eksekusi query bebas (hati-hati SQL injection jika input langsung)
    public function query($sql) {
        return $this->conn->query($sql);
    }

    // get all rows atau satu baris jika where mengembalikan 1 row
    public function get($table, $where = null) {
        $whereSql = $where ? " WHERE " . $where : "";
        $sql = "SELECT * FROM " . $this->conn->real_escape_string($table) . $whereSql;
        $res = $this->conn->query($sql);
        if ($res === false) return false;
        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // insert menggunakan associative array $data
    public function insert($table, $data) {
        if (!is_array($data) || empty($data)) return false;
        $columns = [];
        $values  = [];
        foreach ($data as $key => $val) {
            $columns[] = "`" . $this->conn->real_escape_string($key) . "`";
            $values[]  = "'" . $this->conn->real_escape_string($val) . "'";
        }
        $columnsStr = implode(",", $columns);
        $valuesStr  = implode(",", $values);

        $sql = "INSERT INTO `" . $this->conn->real_escape_string($table) . "` ($columnsStr) VALUES ($valuesStr)";
        return $this->conn->query($sql);
    }

    // update $data array dengan $where (string, misal "id=1")
    public function update($table, $data, $where) {
        if (!is_array($data) || empty($data) || !$where) return false;
        $updateParts = [];
        foreach ($data as $key => $val) {
            $k = $this->conn->real_escape_string($key);
            $v = $this->conn->real_escape_string($val);
            $updateParts[] = "`{$k}`='{$v}'";
        }
        $updateStr = implode(",", $updateParts);
        $sql = "UPDATE `" . $this->conn->real_escape_string($table) . "` SET $updateStr WHERE $where";
        return $this->conn->query($sql);
    }

    // delete with filter (e.g. "WHERE id=1")
    public function delete($table, $filter) {
        if (!$filter) return false;
        $sql = "DELETE FROM `" . $this->conn->real_escape_string($table) . "` " . $filter;
        return $this->conn->query($sql);
    }

    public function __destruct() {
        if ($this->conn) $this->conn->close();
    }
}
?>
