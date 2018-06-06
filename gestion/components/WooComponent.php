<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;


class WooComponent extends Component
{
    public $woocommerce;

    public function init()
    {
        parent::init();
        $this->woocommerce = new Client(
            'http://50.87.202.25/~prospfq1/',
            'ck_4fe5806728d73103c421aadf5288d159f333d421',
            'cs_dd83aea11b34a0437d3f0ecb07c796cc6a692266',
            [
                'wp_api' => true,
                'version' => 'wc/v2',
            ]
        );
    }

    // ------------------------------ -----------  CLIENTES --------------------------------------------
    public function getCliente($id){
        return $this->woocommerce->get('customers/'.$id);
    }

    public function getClienteMail($email)
    {
        return $this->woocommerce->get('customers', ['email' => $email]);
    }

    public function updateCliente($id, $data){
      $e = NULL;
      $error = FALSE;
      try {
        $e= $this->woocommerce->put('customers/'.$id, $data);
      } catch (HttpClientException $e) {
        $e = $e->getMessage();
        $error = true;
      }

        return ['error' => $error, 'mensaje' => $e];
    }

    public function deleteCliente($id){
        return $this->woocommerce->delete('customers/'.$id, ['force' => true]);
    }

    public function newCliente($data){
        $e = NULL;
        $error = FALSE;
        try {
          $e = $this->woocommerce->post('customers', $data);
        } catch (HttpClientException $e) {
          $e = $e->getMessage();
          $error = true;
        }
        return ['error' => $error, 'mensaje' => $e];
    }

    public function getClientes(){
        return $this->woocommerce->get('customers');
    }

    // ------------------------------ -----------  PEDIDOS --------------------------------------------
    public function getPedido($id)
    {
        return $this->woocommerce->get('orders/'.$id);
    }

    public function getPedidos($date)
    {
      // $date = '2017-12-20T00:00:00'; Formato que debe llevar la fecha para la api
      return $this->woocommerce->get('orders', ['after' => $date]);
    }

    public function updatePedido($id,$data)
    {
        return $this->woocommerce->put("orders/$id", $data);
    }

    public function deletePedido($id)
    {
      return $this->woocommerce->delete("orders/$id", ['force' => true]);
    }

    public function newPedido($data)
    {
      return $this->woocommerce->post('orders', $data);
    }

    public function setEstado($id,$estado)
    {
      $data = ['status' => $estado];
      return $this->woocommerce->put("orders/$id", $data);
    }

    // ------------------------------ -----------  PRODUCTOS --------------------------------------------
    public function newProducto($data)
    {
      try {
          return $this->woocommerce->post('products', $data);
      } catch (HttpClientException $e) {

      }
    }

    public function updateProducto($data,$id)
    {
      try {
          return $this->woocommerce->put('products/'.$id, $data);
      } catch (HttpClientException $e) {

      }
    }
}

?>
