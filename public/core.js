/**
 * Created by cristian on 21-02-15.
 */

$(document).ready(function() {
    /*place jQuery actions here*/
    var link = "http://localhost/carrito_compras/"; // Url to your application (including index.php/)

    $("form").submit(function() {
        // Get the product ID and the quantity
        var id = $(this).find('input[name=product_id]').val();
        var qty = $(this).find('input[name=quantity]').val();

        $.post(link + "carritos_compras/add_cart_item", { product_id: id, quantity: qty, ajax: '1' },
            function(data){
                // Interact with returned data
                if(data == 'true'){

                    $.get(link + "carritos_compras/show_cart", function(cart){ // Get the contents of the url cart/show_cart
                        $("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
                    });
                }else{
                    alert("Product does not exist");
                }
            });

        return false; // Stop the browser of loading the page defined in the form "action" parameter.
    });

});