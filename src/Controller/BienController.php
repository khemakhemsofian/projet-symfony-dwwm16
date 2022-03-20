<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Mail;
use App\Form\MailformType;
use Symfony\Component\Mime\Email;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class BienController extends AbstractController
{
    #[Route('/bien', name: 'bien')]
    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('bien/index.html.twig', [
            'bienList' => $manager->getRepository(Bien::class)->findAll(),
        ]);
    }
    #[Route('/', name: 'acceuil')]
    public function acceuil(ManagerRegistry $manager): Response
    {
        return $this->render('bien/acceuil.html.twig', [
            'pageAcceuil' => $manager->getRepository(Bien::class)->findBy( [],["id" => "DESC"], 5)
        ]);
    }
    #[
        Route('/bien/{id}', name:'bien_single', requirements:['id'=>'\d+'])
     ]
     public function single(int $id, ManagerRegistry $manager, Request $request, MailerInterface $mailer):Response
     {
         $bien = $manager->getRepository(Bien::class)->find($id);
         $mail = new Mail;
         $form = $this->createForm(MailformType::class, $mail);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $em = $manager->getManager();
             $mail->setBien($bien);
             $user= $bien->getAgent();
             $mail->setUser($user);
             $em->persist($mail);
             $em->flush();
             // faut aussi faire la commande  "maildev --hide-extensions STARTTLS" pour que ça fonctionne a chaque fois que je lance mon symfony 
             //(utiliser le lien http://0.0.0.0:1080 pour regarder tt les information du mail ou aller sur la page /vos rdv mais il y a pas tt les info)
             $email = (new Email())
                        ->from($mail->getEmail()) 
                        ->to( $mail->getUser()->getEmail(),$mail->getEmail())
                        ->subject("Monsieur ".$mail->getNom(). " qui se nomme,".$mail->getPrenom(). " et son adresse e-mail ".$mail->getEmail())
                        ->text("A bien son rdv du ".$mail->getDaterdv()->format('Y-m-d H:i:s')." voici son numéro de téléphone: +33 ".$mail->getNumTel());
                       

            $mailer->send($email);

             $this->addFlash('success', "Votre rdv a bien été pris en compte,on vous recontactera");
             return $this->redirectToRoute('acceuil', ['id'=>$id]);
         }
         return $this->render("bien/single.html.twig", [
             'bien' => $bien,
             'form' => $form->createView()
         ]);
     }
 #[Route('/vosrdv', name:'mail')]
 public function rdv(ManagerRegistry $manager): Response
 {
    return $this->render('rdv/index.html.twig', [
        'mails' => $manager->getRepository(Mail::class)->findBy(['user'=> $this->getUser()]),
   ]);
 }

}
