<?php

namespace Strategio\Model;

use Nette\Utils\DateTime;

class WhyUsDataset
{
    /**
     * @return array<int,array{title:string, description:string}>
     */
    public function get(): array
    {
        $years = (new DateTime('1987-01-01 00:00:00'))->diff(new DateTime())->y;
        
        return [
            [
                'title' => 'Máme zkušenosti a ručíme za kvalitu',
                'description' => "Za {$years} let existence firmy máme drahé a těžce nabyté zkušenosti. Za svou práci ručíme."
            ],
            [
                'title' => 'Jsme cenově dostupní',
                'description' => 'Jen na Vás záleží, kolik investujete do střechy. Nejdražší není vždy nejlepší.'
            ],
            [
                'title' => 'Poskytujeme časovou flexibilitu',
                'description' => 'Každý den v terénu, nonstop na telefonu i e-mailu. Rádi pomůžeme.'
            ],
            [
                'title' => 'Pravidelně (se) školíme',
                'description' => 'Rok co rok, zimu co zimu, podstupujeme teoretické a praktické školení.'
            ],
            [
                'title' => 'Získáváme ocenění a diplomy',
                'description' => 'Vlastníme mnohá ocenění a různé diplomy. Jsme na to patřičně hrdí.'
            ],
            [
                'title' => 'Klienti si nás váží',
                'description' => 'Zeptejte se našich zákazníků a uvidíte sami. Naše motto: Slovo chlapa a férové jednání.'
            ],
        ];
    }
}