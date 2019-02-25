<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Employee;
use App\Form\CompanyType;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConsumerController
 * @package App\Controller
 */
class ConsumerController extends AbstractController
{
    /**
     * @Route("/consumer", name="consumer_index")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $companies = $entityManager->getRepository(Company::class)->findAll();
        $employees = $entityManager->getRepository(Employee::class)->findAll();
        return $this->render('consumer/index.html.twig', [
            'employees' => $employees,
            'companies' => $companies,
        ]);
    }

    /**
     * Create and Persist a new company
     * Return view
     * @param Request $request
     * @return Response
     * @Route("/consumer/company/new", name="consumer_add_company", methods={"GET","POST"})
     */
    public function newCompany(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();
            $this->addFlash('success', '<strong>Excellent!</strong> New company created');
        }

        return $this->render('consumer/form.html.twig', [
            'company' => $company,
            'title' => 'New company',
            'form' => $form->createView(),
        ]);
    }

    /**
     * Create and Persist a new company
     * Return view
     * @param Request $request
     * @return Response
     * @Route("/consumer/company/{company}/edit", name="consumer_edit_company",  methods={"GET","POST"})
     */
    public function editCompany(Request $request, Company $company)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();
            $this->addFlash('success', '<strong>Excellent!</strong> New company created');
        }

        return $this->render('consumer/form.html.twig', [
            'company' => $company,
            'title' => 'Edit company',
            'form' => $form->createView(),
        ]);
    }

    /**
     * Create and Persist a new employee
     * Return view
     * @param Request $request
     * @return Response
     * @Route("/consumer/employee/new", name="consumer_add_employee", methods={"GET","POST"})
     */
    public function newEmployee(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employee);
            $entityManager->flush();
            $this->addFlash('success', '<strong>Excellent!</strong> New employee created');
        }

        return $this->render('consumer/form.html.twig', [
            'employee' => $employee,
            'title' => 'New employee',
            'form' => $form->createView(),
        ]);
    }

    /**
     * Create and Persist a new employee
     * Return view
     * @param Request $request
     * @return Response
     * @Route("/consumer/employee/{employee}/edit", name="consumer_edit_employee",  methods={"GET","POST"})
     */
    public function editEmployee(Request $request, Employee $employee)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employee);
            $entityManager->flush();
            $this->addFlash('success', '<strong>Excellent!</strong> Employee updated');
        }

        return $this->render('consumer/form.html.twig', [
            'employee' => $employee,
            'title' => 'Edit employee',
            'form' => $form->createView(),
        ]);
    }
}
