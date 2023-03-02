<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
  #[Route('/', name: 'app_homepage')]
  public function homepage()
  {
    $tracks = [
      ['song' => 'Ojos negros', 'artist' => 'El Gran Combo de Puerto Rico'],
      ['song' => 'Quimbara', 'artist' => 'Fania'],
    ];
    
    return $this->render('vinyl/homepage.html.twig', [
      'tracks' => $tracks,
      'title' => 'Trucutu'
    ]);
  }

  #[Route('/browse/{slug}', name: 'app_browse')]
  public function browse(string $slug = null)
  {
    $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre
    ]);
  }
}
