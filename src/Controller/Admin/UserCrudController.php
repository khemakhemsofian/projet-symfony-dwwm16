<?php

namespace App\Controller\Admin;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
       
    }

    
    public function configureFields(string $pageName): iterable
    {
      
        return [
            TextField::new('email'),
            ChoiceField::new('roles')->setChoices([
                 'ROLE_ADMIN'=>'ROLE_ADMIN',  
                 'ROLE_AGENT'=>'ROLE_AGENT',
                 'ROLE_USER'=> 'ROLE_USER'
            ])->allowMultipleChoices(),
            TextField::new('password'),
        ];
            
    }
    public function  __construct( UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder=$passwordEncoder;
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $password = $this->passwordEncoder->encodePassword($entityInstance, $entityInstance->getPassword());
        $entityInstance->setPassword($password);
        $entityManager->persist($entityInstance);
        $entityManager->flush();


    }

}
