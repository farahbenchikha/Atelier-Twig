<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/{name}', name: 'show_name')]
    public function authorName(string $name): Response
    {
        // Rendre le template Twig avec la variable $name
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/authors', name: 'list_authors')]
    public function listAuthors(){
        $authors = array(
            array('id' => 1, 'picture' => '/images/victor.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        // calcul du nombre des livres total
        $totalBooks = array_sum(array_column($authors, 'nb_books'));
        return $this->render('author/list.html.twig',[
            
            'authors'=>$authors,
            'totalBooks' => $totalBooks,
        ]);
    }
    #[Route('/author/details/{id}', name: 'author_details')]
    public function authorDetails(int $id): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/victor.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        if (!isset($authors[$id])) {
            throw $this->createNotFoundException('Auteur non trouvé');
        }

        return $this->render('author/showAuthors.html.twig', [
            'author' => $authors[$id],
        ]);
    }
}
