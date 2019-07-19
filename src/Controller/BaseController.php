<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="index")
    */
    public function index()
    {
        return $this->render('layout/home.html.twig');
    }

    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function userRegistration(Request $request, EntityManagerInterface $em): Response
    {
        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirectToRoute('index');
        }

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //$data = $form->getData();

            if ($em->getRepository(User::class)->findBy(['email' => $user->getEmail()])) {
                $form->get('email')->addError(new FormError('error'));
            }

            if($form->isValid()) {
                $tokenExpiresAt = new \DateTime('now +24 hours');

                $user->setRoles(['ROLE_USER']);
                $hash = password_hash($user->getEmail() . microtime() . uniqid(), PASSWORD_BCRYPT, array('cost' => 12));
                $hash = str_replace('/', '', $hash);
                $user->setActivationHash($hash);
                $user->setTokenExpiresAt($tokenExpiresAt);
                $em->persist($user);

                $em->flush();

                //$emailService->sendRegistrationEmail($user);

                /*return $this->forward('\App\Controller\SecurityController::activationSent', array(
                    'email' => $user->getEmail()
                ));*/

                return $this->redirectToRoute('index');
            }
        }

        return $this->render(
            'security/registration.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function activationSent(Request $request)
    {
        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirectToRoute('index');
        }

        return $this->render(
            'security/registration/activationSent.html.twig', [
                'email' => $request->attributes->get('email')
            ]
        );
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirectToRoute('product_types');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     * @throws \Exception
     */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}
