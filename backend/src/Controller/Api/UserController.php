
<?php
namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate the data received from the front-end (email, password, etc.)

        // Create a new User entity and set the email
        $user = new User();
        $user->setEmail($data['email']);

        // Encode the password before storing it in the database
        $encodedPassword = $passwordEncoder->encodePassword($user, $data['password']);
        $user->setPassword($encodedPassword);

        // Save the user data to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User registered successfully!']);
    }
}