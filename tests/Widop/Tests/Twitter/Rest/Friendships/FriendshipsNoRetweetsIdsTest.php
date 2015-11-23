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
use Widop\Twitter\Rest\Friendships\FriendshipsNoRetweetsIdsRequest;

/**
 * Friendships no retweets ids request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsNoRetweetsIdsRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new FriendshipsNoRetweetsIdsRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getStringifyIds());
    }

    public function testStringifyIds()
    {
        $this->request->setStringifyIds(true);

        $this->assertTrue($this->request->getStringifyIds());
    }

    public function testOAuthRequestWithoutParameters()
    {
        $this->assertEmpty($this->request->createOAuthRequest()->getGetParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setStringifyIds(true);
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/friendships/no_retweets/ids.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('stringify_ids' => 'true'), $oauthRequest->getGetParameters());
    }
}
