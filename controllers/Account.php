<?php

namespace module\controllers;

use module\models\AmazonModel;

class Account extends Controller
{

    public function init()
    {

    }

    //平台账号列表
    public function lists()
    {
        $platformCode = $this->get['platform_code'] ?? '';
        if (empty($platformCode)) {
            throw new \Exception('empty platform_code');
        }
        $accountModel = null;
        if ($platformCode === 'Amazon') {
            $accountModel = new AmazonModel();
        }
        if ($accountModel === null) {
            throw new \Exception('platform_code not support.');
        }
        $lists = $accountModel->findAll(
            ['account_status' => 10, 'auth_status' => 1],
            20,
            [
                'id', 'account_id', 'account_name', 'account_real_name as account_s_name', 'account_email', 'selling_partner_id',
                'auth_status', 'app_id', 'access_token', 'expires_time', 'account_status', 'site_id', 'is_pull_order',
                'account_sales_plan', 'is_leave_account', 'leave_time', 'group_id', 'is_adjustment', 'is_stocking', 'refresh_status', 'refresh_msg',
            ]);
        return ['lists' => $lists, 'count' => count($lists)];
    }

    //修改账号
    public function edit()
    {
        $platformCode = $this->get['platform_code'] ?? '';
        $id = $this->get['id'] ?? '';
        $data = $this->get['data'] ?? [];
        if (empty($platformCode) || empty($id) || empty($data)) {
            throw new \Exception('params error');
        }
        $accountModel = null;
        if ($platformCode === 'Amazon') {
            $accountModel = new AmazonModel();
        }
        if ($accountModel === null) {
            throw new \Exception('platform_code not support.');
        }
        $affectRow = $accountModel->saveData($data, ['id' => $id]);
        return ['id' => $id, 'result' => $affectRow];
    }

}