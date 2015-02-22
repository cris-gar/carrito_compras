<script type="text/javascript" src="<?php echo base_url(); ?>public/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/core.js"></script>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <tbody>
        <!-- Aplicadas en las filas -->
        <tr class="active">
            <th>Nombre</th>
            <th>Descipcion</th>
            <th>Codigo</th>
            <th>Stock</th>
            <th>Foto</th>
        </tr>
<!-- Aplicadas en las celdas (<td> o <th>) -->
        <?php
            foreach ($ArrayConLosProductosEnLaBDD as $Productos):
                echo ' <tr>';
                    echo '<td>'. $Productos->nombre . '</td>';
                    echo '<td>'. $Productos->descripcion .'</td>';
                    echo '<td>'. $Productos->codigo .'</td>';
                    echo '<td>'. $Productos->stock .'</td>';

                $image_properties = array(
                    'src' => 'uploads/'.$Productos->foto,
                    'width' => '50',
                    'height' => '50',
                    );

                    echo '<td>'.  img($image_properties) .'</td>';

                    echo '<td></t><fieldset>';
                    echo form_open();
                    echo '<label>Quantity</label>';
                    echo form_input('quantity', '1', 'maxlength="2"');
                    echo form_hidden('product_id', $Productos->id);
                    echo form_submit('add', 'Add');
                    echo form_close();
                    echo '</fieldset></td>';

                    echo '</tr>';
            endforeach;
        ?>
    </tbody>
</table>

    <div id="wrap">


        <div class="cart_list">
            <h3>Your shopping cart</h3>
            <div id="cart_content">
                <?php echo $this->view('carrito_compras/cart.php'); ?>
            </div>
        </div>
    </div>