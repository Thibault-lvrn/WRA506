<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Génére moi 5 objets Category fictifs
        // tableau php contenant une liste de categorie de films :
        $categories = ['Action', 'Aventure', 'Comédie', 'Drame', 'Horreur', 'Policier', 'Science-fiction', 'Thriller'];

        foreach (range(1, 5) as $i) {
            $category = new Category();
            $category->setName($categories[$i]);
            $manager->persist($category);
            $this->addReference('category_' . $i, $category); // "expose" l'objet à l'extérieur de la classe pour les liaisons avec Movie
        }

        $manager->flush();
    }
}