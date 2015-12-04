<?php

namespace Ais\StatusKeaktifanBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\StatusKeaktifanBundle\Model\StatusKeaktifanInterface;
use Ais\StatusKeaktifanBundle\Form\StatusKeaktifanType;
use Ais\StatusKeaktifanBundle\Exception\InvalidFormException;

class StatusKeaktifanHandler implements StatusKeaktifanHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a StatusKeaktifan.
     *
     * @param mixed $id
     *
     * @return StatusKeaktifanInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of StatusKeaktifans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new StatusKeaktifan.
     *
     * @param array $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function post(array $parameters)
    {
        $status_keaktifan = $this->createStatusKeaktifan();

        return $this->processForm($status_keaktifan, $parameters, 'POST');
    }

    /**
     * Edit a StatusKeaktifan.
     *
     * @param StatusKeaktifanInterface $status_keaktifan
     * @param array         $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function put(StatusKeaktifanInterface $status_keaktifan, array $parameters)
    {
        return $this->processForm($status_keaktifan, $parameters, 'PUT');
    }

    /**
     * Partially update a StatusKeaktifan.
     *
     * @param StatusKeaktifanInterface $status_keaktifan
     * @param array         $parameters
     *
     * @return StatusKeaktifanInterface
     */
    public function patch(StatusKeaktifanInterface $status_keaktifan, array $parameters)
    {
        return $this->processForm($status_keaktifan, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param StatusKeaktifanInterface $status_keaktifan
     * @param array         $parameters
     * @param String        $method
     *
     * @return StatusKeaktifanInterface
     *
     * @throws \Ais\StatusKeaktifanBundle\Exception\InvalidFormException
     */
    private function processForm(StatusKeaktifanInterface $status_keaktifan, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new StatusKeaktifanType(), $status_keaktifan, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $status_keaktifan = $form->getData();
            $this->om->persist($status_keaktifan);
            $this->om->flush($status_keaktifan);

            return $status_keaktifan;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createStatusKeaktifan()
    {
        return new $this->entityClass();
    }

}
