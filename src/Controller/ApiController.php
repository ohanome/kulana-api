<?php

namespace App\Controller;

use App\Service\Kulana;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'app_api_')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Kulana $kulana): JsonResponse
    {
        return $this->json($kulana->status('https://ohano.me')->toArray());
    }
}
