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

/**
 * Abstract timeline request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AbstractTimelineRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = $this->getMockBuilder('Widop\Twitter\Rest\Statuses\AbstractTimelineRequest')
            ->setMethods(array('__construct'))
            ->setConstructorArgs(array($this->optionBagFactory))
            ->getMockForAbstractClass('Widop\Twitter\Rest\Statuses\AbstractTimelineRequest');
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

        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getTrimUser());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testTrimUser()
    {
        $this->request->setTrimUser(true);

        $this->assertTrue($this->request->getTrimUser());
    }

    public function testOAuthRequest()
    {
        $this->request->setCount(50);
        $this->request->setSinceId('0123456789');
        $this->request->setMaxId('9876543210');
        $this->request->setTrimUser(true);

        $oauthRequest = $this->request->createOAuthRequest();

        $expected = array(
            'count'     => '50',
            'since_id'  => '0123456789',
            'max_id'    => '9876543210',
            'trim_user' => 'true',
        );

        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertEquals($expected, $oauthRequest->getGetParameters());
    }
}
