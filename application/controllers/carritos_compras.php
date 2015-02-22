<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carritos_compras extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $ArrayConLosProductosEnLaBDD = $this->Productos_model->GetProductos();
        if($ArrayConLosProductosEnLaBDD){
            $this->load->view('carrito_compras/index', compact('ArrayConLosProductosEnLaBDD'));
//            print_r($ArrayConLosProductosEnLaBDD);

        }else{
            echo "NO NO";
        }

    }

    public function create_producto(){

        $this->load->view('carrito_compras/create');
    }

    public function do_upload(){

        if($this->input->post()){

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000';
            $config['max_width'] = '2024';
            $config['max_height'] = '2008';

            //$this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload())
            {
                print_r($this->upload->file_type);
                print_r($error = array('error' => $this->upload->display_errors()));

                //$this->load->view('upload_form', $error);
            }
            else
            {
                $filename =  $this->upload->data();

                //$this->load->view('upload_success', $data);
                $ArrayConLosDatosDelProducto = array(
                    'nombre' => $this->input->post('nombre',true),
                    'descripcion' => $this->input->post('descripcion',true),
                    'codigo' => $this->input->post('codigo', true),
                    'stock' => $this->input->post('stock', true),
                    'foto' => $filename['file_name'],
                );

                $VerificacionCreateProducto = $this->Productos_model->InsertProducto($ArrayConLosDatosDelProducto);
                if($VerificacionCreateProducto){
                    redirect('http://localhost/carrito_compras' ,301);
                }

            }


        }
    }

    public function add_cart_item(){
        if($this->Productos_model->validate_add_cart_item() == TRUE){

            // Check if user has javascript enabled
            if($this->input->post('ajax') != '1'){

                redirect('carritos_compras'); // If javascript is not enabled, reload the page with new data
            }else{
                echo 'true'; // If javascript is enabled, return true, so the cart gets updated
            }
        }
    }


    public function show_cart(){
        $this->load->view('carrito_compras/cart');
    }
}
