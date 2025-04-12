<?php

namespace Concrete\Package\Card\Block\Card;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Form\Service\DestinationPicker\DestinationPicker;

class Controller extends BlockController
{
    protected $btTable = 'btCard';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btCacheBlockOutputLifetime = 300;

    public function getBlockTypeDescription(): string
    {
        return t('Add support to add video and image slideshow to your site.');
    }

    public function getBlockTypeName(): string
    {
        return t("Card");
    }

    public function save($args)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        list($buttonLinkType, $buttonLinkValue) = $this->app->make(DestinationPicker::class)->decode('buttonLink', [
            'none',
            'page',
            'file',
            'external_url' => ['maxlength' => 255],
        ], null, null, $args);

        $args['buttonInternalLinkCID'] = $buttonLinkType === 'page' ? $buttonLinkValue : 0;
        $args['buttonFileLinkID'] = $buttonLinkType === 'file' ? $buttonLinkValue : 0;
        $args['buttonExternalLink'] = $buttonLinkType === 'external_url' ? $buttonLinkValue : '';

        parent::save($args);
    }
}