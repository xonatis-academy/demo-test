<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add(Book $book, SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get('panier', [
            'elements' => [],
            'total' => 0
        ]);

        if (!isset($panier['elements'][$book->getId()])) {
            $panier['elements'][$book->getId()] = [
                'quantity' => 0,
                'book' => $book
            ];
        }

        $panier['elements'][$book->getId()]['quantity'] ++;
        $panier['total'] = $panier['total'] + $book->getPrice();

        $sessionInterface->set('panier', $panier);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clear(SessionInterface $sessionInterface): Response
    {
        $sessionInterface->remove('panier');
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get('panier', []);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'panier' => $panier
        ]);
    }
}
