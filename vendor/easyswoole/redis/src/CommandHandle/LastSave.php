<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class LastSave extends AbstractCommandHandle
{
	public $commandName = 'LastSave';


	public function handelCommandData(...$data)
	{

		$command = [CommandConst::LASTSAVE];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return $recv->getData();
	}
}
