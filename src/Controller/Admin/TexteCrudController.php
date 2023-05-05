<?php

namespace App\Controller\Admin;

use App\Entity\Texte;
use App\Form\ImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class TexteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Texte::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            AssociationField::new('categories'),

            TextField::new('titre'),

            TextEditorField::new('description'),

            CollectionField::new('images')
                ->setEntryType(ImagesType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),

            CollectionField::new('images','Photos')
                ->setTemplatePath('security/images.html.twig')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            BooleanField::new('etat', 'En Ligne'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail')
                        ->add(Crud::PAGE_EDIT,'detail');
    }
}

