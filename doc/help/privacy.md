# Help Privacy Request

Returns Twitter's Privacy Policy.

``` php
use Widop\Twitter\Options\OptionBagFactory;
use Widop\Twitter\Rest\Help\HelpPrivacyRequest;

$languages = $twitter->send(new HelpPrivacyRequest(new OptionBagFactory()));
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/help/privacy).
