<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

  #[Route('/user/new', name: 'user_create', methods: ['GET', 'POST'])]
  public function create(
    Request $request, 
    EntityManagerInterface $entityManager,
    UserPasswordHasherInterface $passwordHasher
    ): Response
  {
    if ($request->isMethod('POST')) {
      // $name = $request->request->get('name');
      $data = [
        'first_name' => $request->request->get('first_name'),
        'last_name' => $request->request->get('last_name'),
        'email' => $request->request->get('email'),
        'plainPassword' => $request->request->get('password'),
      ];
      
      $errors = $this->validateCreate($data);
      if($errors){
        return $this->redirectToRoute('dashboard');
      }

      $user = new User();
      // $user->setName($name);
      $user->setFirstName($data['first_name']);
      $user->setLastName($data['last_name']);
      $user->setEmail($data['email']);
      $user->setRoles(['ROLE_USER']);
      
      // Password

      $hashedPassword = $passwordHasher->hashPassword($user, $data['plainPassword']);
      $user->setPassword($hashedPassword);

      $entityManager->persist($user);
      $entityManager->flush();
    }
    return $this->redirectToRoute('dashboard');
  }

  private function validateCreate($data){
    foreach ($data as $key => $value) {
      if(mb_strlen($value) <= 3){
        return 'value can not be shorter than 4';
      }
    }
    return;
  }
}