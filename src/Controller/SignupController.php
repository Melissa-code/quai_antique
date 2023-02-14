<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{
    #[Route('/inscription', name: 'app_signup')]
    public function signup(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
        }


        return $this->render('signup/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
