<?php
namespace Hirotae\Ticket\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public $body = [
        'overview' => 'This is the Tutorial2 TEST API',
        'issue' => 'https://github.com/bearsunday/tutorial2/issues',
        '_links' => [
            'self' => [
                'href' => '/',
            ],
            'curies' => [
                'href' => 'rels/{rel}.html',
                'name' => 'tk',
                'templated' => true
            ],
            'tk:ticket' => [
                'href' => '/tickets/{id}',
                'title' => 'The ticket item',
                'templated' => true
            ],
            'tk:tickets' => [
                'href' => '/tickets',
                'title' => 'The ticket list'
            ]
        ]
    ];

    public function onGet() : ResourceObject
    {
        return $this;
    }
}
