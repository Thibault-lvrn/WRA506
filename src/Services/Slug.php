<?php

namespace App\Services;
use Symfony\Component\String\Slugger\AsciiSlugger;

class Slug {
    public function sluggify(string $string): string {
        $slugger = new AsciiSlugger();
        return $slugger->slug($string);
    }
}