<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Help;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Help\HelpLanguagesRequest;

/**
 * Help languages request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class HelpLanguagesRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new HelpLanguagesRequest($this->optionBagFactory);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\Rest\AbstractRequest', $this->request);
    }

    public function testOAuthRequest()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/help/languages.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }
}
