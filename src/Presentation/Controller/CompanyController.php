<?php

namespace App\Presentation\Controller;

use App\Application\Command\Company\CreateCompanyCommand;
use App\Application\Command\Company\DeleteCompanyCommand;
use App\Application\Command\Company\UpdateCompanyCommand;
use App\Application\Query\Company\GetCompanyByIdQuery;
use App\Application\Service\CompanyService;
use App\Contracts\Service\CompanyServiceInterface;
use App\Presentation\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    private CompanyServiceInterface $service;

    public function __construct(CompanyServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/companies", name="company_index")
     */
    public function index(): Response
    {
        $companies = $this->service->getAllCompanies();
        
        return $this->render('company/index.html.twig', [
            'companies' => $companies
        ]);
    }

    /**
     * @Route("/companies/new", name="company_new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(CompanyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new CreateCompanyCommand($data['name'], $data['website'], $data['address'], $data['telephone']);
            $this->service->createCompany($command);

            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/companies/{id}/edit", name="company_edit")
     */
    public function edit(int $id, Request $request): Response
    {
        $company = $this->service->getCompanyById(new GetCompanyByIdQuery($id));
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new UpdateCompanyCommand(
                $id,
                $data['name'],
                $data['website'],
                $data['address'],
                $data['telephone']
            );
            $this->service->updateCompany($command);

            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/companies/{id}/delete", name="company_delete")
     */
    public function delete(int $id): Response
    {
        $this->service->deleteCompany(new DeleteCompanyCommand($id));

        return $this->redirectToRoute('company_index');
    }
}