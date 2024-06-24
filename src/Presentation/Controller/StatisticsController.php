<?php

namespace App\Presentation\Controller;

use App\Application\Service\StatisticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * @Route("/statistics", name="statistics_index")
     */
    public function index(): Response
    {
        $mostPositiveRatedResume = $this->statisticsService->getMostPositiveRatedResume();
        return $this->render('statistics/index.html.twig', [
            'mostPositiveRatedResume' => $mostPositiveRatedResume
        ]);
    }
}