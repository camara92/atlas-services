<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Prestataires;
use App\Entity\User;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces')]
    public function Annonces(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
      
        $annonces = new Annonces();
        $user = new User(); 
       
        $form = $this->createForm(AnnoncesType::class, $annonces);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        

            $entityManager->persist($annonces);
            $entityManager->flush();
           
            // mettre aussi une flash une fois l'annonce créée !!! doauda atlas dev 
         
            return $this->redirectToRoute('app_home');
        }
        return $this->render('annonces/index.html.twig', [
            'annonces' => $form->createView(),
        ]);
      
    }

    #[Route('/annonces_show', name: 'app_annonces_show')]
    public function showPrestation(AnnoncesRepository $annoncesRepository): Response {

        
        return $this->render('annonces/show.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
            'annonces_date' => $annoncesRepository->findBy(['id'=>true], ['createdat'=>'desc']),
        ]);
    }
}
