# Friendships Outgoing Request

Returns a collection of numeric IDs for every user who has a pending request to follow the authenticating user.

``` php
use Widop\Twitter\Options\OptionBagFactory;
use Widop\Twitter\Rest\Friendships\FriendshipsOutgoingRequest;

$request = new FriendshipsOutgoingRequest(new OptionBagFactory());

$request->setCursor('123465879');
$cursor = $request->getCursor();

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/friendships/outgoing).
