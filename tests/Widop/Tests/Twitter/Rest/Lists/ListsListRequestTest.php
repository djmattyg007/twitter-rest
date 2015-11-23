<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Lists;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Lists\ListsListRequest;

/**
 * Lists destroy request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsListRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new ListsListRequest($this->optionBagFactory);
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
        $this->assertNull($this->request->getReverse());
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

    public function testReverse()
    {
        $this->request->setReverse(true);

        $this->assertTrue($this->request->getReverse());
    }

    public function testOAuthRequestWithUserId()
    {
        $expected = array(
            'user_id' => '123456789',
            'reverse' => 'true'
        );
        $this->request->setUserId('123456789');
        $this->request->setReverse(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/list.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithScreenName()
    {
        $expected = array(
            'user_id' => '123456789',
            'reverse' => 'true'
        );
        $this->request->setUserId('123456789');
        $this->request->setReverse(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
