<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Trends;

use Widop\Twitter\Options\OptionBagInterface;
use Widop\Twitter\Options\OptionBagFactoryInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Trends place request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/trends/place
 * @link http://developer.yahoo.com/geo/geoplanet/
 *
 * @method string      getId()                     Gets the WOEID.
 * @method null        setId(string $id)           Sets the WOEID.
 * @method string|null getExclude()                Gets if the hashtags will be removed from the trend list.
 * @method null        setExclude(string $exclude) Sets if the hashtags will be removed from the trend list.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TrendsPlaceRequest extends AbstractGetRequest
{
    /**
     * Creates a trends place request.
     *
     * @param \Widop\Twitter\Options\OptionBagFactoryInterface $factory
     * @param string $id The WOEID.
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
            ->register('exclude');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBagInterface $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must provide a WOEID.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/trends/place.json';
    }
}
