<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Role;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('acceuil');
    }

    #[Route('/logon', name: 'logon')]
    public function logon(ManagerRegistry $doctrine): Response
    {
        extract($_POST);

        if(isset($_POST['envoyer'])){

            $users = $doctrine->getRepository(Users::class)->findAll();

            // foreach($users as $user){
            //     if($email = $users['email'] || $password = $users['password']){

            //         return $this->render('acceuil.html.twig', [
            //             'users' => $users,
            //         ]);
            //     }
            // }

        }
        
        return $this->render('acceuil.html.twig', [
            'users' => $users,
        ]);
    }


    public function show(ManagerRegistry $doctrine, int $id, int $email, string $mdp ): Response
    {
        $user = $doctrine->getRepository(Users::class)->find($id,$email,$mdp);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$email
            );
        }

        return new Response('Check out this great product: '.$user->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    
}
