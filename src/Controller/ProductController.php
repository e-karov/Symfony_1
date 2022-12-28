<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ProductController extends AbstractController
{

    #[Route("/", name:"index_action")]
    public function indexAction(ManagerRegistry $doctrine)
    {
        $products = $doctrine
            ->getRepository(Product::class)
            ->findAll();
        return $this->render("product/index.html.twig", ["products"=>$products]);
    }

   #[Route("/create", name:"create_action")]
   public function createAction(ManagerRegistry $doctrine)
   {
        #fetch the ManagerRegistry via $doctrine()
        $em = $doctrine->getManager();
        $product = new Product();
        $product->setName("Keyboard");
        $product->setPrice(19);

        
        $em->persist($product); # Tell Doctrine we want to save the Product (not a query yet)

        $em->flush();   # Actually executes the query ("INSERT ..."-query)

        return new Response("Saved new with id".$product->getId()); 

    }
    
    #[Route("/details/(productId)", name:"details_action")]
    public function showDetailsAction($productId, ManagerRegistry $doctrine)
    {
        $product = $doctrine
            ->getRepository(Product::class)
            ->find($productId);
        if (!$product) {
            throw $this->createNotFoundException("No product found for id".$productId);
        } else {
            return new Response("Details for the product with id".$productId
                . ", Product name is ".$product->getName()
                . "and it cost " . $product->getPrice() . "€.");
        }
    }
}
