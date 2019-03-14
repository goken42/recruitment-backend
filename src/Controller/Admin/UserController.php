<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use App\Form\AdminUserType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as FOS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * Users list
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return array
     *
     * @FOS\Get(name="admin_user")
     * @FOS\View(serializerGroups={"user", "roles", "role", "paths", "path"})
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $users = $entityManager->getRepository(AdminUser::class)->findByFilters();

        return $users;
    }

    /**
     * Get user
     *
     * @param EntityManagerInterface $entityManager
     * @param integer $id
     *
     * @return AdminUser
     *
     * @FOS\Get("/{id}", name="admin_user_find")
     * @FOS\View(serializerGroups={"user", "roles", "role", "paths", "path"})
     */
    public function find(EntityManagerInterface $entityManager, int $id)
    {
        if ($user = $entityManager->getRepository(AdminUser::class)->find($id)) {
            return $user;
        }
    }

    /**
     * Create user
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @return AdminUser
     *
     * @FOS\Post(name="admin_user_create")
     * @FOS\View()
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $user = new AdminUser();

        $form = $this
            ->createForm(AdminUserType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $user;
        }
    }

    /**
     * Update user
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param integer $id
     *
     * @return AdminUser
     *
     * @FOS\Put("/{id}", name="admin_user_update")
     * @FOS\View()
     */
    public function update(EntityManagerInterface $entityManager, Request $request, int $id)
    {
        if ($user = $entityManager->getRepository(AdminUser::class)->find($id)) {
            $form = $this
                ->createForm(AdminUserType::class, $user, ['method' => 'PUT'])
                ->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $user;
            }
        }
    }

    /**
     * Delete user
     *
     * @param EntityManagerInterface $entityManager
     * @param integer $id
     *
     * @return void
     *
     * @FOS\Delete("/{id}", name="admin_user_delete")
     * @FOS\View()
     */
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        if ($user = $entityManager->getRepository(AdminUser::class)->find($id)) {
            $entityManager->remove($user);
            $entityManager->flush();
        }
    }
}
