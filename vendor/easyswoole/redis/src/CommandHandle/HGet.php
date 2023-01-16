<?php

namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class HGet extends AbstractCommandHandle
{
    public $commandName = 'HGet';


    public function handelCommandData(...$data)
    {
        $key = array_shift($data);
        $this->setClusterExecClientByKey($key);
        $field = array_shift($data);

        $command = [CommandConst::HGET, $key, $field];
        $commandData = array_merge($command, $data);
        return $commandData;
    }


    public function handelRecv(Response $recv)
    {
        $data = $recv->getData();
        return $this->unSerialize($data);
    }
}
