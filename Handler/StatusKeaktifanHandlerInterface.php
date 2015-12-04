<?php

namespace Ais\StatusKeaktifanBundle\Handler;

use Ais\StatusKeaktifanBundle\Model\StatusKeaktifanInterface;

interface StatusKeaktifanHandlerInterface
{
    /**
     * Get a StatusKeaktifan given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return StatusKeaktifanInterface
     */
    public function get($id);

    /**
     * Get a list of StatusKeaktifans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post StatusKeaktifan, creates a new StatusKeaktifan.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function post(array $parameters);

    /**
     * Edit a StatusKeaktifan.
     *
     * @api
     *
     * @param StatusKeaktifanInterface   $status_keaktifan
     * @param array           $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function put(StatusKeaktifanInterface $status_keaktifan, array $parameters);

    /**
     * Partially update a StatusKeaktifan.
     *
     * @api
     *
     * @param StatusKeaktifanInterface   $status_keaktifan
     * @param array           $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function patch(StatusKeaktifanInterface $status_keaktifan, array $parameters);
}
