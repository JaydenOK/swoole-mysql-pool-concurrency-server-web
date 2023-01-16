<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class Watch extends AbstractCommandHandle
{
	public $commandName = 'Watch';


	public function handelCommandData(...$data)
	{
		$key=array_shift($data);

		$command = [CommandConst::WATCH,$key];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return true;
	}
}
