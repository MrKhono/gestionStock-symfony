<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\Categorie;

class ProduitController extends AbstractController
{
    #[Route('/Produit', name: 'produit')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $produits = $doctrine->getRepository(Produit::class)->findAll();

        $categories = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('produit/produit.html.twig',
        ['produits' => $produits,
        'categories' => $categories]);
    }

    

    #[Route('/Produit/get/{id}', name: 'produit_get')]
    public function getProduit($id): Response
    {   
        return $this->render('produit/produit.html.twig');
    }

    

    // #[Route('/addProduit', name: 'addProduit')]
    // public function addProduit(): Response
    // {
    //     return $this->render('addProduit.html.twig');
    // }

    #[Route('/add', name: 'ajout_produit')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        
        extract($_POST);
        

        if (isset($_POST['ajouter'])){
    
            $entityManager = $doctrine->getManager();

            $c = new Categorie();

            $product = new Produit();
            
            $product->setLibelle($libelle);
            $product->setStock($stock);

            $id = $c->getId();
            $product->setCategorieId($id);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('addProduit.html.twig');
        }

        return $this->render('addProduit.html.twig');
        
        // return new Response('Saved new product with id '.$product->getId());
    }

    

    

}
