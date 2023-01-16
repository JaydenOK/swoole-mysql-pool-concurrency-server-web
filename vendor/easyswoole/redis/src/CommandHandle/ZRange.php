<?php

namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class ZRange extends AbstractCommandHandle
{
    public $commandName = 'ZRange';

    protected $withScores = false;

    public function handelCommandData(...$data)
    {
        $key = array_shift($data);
        $this->setClusterExecClientByKey($key);
        $start = array_shift($data);
        $stop = array_shift($data);
        $withScores = array_shift($data);
        $this->withScores = $withScores;
        $command = [CommandConst::ZRANGE, $key, $start, $stop,];
        if ($withScores == true) {
            $command[] = 'WITHSCORES';
        }
        $commandData = array_merge($command);
        return $commandData;
    }


    public function handelRecv(Response $recv)
    {
        $data = $recv->getData();
        if ($this->withScores == true) {
            $result = [];
            foreach ($data as $k => $va) {
                if ($k % 2 == 0) {
                    $result[$this->unSerialize($va)] = 0;
                } else {
                    $result[$this->unSerialize($data[$k - 1])] = $va;
                }
            }
        } else {
            $result = [];
            foreach ($data as $k => $va) {
                $result[$k] = $this->unSerialize($va);
            }
        }

        return $result;
    }
}
