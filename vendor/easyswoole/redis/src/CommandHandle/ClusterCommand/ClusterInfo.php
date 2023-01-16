<?php

namespace EasySwoole\Redis\CommandHandle\ClusterCommand;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\CommandHandle\AbstractCommandHandle;
use EasySwoole\Redis\Response;

class ClusterInfo extends AbstractCommandHandle
{
    public $commandName = 'ClusterInfo';


    public function handelCommandData(...$data)
    {
        $command = [CommandConst::CLUSTER, 'INFO'];
        $commandData = array_merge($command);
        return $commandData;
    }


    public function handelRecv(Response $recv)
    {
        $result = [];
        foreach (explode("\r\n",$recv->getData()) as $value){
            if (empty($value)){
                continue;
            }
            $kvArr = explode(':',$value);
            $result[$kvArr[0]] = $kvArr[1];
        }
        return $result;
    }
}
