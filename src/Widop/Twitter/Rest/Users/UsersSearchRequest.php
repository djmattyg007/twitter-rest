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

use Widop\Twitter\Options\OptionBagInterface;
use Widop\Twitter\Options\OptionBagFactoryInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Users show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/users/search
 *
 * @method string       getQ()                                       Gets the search query.
 * @method null         setQ(string $query)                          Sets the search query.
 * @method integer|null getPage()                                    Gets the page of results to retrieve.
 * @method null         setPage(integer $page)                       Sets the page of results to retrieve.
 * @method integer|null getCount()                                   Gets the number of users to return.
 * @method null         setCount(integer $count)                     Sets the number of users to return.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSearchRequest extends AbstractGetRequest
{
    /**
     * Creates a search tweets request.
     *
     * @param \Widop\Twitter\Options\OptionBagFactoryInterface $factory
     * @param string $query The search query.
     */
    public function __construct(OptionBagFactoryInterface $factory, $query = null)
    {
        parent::__construct($factory);

        if ($query !== null) {
            $this->setQ($query);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBagInterface $optionBag)
    {
        $optionBag
            ->register('q')
            ->register('page')
            ->register('count')
            ->register('include_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBagInterface $optionBag)
    {
        if (!isset($optionBag['q'])) {
            throw new \RuntimeException('You must specify a query.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/search.json';
    }
}
