<?php
namespace Hirotae\Ticket\Resource\App;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;
use Ray\Di\Di\Named;
use Ray\IdentityValueModule\NowInterface;
use Ray\IdentityValueModule\UuidInterface;
use Ray\Query\Annotation\Query;

/**
 * @Cacheable
 */
class Tickets extends ResourceObject
{
    /**
     * Undocumented variable
     *
     * @var callable
     */
    private $createTicket;

    /**
     * Undocumented variable
     *
     * @var NowInterface
     */
    private $now;

    /**
     * Undocumented variable
     *
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @Named("createTicket=ticket_insert")
     *
     * @param callable      $createTicket
     * @param NowInterface  $now
     * @param UuidInterface $uuid
     */
    public function __construct(callable $createTicket, NowInterface $now, UuidInterface $uuid)
    {
        $this->createTicket = $createTicket;
        $this->now = $now;
        $this->uuid = $uuid;
    }

    /**
     * @JsonSchema(schema="tickets.json")
     * @Query("ticket_list")
     *
     * @return ResourceObject
     */
    public function onGet() : ResourceObject
    {
        return $this;
    }

    /**
     * @ReturnCreatedResource
     * @Transactional
     * @Purge(uri="app://self/tickets")
     *
     * @param string $title
     * @param string $description
     * @param string $assignee
     *
     * @return ResourceObject
     */
    public function onPost(
        string $title,
        string $description = '',
        string $assignee = ''
    ) : ResourceObject {
        $id = (string) $this->uuid;
        $time = (string) $this->now;
        ($this->createTicket)([
           'id' => $id,
           'title' => $title,
           'description' => $description,
           'assignee' => $assignee,
           'status' => '',
           'created_at' => $time,
           'updated_at' => $time,
        ]);
        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = "/ticket?id={$id}";

        return $this;
    }
}
