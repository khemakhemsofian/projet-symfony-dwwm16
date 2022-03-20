<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bien::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('description'),
            ImageField::new('photo')->setUploadDir('public/upload')->setBasePath('upload/'),
           // ImageField:: new('photo')
           // ->setBasePath('upload/')
           // ->setUploadDir('public/upload/')
           // ->setUploadedFileNamePattern('[randomhash].[extension]'),

            BooleanField::new('vente'),
            TextField::new('type'),
            DateField::new('datedeconstruction'),
            IntegerField::new('surface'),
            IntegerField::new('tailleDuTerrain'),
            IntegerField::new('nombreDePiece'),
            IntegerField::new('etage'),
            TextareaField::new('adresse'),
            IntegerField::new('prix'),
            AssociationField::new('options'),
            AssociationField::new('lesimages'),
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        $entityInstance->setAgent($this->getUser());
        $image = new File ($entityInstance->getPhoto());
        $imageName = md5(uniqid()) . '.' .$image->guessExtension();
        $image->move(
             $this->getParameter('upload_files'),
            $imageName
        );
        
        $entityInstance->setPhoto($imageName);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
   
     public function UpdateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getPhoto()) {
            $entityInstance->setPhoto(
                new File($this->getParameter('upload_files') . '/' . $entityInstance->getPhoto())
            );
        }
        $image = new File ($entityInstance->getPhoto());
         $imageName = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move(
            $this->getParameter('upload_files'),
            $imageName
        );
        $entityInstance->setPhoto($imageName);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
        
    }
}
