<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('Email'),
            TextField::new('Password')->setFormType(PasswordType::class),
            TextField::new('Username'),
            TextField::new('Name'),
            ChoiceField::new('Roles')->allowMultipleChoices()->setChoices([
                'User' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN'
            ])
        ];
    }
}
