<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Users;

use Widop\Tests\Twitter\Rest\AbstractRequestTestCase;
use Widop\Twitter\Rest\Users\UsersSuggestionsRequest;

/**
 * Users suggestions request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSuggestionsRequestTest extends AbstractRequestTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->request = new UsersSuggestionsRequest($this->optionBagFactory);
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

        $this->assertNull($this->request->getLang());
    }

    public function testLang()
    {
        $this->request->setLang('fr');

        $this->assertSame('fr', $this->request->getLang());
    }

    public function testOAuthRequest()
    {
        $this->request->setLang('fr');

        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/users/suggestions.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('lang' => 'fr'), $oauthRequest->getGetParameters());
    }
}
