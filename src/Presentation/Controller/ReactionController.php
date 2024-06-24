<?php

namespace App\Presentation\Controller;

use App\Application\Command\Reaction\CreateReactionCommand;
use App\Application\Command\Reaction\DeleteReactionCommand;
use App\Application\Command\Reaction\UpdateReactionCommand;
use App\Application\Query\Reaction\GetReactionByIdQuery;
use App\Application\Service\ReactionService;
use App\Contracts\Service\ReactionServiceInterface;
use App\Presentation\Form\ReactionType;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController extends AbstractController
{
    private ReactionServiceInterface $service;

    public function __construct(ReactionServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/reactions", name="reaction_index")
     */
    public function index(): Response
    {
        $reactions = $this->service->getAllReactions();

        return $this->render('reaction/index.html.twig', [
            'reactions' => $reactions
        ]);
    }

    /**
     * @Route("/reactions/new", name="reaction_new")
     * @throws Exception
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(ReactionType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new CreateReactionCommand(
                $data['resumeId'],
                $data['companyId'],
                $data['reactionType'],
                new DateTime($data['sentDate'])
            );
            $this->service->createReaction($command);

            return $this->redirectToRoute('reaction_index');
        }

        return $this->render('reaction/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reactions/{id}/edit", name="reaction_edit")
     */
    public function edit(int $id, Request $request): Response
    {
        $reaction = $this->service->getReactionById(new GetReactionByIdQuery($id));
        $form = $this->createForm(ReactionType::class, $reaction);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $command = new UpdateReactionCommand($id, $data['reactionType']);
            $this->service->updateReaction($command);

            return $this->redirectToRoute('reaction_index');
        }

        return $this->render('reaction/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reactions/{id}/delete", name="reaction_delete")
     */
    public function delete(int $id): Response
    {
        $this->service->deleteReaction(new DeleteReactionCommand($id));

        return $this->redirectToRoute('reaction_index');
    }
}