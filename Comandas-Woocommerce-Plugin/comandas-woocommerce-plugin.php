<?php
/**
 * Plugin Name: Comandas Woocomerce Plugin
 * Description: Plugin de implementación de api rest endpoints
 * Author: Qwavee Team
 * Author URI: http://www.qwavee.com
 * Version: 0.1
 * Plugin URI: http://www.qwavee.com/commandas-wordpress-plugin
 */


add_filter( 'woocommerce_checkout_fields' , 'custom_comanda_fecha_produccion_field' );

// Our hooked in function - $fields is passed via the filter!
function custom_comanda_fecha_produccion_field( $fields ) {

    $fields['fecha_produccion'] = array(
        'label'     => __('Fecha Producción', 'woocommerce'),
        'placeholder'   => _x('Fecha Producción', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true,
    );
    return $fields;

}


/**
 * Display field value on the order edit page
 */

add_action( 'woocommerce_checkout_before_customer_details', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta(){
    echo '
        <div class="col2-set" id="fecha_produccion_custom">
			     <div class="col-1">
                <div id="fecha_produccion_custom_checkout_field">
                    <h3>'.__('Fecha De Entrega del Pedido').'</h3>';

                    woocommerce_form_field( 'fecha_produccion',
                    [
                        'type'          => 'text',
                        'class'         => array('my-field-class form-row-wide'),
                        'required'      => true,
                        'id'            => 'fecha_produccion_datepicker',
                        'label'         => __('Fecha Producción'),
                        'placeholder'   => __('Seleccione Fecha de Producción'),
                    ]);
    echo '
                </div>
            </div>
        </div>';
}

/**
 * Update the order meta with field value
 **/
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');

function my_custom_checkout_field_update_order_meta( $order_id ) {
    delete_post_meta($order_id, 'fecha_produccion');
    if (isset($_POST['fecha_produccion'])) {
        add_post_meta( $order_id, 'fecha_produccion', $_POST['fecha_produccion']);
    }
}

//add_action( 'woocommerce_api_create_order', 'my_woocommerce_api_create_order', 10, 2);
//
//function my_woocommerce_api_create_order( $order_id, $data ) {
//
//     // $data contains the data was posted, add code to extract the required
//     // fields and process it as required
//     var_dump($order_id);
//     var_dump($data);
//     die('listorti!');
//
//}


// add the filter
add_filter( 'woocommerce_rest_prepare_shop_order_object', 'my_custom_wc_api_order_response', 10, 3 );
//// define the woocommerce_api_order_response callback
function my_custom_wc_api_order_response( $response, $object, $request ) {
    if (!empty($response->data['meta_data'])) {
      $a = DateTime::createFromFormat('d/m/Y', get_post_meta( $object->ID, 'fecha_produccion', true));
      if (!empty($a)) {
        $fecha = $a->format('Y-m-d');
        //$fecha = '2018-02-22';
        $response->data['fecha_produccion'] = $fecha; 
        //$response->data['fecha_produccion'] =  wc_rest_prepare_date_response('2018-02-22');
        return $response;
      }
     
    }
    return $response;

};

add_filter( 'wp_footer' , 'woo_add_checkout_field_date_range_limit' );
/**
 * woo_add_checkout_field_date_range_limit
 *
 * @access      public
 * @since       1.0
 * @return      void
 * See: http://jqueryui.com/datepicker/#min-max
*/
function woo_add_checkout_field_date_range_limit() {
	if ( is_checkout() ) {
	?>
	<script type="text/javascript">
		jQuery( document ).ready( function ( e ) {
			jQuery(function() {
				jQuery( "#fecha_produccion_datepicker" ).datepicker({
                    minDate: 1,
                    dateFormat: 'dd/mm/yy'
                });
			});
		});
	</script>
	<?php
	}
}

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    $actualDate = new \DateTime('+2 days');
    $userDate = DateTime::createFromFormat('d/m/Y',$_POST['fecha_produccion']);
    if ( $userDate  < $actualDate )
        wc_add_notice( __( 'El pedido no puede ser realizado en la fecha solicitada' ), 'error' );
}
?>
