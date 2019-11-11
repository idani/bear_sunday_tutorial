<?php

namespace Hirotae\Vue01\Resource\Page;

use BEAR\Resource\ResourceObject;
use Hirotae\Vue01\Annotation\Api;

/**
 * @Api
 */
class Links extends ResourceObject
{
    public function onGet()
    {
        $this['essential_links'] = [
            [
                'label' => 'Core Docs',
                'url' => 'https://vuejs.org'
            ]
        ];

        $this['ecosystem_links'] = [
            [
                'label' => 'vue-router',
                'url' => 'http://router.vuejs.org/'
            ]
        ];

        return $this;
    }
}