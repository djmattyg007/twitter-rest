<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\DirectMessages;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\DirectMessages\DirectMessagesShowRequest;

/**
 * Statuses show request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectMessagesShowRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new DirectMessagesShowRequest($this->optionBagFactory, '123');
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

        $this->assertSame('123', $this->request->getId());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testOAuthRequest()
    {
        $this->request->setId('12344');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array('id' => '12344');

        $this->assertSame('/direct_messages/show.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide an id.
     */
    public function testOAuthRequestWithoutId()
    {
        $this->request->setId(null);

        $this->request->createOAuthRequest();
    }
}
