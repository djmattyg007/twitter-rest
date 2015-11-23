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
use Widop\Twitter\Rest\Friendships\FriendshipsDestroyRequest;

/**
 * Friendships destroy request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsDestroyRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new FriendshipsDestroyRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getUserId());
        $this->assertNull($this->request->getScreenName());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame('noradio', $this->request->getScreenName());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setUserId('123456789');
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/friendships/destroy.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame(array('user_id' => '123456789'), $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('noradio');

        $this->assertSame(array('screen_name' => 'noradio'), $this->request->createOAuthRequest()->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }
}
