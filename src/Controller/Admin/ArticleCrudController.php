<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\TagType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

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
            yield TextField::new('slug'),
            yield CollectionField::new('tags')->setEntryType(TagType::class)->setEntryIsComplex(true),
            // yield TextField::new('meta_title'),
            // yield TextField::new('meta_desc'),
            yield TextEditorField::new('description')->hideOnIndex()->setFormType(CKEditorType::class),
            yield TextEditorField::new('description2')->hideOnIndex()->setFormType(CKEditorType::class),
            yield TextEditorField::new('citation')->hideOnIndex()->setFormType(CKEditorType::class),
            yield AssociationField::new('category'),
            yield ImageField::new('images')
                ->setBasePath('uploads/img/')
                ->setUploadDir('public/uploads/img/'),
            yield ImageField::new('image2')
                ->setBasePath('uploads/img/')
                ->setUploadDir('public/uploads/img/'),
            yield ImageField::new('image3')
                ->setBasePath('uploads/img/')
                ->setUploadDir('public/uploads/img/')
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}