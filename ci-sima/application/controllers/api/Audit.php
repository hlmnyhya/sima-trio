<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Audit extends REST_Controller {

function __construct() {
    parent::__construct();
    $this->load->model('audit/m_audit','maudit');
    
    }

    public function Audit_get(){
        $id= $this->get('id');
        
        if ($id===null) {
            $audit= $this->maudit->GetAudit();
            
        }else{
            $audit= $this->maudit->GetAudit($id);

        }
        if ($audit) {
            $this->response([
                'status' => true,
                'data' => $audit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }

    public function Audit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->maudit->delAudit($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Audit_post()
    {
        $data=[
            'id_audit' => $this->post('id_audit',true),
                'auditor' => $this->post('auditor', true),
                'keterangan' => $this->post('keterangan', true),
                'idjenis_audit' => $this->post('idjenis_audit', true),
        ];

        if ($this->maudit->AddAudit($data)) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Audit_put()
    {
        $id =$this->put('id');

        $data=[
            'auditor' => $this->post('auditor', true),
            'keterangan' => $this->post('keterangan', true),
            'idjenis_audit' => $this->post('idjenis_audit', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->maudit->editAudit($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}
/** End of file Audit.php **/
 ?>
