<?php

namespace App\Controller;

use App\Entity\Prestataires;
use App\Form\PrestatairesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestatairesController extends AbstractController
{
    #[Route('/prestataires', name: 'app_prestataires')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prestataire = new Prestataires();
        $form = $this->createForm(PrestatairesType::class, $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
       

            $entityManager->persist($prestataire);
            $entityManager->flush();
           

         
            return $this->redirectToRoute('app_home');
        }
        return $this->render('prestataires/index.html.twig', [
            'prestation' => $form->createView(),
        ]);
    }
}
