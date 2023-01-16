<?php

namespace module\models;

class AmazonModel extends Model
{

    public function tableName()
    {
        return 'yibai_amazon_account';
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