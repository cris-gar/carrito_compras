<?php
/**
 * Created by PhpStorm.
 * User: cristian
 * Date: 21-02-15
 * Time: 06:34 PM
 */

$nombre = array(
    'name'        => 'nombre',
    'id'          => 'nombre',
);

$descripcion = array(
    'name' => 'descripcion',
    'id' => 'descripcion'
);

$codigo = array(
    'name' => 'codigo',
    'id' => 'codigo'
);

$stock = array(
    'name' => 'stock',
    'id' => 'stock',
);

echo form_open_multipart('carritos_compras/do_upload');

echo form_label('Nombre del producto', 'nombre');
echo form_input($nombre);
echo br();

echo form_label('Descripcion del producto', 'descripcion');
echo form_textarea($descripcion);
echo br();

echo form_label('Codigo del producto', 'codigo');
echo form_input($codigo);
echo br();

echo form_label('Stock del producto', 'stock');
echo form_input($stock);
echo br();

echo form_label('Imagen del producto', 'imagen');
echo form_upload('userfile');
echo br();

echo form_submit('enviar', 'Crear Producto');
echo form_close();