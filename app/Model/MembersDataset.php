<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

class MembersDataset
{
    /**
     * @param array<int, string> $keys
     * @return array<string, array{name:string, job:string|null, phone:string, mail:string, photo:string|null}>
     */
    public function get(array $keys = []): array
    {
        $data =  [
            'realizace' => [
                'name' => 'Realizace',
                'job' => null,
                'phone' => '+420 739 405 068',
                'mail' => 'info@strechybohemia.cz',
                'photo' => null
            ],
            'obchod' => [
                'name' => 'Obchod',
                'job' => null,
                'phone' => '+420 608 524 294',
                'mail' => 'info@strechybohemia.cz',
                'photo' => null
            ],
            'roman_kucera' => [
                'name' => 'Roman Kučera',
                'job' => 'Jednatel společnosti',
                'phone' => '+420 739 405 068',
                'mail' => 'roman@strechybohemia.cz',
                'photo' => '/img/photo-kucera.jpg'
            ],
            'jan_pribyl' => [
                'name' => 'Jan Přibyl',
                'job' => 'Obchodní manažer',
                'phone' => '+420 608 524 294',
                'mail' => 'honza@strechybohemia.cz',
                'photo' => '/img/photo-pribyl.jpg'
            ],
            'miroslav_dubsky' => [
                'name' => 'Miroslav Dubský',
                'job' => 'Rozpočtář/kalkulant',
                'phone' => '+420 608 269 328',
                'mail' => 'mira.dubsky@strechybohemia.cz',
                'photo' => '/img/photo-dubsky.jpg'
            ],
            'veronika_dubska' => [
                'name' => 'Veronika Dubská',
                'job' => 'Marketing společnosti',
                'phone' => '+420 731 909 896',
                'mail' => 'veronika@strechybohemia.cz',
                'photo' => '/img/photo-dubska.jpg'
            ],
            'ondra_kohout' => [
                'name' => 'Ondra Kohout',
                'job' => 'Vedoucí skladu',
                'phone' => '+420 608 623 216',
                'mail' => 'ondra@strechybohemia.cz',
                'photo' => '/img/photo-kohout.jpg'
            ],
            'david_hovorka' => [
                'name' => 'David Hovorka',
                'job' => 'Obchodní zástupce',
                'phone' => '+420 777 745 345',
                'mail' => 'david.hovorka@strechybohemia.cz',
                'photo' => '/img/photo-hovorka.jpg'
            ],
            'martin_jungvirt' => [
                'name' => 'Martin Jungvirt',
                'job' => 'Účetní',
                'phone' => 'jungvirt@ikancelar.eu',
                'mail' => '+420 604 231 323',
                'photo' => '/img/photo-jingvirt.jpg'
            ],
        ];
        
        if (count($keys) !== 0) {
            $result = [];
            foreach ($keys as  $key) {
                $result[$key] = $data[$key];
            }
            return $result;
        }
        
        return $data;
    }
}