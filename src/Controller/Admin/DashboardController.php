<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Mail;
use App\Entity\User;
use App\Entity\ImageBien;
use App\Controller\Admin\BienCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
       if ( $this->IsGranted("ROLE_ADMIN")|| $this->IsGranted("ROLE_AGENT")) {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(BienCrudController::class)->generateUrl());
      }
       return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
       

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Agence Imobiliere')
            ;

    }

    public function configureMenuItems(): iterable
    {
        

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');        
            if($this->getUser() && $this->isGranted('ROLE_ADMIN') ){
            yield MenuItem::linkToCrud('user', 'fas fa-list', User::class);
            }
        yield MenuItem::linkToCrud('bien', 'fas fa-list', Bien::class);
        yield MenuItem::linkToCrud('imagebiens', 'fas fa-list', ImageBien::class);
        yield MenuItem::linkToCrud('mail', 'fas-fa-list', Mail::class); 

        //  MenuItem::linkToCrud('bien', 'fas fa-list', Bien::class)
        //  ->setPermission("ROLE_AGENT")
        //  ->setAction("new"),
    
    }
   
}
