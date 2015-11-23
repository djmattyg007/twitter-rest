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
use Widop\Twitter\Rest\DirectMessages\DirectMessagesNewRequest;

/**
 * Direct messages new request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesNewRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new DirectMessagesNewRequest($this->optionBagFactory, 'This is a direct message.');
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
        $this->assertSame('This is a direct message.', $this->request->getText());
    }

    public function testUserId()
    {
        $this->request->setUserId('0123456789');

        $this->assertSame('0123456789', $this->request->getUserId());
    }

    public function testScreenName()
    {
        $this->request->setScreenName('0123456789');

        $this->assertSame('0123456789', $this->request->getScreenName());
    }

    public function testText()
    {
        $this->request->setText('mouchacho');

        $this->assertSame('mouchacho', $this->request->getText());
    }

    public function testOAuthRequestWithUserId()
    {
        $this->request->setUserId('123456789');
        $this->request->setText('bar');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'user_id' => '123456789',
            'text'    => 'bar',
        );

        $this->assertSame('/direct_messages/new.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $this->request->setScreenName('foo');
        $this->request->setText('bar');

        $expected = array(
            'screen_name' => 'foo',
            'text'        => 'bar',
        );

        $this->assertSame($expected, $this->request->createOAuthRequest()->getPostParameters());
    }

    public function testOAuthRequestWithUserIdAndScreenName()
    {
        $this->request->setUserId('123456789');
        $this->request->setScreenName('foo');
        $this->request->setText('bar');

        $expected = array(
            'user_id' => '123456789',
            'text'    => 'bar',
        );

        $this->assertEquals($expected, $this->request->createOAuthRequest()->getPostParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a user id or a screen name.
     */
    public function testOAuthRequestWithoutUserIdAndScreenName()
    {
        $this->request->setUserId(null);
        $this->request->setScreenName(null);

        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a text.
     */
    public function testOAuthRequestWithoutText()
    {
        $this->request->setUserId('123');
        $this->request->setText(null);

        $this->request->createOAuthRequest();
    }
}
