<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\Statuses\StatusesShowRequest;

/**
 * Statuses show request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Statuses\StatusesShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new StatusesShowRequest('123');
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
        $this->assertNull($this->request->getTrimUser());
        $this->assertNull($this->request->getIncludeMyRetweet());
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testIncludeMyRetweet()
    {
        $this->request->setIncludeMyRetweet(true);

        $this->assertTrue($this->request->getIncludeMyRetweet());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setTrimUser(true);
        $this->request->setIncludeMyRetweet(true);
        $this->request->setIncludeEntities(true);

        $oauthRequest = $this->request->createOAuthRequest();
        $oauthRequest->setBaseUrl('https://api.twitter.com/oauth');

        $expected = array(
            'trim_user'          => 'true',
            'include_my_retweet' => 'true',
            'include_entities'   => 'true',
        );

        $this->assertSame('/statuses/show/:id.json', $oauthRequest->getPath());
        $this->assertSame('https://api.twitter.com/oauth/statuses/show/123.json', $oauthRequest->getSignatureUrl());
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
