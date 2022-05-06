<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypesRepository;
<<<<<<< HEAD
=======
use App\Entity\Types;
>>>>>>> tablePivot
use Doctrine\Persistence\ManagerRegistry;

class TypesController extends AbstractController
{
    #[Route('/types', name: 'app_types')]
    public function index(TypesRepository $repository): Response
    {
        //$repository = $this->getRepository(Types::class);
        $types = $repository->findAll();

        return $this->render('types/index.html.twig', [
            'types' => $types,
            'resource' => 'types',

        ]);
    }

        /**
     * @Route("/types/{id}", name="types_show")
     */
    public function show(ManagerRegistry $doctrine,$id)
    {
        $repository = $doctrine->getRepository(Types::class);
        $type = $repository->find($id);

        return $this->render('types/show.html.twig', [
            'type' => $type,
        ]);
    }
}
