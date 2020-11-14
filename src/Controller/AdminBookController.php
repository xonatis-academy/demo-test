<?php

namespace App\Controller;

use App\Form\BookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookController extends AbstractController
{
    /**
     * @Route("/admin/book", name="admin_book")
     */
    public function index(): Response
    {
        return $this->render('admin_book/index.html.twig', [
            'controller_name' => 'AdminBookController',
        ]);
    }

    /**
     * @Route("/admin/book/create", name="admin_book_create")
     */
    public function create(): Response
    {
        $form = $this->createForm(BookFormType::class, null, [
            'id' => 234
        ]);
        return $this->render('admin_book/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/book/{id}", name="admin_book_get")
     */
    public function get($id): Response
    {
        dd($id);
        return $this->render('admin_book/index.html.twig', [
            'controller_name' => 'AdminBookController',
        ]);
    }
}
