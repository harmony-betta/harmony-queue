# Harmony Queue Package

```
# worker.php

<?php

use Harmony\HarmonyQueue;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once 'Jobs/SendEmail.php'; # require your Bootstrap Application / Job File.

try {

	/**
	 * [$redis intances]
	 * @var HarmonyQueue
	 */
    $redis = new HarmonyQueue;

    /**
     * set Queue ID
     *
     * @param 	[int] $[first] 		= Unique ID
     * @param 	[int] $[second]		= expire time
     * @param 	[array] $[third]	= [Class Name, Method, Only One Argument!]
     *
     */
    $redis->setQId(12345, 10, ['SendEmail', 'run', 'bettadevindonesia@gmail.com']);

} catch (Exception $e) {

    die ($e->getMessage());

}
```

# Requirement
* PHP ^5.3.3 || ^7.0
* Redis [Download]('https://redis.io/download')

# Installation

	composer require harmony-betta/queue

# Usage

	$ php worker.php