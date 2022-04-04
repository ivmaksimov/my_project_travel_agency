<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Destin;

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
    public function createAction(ManagerRegistry $doctrine)
    {

        // you can fetch the EntityManager via $doctrine
        $em = $doctrine->getManager();
        $destination = new Destin(); // here we will create an object from our class Product.

        $destination->setPlace('Kratovo');
        $destination->setCountry('Macedonia');
        $destination->setDes('Oldest town in the Balkans');
        $destination->setLat('42.07836');
        $destination->setLon('22.18194');
        $destination->setSect('special');
        $destination->setPicture('product.png'); // in our Product class we have a set function for each column in our db
        $destination->setPrice(19);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($destination);
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return new Response('Saved new product with id' . $destination->getId());
    }

    #[Route('/details/{id}', name: 'details_action')]
    public function showDetailsAction($id, ManagerRegistry $doctrine)
    {
        $destination = $doctrine
            ->getRepository(Destin::class)
            ->find($id);
        if (!$destination) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        } else {
            return new Response('Details from the product with id ' . $id . ", Product name is " . $destination->getPlace() . " and it cost " . $destination->getPrice() . "€");
        }
    }
}
