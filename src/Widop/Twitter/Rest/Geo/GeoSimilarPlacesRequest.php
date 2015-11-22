<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Geo;

use Widop\Twitter\Options\OptionBagInterface;
use Widop\Twitter\Options\OptionBagFactoryInterface;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Geo similar places request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/geo/similar_places
 *
 * @method string      getLat()                                      Gets the latitude.
 * @method null        setLat(string $lat)                           Sets the latitude.
 * @method string      getLong()                                     Gets the longitude.
 * @method null        setLong(string $long)                         Sets the longitude.
 * @method string      getName()                                     Gets the name a place is known as.
 * @method null        setName(string $name)                         Sets the name a place is known as.
 * @method string|null getContainedWithin()                          Gets the place_id which you would like to restrict the search results to.
 * @method null        setContainedWithin(string $containedWithin)   Sets the place_id which you would like to restrict the search results to.
 * @method string|null getAttribute_StreetAddress()                  Gets the number of results to return.
 * @method null        setAttribute_StreetAddress(string $attribute) Sets the number of results to return.
 * @method string|null getCallback()                                 Gets the callback.
 * @method null        setCallback(string $callback)                 Sets the callback.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoSimilarPlacesRequest extends AbstractGetRequest
{
    /**
     * Creates a geo similar places request.
     *
     * @param \Widop\Twitter\Options\OptionBagFactoryInterface $factory
     * @param string $latitude  The latitude.
     * @param string $longitude The longitude.
     * @param string $name      The name of a place.
     */
    public function __construct(OptionBagFactoryInterface $factory, $latitude = null, $longitude = null, $name = null)
    {
        parent::__construct($factory);

        if ($latitude !== null) {
            $this->setLat($latitude);
        }
        if ($longitude !== null) {
            $this->setLong($longitude);
        }
        if ($name !== null) {
            $this->setName($name);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBagInterface $optionBag)
    {
        $optionBag
            ->register('lat')
            ->register('long')
            ->register('name')
            ->register('contained_within')
            ->register('attribute:street_address')
            ->register('callback');
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

        if (!isset($optionBag['name'])) {
            throw new \RuntimeException('You must provide a name.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/geo/similar_places.json';
    }
}
