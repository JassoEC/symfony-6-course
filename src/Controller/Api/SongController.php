<?php

namespace App\Controller\Api;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
  // #[Route('/api/songs/{id}', name: 'api_get_song', methods: ['GET'])]
  #[Route('/api/songs/{id<\d+>}', name: 'api_get_song', methods: ['GET'])]
  public function getSong(LoggerInterface $logger, int $id): Response
  {
    $song = [
      'id' => $id,
      'name' => 'Quimbara',
      'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3'
    ];
    return $this->json($song);
  }
}
