<?php

namespace Ais\StatusKeaktifanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\StatusKeaktifanBundle\Exception\InvalidFormException;
use Ais\StatusKeaktifanBundle\Form\StatusKeaktifanType;
use Ais\StatusKeaktifanBundle\Model\StatusKeaktifanInterface;


class StatusKeaktifanController extends FOSRestController
{
    /**
     * List all status_keaktifans.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing status_keaktifans.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many status_keaktifans to return.")
     *
     * @Annotations\View(
     *  templateVar="status_keaktifans"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getStatusKeaktifansAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->all($limit, $offset);
    }

    /**
     * Get single StatusKeaktifan.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a StatusKeaktifan for a given id",
     *   output = "Ais\StatusKeaktifanBundle\Entity\StatusKeaktifan",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the status_keaktifan is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="status_keaktifan")
     *
     * @param int     $id      the status_keaktifan id
     *
     * @return array
     *
     * @throws NotFoundHttpException when status_keaktifan not exist
     */
    public function getStatusKeaktifanAction($id)
    {
        $status_keaktifan = $this->getOr404($id);

        return $status_keaktifan;
    }

    /**
     * Presents the form to use to create a new status_keaktifan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newStatusKeaktifanAction()
    {
        return $this->createForm(new StatusKeaktifanType());
    }
    
    /**
     * Presents the form to use to edit status_keaktifan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisStatusKeaktifanBundle:StatusKeaktifan:editStatusKeaktifan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the status_keaktifan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when status_keaktifan not exist
     */
    public function editStatusKeaktifanAction($id)
    {
		$status_keaktifan = $this->getStatusKeaktifanAction($id);
		
        return array('form' => $this->createForm(new StatusKeaktifanType(), $status_keaktifan), 'status_keaktifan' => $status_keaktifan);
    }

    /**
     * Create a StatusKeaktifan from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new status_keaktifan from the submitted data.",
     *   input = "Ais\StatusKeaktifanBundle\Form\StatusKeaktifanType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisStatusKeaktifanBundle:StatusKeaktifan:newStatusKeaktifan.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postStatusKeaktifanAction(Request $request)
    {
        try {
            $newStatusKeaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newStatusKeaktifan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_status_keaktifan', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing status_keaktifan from the submitted data or create a new status_keaktifan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\StatusKeaktifanBundle\Form\StatusKeaktifanType",
     *   statusCodes = {
     *     201 = "Returned when the StatusKeaktifan is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisStatusKeaktifanBundle:StatusKeaktifan:editStatusKeaktifan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the status_keaktifan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when status_keaktifan not exist
     */
    public function putStatusKeaktifanAction(Request $request, $id)
    {
        try {
            if (!($status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->put(
                    $status_keaktifan,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $status_keaktifan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_status_keaktifan', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing status_keaktifan from the submitted data or create a new status_keaktifan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\StatusKeaktifanBundle\Form\StatusKeaktifanType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisStatusKeaktifanBundle:StatusKeaktifan:editStatusKeaktifan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the status_keaktifan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when status_keaktifan not exist
     */
    public function patchStatusKeaktifanAction(Request $request, $id)
    {
        try {
            $status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $status_keaktifan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_status_keaktifan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a StatusKeaktifan or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return StatusKeaktifanInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $status_keaktifan;
    }
    
    public function postUpdateStatusKeaktifanAction(Request $request, $id)
    {
		try {
            $status_keaktifan = $this->container->get('ais_status_keaktifan.status_keaktifan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $status_keaktifan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_status_keaktifan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
