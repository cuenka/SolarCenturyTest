<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Employee;
use App\Service\RequestValidator;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Here you will find all the endpoints of the API
 * Class ProviderController
 */
class ProviderController extends Controller
{
    /**
     * @Route("/provider", name="provider_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('provider/index.html.twig', []);
    }

    /**
     * Return a list of companies or employees depending of parameter type
     * @param string $type
     * @return Response
     * @Route("/provider/{type}/list", name="provider_list", methods={"GET"}, defaults={"type": "company"},
     *     requirements={"type": "company|employee"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of an employees or companies",
     * )
     */
    public function list(string $type)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $normalizer = new ObjectNormalizer();
        switch ($type) {
            case Employee::NAME:
                $instance = $entityManager->getRepository(Employee::class)->findAll();
                $normalizer->setCircularReferenceHandler(function ($object, string $format = null, array $context = []) {
                    return $object->getFirstName();
                });
                break;
            case Company::NAME:
            default:
                $instance = $entityManager->getRepository(Company::class)->findAll();
                $normalizer->setCircularReferenceHandler(function ($object, string $format = null, array $context = []) {
                    return $object->getName();
                });
        }

        // Using serializer
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $jsonContent = $serializer->serialize($instance, 'json');

        return new Response($jsonContent, Response::HTTP_OK);
    }

    /**
     * Create and Persist a new company or empployee
     * Return OK and status 200 if the data is correct or 400
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param string $type
     * @return JsonResponse
     * @Route("/provider/{type}/add", name="provider_add", methods={"POST"}, defaults={"type": "company"},
     *     requirements={"type": "company|employee"})
     * @SWG\Response(
     *     response=200,
     *     description="Information persisted"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Information not persisted, missing mandatory data or not validated"
     * )
     * @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     type="string",
     *     description="Name of Company"
     * )
     * @SWG\Parameter(
     *     name="headquarters",
     *     in="query",
     *     type="string",
     *     description="Company headquarters"
     * )
     * @SWG\Parameter(
     *     name="founded",
     *     in="query",
     *     type="string",
     *     description="(* Not Mandatory), Date when was the company founded, format DD-MM-YYYY"
     * )
     * @SWG\Parameter(
     *     name="firstName",
     *     in="query",
     *     type="string",
     *     description="Employee, First Name"
     * )
     * @SWG\Parameter(
     *     name="lastName",
     *     in="query",
     *     type="string",
     *     description="Employee, Last Name"
     * )
     */
    public function add(ValidatorInterface $validator, Request $request, string $type)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $parameters = $request->query->all();
        $paramValidator = $this->get('app.service.request_validator');
        $cleanParameters = $paramValidator->validateRequest($parameters);

        if ($type == Company::NAME) {
            $entity = new Company();
            $entity->setName($cleanParameters['name']);
            $entity->setHeadquarters($cleanParameters['headquarters']);
            $entity->setFounded($cleanParameters['founded']);
        } else {
            $entity = new Employee();
            $entity->setFirstName($cleanParameters['firstname']);
            $entity->setLastName($cleanParameters['lastName']);
            $entity->setCompany($cleanParameters['company']);
        }
        $entityManager->persist($entity);

        $errors = $validator->validate($entity);
        if (count($errors) > 0) {
            // This gives us a nice string for error feedback.
            $errorsString = (string)$errors;

            return new JsonResponse($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        return new JsonResponse('OK', Response::HTTP_CREATED);
    }

    /**
     * edit and Persist an existing company or empployee
     * Return OK and status 200 if the data is correct or 400
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param string $type
     * @param integer $id
     * @return JsonResponse
     * @Route("/provider/{type}/{id}/edit", name="provider_edit", methods={"PUT"}, defaults={"type": "company"},
     *     requirements={"type": "company|employee", "id":"\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Information persisted"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Information not persisted, missing mandatory data or not validated"
     * )
     * @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     type="string",
     *     description="Name of Company"
     * )
     * @SWG\Parameter(
     *     name="headquarters",
     *     in="query",
     *     type="string",
     *     description="Company headquarters"
     * )
     * @SWG\Parameter(
     *     name="founded",
     *     in="query",
     *     type="string",
     *     description="(* Not Mandatory), Date when was the company founded, format DD-MM-YYYY"
     * )
     * @SWG\Parameter(
     *     name="firstName",
     *     in="query",
     *     type="string",
     *     description="Employee, First Name"
     * )
     * @SWG\Parameter(
     *     name="lastName",
     *     in="query",
     *     type="string",
     *     description="Employee, Last Name"
     * )
     */
    public function edit(ValidatorInterface $validator, Request $request, string $type, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $parameters = $request->query->all();
        $paramValidator = $this->get('app.service.request_validator');
        $cleanParameters = $paramValidator->validateRequest($parameters);

        if ($type == Company::NAME) {
            $entity = $entityManager->getRepository(Company::class)->find($id);
            if ($entity === null) return new JsonResponse($type . ' does not exist', Response::HTTP_BAD_REQUEST);
            $entity->setName($cleanParameters['name']);
            $entity->setHeadquarters($cleanParameters['headquarters']);
            $entity->setFounded($cleanParameters['founded']);
        } else {
            $entity = $entityManager->getRepository(Employee::class)->find($id);
            if ($entity === null) return new JsonResponse($type . ' does not exist', Response::HTTP_BAD_REQUEST);
            $entity->setFirstName($cleanParameters['firstname']);
            $entity->setLastName($cleanParameters['lastName']);
            $entity->setCompany($cleanParameters['company']);
        }
        $entity->setDateModified(new \DateTime());
        $entityManager->persist($entity);

        $errors = $validator->validate($entity);
        if (count($errors) > 0) {
            // This gives us a nice string for error feedback.
            $errorsString = (string)$errors;

            return new JsonResponse($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        return new JsonResponse('OK', Response::HTTP_OK);
    }

    /**
     * delete an existing company or empployee
     * Return OK and status 200 if the data is correct or 400
     * @param Request $request
     * @param string $type
     * @param integer $id
     * @return Response
     * @Route("/provider/{type}/{id}/remove", name="provider_delete", methods={"DELETE"}, defaults={"type": "company"},
     *     requirements={"type": "company|employee", "id":"\d+"})
     * @SWG\Response(
     *     response=200,
     *     description="Information deleted"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Information not deleted, missing mandatory data or not validated"
     * )
     */
    public function delete(Request $request, string $type, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ($type == Company::NAME) {
            $entity = $entityManager->getRepository(Company::class)->find($id);
        } else {
            $entity = $entityManager->getRepository(Employee::class)->find($id);
        }
        if ($entity === null) return new JsonResponse($type . ' does not exist', Response::HTTP_BAD_REQUEST);

        $entityManager->remove($entity);
        $entityManager->flush();

        return new JsonResponse('OK', Response::HTTP_OK);
    }
}
