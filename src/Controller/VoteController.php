<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\VoteType;
use App\Repository\UserRepository;
use App\Repository\PollingRepository;
use App\Repository\VoteRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/vote")
 */
class VoteController extends AbstractController
{


    /**
     * @Route("/", name="vote_index", methods={"GET"})
     */
    public function index(VoteRepository $voteRepository): Response
    {
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
            'datetime' => $voteRepository->timer($vote->getId())
        ]);
    }

//    /**
//     * @Route("/castvote/{id}", name="castvote", methods={"GET"})
//     */
//    public function castVote(Request $request, Vote $vote ): Response
//    {
//        $value = $request->query->get('id');
////        $for = (int) $request->query->get('count_for');
//        $for = $VoteRepository->findByCountFor($value);
//
//        //$against = (int) $request->query->get('count_against');
//
//        //  $vote = new Vote();
//        //$vote->setCountFor(++$test);
//        //$against->setCountAgainst($against);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($vote);
//        $entityManager->flush();
//
//
//        return $this->render('vote/voting.html.twig', [
//            'vote' => $vote,
//        ]);
//
//    }

    /**
     * @Route("/{id}", name="vote_show", methods={"GET"})
     */
    public function show(Vote $vote ,Request $request, PollingRepository $pollingRepository, VoteRepository $VoteRepository): Response
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('vote_show');
        }


        return $this->render('vote/show.html.twig', [
            'vote' => $vote,
            'ans' => $pollingRepository->findByExampleField($vote),
            'datetime' => $VoteRepository->timer($vote->getId()),
            'comment' => $comment,
            'form' => $form->createView(),
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
