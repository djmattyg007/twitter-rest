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
use Widop\Twitter\Rest\Lists\ListsMembersRequest;

/**
 * Lists members request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsMembersRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new ListsMembersRequest($this->optionBagFactory);
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
        $this->assertNull($this->request->getListId());
        $this->assertNull($this->request->getSlug());
        $this->assertNull($this->request->getOwnerId());
        $this->assertNull($this->request->getOwnerScreenName());
        $this->assertNull($this->request->getCursor());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testListId()
    {
        $this->request->setListId('123456789');

        $this->assertSame('123456789', $this->request->getListId());
    }

    public function testSlug()
    {
        $this->request->setSlug('sandwich');

        $this->assertSame('sandwich', $this->request->getSlug());
    }

    public function testOwnerId()
    {
        $this->request->setOwnerId('123456789');

        $this->assertSame('123456789', $this->request->getOwnerId());
    }

    public function testOwnerScreenName()
    {
        $this->request->setOwnerScreenName('noradio');

        $this->assertSame('noradio', $this->request->getOwnerScreenName());
    }

    public function testCursor()
    {
        $this->request->setCursor('123456789');

        $this->assertSame('123456789', $this->request->getCursor());
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

    public function testOAuthRequestWithListId()
    {
        $expected = array(
            'list_id'         => '123456789',
            'cursor'           => '-1',
            'include_entities' => 'false',
            'skip_status'      => 'true'
        );
        $this->request->setListId('123456789');
        $this->request->setCursor('-1');
        $this->request->setIncludeEntities(false);
        $this->request->setSkipStatus(true);
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/members.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $this->request->setCursor('-1');
        $this->request->setIncludeEntities(false);
        $this->request->setSkipStatus(true);
        $expected = array(
            'slug'             => 'sandwich',
            'owner_id'         => '123456789',
            'cursor'           => '-1',
            'include_entities' => 'false',
            'skip_status'      => 'true'
        );
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a list id or slug.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide the owner screen name or id in conjuction with the slug parameter.
     */
    public function testOAuthRequestWithSlugOnly()
    {
        $this->request->setSlug('sandwich');
        $this->request->createOAuthRequest();
    }
}
