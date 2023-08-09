<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Http\Controllers\Controller;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;


class RegistrationController extends AbstractController
{

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function apiRegister(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        $entityManager = $doctrine->getManager();

        $user = new User();
        $user->setUsername($email); // Assuming email is used as username
        $hashedPassword = $passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']); // Default role

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Registration successful'], Response::HTTP_CREATED);
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function apiLogin(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        // Load the user from the database based on the provided email
        $entityManager = $doctrine->getManager()->getRepository(User::class);
        $user = $userRepository->findOneBy(['username' => $email]);

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Verify the password
        if ($passwordHasher->isPasswordValid($user, $password)) {
            // Password matches, perform login logic (such as generating a token)

            // Return success response
            return new JsonResponse(['message' => 'Login successful']);
        }

        return new JsonResponse(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

}
