<?php

namespace Ais\StatusKeaktifanBundle\Tests\Handler;

use Ais\StatusKeaktifanBundle\Handler\StatusKeaktifanHandler;
use Ais\StatusKeaktifanBundle\Model\StatusKeaktifanInterface;
use Ais\StatusKeaktifanBundle\Entity\StatusKeaktifan;

class StatusKeaktifanHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\StatusKeaktifanBundle\Tests\Handler\DummyStatusKeaktifan';

    /** @var StatusKeaktifanHandler */
    protected $status_keaktifanHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $status_keaktifan = $this->getStatusKeaktifan();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($status_keaktifan));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->status_keaktifanHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $status_keaktifans = $this->getStatusKeaktifans(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($status_keaktifans));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->status_keaktifanHandler->all($limit, $offset);

        $this->assertEquals($status_keaktifans, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $status_keaktifan = $this->getStatusKeaktifan();
        $status_keaktifan->setTitle($title);
        $status_keaktifan->setBody($body);

        $form = $this->getMock('Ais\StatusKeaktifanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($status_keaktifan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $status_keaktifanObject = $this->status_keaktifanHandler->post($parameters);

        $this->assertEquals($status_keaktifanObject, $status_keaktifan);
    }

    /**
     * @expectedException Ais\StatusKeaktifanBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $status_keaktifan = $this->getStatusKeaktifan();
        $status_keaktifan->setTitle($title);
        $status_keaktifan->setBody($body);

        $form = $this->getMock('Ais\StatusKeaktifanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->status_keaktifanHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $status_keaktifan = $this->getStatusKeaktifan();
        $status_keaktifan->setTitle($title);
        $status_keaktifan->setBody($body);

        $form = $this->getMock('Ais\StatusKeaktifanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($status_keaktifan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $status_keaktifanObject = $this->status_keaktifanHandler->put($status_keaktifan, $parameters);

        $this->assertEquals($status_keaktifanObject, $status_keaktifan);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $status_keaktifan = $this->getStatusKeaktifan();
        $status_keaktifan->setTitle($title);
        $status_keaktifan->setBody($body);

        $form = $this->getMock('Ais\StatusKeaktifanBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($status_keaktifan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->status_keaktifanHandler = $this->createStatusKeaktifanHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $status_keaktifanObject = $this->status_keaktifanHandler->patch($status_keaktifan, $parameters);

        $this->assertEquals($status_keaktifanObject, $status_keaktifan);
    }


    protected function createStatusKeaktifanHandler($objectManager, $status_keaktifanClass, $formFactory)
    {
        return new StatusKeaktifanHandler($objectManager, $status_keaktifanClass, $formFactory);
    }

    protected function getStatusKeaktifan()
    {
        $status_keaktifanClass = static::DOSEN_CLASS;

        return new $status_keaktifanClass();
    }

    protected function getStatusKeaktifans($maxStatusKeaktifans = 5)
    {
        $status_keaktifans = array();
        for($i = 0; $i < $maxStatusKeaktifans; $i++) {
            $status_keaktifans[] = $this->getStatusKeaktifan();
        }

        return $status_keaktifans;
    }
}

class DummyStatusKeaktifan extends StatusKeaktifan
{
}
