<?php

namespace App\Controller;

use App\Entity\Polling;
use App\Entity\Vote;
use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\PollingType;
use App\Form\VoteType;
use App\Repository\UserRepository;
use App\Repository\PollingRepository;
use App\Repository\VoteRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


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



    /**
     * @Route("/{id}", name="vote_show", methods={"GET"})
     */
    public function show(Vote $vote ,Request $request,UserInterface $user, PollingRepository $pollingRepository, VoteRepository $VoteRepository): Response
    {

//        $polling = new Polling();
//        $form = $this->createForm(PollingType::class, $polling);
//        $form->handleRequest($request);
//
//        $em = $this->getDoctrine()->getManager();
//        if ($form->isSubmitted() && $form->isValid()) {
//            $decision = $_POST['answer'];
//            $choice = $_POST['question'];
////            $user = $_POST['username'];
//            var_dump($user->getUsername());
//            $polling->setAns($decision);
////            $users =  $userRepository -> findUserById($user);
//            $polling->setUserId($user);
//            $voting = $em->getRepository('App:Vote')->find($choice);
//            $polling->setVotingId($voting);
////            $polling->setUserId($users);
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($polling);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('polling_index');
//        }

        return $this->render('vote/show.html.twig', [
            'vote' => $vote,
            'ans' => $pollingRepository->findByExampleField($vote),
            'datetime' => $VoteRepository->timer($vote->getId()),
            'comment' => $VoteRepository->showComment($vote->getId()),
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
