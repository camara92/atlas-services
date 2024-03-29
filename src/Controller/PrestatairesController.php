<?php

namespace App\Controller;

use App\Entity\Prestataires;
use App\Form\PrestatairesType;
use App\Repository\PrestatairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestatairesController extends AbstractController
{
    #[Route('/prestataires', name: 'app_prestataires')]
    public function AddPrestations(Request $request, EntityManagerInterface $entityManager): Response
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
    #[Route('/prestataires_show', name: 'app_prestataires_show')]
    public function showPrestation(PrestatairesRepository $prestatairesRepository): Response {

        
        return $this->render('prestataires/show.html.twig', [
            'prestations' => $prestatairesRepository->findAll(),
            'prestations_par_date' => $prestatairesRepository->findBy(['active'=>true], ['createdat'=>'desc']),
        ]);
    }
}
