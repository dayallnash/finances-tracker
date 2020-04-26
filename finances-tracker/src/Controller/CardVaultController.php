<?php

namespace App\Controller;

use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardVaultController extends AbstractController
{
    /**
     * @Route("/card/vault", name="card_vault")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('card_vault/index.html.twig', [
            'allCards' => $this->getDoctrine()->getRepository(Card::class)->findBy(['user_id' => $this->getUser()->getId()]),
            'showDetails' => false,
        ]);
    }

    /**
     * @Route("/card/vault/show-details", name="card_vault_show_details")
     * @return Response
     */
    public function indexShowDetails(): Response
    {
        return $this->render('card_vault/index.html.twig', [
            'allCards' => $this->getDoctrine()->getRepository(Card::class)->findBy(['user_id' => $this->getUser()->getId()]),
            'showDetails' => true,
        ]);
    }

    /**
     * @Route("/card/vault/add", name="card_vault_add")
     * @param Request $request
     * @return Response
     */
    public function addCard(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $errors = false;

            if (empty($request->request->filter('name', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No card name provided!');
                $errors = true;
            }

            if (empty($request->request->filter('description', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No description provided!');
                $errors = true;
            }

            $longNumber = '';
            if (empty($request->request->filter('long_number', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No long number provided!');
                $errors = true;
            } else {
                $cardScrambler = explode(':', $this->getUser()->getCardScrambler());
                $longNumber = (string) ($request->request->filter('long_number', '', FILTER_VALIDATE_INT) / $cardScrambler[0]) * $cardScrambler[1];
            }

            if (empty($request->request->filter('cardholder_name', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No cardholder name provided!');
                $errors = true;
            }

            if (empty($request->request->filter('expiry_date', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No expiry date provided!');
                $errors = true;
            }

            if (empty($request->request->filter('cvv', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No CVV provided!');
                $errors = true;
            }

            if (empty($request->request->filter('card_type', '', FILTER_SANITIZE_STRING))) {
                $this->addFlash('danger', 'No card type matched!');
                $errors = true;
            }

            if (!$errors) {
                $card = (new Card())
                    ->setName($request->request->filter('name', '', FILTER_SANITIZE_STRING))
                    ->setDescription($request->request->filter('description', '', FILTER_SANITIZE_STRING))
                    ->setLongNumber($longNumber)
                    ->setCardholderName($request->request->filter('cardholder_name', '', FILTER_SANITIZE_STRING))
                    ->setExpiryDate($request->request->filter('expiry_date', '', FILTER_SANITIZE_STRING))
                    ->setCvv($request->request->filter('cvv', '', FILTER_SANITIZE_STRING))
                    ->setCardType($request->request->filter('card_type', '', FILTER_SANITIZE_STRING))
                    ->setUserId($this->getUser()->getId());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($card);
                $entityManager->flush();

                return new RedirectResponse($this->generateUrl('card_vault'));
            }
        }

        return $this->render('card_vault/add.html.twig');
    }
}
