<?php
require(APPPATH.'libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Person extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('people_model');
	}

    /**
     * @api {get} /person List all people
     * @apiVersion 1.0.0
     * @apiName Get
     * @apiGroup People
     */	
    public function index_get()
    {
		$results = $this->people_model->get();
        $this->response(['data' => $results]);
    }

    /**
     * @api {post} /person/create Create a new Person
     * @apiVersion 1.0.0
     * @apiName Create
     * @apiGroup Person
     *
     * @apiParam {Integer} id id of the user
     *
	 * @apiParam {Array[]} Person
     * @apiParam {String} Person.name Name of user
     * @apiParam {String} Person.last_name Last name of user
     * @apiParam {Date} Person.date_birth date of the birth yyyy-mm-dd
     *
     * @apiParam {Array[]} Contact
     * @apiParam {Integer=1-E-mail,2-Whatsapp,3-Phone, 4-Cellphone, 5-Others} Contact.type
     * @apiParam {String} Contact.value
     */	
    public function create_post()
    {
        $return = $this->people_model->insert();
		$this->response($return);
	}
	
    /**
     * @api {put} /person/:id/update Updata a person
     * @apiVersion 1.0.0
     * @apiName Update
     * @apiGroup Person
     *
     * @apiParam {Integer} id id of the user
     *
	 * @apiParam {Array[]} Person
     * @apiParam {String} Person.name Name of user
     * @apiParam {String} Person.last_name Last name of user
     * @apiParam {Date} Person.date_birth date of the birth yyyy-mm-dd
     *
     * @apiParam {Array[]} Contact
     * @apiParam {Integer=1-E-mail,2-Whatsapp,3-Phone, 4-Cellphone, 5-Others} Contact.type
     * @apiParam {String} Contact.value
     */	
	public function update_put($id) {
		$dataPerson = $this->put('Person');
		$dataContact = $this->put('Contact');
		$return = $this->people_model->update($id, $dataPerson, $dataContact);
		$this->response($return);
	}

    /**
     * @api {delete} /person/:id/delete Delete a person
     * @apiVersion 1.0.0
     * @apiName Delete
     * @apiGroup Person
     *
     * @apiParam {Integer} id id of the user
     */	
	public function delete_delete($id) {
		$return = $this->people_model->delete($id);
		$this->response($return);
	}
}
