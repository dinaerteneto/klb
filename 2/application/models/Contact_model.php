<?php

class Contact_model extends CI_Model
{
    private $table_name = 'people_contacts';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($personId, $id = null)
    {
        $return = [];
        $this->db->select('p.*, pc.id AS pc_id, pc.people_contact_type_id as type_id, pct.type, pc.value')
                ->from('people p')
                ->join('people_contacts pc', 'pc.people_id = p.id and pc.deleted_at is null', 'left')
                ->join('people_contact_types pct', 'pc.people_contact_type_id = pct.id', 'left')
                ->where('p.id = ', $personId)
                ->where('p.deleted_at is null');
        $query = $this->db->get();
        $results = $query->result();
            
        // formatting return array
        // this is necessary to reduce requests to database
        if ($results) {
            $return = [];
            foreach ($results as $result) {
                if (!isset($return[$result->id])) {
                    $return[$result->id] = [
                            'id' => (int) $result->id,
                            'name' => $result->name,
                            'last_name' => $result->last_name,
                            'date_birth' => $result->date_birth,
                            'created_at' => $result->created_at,
                            'updated_at' => $result->updated_at
                        ];
                }
                if ($result->pc_id) {
                    $return[$result->id]['contacts'][] = [
                            'id' => (int)$result->pc_id,
                            'type_id' =>  (int) $result->type_id,
                            'type' => $result->type,
                            'value' => $result->value
                        ];
                }
            }
            $return = array_values($return);
            return $return;
        }
    }

    public function insert($personId)
    {
        $createdAt = date('Y-m-d H:i:s');
        $updateAt = date('Y-m-d H:i:s');

		$data = $this->input->post('Contact');
		$data['people_contact_type_id'] = $data['type'];
		unset($data['type']);
        $data['created_at'] = $createdAt;
        $data['updated_at'] = $updateAt;
        return $this->db->insert($this->table_name, $data);
    }

    public function update($id, $personId, array $data = [])
    {
        $updateAt = date('Y-m-d H:i:s');

        $data['updated_at'] = $updateAt;
        $this->db->where('id', $id);
        $this->db->where('people_id', $personId);
        return $this->db->update($this->table_name, $data);
    }

    public function delete($id, $personId)
    {
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
		$this->db->where('people_id', $personId);
        return $this->db->update($this->table_name, $data);
    }
}
