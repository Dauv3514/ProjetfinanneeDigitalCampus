<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Entity\Sortie;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/concept", name="concept")
     */
    public function concept(): Response
    {
        return $this->render('site/concept.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation(): Response
    {
        return $this->render('site/presentation.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/sorties", name="sorties")
     */
    public function sorties(): Response
    {
        //affiche mes données sur la page
        $repo=$this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repo->findAll();

        $repository=$this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();


        return $this->render('site/sorties.html.twig', [
            'sorties'=>$sorties,
            'users'=>$users,
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(): Response
    {
        return $this->render('site/connexion.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(): Response
    {
        return $this->render('site/inscription.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }



    /**
     * @Route("/concept2", name="concept2")
     */
    public function concept2(): Response
    {
        return $this->render('site/concept2.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/sorties2", name="sorties2")
     */
    public function sorties2(): Response
    {
        //affiche mes données sur la page
        $repo=$this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repo->findAll();

        $repository=$this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();


        return $this->render('site/sorties2.html.twig', [
            'sorties'=>$sorties,
            'users'=>$users,
        ]);
    }

    /**
     * @Route("/sorties2/{id}", name="acceptesortie", methods={"GET"})
     */
    public function acceptesortie(Sortie $sortie): Response
    {

        $presence = new Presence();
        $presence->setSorties($sortie);
        $presence->setUsers($this->getUser());
        $presence->setValidation(false);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($presence);
        $entityManager->flush();

        return $this->redirectToRoute('sorties2');

    }


}
