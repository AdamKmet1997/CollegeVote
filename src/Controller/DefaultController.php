<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Polling;
//use App\Entity\Support;
//use App\Repository\SupportRepository;
use App\Entity\Supporting;
use App\Repository\SupportingRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Vote;
use App\Entity\User;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Form\PollingType;
use App\Repository\PollingRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\VoteRepository;
use App\Repository\UserRepository;
use App\Form\CommentType;
use App\Form\VoteType;
use Doctrine\ORM\Query;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('default/homepage.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}

#chapter 3 done
# need to create entity, DB, Login (User, Admin), CRUD