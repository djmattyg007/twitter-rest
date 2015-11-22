<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Statuses;

use Widop\Twitter\Options\OptionBagInterface;
use Widop\Twitter\Options\OptionBagFactoryInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Statuses retweeters ids request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweeters/ids
 *
 * @method string       getId()                                Gets the tweet ID from whom to find retweeters ids.
 * @method null         setId(string $id)                      Sets the tweet ID from whom to find retweeters ids.
 * @method string|null  getCursor()                            Gets the cursor.
 * @method null         setCursor(string $curos)               Sets the cursor.
 * @method boolean|null getStringifyIds()                      Checks if the ids should be stringified.
 * @method null         setStringifyIds(boolean $stringifyIds) Sets if the ids should be stringified.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetersIdsRequest extends AbstractGetRequest
{
    /**
     * Creates a statuses retweeters ids request.
     *
     * @param \Widop\Twitter\Options\OptionBagFactoryInterface $factory
     * @param string $id The tweet identifier.
     */
    public function __construct(OptionBagFactoryInterface $factory, $id = null)
    {
        parent::__construct($factory);

        if ($id !== null) {
            $this->setId($id);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBagInterface $optionBag)
    {
        $optionBag
            ->register('id')
            ->register('cursor')
            ->register('stringify_ids');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBagInterface $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must provide an id.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/retweeters/ids.json';
    }
}
