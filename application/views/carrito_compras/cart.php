<?php
/**
 * Created by PhpStorm.
 * User: cristian
 * Date: 21-02-15
 * Time: 09:44 PM
 */
if(!$this->cart->contents()):
    echo 'Uds no tiene articulos en el carro.';
else:
    ?>

    <?php echo form_open('carritos_compras/update_cart'); ?>
    <table width="100%" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <td>Cantidad</td>
            <td>Nombre del Producto</td>
            <td>Descripcion del Producto</td>
            <td>Codigo del Producto</td>
            <td>Precio del Producto</td>
            <td>Sub-Total</td>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($this->cart->contents() as $Producto): ?>

            <?php echo form_hidden('rowid[]', $Producto['rowid']); ?>
            <tr <?php if($i&1){ echo 'class="alt"'; }?>>
                <td>
                    <?php echo form_input(array('name' => 'qty[]', 'value' => $Producto['qty'], 'maxlength' => '3', 'size' => '5')); ?>
                </td>

                <td><?php echo $Producto['name']; ?></td>
                <td><?php echo $Producto['options']['descripcion']; ?></td>
                <td><?php echo $Producto['options']['codigo']; ?></td>
                <td>&euro;<?php echo $this->cart->format_number($Producto['price']); ?></td>
                <td>&euro;<?php echo $this->cart->format_number($Producto['subtotal']); ?></td>
            </tr>

            <?php $i++; ?>
        <?php endforeach; ?>

        <tr>
            <td</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td>&euro;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
        </tr>
        </tbody>
    </table>

    <p><?php echo form_submit('', 'Actualizar tu carro'); echo anchor('carritos_compras/empty_cart', 'Vaciar Carro', 'class="empty"');
        echo "\n".anchor('carritos_compras/comprar','Comprar')?></p>
    <p><small>Si la cantidad se ajusta a cero, el artículo será retirado de la carreta.</small></p>
    <?php
    echo form_close();
endif;
?>