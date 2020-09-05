<?php

namespace App\Controller;

use App\PhraseGenerator;
use App\Entity\Phrase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PhraseController extends AbstractController
{
    /**
     * @Route("/", name="phrase")
     */
    public function index()
    {

        $generator=new PhraseGenerator() ;
        $phrase = $generator->getRandomPhrase();
       
        return $this->render('phrase/index.html.twig', [
            'controller_name' => 'PhraseController',
            'phr' => $phrase,
        ]);
    }
    /**
     * @Route("/save/{url_code}", name="phrases")
     */
    public function saveAction(Request $request,$url_code)
    { 
        $text=$request->request->get('phrase_text');
        $color=$request->request->get('phrase_color');
        $entityManager = $this->getDoctrine()->getManager();

        $phrase = new Phrase();
        $phrase->setPhrase($text);
        $phrase->setColor($color);
        $phrase->setUrl($url_code);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($phrase);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$phrase->getId());
      
    }
    /**
     * @Route("/{url_code}", name="phrases")
     */
    public function showAction($url_code)
    { 
        $text=$request->request->get('phrase_text');
        $color=$request->request->get('phrase_color');
        $entityManager = $this->getDoctrine()->getManager();

        $phrase = new Phrase();
        $phrase->setPhrase($text);
        $phrase->setColor($color);
        $phrase->setUrl($url_code);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($phrase);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$phrase->getId());
      
    }



}
