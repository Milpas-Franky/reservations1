<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistsRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Artists;


class ArtistsController extends AbstractController
{
    #[Route('/artists', name: 'app_artists')]
    public function index(ArtistsRepository $repository): Response
    {

        //$repository = $this->getRepository(Artists::class);
        $artists = $repository->findAll();

        return $this->render('artists/index.html.twig', [
            'artists' => $artists,
            'resource' => 'artistes',
        ]);
    }

        /**
     * @Route("/artists/{id}", name="artists_show")
     */
    public function show(ManagerRegistry $doctrine, $id)
    {
        $repository = $doctrine->getRepository(Artists::class);
        $artist = $repository->find($id);

        //dd($artist->getTypes()[1]->getType());

        return $this->render('artists/show.html.twig', [
            'artist' => $artist,
        ]);
    }
}
