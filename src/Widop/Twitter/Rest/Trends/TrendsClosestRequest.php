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
 * Trends closest request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/trends/closest
 *
 * @method string getLat()              Gets the latitude.
 * @method null   setLat(string $lat)   Sets the latitude.
 * @method string getLong()             Gets the longitude.
 * @method null   setLong(string $long) Sets the longitude.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TrendsClosestRequest extends AbstractGetRequest
{
    /**
     * Creates a trends closest request.
     *
     * @param \Widop\Twitter\Options\OptionBagFactoryInterface $factory
     * @param string $latitude  The latitude.
     * @param string $longitude The longitude.
     */
    public function __construct(OptionBagFactoryInterface $factory, $latitude = null, $longitude = null)
    {
        parent::__construct($factory);

        if ($latitude !== null) {
            $this->setLat($latitude);
        }
        if ($longitude !== null) {
            $this->setLong($longitude);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBagInterface $optionBag)
    {
        $optionBag
            ->register('lat')
            ->register('long');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBagInterface $optionBag)
    {
        if (!isset($optionBag['lat'])) {
            throw new \RuntimeException('You must provide a latitude.');
        }

        if (!isset($optionBag['long'])) {
            throw new \RuntimeException('You must provide a longitude.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/trends/closest.json';
    }
}
