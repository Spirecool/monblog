<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        // Soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            // on fait une copie à Mailtrap (adresse de l'administrateur)
            $email = new Email();
            $email->from($contact->getEmail())
                ->to($this->getParameter('app.contact.email'))
                ->replyTo($this->getParameter('app.contact.email'))
                ->subject($this->getParameter('app.contact.subject'))
                ->html($contact->getMessage());

            $this->addFlash('success', 'Votre message a bien été envoyé');

            $mailer->send($email); // envoie d'email
            return $this->redirectToRoute('app_contact');
        }

        // Ici on passe les variables créer dans le fichier services.yaml au contrôleur, pour qu'il les passe au niveau du template Twig
        return $this->render('contact/index.html.twig', [
            'contact_address' => $this->getParameter('app.contact.address'),   
            'contact_phone' => $this->getParameter('app.contact.phone'),
            'contact_email' => $this->getParameter('app.contact.email'),
            'form' => $form->createView()
        ]);
    }
}
