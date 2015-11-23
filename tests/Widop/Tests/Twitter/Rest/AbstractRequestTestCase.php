<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest;

use Widop\Twitter\Options\OptionBagFactory;

/**
 * Abstract request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractRequestTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\AbstractRequest */
    protected $request;

    /** @var \Widop\Twitter\Options\OptionBagFactory */
    protected $optionBagFactory;

    protected function setUp()
    {
        $this->optionBagFactory = new OptionBagFactory();
    }
}
