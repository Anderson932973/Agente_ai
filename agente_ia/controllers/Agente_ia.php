<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agente_ia extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agente_iaai_model');
    }

    /**Agents */
    public function index()
    {
        // if (!has_permission('agente_ia', '', 'view')) {
        //     access_denied('agente_ia');
        // }

        $data['title'] = _l('Agente_ia_builder_list');
        $data['agente_ias'] = $this->Agente_iaai_model->get_agents();
        $data['agentes'] = [
            'gpt' => 'GPT',
            // 'claude' => 'Claude',
            // 'gemini' => 'Gemini',
            // 'mistral' => 'Mistral',
            // 'llama' => 'Llama',
            // 'openai' => 'OpenAI',
        ];
        $data['modelos'] = [
            'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
            'gpt-4' => 'GPT-4',
            'gpt-4o' => 'GPT-4o',
            'gpt-4-turbo' => 'GPT-4 Turbo',
            'gpt-4o-mini' => 'GPT-4o Mini',
        ];
        $this->load->view('agente_ia/admin/agents', $data);
    }

    /**save */
    public function save()
    {
        // if (!has_permission('agente_ia', '', 'create') && !has_permission('agente_ia', '', 'edit')) {
        //     access_denied('agente_ia');
        // }

        $data = $this->input->post();
        $id = $this->Agente_iaai_model->save($data);

        if ($id) {
            set_alert('success', _l('agente_ia_saved_successfully'));
        } else {
            set_alert('danger', _l('agente_ia_saved_failed'));
        }

        redirect(admin_url('agente_ia'));
    }

    /**edit */
    public function edit($id)
    {
        // if (!has_permission('agente_ia', '', 'view')) {
        //     access_denied('agente_ia');
        // }

        $data['title'] = _l('Agente_ia_builder_edit');
        $data['agente_ia'] = $this->Agente_iaai_model->get_agent($id);
        $data['agente_ias'] = $this->Agente_iaai_model->get_agents();
        $data['agentes'] = [
            'gpt' => 'GPT',
            // 'claude' => 'Claude',
            // 'gemini' => 'Gemini',
            // 'mistral' => 'Mistral',
            // 'llama' => 'Llama',
            // 'openai' => 'OpenAI',
        ];
        $data['modelos'] = [
            'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
            'gpt-4' => 'GPT-4',
            'gpt-4o' => 'GPT-4o',
            'gpt-4-turbo' => 'GPT-4 Turbo',
            'gpt-4o-mini' => 'GPT-4o Mini',
        ];
        $data['edit'] = true;
        $this->load->view('agente_ia/admin/agents', $data);
    }

    /**delete */
    public function delete($id)
    {
        // if (!has_permission('agente_ia', '', 'delete')) {
        //     access_denied('agente_ia');
        // }
        $this->Agente_iaai_model->delete_agent($id);
        set_alert('success', _l('agente_ia_deleted'));
        redirect(admin_url('agente_ia'));
    }

}