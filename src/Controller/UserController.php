<?php

namespace App\Controller;

use App\Entity\User;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/users", name="user")
     * @param SerializerInterface $serializer
     */
    public function index(SerializerInterface $serializer)
    {
        $userRepository = $this->container->get('doctrine')->getRepository(User::class);

        return new JsonResponse($serializer->serialize($userRepository->findAll(), 'json'), 200, [], true);
    }
}
