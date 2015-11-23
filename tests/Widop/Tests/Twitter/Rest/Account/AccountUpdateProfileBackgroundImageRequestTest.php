<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Account;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Account\AccountUpdateProfileBackgroundImageRequest;

/**
 * Account update profile background image request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileBackgroundImageRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new AccountUpdateProfileBackgroundImageRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getImage());
        $this->assertNull($this->request->getTile());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
        $this->assertNull($this->request->getUse());
    }

    public function testImage()
    {
        $this->request->setImage('foo');

        $this->assertSame('foo', $this->request->getImage());
    }

    public function testTile()
    {
        $this->request->setTile(true);

        $this->assertTrue($this->request->getTile());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testSkipStatus()
    {
        $this->request->setSkipStatus(true);

        $this->assertTrue($this->request->getSkipStatus());
    }

    public function testUse()
    {
        $this->request->setUse(true);

        $this->assertTrue($this->request->getUse());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide either an image, tile or use.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_background_image.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setImage('foo');
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $this->request->setUse(true);
        $expected = array(
            'image'            => 'foo',
            'include_entities' => 'true',
            'skip_status'      => 'true',
            'use'              => 'true'
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_profile_background_image.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
