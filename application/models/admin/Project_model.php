<?php
class Project_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_projects()
    {
        $query = $this->db->get('project_master');
        $SQL = $this->db->last_query();

        return $this->datatable->LoadJson($SQL);
    }

    public function add_project($data)
    {
        $this->db->insert('project_master', $data);
        return true;
    }

    public function edit_project($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('project_master', $data);
        return true;
    }

    public function get_project_by_id($id)
    {
        return $this->db->get_where('project_master', ['id' => $id])->row_array();
    }



}
?>