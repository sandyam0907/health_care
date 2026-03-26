<?php
class Notice_model extends CI_Model
{
    public function get_all_notices()
    {
        $query = $this->db->get('notices'); // your table
        $SQL = $this->db->last_query();

        return $this->datatable->LoadJson($SQL); // ✅ same as project
    }

    public function add_notice($data)
    {
        return $this->db->insert('notices', $data);
    }

    public function get_notice_by_id($id)
    {
        return $this->db->get_where('notices', ['id' => $id])->row_array();
    }

    public function edit_notice($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('notices', $data);
    }

    // IMPORTANT → for user side
    public function get_active_notices()
    {
        return $this->db
            ->where('status', 1)
            ->where('valid_till >=', date('Y-m-d'))
            ->order_by('id', 'DESC')
            ->get('notices')
            ->result();
    }
}