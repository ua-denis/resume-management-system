<?php

namespace App\Presentation\Controller;

use App\Application\Command\Resume\CreateResumeCommand;
use App\Application\Command\Resume\DeleteResumeCommand;
use App\Application\Command\Resume\UpdateResumeCommand;
use App\Application\Query\Resume\GetResumeByIdQuery;
use App\Application\Service\ResumeService;
use App\Presentation\Form\ResumeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController extends AbstractController
{
    private ResumeService $service;

    public function __construct(ResumeService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/resumes", name="resume_index")
     */
    public function index(): Response
    {
        $resumes = $this->service->getAllResumes();
        
        return $this->render('resume/index.html.twig', [
            'resumes' => $resumes
        ]);
    }

    /**
     * @Route("/resumes/new", name="resume_new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(ResumeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new CreateResumeCommand($data['jobTitle'], $data['resumeFile'], $data['resumeText']);
            $this->service->createResume($command);

            return $this->redirectToRoute('resume_index');
        }

        return $this->render('resume/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/resumes/{id}/edit", name="resume_edit")
     */
    public function edit(int $id, Request $request): Response
    {
        $resume = $this->service->getResumeById(new GetResumeByIdQuery($id));
        $form = $this->createForm(ResumeType::class, $resume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new UpdateResumeCommand($id, $data['jobTitle'], $data['resumeFile'], $data['resumeText']);
            $this->service->updateResume($command);

            return $this->redirectToRoute('resume_index');
        }

        return $this->render('resume/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/resumes/{id}/delete", name="resume_delete")
     */
    public function delete(int $id): Response
    {
        $this->service->deleteResume(new DeleteResumeCommand($id));

        return $this->redirectToRoute('resume_index');
    }
}