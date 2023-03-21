<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{
    /**
     * Sign up
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param ManagerRegistry $managerRegistry
     * @return Response
     */
    #[Route('/inscription', name: 'app_signup')]
    public function signup(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $managerRegistry): Response
    {
        $user = new User();
        $form = $this->createForm(SignupType::class, $user);
        $form->handleRequest($request);
        //$form->get('cgu')->getData();

        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Hash the password
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
            // Save the new user data in the database
            $managerRegistry->getManager()->persist($user);
            $managerRegistry->getManager()->flush();

            // Redirect the user to the login page
            return $this->redirectToRoute('app_login');
        }

        return $this->render('signup/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
