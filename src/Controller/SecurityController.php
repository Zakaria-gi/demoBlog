<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
   /**
    * @Route("/inscription", name="security_registration")
    */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User;

        $form = $this->createForm(RegistrationType::class, $user);

        dump($request);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            // On récupère le mot de passe du formulaire (non haché pour le moment) pour le transmettre à la méthode 
            // EncodePassword() qui elle va se chargée d'encoder / crypter / hacher le mot de passe
            
            $user->setPassword($hash); // on envoie le mot de passe haché dans le setteur de l'objet $user afin qu'il soit inséré
            // dans la BDD

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login'); // on redirige vers la page de connexion aprés inscription
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion",name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // renvoi le message d'erreur en cas de mauvais identifiants au moment de la connexion
        $error = $authenticationUtils->getLastAuthenticationError();

        // recupère le dernier username (email) que l'internaute a saisie dans le formulaire de connexion
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
           
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        // cette fonction ne retourne rien, il nous suffit d'avoir une route pour la deconnexion (voir security.yaml / firewalls)
    }

    /*
        security.yaml :

        providers : où ce trouvent les données à controler
        fireWalls : quelles parties du site nous allons protéger et par quel moyen (formulaire de connexion)
    */
}
