<?php

namespace App\Controller;

use App\Entity\AdminUser;
use App\Form\AdminUserType;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route(name="test")
     */
    public function index(SerializerInterface $serializer)
    {
        $client = new Client();
        $response = $client->get($this->generateUrl('admin_user', [], UrlGeneratorInterface::ABSOLUTE_URL));
        $users = $serializer->deserialize($response->getBody()->getContents(), AdminUser::class . '[]', 'json');

        return $this->render('test/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/new", name="test_new")
     */
    public function new(Request $request)
    {
        $user = new AdminUser();

        $form = $this
            ->createForm(AdminUserType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = new Client();
            $client->post($this->generateUrl('admin_user_create', [], UrlGenerator::ABSOLUTE_URL), [
                'form_params' => $request->request->all()
            ]);

            return $this->redirectToRoute('test');
        }

        return $this->render('test/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test_edit")
     */
    public function edit(AdminUser $user, Request $request)
    {
        $form = $this
            ->createForm(AdminUserType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = new Client();
            $client->put($this->generateUrl('admin_user_update', ['id' => $user->getId()], UrlGenerator::ABSOLUTE_URL), [
                'form_params' => $request->request->all()
            ]);

            return $this->redirectToRoute('test');
        }

        return $this->render('test/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="test_delete")
     */
    public function delete(AdminUser $user)
    {
        $client = new Client();
        $client->delete($this->generateUrl('admin_user_delete', ['id' => $user->getId()], UrlGenerator::ABSOLUTE_URL));

        return $this->redirectToRoute('test');
    }
}
