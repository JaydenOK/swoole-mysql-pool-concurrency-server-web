<?php
namespace EasySwoole\Redis\CommandHandle;

use EasySwoole\Redis\CommandConst;
use EasySwoole\Redis\Redis;
use EasySwoole\Redis\Response;

class Auth extends AbstractCommandHandle
{
	public $commandName = 'Auth';


	public function handelCommandData(...$data)
	{
		$password=array_shift($data);

		$command = [CommandConst::AUTH,$password];
		$commandData = array_merge($command,$data);
		return $commandData;
	}


	public function handelRecv(Response $recv)
	{
		return true;
	}
}
