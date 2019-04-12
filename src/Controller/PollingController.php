<?php

namespace App\Controller;

use App\Entity\Polling;
use App\Entity\User;
use App\Entity\Vote;
use App\Form\PollingType;
use App\Repository\PollingRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/polling")
 */
class PollingController extends AbstractController
{
    /**
     * @Route("/", name="polling_index", methods={"GET"})
     */
    public function index(PollingRepository $pollingRepository): Response
    {
        return $this->render('polling/index.html.twig', [
            'pollings' => $pollingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="polling_new", methods={"GET","POST"})
     */
    public function new(Request $request ,$id,Vote $vote,PollingRepository $pollingRepository, VoteRepository $voteRepository): Response
    {
        $polling = new Polling();
        $form = $this->createForm(PollingType::class, $polling);
        $form->handleRequest($request);

        ################################
        $pollingRepository = $this->getDoctrine()->getRepository('App:Polling');
        $counter = $pollingRepository->findBy(array('Voting_id'=>$id));
        $counter = count($counter);
        $liked = false;

        $checker = $pollingRepository->findOneBy(array('User_id' => $this->getUser(),'Voting_id' => $id));

        if($checker == null){
            $liked = true;
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $user = $_POST['user'];
                $ans = $_POST['ans'];
                $user = $entityManager->getRepository('App:User')->find($user);
                $polling->setUserId($user);
                $vote = $entityManager->getRepository('App:Vote')->find($vote);
                $polling->setVotingId($vote);
                $polling->setAns($ans);

                $entityManager->persist($polling);
                $entityManager->flush();
                return $this->redirectToRoute('vote_show', [
                    'id' => $vote->getId()
                ]);        }
        }
        if($liked == false){


        }
        ##############################

//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $user = $_POST['user'];
//            $ans = $_POST['ans'];
//            $user = $entityManager->getRepository('App:User')->find($user);
//            $polling->setUserId($user);
//            $vote = $entityManager->getRepository('App:Vote')->find($vote);
//            $polling->setVotingId($vote);
//            $polling->setAns($ans);
//
//            $entityManager->persist($polling);
//            $entityManager->flush();
//            return $this->redirectToRoute('vote_show', [
//                'id' => $vote->getId()
//            ]);        }

        return $this->render('polling/new.html.twig', [
            'polling' => $polling,
            'liked'=>$liked,
            'form' => $form->createView(),
            'vote' => $vote,
//            'likes' => $voteRepository->supportCounter($vote->getId()),

        ]);
    }

    /**
     * @Route("/{id}", name="polling_show", methods={"GET"})
     */
    public function show(Polling $polling): Response
    {
        return $this->render('polling/show.html.twig', [
            'polling' => $polling,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="polling_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Polling $polling): Response
    {
        $form = $this->createForm(PollingType::class, $polling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polling_index', [
                'id' => $polling->getId(),
            ]);
        }

        return $this->render('polling/edit.html.twig', [
            'polling' => $polling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polling_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Polling $polling): Response
    {
        if ($this->isCsrfTokenValid('delete'.$polling->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($polling);
            $entityManager->flush();
        }

        return $this->redirectToRoute('polling_index');
    }
}
