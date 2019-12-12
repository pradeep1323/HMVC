<?php
/**
 * Name:    Common Method Model
 * Author:  Pradeep
 *           pradeepraj110197@gmail.com
 *
 * Requirements: PHP5 or above
 *
 * @package    CodeIgniter-Custom-query-Methods
 * @author     Er.Pradeep
 * @link       https://github.com/pradeep1323/HMVC/
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Common_method_model
 */
class Common_method_model extends CI_Model
{
    /**
     *
     * where condition pass accorting to need
     * $where = array('col_name'=>$val,'col_name1'=>$val2)
     *
     */

    /**
     * @param $table
     * @param $data
     * @return bool
     */
    public function insert($table,$data)
    {

        if ($this->db->table_exists($table))
        {
            $this->db->trans_begin();
            $query = $this->db->insert($table, $data);
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }
        }
    }

    /**
     * @param $table_name
     * @param $data
     * @param $where
     * @return bool
     */
    public function updateWhere($table_name,$data,$where)
    {
        if ($this->db->table_exists($table_name)) {
            $query = $this->db
                ->update($table_name, $data, $where);
            if ($query) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @param $table
     * @param $where
     * @return bool
     */
    public function deleteWhere($table,$where){
        if ($this->db->table_exists($table)) {
            $query = $this->db->delete($table, $where);
            if ($query) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }



    /**
     * @param $table
     * @param $data
     * @return bool
     * $where = "(location_type='1' OR location_type='2' OR region LIKE '%".$region."%')";
     * ->where ("(location_type='1' OR location_type='2' OR region LIKE '%".$region."%')", NULL, FALSE)
     */
    public function getResult($table,$data)
    {
        if ($this->db->table_exists($table)) {
            $query = $this->db->select($data)
                ->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @param $table
     * @param $where
     * @param $data
     * @return bool
     * $where = array('col_name'=>$val,'col_name1'=>$val2)
     */
    public function getWhereResult($table,$where,$data)
    {
        if ($this->db->table_exists($table)) {
            $query = $this->db->select($data)
                ->where($where)
                ->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @param $table
     * @param $data
     * @return bool
     */
    public function getRow($table,$data)
    {
        if ($this->db->table_exists($table)) {
            $query = $this->db->select($data)
                ->get($table);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return FALSE;
            }
        }
    }

    /**
     * @param $table
     * @param $where
     * @param $data
     * @return bool
     */
    public function getWhereRow($table,$where,$data)
    {
        if ($this->db->table_exists($table)) {
            $query = $this->db->select($data)
                ->where($where)
                ->get($table);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return FALSE;
            }
        }
    }
}
