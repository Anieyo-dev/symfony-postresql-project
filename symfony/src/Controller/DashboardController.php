<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;

class DashboardController extends AbstractController
{
  #[Route('/xml/', name: 'dashboard')]
  public function dashboard(
    Request $request,
    UserRepository $userRepository,
    ServiceRepository $serviceRepository): Response
  {
    $number = random_int(0,100);

    // return new Response(
    //   '<html><body>Lucky number: '.$number.'</body></html>'
    // );

    // $user = new User();
    // $user_form = $this->createForm(UserType::class, $user);
    #$user_form = $this->createFormBuilder($user)->getForm();

    $users = $userRepository->getAllUsers();
    $services = $serviceRepository->getAllServices();

    return $this->render('xml/dashboard.html.twig', [
      'number' => $number,
      'users' => $users,
      'services' => $services,
      // 'user_form' => $user_form,
    ]);
  }
}