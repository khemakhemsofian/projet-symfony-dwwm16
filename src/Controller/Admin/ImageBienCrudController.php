<?php

namespace App\Controller\Admin;

use App\Entity\ImageBien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ImageBienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageBien::class;
    }
    
    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('lebien'),
            ImageField::new('nomimage')->setUploadDir('public/upload')->setBasePath('upload/'),
            // CollectionField::new('nom_image')->setEntryType(FileType::class,[
            //     'label'=>"label d'image"
            // ]) 
            
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        $image = new File ($entityInstance-> getNomImage());
        $imageName = md5(uniqid()) . '.' .$image->guessExtension();
        $image->move(
             $this->getParameter('upload_files'),
            $imageName
        );
        
        $entityInstance->setNomImage($imageName);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
    public function UpdateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance-> getNomImage()) {
            $entityInstance->setNomImage(
                new File($this->getParameter('upload_files') . '/' . $entityInstance-> getNomImage())
            );
        }
        $image = new File ($entityInstance-> getNomImage());
         $imageName = md5(uniqid()) . '.' . $image->guessExtension();
        $image->move(
            $this->getParameter('upload_files'),
            $imageName
        );
        $entityInstance->setNomImage($imageName);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
        
    }
}
