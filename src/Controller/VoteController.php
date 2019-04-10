<?php

namespace App\Controller;

use App\Entity\Polling;
//use App\Entity\Support;
//use App\Repository\SupportRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Vote;
use App\Entity\User;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Form\PollingType;
use App\Repository\PollingRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoteRepository;
use App\Repository\UserRepository;
use App\Form\CommentType;
use App\Form\VoteType;
use Doctrine\ORM\Query;


/**
 * @Route("/vote")
 */
class VoteController extends AbstractController
{


    /**
     * @Route("/", name="vote_index", methods={"GET"})
     */
    public function index( VoteRepository $voteRepository): Response
    {
//        $vote = new Vote();
//        $form = $this->createForm(VoteType::class, $vote);
//        $form->handleRequest($request);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');
//            if ($form->get('like')->isClicked()) {
//
//        $like = $voteRepository->find($id);
//
//        $like->setLikes($like->getLikes() + 1);
//
//        $entityManager->persist($like);
//        $entityManager->flush();
//            }
        return $this->render('vote/index.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="vote_new", methods={"GET","POST"})
     */
    public function new(Request $request , VoteRepository $voteRepository ): Response
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vote);
            $entityManager->flush();

            return $this->redirectToRoute('vote_index');
        }

        return $this->render('vote/new.html.twig', [
            'vote' => $vote,
            'form' => $form->createView(),
            'datetime' => $voteRepository->timer($vote->getId()),
//            'support' => $voteRepository->supportCounter($vote->getId())
        ]);
    }



    /**
     * @Route("/{id}", name="vote_show")
     */
    public function show(Vote $vote, $id,Request $request,VoteRepository $voteRepository, PollingRepository $pollingRepository, VoteRepository $VoteRepository): Response
    {
        return $this->render('vote/show.html.twig', [
            'vote' => $vote,
//            'form' => $form->createView(),
            'ans' => $pollingRepository->findByExampleField($vote),
            'datetime' => $VoteRepository->timer($vote->getId()),
            'comment' => $VoteRepository->showComment($vote->getId()),
//            'likes' => $VoteRepository->supportCounter($vote->getId()),

        ]);
    }
    /**
     * @Route("/{id}/like   ", name="like_show")
     */
    public function likeVote(Request $request, VoteRepository $voteRepository, $id, PollingRepository $pollingRepository,Vote $vote){


        $form = $this->createForm(VoteType::class);

        $entityManager = $this->getDoctrine()->getManager();
        $voteRepository = $this->getDoctrine()->getRepository('App:Vote');

        $like = $voteRepository->find($id);

        $like->setLikes($like->getLikes() + 1);

        $entityManager->persist($like);
        $entityManager->flush();



        return $this->render('vote/show.html.twig', [
            'vote' => $vote,
//            'form' => $form->createView(),
            'ans' => $pollingRepository->findByExampleField($vote),
            'datetime' => $voteRepository->timer($vote->getId()),
            'comment' => $voteRepository->showComment($vote->getId()),
//            'likes' => $VoteRepository->supportCounter($vote->getId()),

        ]);

    }

    /**
     * @Route("/{id}/edit", name="vote_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vote $vote): Response
    {
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vote_index', [
                'id' => $vote->getId(),
            ]);
        }


        return $this->render('vote/edit.html.twig', [
            'vote' => $vote,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/voted/{id}", name="vote_voting", methods={"GET"})
     */
    public function posting( Vote $vote): Response
    {


        return $this->render('vote/voting.html.twig', [
            'vote' => $vote,
        ]);
    }

    /**
     * @Route("/{id}", name="vote_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vote $vote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vote_index');
    }

}
