<?php

class People_model extends CI_Model
{
    private $table_name = 'people';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($id = null)
    {
		$return = [];
		$this->db->select('p.*, pc.id AS pc_id, pc.people_contact_type_id as type_id, pct.type, pc.value')
			->from('people p')
			->join('people_contacts pc', 'pc.people_id = p.id and pc.deleted_at is null', 'left')
			->join('people_contact_types pct', 'pc.people_contact_type_id = pct.id', 'left')
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
						'id' => (int)$result->id,
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
						'type_id' => (int)$result->type_id,
						'type' => $result->type,
						'value' => $result->value
					];
				}
			}
			$return = array_values($return);
			return $return;
		}		
    }

    public function insert()
    {
        $createdAt = date('Y-m-d H:i:s');
        $updateAt = date('Y-m-d H:i:s');

        $dataPerson = $this->input->post('Person');
        $dataPerson['created_at'] = $createdAt;
        $dataPerson['updated_at'] = $updateAt;
        $this->db->insert($this->table_name, $dataPerson);
    
        $personId = $this->db->insert_id();

        $contacts = $this->input->post('Contact');
        if (isset($contacts)) {
            foreach ($contacts as $contact) {
                $dataContacts = [
                    'people_id' => $personId,
                    'people_contact_type_id' => $contact['type'],
                    'value' => $contact['value'],
                    'created_at' => $createdAt,
                    'updated_at' => $updateAt
                ];
                $this->db->insert('people_contacts', $dataContacts);
            }
        }

        return true;
    }

    public function update($id, array $dataPerson, array $dataContact = [])
    {
        $updateAt = date('Y-m-d H:i:s');

        $dataPerson['updated_at'] = $updateAt;
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $dataPerson);

        if ($dataContact) {
            foreach ($dataContact as $key => $contact) {
                $data = [
                    'value' => $contact['value'],
                    'people_contact_type_id' => $key
                ];
                $this->db->where('id', $key);
                $this->db->update('people_contacts', $data);
            }
        }
        return true;
    }

    public function delete($id)
    {
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }
}
