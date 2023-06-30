<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }



    public function configureFields(string $pageName): iterable
    {
        $userId = $this->getUser()->getId();
        return [
            yield HiddenField::new('Users')->setValue($userId),
            yield TextField::new('title'),
            yield TextField::new('meta_title'),
            yield TextareaField::new('description'),
            yield TextField::new('meta_desc'),
            yield AssociationField::new('Category'),
            yield ImageField::new('images')->setUploadDir('public/uploads/images/')



        ];
    }
}
