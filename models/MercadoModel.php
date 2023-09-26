<?php

namespace module\models;

class MercadoModel extends Model
{

    public function tableName()
    {
        return 'ml_publish_attr';
    }

    /**
     * @param string $className
     * @return Model
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}