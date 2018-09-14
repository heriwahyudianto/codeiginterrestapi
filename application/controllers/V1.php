<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class V1 extends REST_Controller {
    public function __construct($config = 'rest')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //TODO JWT (json web token)
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['customers_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['customers_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['customers_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function customers_get()
    {
        $id = $this->get('id');

        $this->load->model('customer_model');  
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            $customers=$this->customer_model->listall();    
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($customers)
            {
                // Set the response and exit
                $this->response($customers, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No customers were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $customer = NULL;
        $customers=$this->customer_model->get($id);    
        if (!empty($customers))
        {
            foreach ($customers as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $customer = $value;
                }
            }
        }

        if (!empty($customer))
        {
            $this->set_response($customer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Customer could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function customer_get($id)
    {
        $id = $this->get('id');
        $this->load->model('customer_model');  
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No customers were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $customer=$this->customer_model->get($id);  
        

        if (count($customer))
        {
            $this->set_response($customer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Customer could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function customers_post()
    {
        $datas= $this->post();
        //TO DO validation
        $this->load->model('customer_model');        
        $customer=$this->customer_model->add($datas);
        $this->set_response($datas, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function customers_delete()
    {
        // TO DO check transaction
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function transactions_get()
    {
        $id = $this->get('id');

        $this->load->model('transaction_model');  
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            $transactions=$this->transaction_model->listall();    
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($transactions)
            {
                // Set the response and exit
                $this->response($transactions, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No customers were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $transaction = NULL;
        $transactions=$this->transaction_model->get($id);    
        if (!empty($transactions))
        {
            foreach ($transactions as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $transaction = $value;
                }
            }
        }

        if (!empty($transaction))
        {
            $this->set_response($transaction, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Transaction could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function transaction_get($customerid)
    {
        $id = $this->get('customerid');
        $this->load->model('transaction_model');  
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No transactions were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $transaction=$this->transaction_model->getbycustid($id);  
        

        if (count($transaction))
        {
            $this->set_response($transaction, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Transaction could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function transactions_post()
    {
        $datas= $this->post();
        //TO DO validation
        $this->load->model('transaction_model');        
        $transaction=$this->transaction_model->add($datas);
        $this->set_response($datas, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function transfers_post()
    {
        $datas= $this->post();
        //TO DO validation
        $this->load->model('transaction_model'); 
        $this->load->model('customer_model');
        $tocustomerid= $this->customer_model->getbyaccount($datas['toaccountnumber']);
        //TO DO if no toaccountnumber
        $fromdatas=['customerid'=>$datas['fromcustomerid'],'type'=>3, 'credit'=>$datas['amount'],'descr'=>'transfer ke '.$tocustomerid];
        $todatas=['customerid'=>$tocustomerid,'type'=>3, 'debet'=>$datas['amount'],'descr'=>'transfer dari '.$datas['fromcustomerid']];
        $transaction=$this->transaction_model->transfer($fromdatas,$todatas);
        $this->set_response([$fromdatas,$todatas], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function login_post()
    {
        $datas= $this->post();
        //TO DO validation
        $this->load->model('customer_model'); 
        $customer=$this->customer_model->login($datas);
        if (count($customer))
        {
            // TO DO token
            $this->set_response($customer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Customer could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function owner_get()
    {
        $this->load->model('transaction_model');
        $transactions=$this->transaction_model->saldo();    
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($transactions)
        {
            // Set the response and exit
            $this->response($transactions, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
}
