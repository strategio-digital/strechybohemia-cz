<?php

namespace Strategio\Model;

class TestimonialDataset
{
    /**
     * @param string|null $size
     * @return array<int, array{src:string, title: string}>
     */
    public function getLogos(string $size = null): array
    {
        $suffix = $size ? "-{$size}" : '';
        
        return [
            ['src' => "/img/logo-creaton{$suffix}.png", 'title' => 'Opravy Střech - Creaton'],
            ['src' => "/img/logo-puren{$suffix}.png", 'title' => 'Opravy Střech - Puren'],
            ['src' => "/img/logo-fatra{$suffix}.png", 'title' => 'Opravy Střech - Fatra'],
            ['src' => "/img/logo-prefa{$suffix}.png", 'title' => 'Opravy Střech - Prefa'],
            ['src' => "/img/logo-sfs{$suffix}.png", 'title' => 'Opravy Střech - SFS'],
            ['src' => "/img/logo-evromat{$suffix}.png", 'title' => 'Opravy Střech - EVROMAT'],
        ];
    }
}