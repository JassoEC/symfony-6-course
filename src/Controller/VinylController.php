<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
  #[Route('/', name: 'app_homepage')]
  public function homepage()
  {
    $mixes = $this->getMixes();

    return $this->render('vinyl/homepage.html.twig', [
      'mixes' => $mixes,
      'title' => 'Trucutu'
    ]);

  }

  #[Route('/browse/{slug}', name: 'app_browse')]
  public function browse( string $slug = null)
  {
    $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
    $mixes = $this->getMixes();
    
    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre,
      'mixes' => $mixes
    ]);
  }

  private function getMixes(): array{
    return [
      ['song' => 'Ojos negros', 'artist' => 'El Gran Combo de Puerto Rico','createdAt'=> new DateTime('2021-10-02')],
      ['song' => 'Quimbara', 'artist' => 'Fania','createdAt'=> new DateTime('2020-10-02')],
    ];
  }
}
