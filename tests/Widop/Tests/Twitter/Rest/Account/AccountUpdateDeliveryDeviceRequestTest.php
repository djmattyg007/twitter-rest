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
use Widop\Twitter\Rest\Account\AccountUpdateDeliveryDeviceRequest;

/**
 * Account update delivery device request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateDeliveryDeviceRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new AccountUpdateDeliveryDeviceRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getDevice());
        $this->assertNull($this->request->getIncludeEntities());
    }

    public function testDevice()
    {
        $this->request->setDevice('sms');

        $this->assertSame('sms', $this->request->getDevice());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a device.
     */
    public function testOAuthRequestWithoutDevice()
    {
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_delivery_device.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertEmpty($oauthRequest->getPostParameters());
    }

    public function testOAuthRequestWithParameters()
    {
        $this->request->setDevice('sms');
        $this->request->setIncludeEntities(true);
        $expected = array(
            'device'           => 'sms',
            'include_entities' => 'true'
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/update_delivery_device.json', $oauthRequest->getPath());
        $this->assertSame('POST', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getPostParameters());
    }
}
