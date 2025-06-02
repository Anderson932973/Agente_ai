<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agente_iaai_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**save */
    public function save($data)
    {
        try{
            if (isset($data['id']) AND $data['id'] != '') {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('id', $data['id']);
                $this->db->update('agente_iaai', $data);
                return $data['id'];
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('agente_iaai', $data);
                return $this->db->insert_id();
            }
        } catch (Exception $e) {
            log_message('error', 'Liquida error - ' . $e->getMessage());
            var_dump($e->getMessage()); exit;
            return false;
        }
    }

    /**get_agents */
    public function get_agents($where = [], $limit = null, $offset = null)
    {
        try {
            $this->db->select('*');
            $this->db->from('agente_iaai');
            $this->db->where('status', 'active');

            if (!empty($where)) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }

            if ($limit !== null) {
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('id', 'DESC');
            return $this->db->get()->result();
        } catch (Exception $e) {
            log_message('error', 'Liquida error - ' . $e->getMessage());
            return [];
        }
    }

    /**get_agent ID */
    public function get_agent($id)
    {
        try {
            $this->db->select('*');
            $this->db->from('agente_iaai');
            $this->db->where('id', $id);
            return $this->db->get()->row();
        } catch (Exception $e) {
            log_message('error', 'Liquida error - ' . $e->getMessage());
            return null;
        }
    }

    /**delete_agent */
    public function delete_agent($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('agente_iaai');
            return true;
        } catch (Exception $e) {
            log_message('error', 'Liquida error - ' . $e->getMessage());
            return false;
        }
    }
}