<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Home_Model');
    }

    protected function recursive_parent($id) {
        $query = $this->Home_Model->getProductByID($id);
        $name = $query->name;
        $parents = array();
        if ($query->parent_id != null) {
            $parent_ids = explode('/', $query->parent_id);
            foreach ($parent_ids as $parent_id) {
                if ($parent_id!=''){
                    $parent = $this->recursive_parent($parent_id);
                    array_push($parents, $parent);
                }
            }
        }
        return array($name, $parents);
    }

    public function index()
    {

        $data['products_list'] = $this->Home_Model->listProducts();
        $data['products_parent_view']=array();
        if ($data['products_list']) {
            foreach ($data['products_list'] as $value){
                array_push($data['products_parent_view'],$this->recursive_parent($value->id));
            }
        }
        $data['nested_products_list'] = $this->Home_Model->Retrieving_Full_Tree();
        $this->load->view('home',$data);
    }

    public function product_submit()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'product_name', 'product name',
            'required|min_length[1]|is_unique[products.name]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        if ($this->form_validation->run() != FALSE){
            if ($this->input->post('products')){
                $parent_id = '';
                foreach ($this->input->post('products') as $products_id){
                    $parent_id .= $products_id.'/';
                }
                $data = array(
                    'parent_id'=>$parent_id,
                    'name'=>$this->input->post('product_name')
                );
            }else{
                $data = array(
                    'parent_id'=>null,
                    'name'=>$this->input->post('product_name')
                );
            }
            $this->Home_Model->insertProduct($data);
        }
        redirect(base_url());
    }
}
