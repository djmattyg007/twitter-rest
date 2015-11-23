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
use Widop\Twitter\Rest\Account\AccountVerifyCredentialsRequest;

/**
 * Account verify credentials request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountVerifyCredentialsRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new AccountVerifyCredentialsRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
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

    public function testOAuthRequest()
    {
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);
        $expected = array(
            'include_entities' => 'true',
            'skip_status'      => 'true',
        );
        $oauthRequest = $this->request->createOAuthRequest();

        $this->assertSame('/account/verify_credentials.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }
}
