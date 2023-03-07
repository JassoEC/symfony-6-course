<?php

namespace App\Controller;

use DateTime;
use Psr\Cache\CacheItemInterface;

use function Symfony\Component\String\u;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VinylController extends AbstractController
{
  #[Route('/', name: 'app_homepage')]
  public function homepage()
  {
    $mixes = [
      ['song' => 'Ojos negros', 'artist' => 'El Gran Combo de Puerto Rico', 'createdAt' => new DateTime('2021-10-02')],
      ['song' => 'Quimbara', 'artist' => 'Fania', 'createdAt' => new DateTime('2020-10-02')],
    ];

    return $this->render('vinyl/homepage.html.twig', [
      'mixes' => $mixes,
      'title' => 'Trucutu',
    ]);
  }

  #[Route('/browse/{slug}', name: 'app_browse')]
  public function browse(
    HttpClientInterface $httpClient,
    CacheInterface $cache,
    string $slug = null
  ) {

    $genre    = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

    $mixes = $cache->get('mixes', function (CacheItemInterface $cacheItem) use ($httpClient) {
      $cacheItem->expiresAfter(5);
      $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
      return $response->toArray();
    });


    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre,
      'mixes' => $mixes,
    ]);
  }
}
