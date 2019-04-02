<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     * * @IsGranted("ROLE_USER")
     */
    public function index(VoteRepository $voteRepository): Response
    {
        return $this->render('vote/user_voting.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }
}
