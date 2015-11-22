<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Options\OptionBagInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Lists ownerships request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/ownerships
 *
 * @method string|null  getUserId()                       Gets the user ID.
 * @method null         setUserId(string $userId)         Sets the user ID.
 * @method string|null  getScreenName()                   Gets the user screen name.
 * @method null         setScreenName(string $screenName) Sets the user screen name.
 * @method integer|null getCount()                        Gets the number of results to return.
 * @method null         setCount(integer $count)          Sets the number of results to return.
 * @method string|null  getCursor()                       Gets the cursor.
 * @method null         setCursor(string $cursor)         Sets the cursor.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsOwnershipsRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBagInterface $optionBag)
    {
        $optionBag
            ->register('user_id')
            ->register('screen_name')
            ->register('count')
            ->register('cursor');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBagInterface $optionBag)
    {
        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or screen name.');
        }

        if (isset($optionBag['user_id'])) {
            unset($optionBag['screen_name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/ownerships.json';
    }
}
