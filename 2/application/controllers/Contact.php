<?php
require(APPPATH.'libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Contact extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
    }


    /**
     * @api {get} /contact/:person_id List all contacts of a person
     * @apiVersion 1.0.0
     * @apiName Get
     * @apiGroup Contact
	 * 
	 * @apiParam {Integer} person_id id of person
     */	
    public function index_get($person_id)
    {
        $results = $this->contact_model->get($person_id);
        $this->response(['data' => $results]);
    }

    /**
     * @api {post} /contact/:person_id/create Add one contact to person
     * @apiVersion 1.0.0
     * @apiName Create
     * @apiGroup Contact
     *
     * @apiParam {Integer} person_id id of the person
     *
     * @apiParam {Array[]} Contact
     * @apiParam {Integer=1-E-mail,2-Whatsapp,3-Phone, 4-Cellphone, 5-Others} contact.type
     * @apiParam {String} Contact.value
     */
    public function create_post($person_id)
    {
        $return = $this->contact_model->insert($person_id);
        $this->response($return);
    }
	
    /**
     * @api {put} /contact/:id/update/:person_id Update a contact of a person
     * @apiVersion 1.0.0
     * @apiName Update
     * @apiGroup Contact
     *
     * @apiParam {Integer} id id of the contact
     * @apiParam {Integer} person_id id of the person
     *
     * @apiParam {Array[]} Contact
     * @apiParam {Integer=1-E-mail,2-Whatsapp,3-Phone, 4-Cellphone, 5-Others} contact.type
     * @apiParam {String} Contact.value
     */
    public function update_put($id, $person_id)
    {
        $dataContact = $this->put('Contact');
        $dataContact['people_contact_type_id'] = $dataContact['type'];
        unset($dataContact['type']);
        $return = $this->contact_model->update($id, $person_id, $dataContact);
        $this->response($return);
    }

    /**
     * @api {delete} /contact/:id/delete/:person_id Delete a contact of a person
     * @apiVersion 1.0.0
     * @apiName Delete 
     * @apiGroup Person
     *
     * @apiParam {Integer} id id of the contact
     * @apiParam {Integer} person_id id of the person
     */
    public function delete_delete($id, $person_id)
    {
        $return = $this->contact_model->delete($id, $person_id);
        $this->response($return);
    }
}
