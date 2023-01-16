<?php

namespace module\models;

class UserModel extends Model
{

    public function tableName()
    {
        return 'yb_user';
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