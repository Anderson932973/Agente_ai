<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agente_iachat extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agentchat_model');
        $this->load->model('Agente_iaai_model');
    }

    /**send */
    public function send()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $idStaff = get_staff_user_id();
        $data['staffid'] = $idStaff;
        $data['session_id'] = session_id();
        $data['sender'] = 'staff';
        $data['status'] = 'sent';
        $data['datetime'] = date('Y-m-d H:i:s');
        // $data['message'] = $data['message'];
        // echo "<pre>"; var_dump($data); exit;
        $id = $this->Agentchat_model->save($data);
        if($id){
            $CI =&get_instance();
            $CI->load->library('Agente_i_a');

            $agente_ias = $this->Agente_iaai_model->get_agents(['atuacao' => 'all'], 1);
            if(empty($agente_ias)){
                $agente_ias = $this->Agente_iaai_model->get_agents(['atuacao' => 'staff'], 1);
            }
            if(is_array($agente_ias)){
                $agente_ias = $agente_ias[0];
            }

            $resposta = $CI->agente_i_a->gpt($data['message'], $agente_ias);
            if($resposta){
                $data['message'] = $resposta;
                $data['sender'] = 'ia';
                $data['status'] = 'sent';
                $data['datetime'] = date('Y-m-d H:i:s');
                $this->Agentchat_model->save($data);
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['id' => $id]));
    }

    public function mensagens()
    {
        $limit = null;
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        $idStaff = get_staff_user_id();

        $mensagens = $this->Agentchat_model->get($idStaff, $limit);
        //[{"id":"1","session_id":"bce46ae4d8badac8705cf9b0b412abc610f6782a","staffid":"1","message":"oi","datetime":"2025-02-08 12:44:55","sender":"staff","status":"sent"}]

        $this->output->set_content_type('application/json')->set_output(json_encode($mensagens));
    }
}