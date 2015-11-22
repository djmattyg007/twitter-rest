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
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Statuses retweet request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/retweet/%3Aid
 *
 * @method string       getId()                        Gets the tweet ID to retweet.
 * @method null         setId(string $id)              Sets the tweet ID to retweet.
 * @method boolean|null getTrimUser()                  Checks if the user should be trimmed.
 * @method null         setTrimUser(boolean $trimUser) Sets if the user should be trimmed.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetRequest extends AbstractPostRequest
{
    /**
     * Creates a statuses retweet request.
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
            ->register('id', OptionInterface::TYPE_PATH)
            ->register('trim_user', OptionInterface::TYPE_POST);
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
        return '/statuses/retweet/:id.json';
    }
}
