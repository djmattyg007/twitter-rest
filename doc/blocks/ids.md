# Blocks Ids Request

Returns an array of numeric user ids the authenticating user is blocking.

``` php
use Widop\Twitter\Options\OptionBagFactory;
use Widop\Twitter\Rest\Blocks\BlocksIdsRequest;

$request = new BlocksIdsRequest(new OptionBagFactory());

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$usersBlockedIds = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/blocks/ids).
