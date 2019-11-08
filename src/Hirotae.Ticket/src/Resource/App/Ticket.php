<?php
namespace Hirotae\Ticket\Resource\App;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Ray\Query\Annotation\Query;

/**
 * @Cacheable
 */
class Ticket extends ResourceObject
{
    /**
     * onGet
     *
     * @JsonSchema(schema="ticket.json")
     * @Query("ticket_item_by_id", type="row")
     *
     * @param string $id
     *
     * @return ResourceObject
     */
    public function onGet(string $id) : ResourceObject
    {
        unset($id);

        return $this;
    }
}
