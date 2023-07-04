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
use Symfony\Component\VarDumper\VarDumper;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $article = new Article();
        $user = $this->getUser();
        if ($user) {
            $article->setUser($user);
            return $article;
        }
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('title'),
            yield TextField::new('meta_title'),
            yield TextareaField::new('description'),
            yield TextField::new('meta_desc'),
            yield AssociationField::new('category'),
            yield ImageField::new('images')
                ->setBasePath('uploads/images/')
                ->setUploadDir('public/uploads/images/')
        ];
    }
}
