<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class UnWatch extends AbstractCommandHandle
{
	public $commandName = 'UnWatch';


	public function handelCommandData(...$data)
	{
		$command = [CommandConst::UNWATCH];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return true;
	}
}
