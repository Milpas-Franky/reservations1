<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Localities;
use App\Repository\LocalitiesRepository;
use Doctrine\Persistence\ManagerRegistry;



class LocalitiesController extends AbstractController
{
    #[Route('/localities', name: 'app_localities')]
    public function index(LocalitiesRepository $repository): Response
    {
        //$repository = $this->getDoctrine()->getRepository(Localities::class);
        $localities = $repository->findAll();

        return $this->render('localities/index.html.twig', [
            'localities' => $localities,
            'resource' => 'localities',

        ]);
    }

        /**
     * @Route("/localities/{id}", name="localities_show")
     */
    public function show(ManagerRegistry $doctrine,$id)
    {
       $repository = $doctrine->getRepository(Localities::class);
       $localitie = $repository->find($id);

        return $this->render('localities/show.html.twig', [
            'localitie' => $localitie,
        ]); 
    }
}
