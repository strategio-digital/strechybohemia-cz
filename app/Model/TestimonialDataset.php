<?php

namespace Strategio\Model;

class TestimonialDataset
{
    /**
     * @return array<int, array{src:string, title: string}>
     */
    public function getLogos(): array
    {
        return [
            ['src' => '/img/logo-creaton.png', 'title' => 'Opravy Střech - Creaton'],
            ['src' => '/img/logo-puren.png', 'title' => 'Opravy Střech - Puren'],
            ['src' => '/img/logo-fatra.png', 'title' => 'Opravy Střech - Fatra'],
            ['src' => '/img/logo-prefa.png', 'title' => 'Opravy Střech - Prefa'],
            ['src' => '/img/logo-sfs.png', 'title' => 'Opravy Střech - SFS'],
            ['src' => '/img/logo-evromat.png', 'title' => 'Opravy Střech - EVROMAT'],
        ];
    }
}