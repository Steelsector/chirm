<?php

namespace App\Controller;

use App\Entity\Chirm;
use App\Form\ChirmType;
use App\Repository\ChirmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chirm")
 */
class ChirmController extends AbstractController
{
    /**
     * @Route("/", name="chirm_index", methods={"GET"})
     */
    public function index(ChirmRepository $chirmRepository): Response
    {
        return $this->render('chirm/index.html.twig', [
            'chirms' => $chirmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chirm_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chirm = new Chirm();
        $usr= $this->getUser();
        $chirm->setCreator($usr);
        $form = $this->createForm(ChirmType::class, $chirm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chirm);
            $entityManager->flush();

            return $this->redirectToRoute('chirm_index');
        }

        return $this->render('chirm/new.html.twig', [
            'chirm' => $chirm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chirm_show", methods={"GET"})
     */
    public function show(Chirm $chirm): Response
    {
        return $this->render('chirm/show.html.twig', [
            'chirm' => $chirm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chirm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chirm $chirm): Response
    {
        $form = $this->createForm(ChirmType::class, $chirm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chirm_index', [
                'id' => $chirm->getId(),
            ]);
        }

        return $this->render('chirm/edit.html.twig', [
            'chirm' => $chirm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chirm_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chirm $chirm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chirm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chirm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chirm_index');
    }
}
