<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class Incr extends AbstractCommandHandle
{
	public $commandName = 'Incr';


	public function handelCommandData(...$data)
	{
		$key=array_shift($data);
        $this->setClusterExecClientByKey($key);


		$command = [CommandConst::INCR,$key];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return $recv->getData();
	}
}
