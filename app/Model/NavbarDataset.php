<?php

namespace Strategio\Model;

use Symfony\Component\Routing\Generator\UrlGenerator;

class NavbarDataset
{
    public function __construct(protected UrlGenerator $generator)
    {
    }
    
    /**
     * @return array<int, array{name:string, link:string, active:bool, dropdown:null|array<int, array{name:string|null, link:string|null, active:bool}>}>
     */
    public function get(): array
    {
        return [
            [
                'name' => 'Úvod',
                'link' => $this->generator->generate('home'),
                'active' => false,
                'dropdown' => null,
            ],
            [
                'name' => 'Služby',
                'link' => '#',
                'active' => false,
                'dropdown' => [
                    [
                        'name' => 'Opravy a servis 24/7',
                        'link' => $this->generator->generate('service_emergency'),
                        'active' => false,
                    ],
                    [
                        'name' => 'Pravidelné revize a kontroly',
                        'link' => $this->generator->generate('service_revisions'),
                        'active' => false,
                    ],
                    [
                        'name' => null,
                        'link' => null,
                        'active' => false,
                    ],
                    [
                        'name' => 'Rekonstrukce šikmých a plochých střech',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'rekonstrukce-sikmych-a-plochych-strech']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Realizace nových střech',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'realizace-novych-strech']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Klempířské práce',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'klempirske-prace']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Pokrývačské práce',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'pokryvacske-prace']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Tesařské práce',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'tesarske-prace']),
                        'active' => false,
                    ],
                    [
                        'name' => null,
                        'link' => null,
                        'active' => false,
                    ],
                    [
                        'name' => 'Tepelná izolace fasád',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'tepelna-izolace-fasad']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Izolace plochých střech',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'izolace-plochych-strech']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Lokalizace netěsností a zatékání',
                        'link' => $this->generator->generate('article_detail', ['label' => 'sluzby', 'slug' => 'lokalizace-netesnosti-a-zatekani']),
                        'active' => false,
                    ],
                ]
            ],
            [
                'name' => 'Reference',
                'link' => $this->generator->generate('reference_list_home'),
                'active' => false,
                'dropdown' => null,
            ],
            [
                'name' => 'Typy střech',
                'link' => '#',
                'active' => false,
                'dropdown' => [
                    [
                        'name' => 'Plochá pultová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'plocha-pultova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Šikmá pultová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'sikma-pultova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Stanová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'stanova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Sedlová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'sedlova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Mansardová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'mansardova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Polovalbová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'polovalbova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Valbová střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'valbova-strecha']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Zelená střecha',
                        'link' => $this->generator->generate('article_detail', ['label' => 'strechy', 'slug' => 'zelena-strecha']),
                        'active' => false,
                    ],
                ]
            ],
            [
                'name' => 'O nás',
                'link' => '#',
                'active' => false,
                'dropdown' => [
                    [
                        'name' => 'Proč zvolit nás',
                        'link' => $this->generator->generate('article_detail', ['label' => 'o-nas', 'slug' => 'proc-zvolit-nas']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Naše certifikace',
                        'link' => $this->generator->generate('article_detail', ['label' => 'o-nas', 'slug' => 'nase-certifikace']),
                        'active' => false,
                    ],
                    [
                        'name' => 'Spolupráce SPŠ Tábor',
                        'link' => $this->generator->generate('cooperation'),
                        'active' => false
                    ]
                ]
            ],
            [
                'name' => 'Kariéra',
                'link' => $this->generator->generate('career'),
                'active' => false,
                'dropdown' => null
            ],
            [
                'name' => 'Kontakty',
                'link' => $this->generator->generate('contact'),
                'active' => false,
                'dropdown' => null
            ],
        ];
    }
}