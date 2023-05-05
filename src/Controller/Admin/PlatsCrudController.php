<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\ImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class PlatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            ChoiceField::new('saveur','Saveur')
                ->renderExpanded()
                ->setChoices([
                    'Salé' => '0',
                    'Sucré' => '1',
                ]),

            TextField::new('titre','Plat'),

            MoneyField::new('prix')->setCurrency('EUR'),

            IntegerField::new('duree','Durée en Min'),

            TextEditorField::new('description'),

            CollectionField::new('images')
                ->setEntryType(ImagesType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),

            CollectionField::new('images', 'Photos')
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
