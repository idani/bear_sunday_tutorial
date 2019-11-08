<?php
namespace MyVendor\Weekday\Resource\App;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\Annotation\Transactional;
use Ray\CakeDbModule\DatabaseInject;

/**
 * @Cacheable
 */
class Todos extends ResourceObject
{
    use DatabaseInject;

    public function onGet(int $id) : ResourceObject
    {
        $this->body = $this
            ->db
            ->newQuery()
            ->select('*')
            ->from('todo')
            ->where(['id' => $id])
            ->execute()
            ->fetch('assoc');

        return $this;
    }

    /**
     * @Transactional
     * @ReturnCreatedResource
     *
     * @param string $todo
     *
     * @return ResourceObject
     */
    public function onPost(string $todo) : ResourceObject
    {
        $statement = $this->db->insert(
            'todo',
            ['todo' => $todo, 'created_at' => new \DateTime('now')],
            ['created_at' => 'datetime']
        );

        $this->code = 201;
        $id = $statement->lastInsertId();
        $this->headers['Location'] = '/todos?id=' . $id;

        return $this;
    }

    /**
     * @Transactional
     *
     * @param int    $id
     * @param string $todo
     *
     * @return ResourceObject
     */
    public function onPut(int $id, string $todo) : ResourceObject
    {
        $this->db->update(
            'todo',
            ['todo' => $todo],
            ['id' => $id]
        );

        $this->code = 204;

        return $this;
    }
}
