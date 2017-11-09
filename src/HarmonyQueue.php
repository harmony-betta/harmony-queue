<?php 

/**
 * 
 * @author Imam Ali Mustofa <bettadevindonesia@gmail.com>
 * @package Harmony Framework Queue System Using Redis
 * 
 */

namespace Harmony;

use Predis\Client;

class HarmonyQueue
{
	protected $redis;

	public function __construct($redis = null)
	{
		$this->redis = ($redis == null) ? new Client : null;
	}

	public function setQId(int $queue_id, int $expire_time, array $queue_value)
	{
		$arr_queue = ['class_name' => $queue_value[0], 'method' => $queue_value[1], 'args' => $queue_value[2]];

		$this->redis->setex("queue:$queue_id", $expire_time, json_encode($arr_queue));
		$this->runQueue(true, $queue_id);

		call_user_func_array([ $arr_queue['class_name'], $arr_queue['method'] ], [ $arr_queue['args'] ]);
	}

	public function runQueue($run = true, $queue_id)
	{

	    while ($run) {
	        $queue = $this->redis->get("queue:$queue_id");
	        // echo $queue."\n";
	        // echo "=";

	        $ttl = $this->redis->ttl("queue:$queue_id");
	        // echo "ttl: ".$ttl."\n";
	        // echo "=";

	        sleep(1);

	        if ($ttl < 0) {
	            $run = false;
	        }
	    }
	}

	 public function removeQueue($queue_id)
	 {
	 	//
	 }

}