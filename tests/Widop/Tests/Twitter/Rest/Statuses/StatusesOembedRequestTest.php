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

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Statuses\StatusesOembedRequest;

/**
 * Statuses oembed request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesOembedRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new StatusesOembedRequest($this->optionBagFactory, '123', 'foo.com');
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
        $this->assertSame('foo.com', $this->request->getUrl());
        $this->assertNull($this->request->getMaxwidth());
        $this->assertNull($this->request->getHideMedia());
        $this->assertNull($this->request->getHideThread());
        $this->assertNull($this->request->getOmitScript());
        $this->assertNull($this->request->getAlign());
        $this->assertNull($this->request->getRelated());
        $this->assertNull($this->request->getLang());
    }

    public function testId()
    {
        $this->request->setId('321');

        $this->assertSame('321', $this->request->getId());
    }

    public function testUrl()
    {
        $this->request->setUrl('foo.fr');

        $this->assertSame('foo.fr', $this->request->getUrl());
    }

    public function testMaxwidth()
    {
        $this->request->setMaxwidth(200);

        $this->assertSame(200, $this->request->getMaxwidth());
    }

    public function testHideMedia()
    {
        $this->request->setHideMedia(true);

        $this->assertTrue($this->request->getHideMedia());
    }

    public function testHideThread()
    {
        $this->request->setHideThread(true);

        $this->assertTrue($this->request->getHideThread());
    }

    public function testOmitScript()
    {
        $this->request->setOmitScript(true);

        $this->assertTrue($this->request->getOmitScript());
    }

    public function testAlign()
    {
        $this->request->setAlign('foo');

        $this->assertSame('foo', $this->request->getAlign());
    }

    public function testRelated()
    {
        $this->request->setRelated('foo');

        $this->assertSame('foo', $this->request->getRelated());
    }

    public function testLang()
    {
        $this->request->setLang('fr');

        $this->assertSame('fr', $this->request->getLang());
    }

    public function testOAuthRequest()
    {
        $this->request->setMaxwidth(200);
        $this->request->setHideMedia(true);
        $this->request->setHideThread(true);
        $this->request->setOmitScript(true);
        $this->request->setAlign('center');
        $this->request->setRelated('foo');
        $this->request->setLang('fr');

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'id'          => '123',
            'url'         => 'foo.com',
            'maxwidth'    => '200',
            'hide_media'  => 'true',
            'hide_thread' => 'true',
            'omit_script' => 'true',
            'align'       => 'center',
            'related'     => 'foo',
            'lang'        => 'fr',
        );

        $this->assertSame('/statuses/oembed.json', $oauthRequest->getPath());
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

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide an url.
     */
    public function testOAuthRequestWithoutUrl()
    {
        $this->request->setUrl(null);

        $this->request->createOAuthRequest();
    }
}
