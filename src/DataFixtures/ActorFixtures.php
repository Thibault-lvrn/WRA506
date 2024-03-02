<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Nationality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [NationalityFixtures::class];
    }
    public function load(ObjectManager $manager): void
    {

        // Génere les données pour 10 acteurs avec un firstName et un lastName réaliste
        $nationalities = $manager->getRepository(Nationality::class)->findAll();

        $faker = Factory::create('fr_FR');

        foreach (range(1, 30) as $i) {
            $actor = new Actor();
            $actor->setFirstName($faker->firstName());
            $actor->setLastName($faker->lastName());
            $actor->setReward($faker->numberBetween(0, 10));
            

            // Vérifie si le tableau des nationalités n'est pas vide
            if (!empty($nationalities)) {
                // Choisis une nationalité aléatoire parmi celles disponibles
                $randomNationality = $nationalities[array_rand($nationalities)];
                $actor->setNationality($randomNationality);
            }

            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor); // "expose" l'objet à l'extérieur de la classe pour les liaisons avec Movie
        }

        $manager->flush();
    }
}