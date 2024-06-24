<?php

namespace App\Presentation\Controller;

use App\Application\Command\Resume\CreateResumeCommand;
use App\Application\Command\Resume\DeleteResumeCommand;
use App\Application\Command\Resume\UpdateResumeCommand;
use App\Application\Query\Resume\GetResumeByIdQuery;
use App\Application\Service\FileService;
use App\Contracts\Service\ResumeServiceInterface;
use App\Presentation\Form\ResumeType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController extends AbstractController
{
    private ResumeServiceInterface $resumeService;
    private FileService $fileService;

    public function __construct(ResumeServiceInterface $resumeService, FileService $fileService)
    {
        $this->resumeService = $resumeService;
        $this->fileService = $fileService;
    }

    /**
     * @Route("/resumes", name="resume_index")
     */
    public function index(): Response
    {
        try {
            $resumes = $this->resumeService->getAllResumes();
            
            return $this->render('resume/index.html.twig', [
                'resumes' => $resumes
            ]);
        } catch (Exception $e) {
            $this->addFlash('error', 'Error fetching resumes: '.$e->getMessage());

            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/resumes/new", name="resume_new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(ResumeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $resumeFile = $form->get('resumeFile')->getData();

                if ($resumeFile) {
                    $newFilename = $this->fileService->uploadFile($resumeFile);
                    $data->setResumeFile($newFilename);
                }

                $command = new CreateResumeCommand(
                    $data->getJobTitle(), $data->getResumeFile(), $data->getResumeText()
                );
                $this->resumeService->createResume($command);
                $this->addFlash('success', 'Resume created successfully.');

                return $this->redirectToRoute('resume_index');
            } catch (Exception $e) {
                $this->addFlash('error', 'Error creating resume: '.$e->getMessage());

                return $this->redirectToRoute('resume_new');
            }
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
        try {
            $resume = $this->resumeService->getResumeById(new GetResumeByIdQuery($id));
            $form = $this->createForm(ResumeType::class, $resume);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                try {
                    $data = $form->getData();
                    $resumeFile = $form->get('resumeFile')->getData();

                    if ($resumeFile) {
                        $newFilename = $this->fileService->uploadFile($resumeFile);
                        $data->setResumeFile($newFilename);
                    }

                    $command = new UpdateResumeCommand(
                        $id,
                        $data->getJobTitle(),
                        $data->getResumeFile(),
                        $data->getResumeText()
                    );
                    $this->resumeService->updateResume($command);
                    $this->addFlash('success', 'Resume updated successfully.');

                    return $this->redirectToRoute('resume_index');
                } catch (Exception $e) {
                    $this->addFlash('error', 'Error updating resume: '.$e->getMessage());

                    return $this->redirectToRoute('resume_edit', ['id' => $id]);
                }
            }

            return $this->render('resume/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        } catch (NotFoundHttpException $e) {
            $this->addFlash('error', 'Resume not found.');

            return $this->redirectToRoute('resume_index');
        } catch (Exception $e) {
            $this->addFlash('error', 'Error fetching resume: '.$e->getMessage());

            return $this->redirectToRoute('resume_index');
        }
    }

    /**
     * @Route("/resumes/{id}/delete", name="resume_delete")
     */
    public function delete(int $id): Response
    {
        try {
            $this->resumeService->deleteResume(new DeleteResumeCommand($id));
            $this->addFlash('success', 'Resume deleted successfully.');
        } catch (NotFoundHttpException $e) {
            $this->addFlash('error', 'Resume not found.');
        } catch (Exception $e) {
            $this->addFlash('error', 'Error deleting resume: '.$e->getMessage());
        }

        return $this->redirectToRoute('resume_index');
    }
}