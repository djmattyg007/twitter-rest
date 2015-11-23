<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Friendships;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Friendships\FriendshipsIncomingRequest;

/**
 * Friendships Incomming request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsIncomingRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new FriendshipsIncomingRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getCursor());
        $this->assertNull($this->request->getStringifyIds());
    }

    public function testCursor()
    {
        $this->request->setCursor('0123456789');

        $this->assertSame('0123456789', $this->request->getCursor());
    }

    public function testStringifyIds()
    {
        $this->request->setStringifyIds(true);

        $this->assertTrue($this->request->getStringifyIds());
    }

    public function testOAuthRequestWithoutParameters()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/friendships/incoming.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setCursor('123456789');
        $this->request->setStringifyIds(true);

        $expected = array(
            'cursor'        => '123456789',
            'stringify_ids' => 'true'
        );

        $this->assertSame($expected, $this->request->createOAuthRequest()->getGetParameters());
    }
}
