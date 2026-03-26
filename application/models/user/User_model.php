<?php
class User_model extends CI_Model
{
    // GET USER BY ID
    public function get_user($user_id)
    {
        return $this->db->get_where('ci_users', ['id' => $user_id])->row();
    }

    // UPDATE PROFILE
    public function update_profile($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('ci_users', $data);
    }

    // CHECK OLD PASSWORD
    public function check_password($user_id, $password)
    {
        return $this->db
            ->where('id', $user_id)
            ->where('password', $password)
            ->get('ci_users')
            ->row();
    }

    // UPDATE PASSWORD
    public function update_password($user_id, $password)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('ci_users', [
            'password' => $password,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    
}