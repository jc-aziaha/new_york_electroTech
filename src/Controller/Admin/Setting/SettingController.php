<?php

namespace App\Controller\Admin\Setting;

use App\Entity\Setting;
use App\Form\SettingFormType;
use App\Repository\SettingRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class SettingController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    #[Route('/setting', name: 'admin_setting_index', methods: ['GET'])]
    public function index(SettingRepository $settingRepository): Response
    {
        return $this->render('pages/admin/setting/index.html.twig', [
            "setting" => $settingRepository->find(2)
        ]);
    }

    #[Route('/setting/{id<\d+>}/edit', name: 'admin_setting_edit', methods: ['GET', 'PUT'])]
    public function edit(Setting $setting, Request $request): Response
    {
        $form = $this->createForm(SettingFormType::class, $setting, [
            "method" => "PUT"
        ]);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) 
        {

            $setting->setUpdatedAt(new DateTimeImmutable());
            
            $this->em->persist($setting);
            $this->em->flush();

            $this->addFlash("success", "Les paramètres du site ont été modifiés.");

            return $this->redirectToRoute("admin_setting_index");
        }

        return $this->render('pages/admin/setting/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }


}
