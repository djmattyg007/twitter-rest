<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Users;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Users suggestions slug request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/users/suggestions/%3Aslug/members
 *
 * @method string|null getSlug()             Gets the list/category slug.
 * @method null        setSlug(string $slug) Sets the list/category slug.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSuggestionsSlugMembersRequest extends AbstractGetRequest
{
    /**
     * Creates a users suggestions slug request.
     *
     * @param string $slug The list/category slug.
     */
    public function __construct($slug)
    {
        parent::__construct();

        $this->setSlug($slug);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('slug', OptionInterface::TYPE_PATH);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['slug'])) {
            throw new \RuntimeException('You must provide a slug.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/suggestions/:slug/members.json';
    }
}
