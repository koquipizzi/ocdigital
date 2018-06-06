<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use drsdre\WordpressApi\Client;

class WordpressApi extends Component
{

  public $WordpressApi;

  public function init()
  {
      parent::init();
      $wordpress_credentials = [
         'endpoint' => 'http://50.87.202.25/~prospfq1/wp-json/comandas_wordpress_plugin/v1',
         'username' => 'admin',
         'password' => 'Prospero!321'
      ];
      $this->WordpressApi = new Client( $wordpress_credentials );
  }

  public function getRoles()
  {
    $ApiResult = $this->WordpressApi->getData(
      'role'
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function rolExist($rolename)
  {
    try {
      $ApiResult = $this->WordpressApi->getData(
        "role/$rolename"
      );
      $data = $ApiResult->asObject();
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function newRol($rolename)
  {
    $update_data = ['rolename' => $rolename];
    $ApiResult = $this->WordpressApi->postData(
      'role',
      'view',
      $update_data
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function clientHasRol($rolename,$id)
  {
    $ApiResult = $this->WordpressApi->getData(
      "user/$id"
    );
    $data = $ApiResult->asArray();
    $roles = $data['caps'];
    if (array_key_exists($rolename,$roles)){
      return true;
    }
    return false;
  }

  public function newClientRol($rolename,$id)
  {
    $update_data = ['rolename' => $rolename];
    $ApiResult = $this->WordpressApi->postData(
      "user/$id",
      'view',
      $update_data
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function deleteClientRol($rolename,$id)
  {
    $ApiResult = $this->WordpressApi->deleteData(
      "user/$id/$rolename"
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function getProductRol($id)
  {
    $ApiResult = $this->WordpressApi->getData(
      "product/$id",
      'view'
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function newProductRol($rolename,$id)
  {
    $update_data = ['rolename' => $rolename];
    $ApiResult = $this->WordpressApi->postData(
      "product/$id",
      'edit',
      $update_data
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function deleteRol($rolename)
  {
    $ApiResult = $this->WordpressApi->deleteData(
      "role/$rolename",
      'view'
    );
    $data = $ApiResult->asArray();
    return $data;
  }

  public function deleteProductoRol($rolename,$web_id)
  {
    $ApiResult = $this->WordpressApi->deleteData(
      "product/$web_id/$rolename"
    );
    $data = $ApiResult->asObject();
    return $data;
  }

  public function hideProduct($web_id)
  {
    try {
      $this->newProductRol('hidden',$web_id);
      $result = true;
    } catch (\Exception $e) {
      $result = false;
    }
    return $result;

  }

}
?>
