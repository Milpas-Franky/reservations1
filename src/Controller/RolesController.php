<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RolesRepository;
use App\Entity\Roles;
use Doctrine\Persistence\ManagerRegistry;


class RolesController extends AbstractController
{
    #[Route('/roles', name: 'app_roles')]
    public function index(RolesRepository $repository): Response
    {
        //$repository = $this->getDoctrine()->getRepository(Roles::class);
        $roles = $repository->findAll();

       return $this->render('roles/index.html.twig', [
            'roles' => $roles,
            'resource' => 'roles',

       ]);     
    }

    /**
     * @Route("/roles/{id}", name="roles_show")
     */
    public function show(ManagerRegistry $doctrine,$id)
    {
        $repository = $doctrine->getRepository(Roles::class);
        $role = $repository->find($id);

        return $this->render('roles/show.html.twig', [
            'role' => $role,
        ]);
    }
}
