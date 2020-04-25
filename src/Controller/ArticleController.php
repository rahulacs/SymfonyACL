<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/user/{id}/articles", name="articles")
     * @param int $id
     * @param SerializerInterface $serializer
     */
    public function index(int $id, SerializerInterface $serializer)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('doctrine')->getRepository(User::class);

        $articles = $userRepository->find($id)->getArticles();

        return new JsonResponse($serializer->serialize($articles, 'json'), 200, [], true);
    }

    /**
     * @Route("/user/{user_id}/article/{article_id}", name="article")
     * @param int $user_id
     * @param int $article_id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function show(int $user_id, int $article_id, SerializerInterface $serializer)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('doctrine')->getRepository(User::class);

        $articles = $userRepository->find($user_id)->getArticles()->filter(function ($article) use ($article_id) {
            return $article_id == $article->getId();
        });

        return new JsonResponse($serializer->serialize($articles, 'json'), 200, [], true);
    }
}
