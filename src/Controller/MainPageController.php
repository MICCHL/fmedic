<?php


namespace App\Controller;


use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="app_mainpage")
     */
    public function index(DoctorRepository $repository)
    {
        return $this->render('main/index.html.twig', [
            'doctors' => $repository->findDoctorWorkToday()
        ]);
    }

}