<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class HLen extends AbstractCommandHandle
{
	public $commandName = 'HLen';


	public function handelCommandData(...$data)
	{
		$key=array_shift($data);
        $this->setClusterExecClientByKey($key);




		$command = [CommandConst::HLEN,$key];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return $recv->getData();
	}
}
