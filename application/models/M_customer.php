<?php 
class M_customer extends CI_Model {
	
	var $table = 'customer'; //nama tabel dari database
    var $column_order = array(null,null,  'kode_customer','nama_customer','alamat','telpon','keterangan'); //field yang ada di table user
    var $column_search = array('kode_customer','nama_customer','alamat','telpon','keterangan');  //field yang diizin untuk pencarian 
    var $order = array('nama_customer' => 'asc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkCustomer($kodecustomer)
        {
                $sql = "select * from customer where kode_customer='$kodecustomer'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function saveCustomer($kode,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "insert into customer values ('$kode','$nama','$alamat','$telepon','$keterangan')";
				
				$query = $this->db->query($sql);
		}

   	public function updateCustomer($kodelama,$kodebaru,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "update customer set nama_customer='$nama',telpon='$telepon',alamat='$alamat',keterangan='$keterangan', kode_customer='$kodebaru' where kode_customer='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deleteCustomer($kode)
        {
                $sql = "delete from customer where kode_customer='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getCustomerAll()
        {
                $sql = "select * from customer order by nama_customer";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getCustomerByKode($kodecustomer)
        {
                $sql = "select * from customer where kode_customer='$kodecustomer'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }
	
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 

}