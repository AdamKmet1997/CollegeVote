<?php

namespace App\Controller;

use App\Entity\Polling;
use App\Entity\Vote;
use App\Entity\User;
use App\Form\PollingType;
use App\Repository\PollingRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoteRepository;
use App\Repository\UserRepository;
/**
 * @Route("/polling")
 */
class PollingController extends AbstractController
{
    /**
     * @Route("/", name="polling_index", methods={"GET"})
     */
    public function index(Request $request,PollingRepository $pollingRepository , UserRepository $userRepository  ,VoteRepository $voteRepository): Response
    {
        return $this->render('polling/index.html.twig', [
            'pollings' => $voteRepository->findAll(),
            'user' => $userRepository->findAll(),
            'football'=>$pollingRepository->findByExampleField(6),
            'count'=> $voteRepository->findAll(),

        ]);
    }

    /**
     * @Route("/new", name="polling_new", methods={"GET","POST"})
     */
    public function new(Request $request , VoteRepository $voteRepository): Response
    {
        $polling = new Polling();
        $form = $this->createForm(PollingType::class, $polling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decision = $_POST['answer'];
            $polling->setAns($decision);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($polling);
            $entityManager->flush();

            return $this->redirectToRoute('polling_index');
        }

        return $this->render('polling/new.html.twig', [
            'pollings' => $polling,
            'vote' => $voteRepository->findall(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polling_show", methods={"GET"})
     */
    public function show(Request $request, Polling $polling, PollingRepository $pollingRepository, UserRepository $userRepository ): Response
    {
//       $value= $polling->getId();

        return $this->render('polling/show.html.twig', [
            'polling' => $polling,
            'pollings' => $pollingRepository->findAll(),
            'user' => $userRepository->findAll(),

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
