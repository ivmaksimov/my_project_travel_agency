<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Destin;
use App\Form\DestinType;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;

class DestinationController extends AbstractController
{

    #[Route('/', name: 'index_action')]
    public function indexAction(ManagerRegistry $doctrine)
    {
        $destin = $doctrine
            ->getRepository(Destin::class)
            ->findAll(); // this variable $products will store the result of running a query to find all the products
        return $this->render('destination/index.html.twig', array("destin" => $destin));
        //sends the variable that have all the products as an array of objects to the index.html.twig page
    }



    #[Route('/create', name: 'create_action')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $destin = new Destin();
        $form = $this->createForm(DestinType::class, $destin);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destin = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($destin);
            $em->flush();

            $this->addFlash('notice', 'Destination Added');

            return $this->redirectToRoute('index_action');
        }


        return $this->render('destination/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/details/{id}', name: 'destin_details')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $destin = $doctrine->getRepository(Destin::class)->find($id);

        return $this->render('destination/details.html.twig', ['destin' => $destin]);
    }

    #[Route('/edit/{id}', name: 'destin_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $destin = $doctrine->getRepository(Destin::class)->find($id);
        $form = $this->createForm(DestinType::class, $destin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $destin = $form->getData();

            $em = $doctrine->getManager();
            $em->persist($destin);
            $em->flush();
            $this->addFlash(
                'notice',
                'Destination Edited'
            );

            return $this->redirectToRoute('index_action');
        }

        return $this->render('destination/edit.html.twig', ['form' => $form->createView()]);
    }


    #[Route('/delete/{id}', name: 'destin_delete')]
    public function deleteDestin($id, ManagerRegistry $doctrine): Response
    {

        $destin = $doctrine->getManager()->getRepository(Destin::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($destin);

        $em->flush();
        $this->addFlash(
            'notice',
            'Destination Removed'
        );

        return $this->redirectToRoute('index_action');
    }
}
