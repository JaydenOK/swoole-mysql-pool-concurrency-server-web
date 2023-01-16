<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class PExpire extends AbstractCommandHandle
{
	public $commandName = 'PExpire';


	public function handelCommandData(...$data)
	{
		$key=array_shift($data);
        $this->setClusterExecClientByKey($key);
        $expireTime=array_shift($data);

		$command = [CommandConst::PEXPIRE,$key,$expireTime];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return $recv->getData();
	}
}
