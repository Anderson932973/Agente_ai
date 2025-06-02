<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agentchat_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**save */
    public function save($data)
    {
        if(isset($data['id'])){
            $this->db->where('id', $data['id']);
            $this->db->update('agente_iachat', $data);
            return $data['id'];
        }else{
            $this->db->insert('agente_iachat', $data);
            return $this->db->insert_id();
        }
    }

    /**get list*/
    public function get($staffId, $limit = 50, $where = [])
    {
        try{
            $this->db->select('*');
            $this->db->from('agente_iachat');
            $this->db->where('staffid', $staffId);

            if(count($where) > 0){
                $this->db->where($where);
            }

            $this->db->order_by('id', 'DESC');
            $this->db->limit($limit);

            $mensagens = $this->db->get()->result();
            // ordernar por id
            $mensagens = array_reverse($mensagens);
            return $mensagens;
        }catch(Exception $e){
            log_message('error', 'Liquida error - '.$e->getMessage());
            return [];
        }
    }
}