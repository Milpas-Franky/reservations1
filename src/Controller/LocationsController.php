<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Locations;
use App\Repository\LocationsRepository;
use Doctrine\Persistence\ManagerRegistry;


class LocationsController extends AbstractController
{
    #[Route('/locations', name: 'app_locations')]
    public function index(LocationsRepository $repository): Response
    {
        //$repository = $this->getDoctrine()->getRepository(Locations::class);
        $locations = $repository->findAll();

        return $this->render('locations/index.html.twig', [
            'locations' => $locations,
            'resource' => 'lieux',
        ]);
    }

    /**
     * @Route("/locations/{id}", name="locations_show")
     */
    public function show(ManagerRegistry $doctrine, $id)
    {
        $repository = $doctrine->getRepository(Locations::class);
        $location = $repository->find($id);

        return $this->render('locations/show.html.twig', [
            'location' => $location,
        ]);
    }


}
