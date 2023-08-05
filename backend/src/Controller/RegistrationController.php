<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function registerForm(): Response
    {
        // Render the registration form template
        return $this->render('registration/register.html.twig');
    }

    #[Route('/register', name: 'register_process', methods: ['POST'])]
    public function registerProcess(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Process the submitted registration form data and create a new user
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        // Create a new User entity and set the email
        $user = new User();
        $user->setEmail($email);

        // Encode the password before storing it in the database
        $encodedPassword = $passwordEncoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);

        // Save the user data to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Redirect the user to a login page or dashboard after successful registration
        return $this->redirectToRoute('login');
    }
}
