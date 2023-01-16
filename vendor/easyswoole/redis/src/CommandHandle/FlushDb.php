<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class FlushDb extends AbstractCommandHandle
{
	public $commandName = 'FlushDb';


	public function handelCommandData(...$data)
	{

		$command = [CommandConst::FLUSHDB];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return true;
	}
}
