<?php

namespace App\Controller\Admin;

use App\Entity\Wish;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wish::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
