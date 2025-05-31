<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// application/models/LogModel.php
class LogModel extends CI_Model {
    public function addLog($userId, $action,$data=null) {
        $data = [
            'user_id' => $userId,
            'action' => $action,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_logs', $data);
    }

    public function getAllLogs() {
        $this->db->select('user_logs.*, users.first_name as name'); // Select fields, including user name
        $this->db->from('user_logs');
        $this->db->join('users', 'users.user_id = user_logs.user_id'); // Join with the users table on user ID
        $this->db->order_by('user_logs.timestamp', 'DESC');
        $this->db->limit(100); // Limit to 100 records
        return $this->db->get()->result_array();
    }
}
