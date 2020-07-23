<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {

        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
        $countUsers = (count($users));

        $clients = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findAll();
        $countClients = (count($clients));

        $jobOffers = $this->getDoctrine()
        ->getRepository(JobOffer::class)
        ->findAll();
        $countJobOffers = (count($jobOffers));

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'countUsers' => $countUsers,
            'countClients' => $countClients,
            'countJobOffers' => $countJobOffers,
        ]);
    }
    
}
