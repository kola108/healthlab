<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Services\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/users", name="users")
     * @Method("GET")
    */
    public function index()
    {
        $list = $this->userService->getList();
        return $this->render('users/index.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("users/add", name="users_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->saveItem($user);
            return $this->redirectToRoute('users');
        }

        return $this->render('users/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'add'
        ]);
    }

    /**
     * @Route("users/edit/{userId}", name="user_edit")
     * @param Request $request
     * @param User $user
     * @ParamConverter("user", options={"mapping": {"userId" : "id"}})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editUser(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->saveItem($user);
            return $this->redirectToRoute('users');
        }

        return $this->render('users/add-edit.html.twig', [
            'form' => $form->createView(),
            'mode' => 'edit'
        ]);
    }


    /**
     * @Route("users/delete/{userId}", name="user_delete")
     * @Method("DELETE")
     * @ParamConverter("user", options={"mapping": {"userId" : "id"}})
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteUser(User $user)
    {
        $this->userService->removeItem($user);
        return $this->redirectToRoute('users');
    }
}
