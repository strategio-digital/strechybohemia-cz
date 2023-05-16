<?php

namespace Strategio\Model;

class RevisionDataset
{
    /**
     * @return array<int, array{title:string, description:array<int,string>}>
     */
    public function getCommonItems(): array
    {
        return [
            [
                'title' => 'Kontrola krytiny a fólie',
                'description' => [
                    '1. Kontrola se týká nadzvednutých tašek, které je nutné umístit do původní polohy.',
                    '2. Kontrola upevnení řezaných a hřebenových tašek v úžlabí a nároží.',
                    '3. Kontrola trhlin, prasklin, odlupujících se nátěrů a netěsností spojů fólie.'
                ]
            ],
            [
                'title' => 'Kontrola klemp. prvků',
                'description' => [
                    '1. Kontroluje se jejich celkový stav, uchycení, napojení nebo ukončení na střešní krytinu.',
                    '2. Kontrulují a čistí se vodní odtokové svody a žlaby. U střešních oken, komínů, solárních kolektorů, atik a vykýřů jejich odtokové drážky.'
                ]
            ],
            [
                'title' => 'Kontrola funkčnosti tmelu',
                'description' => [
                    'U dilatačních lišt a lemovaní kolem komínů, antén, stožárů, vykýřů a jiné.'
                ]
            ],
            [
                'title' => 'Kontrola prostupů',
                'description' => [
                    'Odvětrání kanalizace, sanitární odvětrání, rekuperace, solární potrubý a kabeláž.'
                ]
            ],
            [
                'title' => 'Kontrola ochranných prvků',
                'description' => [
                    'Kontroluje se funkčnost prvků sloužících k ochraně proti pádu ze střechy tj, bezpečnostní háky, úvazová místa apod.'
                ]
            ],
            [
                'title' => 'Kontrola prvků proti povětrnosti',
                'description' => [
                    'Kontrola funkčnosti sněholamů, sněhových háků, vyhřívaní žlabů, úžlabí.'
                ]
            ],
        ];
    }
    
    /**
     * @return array<string, array{name:string, price:int|null, evidencePrice:int|null, items:array<int,array{title:string, description:array<int, string>}>, label:string|null}>
     */
    public function getPackages(): array
    {
        return [
            'standard' => [
                // Při úpravě klíče, názvu nebo ceny je potřeba hodnoty upravit i v app.strechybohemia.cz
                'name' => 'Standard',
                'price' => 5500,
                'evidencePrice' => 2750,
                'items' => [
                    ['title' => '2x ročně, jaro a podzim', 'description' => []],
                    ['title' => 'Neomezená tel. podpora technika', 'description' => []],
                    ['title' => 'Ohlídání termínu kontroly', 'description' => []],
                ],
                'label' => 'Vhodný pro plnění záruky a podmínek pojišťoven.'
            ],
            'profi' => [
                // Při úpravě klíče, názvu nebo ceny je potřeba hodnoty upravit i v app.strechybohemia.cz
                'name' => 'Profi',
                'price' => 15000,
                'evidencePrice' => 2500,
                'items' => [
                    ['title' => '2x ročně, jaro a podzim', 'description' => []],
                    ['title' => 'Neomezená tel. podpora technika', 'description' => []],
                    ['title' => 'Ohlídání termínu kontroly', 'description' => []],
                    ['title' => 'Projektová dokumentace', 'description' => []],
                    ['title' => 'Okamžitá sleva na materiál', 'description' => []],
                    ['title' => 'Po dobu 3 let bez starostí', 'description' => []],
                ],
                'label' => 'Vhodný pro plnění záruky a podmínek pojišťoven.'
            ],
            'individual' => [
                'name' => 'Individual',
                'price' => null,
                'evidencePrice' => null,
                'items' => [
                    ['title' => 'Kontroly až 12x ročně', 'description' => []],
                    ['title' => 'Neomezená tel. podpora technika', 'description' => []],
                    ['title' => 'Ohlídání termínu kontroly', 'description' => []],
                    ['title' => 'Projektová dokumentace', 'description' => []],
                    ['title' => 'Okamžitá sleva na materiál', 'description' => []],
                    ['title' => 'Sjednání na libovolný počet let', 'description' => []],
                    ['title' => 'Fotodokumentace objektu', 'description' => []],
                ],
                'label' => 'Na míru pro firmy a společnosti. Vhodný pro plnění záruky a podmínek pojišťoven.'
            ],
        ];
    }
}