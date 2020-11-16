<?php

namespace App\Controller;

use App\Form\AdminBookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminBookController extends AbstractController
{
    /**
     * @Route("/admin/book/create", name="admin_book_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminBookType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $book = $form->getData();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('admin_book');

        }


        return $this->render('admin_book/create.html.twig', [
            'controller_name' => 'AdminBookController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/book", name="admin_book")
     */
    public function index(): Response
    {
        return $this->render('admin_book/index.html.twig', [
            'controller_name' => 'AdminBookController',
        ]);
    }
}
