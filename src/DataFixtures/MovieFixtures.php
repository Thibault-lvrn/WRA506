<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [ActorFixtures::class];
    }
    public function load(ObjectManager $manager): void
    {
        // Tableau de films avec noms et résumés
        $films = array(
            array("titre" => "Inception", "resume" => "Un voleur de rêves plonge dans l'inconscient pour voler des secrets."),
            array("titre" => "Les Évadés", "resume" => "Deux prisonniers forment une amitié indéfectible tout en planifiant leur évasion."),
            array("titre" => "The Dark Knight : Le Chevalier noir", "resume" => "Batman affronte le Joker dans une lutte pour la justice."),
            array("titre" => "Pulp Fiction", "resume" => "Une histoire entrelacée de gangsters, boxeurs, et personnages excentriques à travers Los Angeles."),
            array("titre" => "Le Parrain", "resume" => "Le patriarche d'une famille criminelle transmet le pouvoir à son fils, déclenchant une série de tragédies."),
            array("titre" => "Forrest Gump", "resume" => "Un homme simple avec un QI bas traverse des décennies d'histoire américaine et influence ceux qui l'entourent."),
            array("titre" => "Matrix", "resume" => "Un programmeur découvre que la réalité est une simulation informatique contrôlée par des machines."),
            array("titre" => "Titanic", "resume" => "Une histoire d'amour épique se déroule à bord du Titanic au cours de son célèbre naufrage."),
            array("titre" => "Avatar", "resume" => "Un marine paraplégique est envoyé sur la planète Pandora pour infiltrer la population autochtone."),
            array("titre" => "Jurassic Park", "resume" => "Des dinosaures génétiquement recréés échappent à leur confinement sur une île."),
            array("titre" => "Le Seigneur des anneaux : La Communauté de l'anneau", "resume" => "Une quête épique pour détruire un anneau maléfique et sauver la Terre du Milieu."),
            array("titre" => "Braveheart", "resume" => "L'histoire de William Wallace, chef écossais, et de sa lutte pour l'indépendance contre l'Angleterre."),
            array("titre" => "Le Silence des agneaux", "resume" => "Un agent du FBI recherche l'aide d'un psychopathe incarcéré pour traquer un tueur en série."),
            array("titre" => "La Liste de Schindler", "resume" => "Un homme d'affaires allemand sauve la vie de Juifs pendant l'Holocauste."),
            array("titre" => "Shining", "resume" => "Une famille devient gardienne d'un hôtel isolé et découvre des forces surnaturelles malveillantes."),
            array("titre" => "Casablanca", "resume" => "Un propriétaire de bar américain se retrouve pris entre l'amour et le devoir pendant la Seconde Guerre mondiale."),
            array("titre" => "Autant en emporte le vent", "resume" => "Une saga épique d'amour et de guerre pendant la Guerre civile américaine."),
            array("titre" => "Fight Club", "resume" => "Un homme crée un club secret où les hommes peuvent exprimer leur colère à travers des combats."),
            array("titre" => "Le Magicien d'Oz", "resume" => "Une jeune fille est transportée dans un monde magique et cherche un moyen de rentrer chez elle."),
            array("titre" => "Retour vers le futur", "resume" => "Un adolescent voyage dans le temps avec l'aide d'un scientifique excentrique."),
            array("titre" => "Le Parrain : 2e partie", "resume" => "La continuation de l'histoire de la famille Corleone, mêlant passé et présent."),
            array("titre" => "La Ligne verte", "resume" => "Un gardien de prison découvre qu'un homme condamné à mort possède des pouvoirs surnaturels."),
            array("titre" => "Gladiator", "resume" => "Un général romain déchu cherche la vengeance dans l'arène du Colisée."),
            array("titre" => "Les Affranchis", "resume" => "L'ascension et la chute d'un criminel dans la mafia italo-américaine."),
            array("titre" => "Les Infiltrés", "resume" => "Un flic infiltré et un criminel infiltré découvrent leurs véritables identités dans la pègre de Boston."),
            array("titre" => "The Social Network", "resume" => "L'histoire de la création de Facebook et des luttes juridiques qui en ont découlé."),
            array("titre" => "Interstellar", "resume" => "Des astronautes voyagent à travers un trou de ver pour trouver une nouvelle planète habitable pour l'humanité."),
            array("titre" => "The Revenant", "resume" => "Un trappeur luttant pour sa survie dans le désert américain après avoir été attaqué par un ours."),
            array("titre" => "La La Land", "resume" => "Une actrice et un musicien tombent amoureux à Los Angeles, poursuivant leurs rêves artistiques."),
            array("titre" => "Gatsby le Magnifique", "resume" => "Un mystérieux millionnaire organise de somptueuses fêtes dans l'espoir de reconquérir un amour perdu."),
            array("titre" => "Blade Runner", "resume" => "Un chasseur de primes traque des androïdes rebelles dans un futur dystopique."),
            array("titre" => "E.T. l'extra-terrestre", "resume" => "Un garçon rencontre un extraterrestre et tente de le ramener chez lui tout en échappant au gouvernement."),
            array("titre" => "Orange mécanique", "resume" => "Un délinquant violent est soumis à une expérimentation de conditionnement mental."),
            array("titre" => "Princess Bride", "resume" => "Une histoire d'amour et d'aventure avec des pirates, des géants et des duels à l'épée."),
            array("titre" => "Amadeus", "resume" => "L'histoire de la rivalité entre les compositeurs Antonio Salieri et Wolfgang Amadeus Mozart."),
            array("titre" => "Reservoir Dogs", "resume" => "Des criminels planifient un vol qui tourne mal, provoquant la suspicion et la trahison."),
            array("titre" => "Usual Suspects", "resume" => "Un groupe de criminels enquête sur un mystérieux criminel connu sous le nom de Keyser Söze."),
            array("titre" => "Terminator", "resume" => "Un cyborg est envoyé du futur pour éliminer la mère du futur leader de la résistance."),
            array("titre" => "2001 : l'Odyssée de l'espace", "resume" => "Une mission spatiale rencontre une intelligence extraterrestre évolutive."),
            array("titre" => "Seven", "resume" => "Deux détectives traquent un tueur en série qui commet des meurtres basés sur les sept péchés capitaux.")
        );

        $faker = \Faker\Factory::create('fr_FR');

        foreach ($films as $film) {
            $movie = new Movie();
            $movie->setTitle($film["titre"]);
            $randomDays = rand(0, 365);
            $releaseDate = new \DateTime();
            $releaseDate->sub(new \DateInterval('P' . $randomDays . 'D'));
            $movie->setReleaseDate($releaseDate);
            $movie->setDuration(rand(60, 180));
            $movie->setDescription($film["resume"]);
            $movie->setCategory($this->getReference('category_' . rand(1, 5)));
            $movie->setDirector($faker->name);
            $movie->setNote(rand(0, 5));
            $movie->setEntries(rand(100000, 1000000));
            $movie->setBudget(rand(100000, 1000000));
            $movie->setWebsite($faker->url);
            
            // Ajoute entre 2 et 6 acteurs dans le films, tous différents en se basant sur les fixtures
            $actors = [];
            foreach (range(1, rand(2, 6)) as $j) {
                $actor = $this->getReference('actor_' . rand(1, 10));
                if (!in_array($actor, $actors)) {
                    $actors[] = $actor;
                    $movie->addActor($actor);
                }
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
