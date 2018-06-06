<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductoRol]].
 *
 * @see ProductoRol
 */
class ProductoRolQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductoRol[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductoRol|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
