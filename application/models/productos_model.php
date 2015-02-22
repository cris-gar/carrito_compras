<?php
/**
 * Created by PhpStorm.
 * User: cristian
 * Date: 21-02-15
 * Time: 06:31 PM
 */

class Productos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function  GetProductos(){
        $query = $this->db
                ->select('*')
                ->from('productos')
                ->get();

        return $query->result();
    }

    function InsertProducto($ArrayConLosDatosDelProducto = array()){
        $this->db->insert('productos', $ArrayConLosDatosDelProducto);
        return true;
    }

    function validate_add_cart_item(){
        $id = $this->input->post('product_id'); // Assign posted product_id to $id
        $cty = $this->input->post('quantity'); // Assign posted quantity to $cty

        $this->db->where('id', $id); // Select where id matches the posted id
        $query = $this->db->get('productos', 1); // Select the products where a match is found and limit the query by 1

        // Check if a row has matched our product id
        if($query->num_rows > 0){
            // We have a match!
            foreach ($query->result() as $row) {
                // Create an array with product information
                $data = array(
                    'id' => $id,
                    'qty' => $cty,
                    'price' => 500,
                    'name' => $row->nombre
                );

                // Add the data to the cart using the insert function that is available because we loaded the cart library
                $this->cart->insert($data);
                return true;
            }
            }else{
            // Nothing found! Return FALSE!
            return FALSE;
        }
    }


}
