<?php

namespace App\Service;
use Symfony\Component\String\Slugger\AsciiSlugger;

class Sluggify {
    public function generateSlug(string $string): string {
        $slugger = new AsciiSlugger();
        return $slugger->slug($string);
    }
}