<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

class FaqDataset
{
    /**
     * @return array<int, array{title:string, description:string}>
     */
    public function getEmergency(): array
    {
        return [
            [
                'title' => 'Za jak dlouho se mi technik ozve?',
                'description' => 'Ihned po objednaní je požadavek odeslán přímo na telefon servisního technika. Ten se s Vámi obratem spojí, zhodnotí situaci a domluví termín příjezdu.'
            ],
            [
                'title' => 'Za jak dlouho technik přijede?',
                'description' => 'Technik zpravidla vyjede do 24 hodin, kompletní servis je vyřízen nejdéle do 5 pracovních dnů od objednání (pokud se tedy nedomluvíte na jiném termínu).'
            ],
            [
                'title' => 'Co mám dělat do doby, než přijede technik?',
                'description' => 'Při komunikaci s technikem dostanete přesná doporučení, aby nedošlo k újmě na zdraví a dalším majetku. Servisní objednávky vyřizujeme v co nejkratším možném čase, a proto téměř jistě nebude potřeba Váš fyzický zásah. Většinou postačí, když pouze vyčkáte.'
            ],
            [
                'title' => 'Jakou dostanu záruku?',
                'description' => 'Pokud se jedná o námi provedené dílo, automaticky dostanete záruku - 24 měsíců. Pochopitelně však nezodpovídáme za místa, která nezasahují do místa opravy, nezodpovídáme ani za původní konstrukce, prvky a materiály.'
            ],
            [
                'title' => 'Proč musím výjezd zaplatit předem?',
                'description' => 'Díky platbě předem nedochází ke zbytečným výjezdům - technik tak má 100% jistotu, že vyrazí na místo, kde ho opravdu potřebují.'
            ],
            [
                'title' => 'Kolik mě bude servis stát?',
                'description' => 'Finální cena bude stanovena na základě Vašich požadavků, cenách použitých materiálů a tarifním pásmu, ve kterém se nachází místo opravy. Cena dopravy a výjezdu technika je stanovena dle tarifního pásma a dozvíte se ji ihned po zadání místa opravy do objednávkového formuláře.'
            ],
            [
                'title' => 'Mohu si Vás objednat, i když nemám střechu přímo od vás?',
                'description' => 'Ano, právě to nás odlišuje od ostatních. Jiné firmy Vás raději odkáží přímo na původního realizátora (a mohou nastat problémy).'
            ],
            [
                'title' => 'Jak si mohu servis objednat?',
                'description' => 'Nejpohodlněji si servis objednáte přímo zde na webu. Také se s námi můžete spojit e-mailem i telefonicky. S radostí Vám zodpovíme jakékoli další dotazy.'
            ],
        ];
    }
    
    /**
     * @return array<int, array{title:string, description:string}>
     */
    public function getRevisions(): array
    {
        return [
            [
                'title' => 'Proč bych si měl zajistit pravidelné kontroly?',
                'description' => 'Pravidelná údržba střechy má zajišťovat spolehlivost a jistotu bezpečí Vám i vašemu okolí. Jelikož vaše střecha neustále po celou dobu její životnosti pracuje a je vystavena vnějším vlivům počasí či třetím osobám (kominík, IT a TV technici) je nutné, aby byla zajištěna její bezporuchová funkce. Střechy a jejich součásti musí být proto pravidelně a odborně kontrolovány ideálně dvakrát ročně (jaro; podzim).'
                    . '<br><br>Dle zákona č. 183/2006 Sb. o územním plánovaní a stavebním řádu a jeho prováděcích předpisů, odpovídá za pravidelné prohlídky a kontrolu střech vlastník budovy (stejně jako např. u revize komínů).'
                    . '<br><br>Př. <em>Pokud by došlo k újmě na zdraví či majetku vinou zanedbané údržby střechy, nese veškerou finanční a právní odpovědnost majitel objektu. Pojišťovny v těchto případech prověřují, zda byla střecha řádně a odborně kontrolována. Pokud ne, bohužel většina pojišťoven nepokryje žádné vzniklé náklady.</em>'
                    . '<br><br>Jako další důvod, proč si sjednat pravidelnou kontrolu střech, balkónu či teras, žlabů a svodů je záruka. Pokud se u nových a předaných děl nedodrží pravidelná prohlídka ideálně 2x ročně (jaro/podzim) po dobu 5 let záruky na dílo, tak se stává neplatnou. Dále tak předejdete nečekaným událostem spojeným s např. počasím, kdy vám prosakující voda ze střechy, terasy či balkonu může poškodit váš dům či movité věci.'
            ],
            [
                'title' => 'Za jak dlouho se mi technik ozve?',
                'description' => 'Ihned po objednaní je požadavek odeslán přímo na telefon servisního technika. Ten se s Vámi obratem spojí, zhodnotí situaci a domluví termíny kontrol.'
            ],
            [
                'title' => 'Dozvím se o kontrole s dostatečným předstihem?',
                'description' => 'Ano, dozvíte. Servisní technik Vás bude kontaktovat minimálně týden předem, následně Vás bude kontaktovat den před výjezdem.'
            ],
            [
                'title' => 'Jakou dostanu záruku?',
                'description' => 'Pokud se jedná o námi provedené dílo, automaticky dostanete záruku - 24 měsíců. Pochopitelně však nezodpovídáme za místa, která nezasahují do místa opravy, nezodpovídáme ani za původní konstrukce, prvky a materiály.'
            ],
            [
                'title' => 'Proč musím kontrolu zaplatit předem?',
                'description' => 'Díky platbě předem nedochází ke zbytečným výjezdům - technik tak má 100% jistotu, že vyrazí na místo, kde ho opravdu potřebují.'
            ],
            [
                'title' => 'Kolik mě bude kontrola stát?',
                'description' => 'Pokud při pravidelné kontrole nebudou zjištěny žádné nedostatky, finální cena zůstane stejná dle cen kontroly v balíčku a tarifního pásma. Při prováděných opravách je nutné k ceně připočíst náklady na materiál a čas (přesáhne-li standardní časový limit).'
            ],
            [
                'title' => 'Mohu si Vás objednat, i když nemám střechu přímo od vás?',
                'description' => 'Ano, právě to nás odlišuje od ostatních. Jiné firmy Vás raději odkáží přímo na původního realizátora (a mohou nastat problémy).'
            ],
            [
                'title' => 'Jak si mohu kontrolu objednat?',
                'description' => 'Nejpohodlněji si servis objednáte přímo zde na webu. Také se s námi můžete spojit e-mailem i telefonicky. S radostí Vám zodpovíme jakékoli další dotazy.'
            ],
        ];
    }
}