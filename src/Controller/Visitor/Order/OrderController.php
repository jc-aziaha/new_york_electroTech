<?php

namespace App\Controller\Visitor\Order;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/recap', name: 'app_order_index', methods:['GET'])]
    public function index(): Response
    {

        /** 
         * 1- Récupérons l'utilisateur actuellement connecté
         * 
         * @var User 
        */
        $user = $this->getUser();


        // 2- Vérifier si cet utilisateur a enregistré au moins une adresse de livraison
        if ( \count($user->getAddresses()->toArray()) == 0 ) 
        {
            $this->addFlash('warning', "Vous devez enregistrer au moins une adresse de livraison avant de passer votre commande.");
            return $this->redirectToRoute('user_address_index');
        }



        return $this->render('pages/visitor/order/index.html.twig');
    }
}
