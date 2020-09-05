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
     * @Route("/save/{url_code}", name="phraseSave")
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

        return $this->render('phrase/show.html.twig', [
            'new' => 'true',
            'url_code' => $url_code,
            'phr' => $phrase,
        ]);
       
      
    }
    /**
     * @Route("/{url_code}", name="phraseShow")
     */
    public function showAction(Request $request,$url_code)
    { 
     
        if($url_code=="search"){
            $url_code = $request->request->get('url_code');
            $repository = $this->getDoctrine()->getRepository(Phrase::class);
            $phrase = $repository->findOneBy(['url_code' => $url_code]);
        }
        else{
            $repository = $this->getDoctrine()->getRepository(Phrase::class);
            $phrase = $repository->findOneBy(['url_code' => $url_code]);
        }
      


        if (!$phrase) {
            return $this->render('phrase/show.html.twig', [
                'not_exist' => 'true',
                'url_code' => $url_code,
                'phr' => $phrase,
            ]);
        }

        return $this->render('phrase/show.html.twig', [
            'phr' => $phrase,
        ]);
      
    }



}
