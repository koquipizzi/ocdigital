<?php
/**
 * Plugin Name: Comandas Wordpress Plugin
 * Description: Plugin de implementación de api rest endpoints
 * Author: Qwavee Team
 * Author URI: http://www.qwavee.com
 * Version: 0.1
 * Plugin URI: http://www.qwavee.com/commandas-wordpress-plugin
 */

include_once 'wp-admin/includes/user.php';

add_action( 'rest_api_init',  function () {
    $plugin= new Comandas_Wordpress_Plugin;
    return $plugin->register_routes();
 });

class Comandas_Wordpress_Plugin extends WP_REST_Controller {
    
  /**
   * Register the routes for the objects of the controller.
   */
  public function register_routes() {
    $version = '1';
    $namespace = 'comandas_wordpress_plugin/v' . $version;
    register_rest_route( $namespace, '/role', [
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'get_items' ),
        'permission_callback' => array( $this, 'get_items_permissions_check' ),
        'args'            => [],
      ),
      array(
        'methods'         => WP_REST_Server::CREATABLE,
        'callback'        => array( $this, 'create_item' ),
        'permission_callback' => array( $this, 'create_item_permissions_check' ),
        'args'            => $this->get_endpoint_args_for_item_schema( true ),
      ),
    ]);
    register_rest_route( $namespace, '/role/(?P<name>[a-zA-Z0-9\s]+)', array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'get_item' ),
        'permission_callback' => array( $this, 'get_item_permissions_check' ),
        'args'            => array(
            'default' => FALSE
        ),
      ),
      array(
        'methods'         => WP_REST_Server::EDITABLE,
        'callback'        => array( $this, 'update_item' ),
        'permission_callback' => array( $this, 'update_item_permissions_check' ),
        'args'            => $this->get_endpoint_args_for_item_schema( false ),
      ),
      array(
        'methods'  => WP_REST_Server::DELETABLE,
        'callback' => array( $this, 'delete_item' ),
        'permission_callback' => array( $this, 'delete_item_permissions_check' ),
        'args'     => array(
          'force'    => array(
            'default'      => false,
          ),
        ),
      ),
    ) );
    
    /**
     * **********************************************************************
     * Products API
     * - Get product: Fetch product and roles information
     *      URL: comandas_wordpress_plugin/v1/product/<id> 
     * - Post product: Save role associated to product 
     *      URL: comandas_wordpress_plugin/v1/product/<id> 
     *      Post Parameters: { "rolename": "<rol_name>" }
     * - Delete product: Removes role from product 
     *      URL: comandas_wordpress_plugin/v1/product/<id>/<rol_name>
     * **********************************************************************
     */
    register_rest_route( $namespace, '/product/(?P<id>[\d]+)', array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'get_product' ),
        'permission_callback' => array( $this, 'get_item_permissions_check' ),
        'args'            => array(
            'default' => FALSE
        ),
      ),    
      array(
        'methods'         => WP_REST_Server::EDITABLE,
        'callback'        => array( $this, 'add_product_item' ),
        'permission_callback' => array( $this, 'update_item_permissions_check' ),
        'args'            => $this->get_endpoint_args_for_item_schema( false ),
      ),
    ) );
    register_rest_route( $namespace, '/product/(?P<id>[\d]+)/(?P<rolename>[a-zA-Z0-9\s]+)', array(
      array(
        'methods'  => WP_REST_Server::DELETABLE,
        'callback' => array( $this, 'delete_product_item' ),
        'permission_callback' => array( $this, 'delete_item_permissions_check' ),
      ),        
    ) );
    
    /**
     * **********************************************************************
     * Users API
     * - Get user: Fetch user and roles information
     *      URL: comandas_wordpress_plugin/v1/user/<id> 
     * - Post user: Save role associated to user 
     *      URL: comandas_wordpress_plugin/v1/user/<id> 
     *      Post Parameters: { "rolename": "<rol_name>" }
     * - Delete user: Removes role from user 
     *      URL: comandas_wordpress_plugin/v1/user/<id>/<rol_name>
     * **********************************************************************
     */
    register_rest_route( $namespace, '/user/(?P<id>[\d]+)', array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'get_user' ),
        'permission_callback' => array( $this, 'get_item_permissions_check' ),
        'args'            => array(
            'default' => FALSE
        ),
      ),        
      array(
        'methods'         => WP_REST_Server::EDITABLE,
        'callback'        => array( $this, 'add_user_item' ),
        'permission_callback' => array( $this, 'update_item_permissions_check' ),
        'args'            => $this->get_endpoint_args_for_item_schema( false ),
      ),
    ) );    
    register_rest_route( $namespace, '/user/(?P<id>[\d]+)/(?P<rolename>[a-zA-Z0-9\s]+)', array(
      array(
        'methods'  => WP_REST_Server::DELETABLE,
        'callback' => array( $this, 'delete_user_item' ),
        'permission_callback' => array( $this, 'delete_item_permissions_check' ),
      ),
    ) );        
    
  }
  
  private function get_raw_items() {
      return wp_roles()->roles;//get_editable_roles();
  }
 
  /**
   * Get a collection of items
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Response
   */
  public function get_items( $request ) {
    $items = $this->get_raw_items();
    $data = array();
    foreach( $items as $item ) {
      $itemdata = $this->prepare_item_for_response( $item, $request );
      $data[] = $this->prepare_response_for_collection( $itemdata );
    }
 
    return new WP_REST_Response( $data, 200 );
  }
  
  /**
   * @todo SI puede usar get_role
   * @param type $name
   * @return type
   * @throws Exception
   */
  private function locateRole($name) {
    $items = $this->get_raw_items();

    $data = NULL;
    foreach ($items as $key => $item) {
        if($key == strtolower($name)) {
            return $item;
        }
    }

    throw new Exception('Role no encontrado');
  }
 
  /**
   * Get one item from the collection
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Response
   */
  public function get_item( $request ) {
    //get parameters from request
    $params = $request->get_params();
    
    try {
        $data = $this->prepare_item_for_response( 
            $this->locateRole($params['name'])
            , $request 
        );
        return new WP_REST_Response( $data, 200 );
    } catch (Exception $exc) {
        return new WP_Error( 'not-found', __( 'Rol no encontrado', 'text-domain' ) );
    }

  }
 
  /**
   * Create one item from the collection
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function create_item( $request ) {
    $item = $this->prepare_item_for_database( $request );
    
    $data = add_role(
                strtolower($item),
                $item,
                ['read' => true]
            );
    //do_action('members_role_added', strtolower($item));
    
    if(!is_null($data)) {
        return new WP_REST_Response( $data, 200 );
    }
 
    return new WP_Error( 'cant-create', __( 'Rol ya existe', 'text-domain'), array( 'status' => 500 ) );
  }
 
  /**
   * Update one item from the collection
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function update_item( $request ) {
    $params = $request->get_params();  
    $new_name = $this->prepare_item_for_database( $request );
    $name = $params['name'];

    try {
        $this->locateRole($name);
        
        $users = get_users( array('role'=> $name) );       
        if(!empty($users)) {
            return new WP_Error( 'cant-update', __( 'No puede modificarse un Rol si posee usuarios', 'text-domain'), array( 'status' => 500 ) );
        }
        
        remove_role($name);
        $rol = add_role(
            strtolower($new_name),
            $new_name,
            ['read' => true]
        );        
        //do_action('members_role_added', strtolower($item));
        
        return new WP_REST_Response( $rol, 200 );
        
    } catch (Exception $exc) {
        return new WP_Error( 'cant-update', __( 'No puede modificarse el Rol porque no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-update', __( 'Rol no puede ser actualizado', 'text-domain'), array( 'status' => 500 ) );      
  }
 
  /**
   * Delete one item from the collection
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function delete_item( $request ) { 
    $params = $request->get_params();  
    $name = $params['name'];
    
    try {
        $rol = $this->locateRole($name);
        
        $users = get_users( array('role'=> $name) );       
        if(!empty($users)) {
            return new WP_Error( 'cant-delete', __( 'No puede borrarse un Rol si posee usuarios', 'text-domain'), array( 'status' => 500 ) );
        }
        
        remove_role($name);
        return new WP_REST_Response( $rol, 200 );
        
    } catch (Exception $exc) {
        return new WP_Error( 'cant-delete', __( 'No puede borrarse el Rol porque no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-delete', __( 'No puede borrarse un Rol', 'text-domain'), array( 'status' => 500 ) );
  }
 
  /**
   * Check if a given request has access to get items
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
  public function get_items_permissions_check( $request ) {
    return 
        current_user_can( 'list_roles' )
      ||current_user_can( 'create_roles' )
      ||current_user_can( 'delete_roles' )
      ||current_user_can( 'edit_roles' );
  }
 
  /**
   * Check if a given request has access to get a specific item
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
  public function get_item_permissions_check( $request ) {
    return $this->get_items_permissions_check( $request );
  }
 
  /**
   * Check if a given request has access to create items
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
  public function create_item_permissions_check( $request ) {
    return $this->get_items_permissions_check( $request );      
  }
 
  /**
   * Check if a given request has access to update a specific item
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
  public function update_item_permissions_check( $request ) {
    return $this->get_items_permissions_check( $request );
  }
 
  /**
   * Check if a given request has access to delete a specific item
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
    public function delete_item_permissions_check( $request ) {
        return $this->get_items_permissions_check( $request );
    }
 
  /**
   * Prepare the item for create or update operation
   *
   * @param WP_REST_Request $request Request object
   * @return WP_Error|object $prepared_item
   */
    protected function prepare_item_for_database( $request ) {
        $rolename = $request->get_param('rolename');
        $rolename_sanitized = filter_var($rolename, FILTER_SANITIZE_STRING);
        return str_replace(' ', '_', $rolename_sanitized);
    }
 
  /**
   * Prepare the item for the REST response
   *
   * @param mixed $item WordPress representation of the item.
   * @param WP_REST_Request $request Request object.
   * @return mixed
   */
  public function prepare_item_for_response( $item, $request ) {
    return $item;
  }
 
  /**
   * Get the query params for collections
   *
   * @return array
   */
  public function get_collection_params() {
    return array(
      'rolename'     => array(
        'description'        => 'Role name',
        'type'               => 'integer',
        'default'            => 1,
        'sanitize_callback'  => 'absint',
      ),
    );
  }
  
  private function setRestrictedProduct($product_id) {

        try {
            $r = get_post_meta( $product_id, "_wc_restrictions_purchase", false );
            if(empty($r) || $r[0] = "inherit") {
                delete_post_meta( $product_id, "_wc_restrictions_purchase");                                        
                if(!add_post_meta( $product_id, "_wc_restrictions_purchase", "restricted", false )) {
                    throw new Exception('No ha podido setear _wc_restrictions_purchase');
                }
            }

            $r = get_post_meta( $product_id, "_wc_restrictions_price", false );
            if(empty($r) || $r[0] = "inherit") {
                delete_post_meta( $product_id, "_wc_restrictions_price");                        
                if(!add_post_meta( $product_id, "_wc_restrictions_price", "restricted", false )) {
                    throw new Exception('No ha podido setear _wc_restrictions_price');
                }
            }

            $r = get_post_meta( $product_id, "_wc_restrictions", false );
            if(empty($r) || $r[0] = "inherit") {
                delete_post_meta( $product_id, "_wc_restrictions");                        
                if(!add_post_meta( $product_id, "_wc_restrictions", "restricted", false )) {
                    throw new Exception('No ha podido setear _wc_restrictions');
                }                
            }
        } catch (Exception $exc) {
            return false;
        }
       
        return true;
  }
  
  private function setPublicProduct($product_id) {

        try {
            $r = get_post_meta( $product_id, "_wc_restrictions_purchase", false );
            if(!empty($r) || $r[0] = "restricted") {
                delete_post_meta( $product_id, "_wc_restrictions_purchase");                                        
                if(!add_post_meta( $product_id, "_wc_restrictions_purchase", "inherit", false )) {
                    throw new Exception('No ha podido setear _wc_restrictions_purchase');
                }
            }

            $r = get_post_meta( $product_id, "_wc_restrictions_price", false );
            if(!empty($r) || $r[0] = "restricted") {
                delete_post_meta( $product_id, "_wc_restrictions_price");                                        
                if(!add_post_meta( $product_id, "_wc_restrictions_price", "inherit", false )) {
                    throw new Exception('No ha podido setear _wc_restrictions_price');
                }
            }            

            $r = get_post_meta( $product_id, "_wc_restrictions", false );
            if(empty($r) || $r[0] = "restricted") {
                if(!delete_post_meta( $product_id, "_wc_restrictions")) {
                    throw new Exception('No ha podido setear _wc_restrictions');
                }                
            }
            
            $r = get_post_meta( $product_id, "_wc_restrictions_purchase_roles", false );
            if(!empty($r)) {
                if(!delete_post_meta( $product_id, "_wc_restrictions_purchase_roles")) {
                    throw new Exception('No ha podido setear _wc_restrictions_purchase_roles');
                }                
            }
            
            $r = get_post_meta( $product_id, "_wc_restrictions_price_roles", false );
            if(!empty($r)) {
                if(!delete_post_meta( $product_id, "_wc_restrictions_price_roles")) {
                    throw new Exception('No ha podido setear _wc_restrictions_price_roles');
                }                
            }
            
        } catch (Exception $exc) {
            return false;
        }
       
        return true;
  }

  private function add_role_restricted($product_id, $rolename) {
    try {
        
        $r = get_post_meta( $product_id, "_wc_restrictions_purchase_roles", true );
        $r[]=$rolename;
        delete_post_meta( $product_id, "_wc_restrictions_purchase_roles");
        if(!update_post_meta( $product_id, "_wc_restrictions_purchase_roles", $r, false)) {
            throw new Exception('No ha podido adicionar un rol en _wc_restrictions_purchase_roles');
        }                

        $r = get_post_meta( $product_id, "_wc_restrictions_price_roles", true );
        $r[]=$rolename;
        delete_post_meta( $product_id, "_wc_restrictions_price_roles");
        if(!update_post_meta( $product_id, "_wc_restrictions_price_roles", $r, false)) {
            throw new Exception('No ha podido adicionar un rol en _wc_restrictions_price_roles');
        }                

    } catch (Exception $exc) {
        return false;
    }

    return true;      
  }

  private function remove_role_restricted($product_id, $rolename) {
    try {
            
        $r = get_post_meta( $product_id, "_wc_restrictions_purchase_roles", true );
        $pos = array_search($rolename,$r);
        if( $pos !== FALSE) {
            unset($r[$pos]);
        }
        delete_post_meta( $product_id, "_wc_restrictions_purchase_roles");
        if(!update_post_meta( $product_id, "_wc_restrictions_purchase_roles", $r, false)) {
            throw new Exception('No ha podido eliminar el rol en _wc_restrictions_purchase_roles');
        }                

        $r = get_post_meta( $product_id, "_wc_restrictions_price_roles", true );
        $pos = array_search($rolename,$r);
        if( $pos !== FALSE) {
            unset($r[$pos]);
        }
        delete_post_meta( $product_id, "_wc_restrictions_price_roles");
        if(!update_post_meta( $product_id, "_wc_restrictions_price_roles", $r, false)) {
            throw new Exception('No ha podido eliminar el rol en _wc_restrictions_price_roles');
        }                
        
    } catch (Exception $exc) {
        return false;
    }

    return true;      
  }

  /**
   * Update product to update rol
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function add_product_item( $request ) {
    $params = $request->get_params();      
      $product_id = $params['id'];
      $rolename = $params['rolename'];
    
    try {
        $this->locateRole($rolename);
        
        $roles_existentes = get_post_meta( $product_id, '_wc_restrictions_allowed', false );
                
        if(array_search($rolename, $roles_existentes) === FALSE) {
            if(
                $this->setRestrictedProduct($product_id) 
                && add_post_meta( $product_id, '_wc_restrictions_allowed', $rolename, false )
                && $this->add_role_restricted($product_id, $rolename)        
            ) {
                $product = get_post_meta($product_id);
                if($product) {
                    return new WP_REST_Response( $product, 200 );
                }
                return new WP_Error( 'cant-get-product', __( 'Producto no existe', 'text-domain'), array( 'status' => 500 ) );      
            }
            else{
                return new WP_Error( 'cant-update', __( 'No puede modificarse los roles del producto', 'text-domain'), array( 'status' => 500 ) );                            
            }
        }                
    } catch (Exception $exc) {
        echo $exc->getMessage();
        return new WP_Error( 'cant-update-rol-not-exists', __( 'El rol no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-update-exists', __( 'Rol no puede ser incluido, ya existe', 'text-domain'), array( 'status' => 500 ) );      
  }  
  
  
  /**
   * Delete role from product 
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function delete_product_item( $request ) {
    $params = $request->get_params();      
      $product_id = $params['id'];
      $rolename = $params['rolename'];

    try {
        $this->locateRole($rolename);

        $roles_existentes = get_post_meta( $product_id, '_wc_restrictions_allowed', false );
        
        if(array_search($rolename, $roles_existentes) !== FALSE) {
            
            $operacion_valida = FALSE;
            if(count($roles_existentes) === 1) {
                $operacion_valida = $this->setPublicProduct($product_id);
                $operacion_valida = $operacion_valida && delete_post_meta( $product_id, '_wc_restrictions_allowed');
            }
            else {
                $operacion_valida = $this->remove_role_restricted($product_id, $rolename);
                $operacion_valida = $operacion_valida && delete_post_meta( $product_id, '_wc_restrictions_allowed', $rolename, false );
            }
            
            if($operacion_valida) {
                $product = get_post_meta($product_id);
                if($product) {
                    return new WP_REST_Response( $product, 200 );
                }
                return new WP_Error( 'cant-get-product', __( 'Producto no existe', 'text-domain'), array( 'status' => 500 ) );      
            }
            else{
                return new WP_Error( 'cant-update', __( 'No puede modificarse los roles del producto', 'text-domain'), array( 'status' => 500 ) );                            
            }
        }                
    } catch (Exception $exc) {
        return new WP_Error( 'cant-delete-rol-not-exists', __( 'El rol no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-delete-rol-not-exists', __( 'Rol no puede ser borrado, no existe en los roles del producto', 'text-domain'), array( 'status' => 500 ) );      
  }    
  
  
  /**
   * Get role/s from product 
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function get_product( $request ) {
      
    $params = $request->get_params();      
      $product_id = $params['id'];
    
    $product = get_post_meta($product_id);
    if($product) {
        return new WP_REST_Response( $product, 200 );
    }
    return new WP_Error( 'cant-get-product', __( 'Producto no existe', 'text-domain'), array( 'status' => 500 ) );      
  }      

  
  /**
   * Get user/s 
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function get_user( $request ) {
      
    $params = $request->get_params();      
      $user_id = $params['id'];
    
    $user = new WP_User($user_id);
    if($user) {
        return new WP_REST_Response( $user, 200 );
    }
    return new WP_Error( 'cant-get-user', __( 'Usuario no existe', 'text-domain'), array( 'status' => 500 ) );      
  }      
  
  
  /**
   * Update product to update rol
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function add_user_item( $request ) {
      
    $params = $request->get_params();      
      $user_id = $params['id'];
      $rolename = $params['rolename'];

    try {
        $this->locateRole($rolename);
        
        $user = new WP_User($user_id);

        if($user->id > 0) {
            $roles_existentes = $user->roles;
            if(array_search($rolename, $roles_existentes) !== FALSE) {
                return new WP_Error( 'cant-set-user_exists', __( 'El usuario ya tiene el rol', 'text-domain'), array( 'status' => 500 ) );
            }
            $user->add_role($rolename);
            $roles_existentes = $user->roles;
            if(array_search($rolename, $roles_existentes) !== FALSE) {
                return new WP_REST_Response( $user, 200 );
            }
            else{
                return new WP_Error( 'cant-set-user', __( 'El rol no puede ser agregado al usuario', 'text-domain'), array( 'status' => 500 ) );
            }
        }   
    } catch (Exception $exc) {
        echo $exc->getMessage();
        return new WP_Error( 'cant-update-rol-not-exists', __( 'El rol no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-user-exists', __( 'El Usuario No Existe', 'text-domain'), array( 'status' => 500 ) );      
  }    

  
  /**
   * Update product to update rol
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Request
   */
  public function delete_user_item( $request ) {      
    $params = $request->get_params();      
      $user_id = $params['id'];
      $rolename = $params['rolename'];
    try {
        $this->locateRole($rolename);
        
        $user = new WP_User($user_id);

        if($user->id > 0) {
            $roles_existentes = $user->roles;
            if(array_search($rolename, $roles_existentes) === FALSE) {
                return new WP_Error( 'cant-delete-user', __( 'Rol no puede ser borrado. El usuario no tiene el rol', 'text-domain'), array( 'status' => 500 ) );
            }
            $user->remove_role($rolename);
            $roles_existentes = $user->roles;            
            if(array_search($rolename, $roles_existentes) === FALSE) {
                return new WP_REST_Response( $user, 200 );
            }
            else{
                return new WP_Error( 'cant-set-user', __( 'El rol no puede ser borrarse del usuario', 'text-domain'), array( 'status' => 500 ) );
            }
        }   
    } catch (Exception $exc) {
        echo $exc->getMessage();
        return new WP_Error( 'cant-update-rol-not-exists', __( 'El rol no existe', 'text-domain'), array( 'status' => 500 ) );
    }
    
    return new WP_Error( 'cant-user-exists', __( 'El Usuario No Existe', 'text-domain'), array( 'status' => 500 ) );      
  }    
  
}