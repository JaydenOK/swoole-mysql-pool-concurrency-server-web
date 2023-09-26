<?php

namespace module\controllers;

use module\lib\DingTalkRobotUtil;
use module\models\AmazonModel;
use module\models\MercadoModel;

class Publish extends Controller
{

    public function init()
    {

    }

    //刊登列表
    public function lists()
    {
        $platformCode = $this->get['platform_code'] ?? '';
        if (empty($platformCode)) {
            throw new \Exception('empty platform_code');
        }
        $lists = [];
        if ($platformCode === 'Amazon') {

        } else if ($platformCode === 'Mercado') {
            $mlPublishAttrModel = MercadoModel::model();
            $state = $this->get['state'] ?? 40;
            $lists = $mlPublishAttrModel->findAll(
                ['state' => $state],
                20,
                [
                    'publishId', 'state', 'productId', 'globalProductId', 'site', 'account', 'unitCode', 'updDate', 'levelCycleId',
                ]);
        }
        return ['lists' => $lists, 'count' => count($lists)];
    }

    //修改
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
        go(function () use ($id, $data) {
            //todo 协程处理其它任务
            $content[] = '【修改账号通知】';
            $content[] = '账号ID:' . $id;
            $content[] = '修改内容:' . json_encode($data, JSON_UNESCAPED_UNICODE);
            DingTalkRobotUtil::send($content, DingTalkRobotUtil::TOKEN_COMMON);
        });
        return ['id' => $id, 'result' => $affectRow];
    }

}