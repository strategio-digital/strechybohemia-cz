<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

class ContactDataset
{
    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        $data = [
            'facebook' => 'https://www.facebook.com/strechybohemia/',
            'instagram' => 'https://www.instagram.com/strechybohemia/',
            'linkedIn' => 'https://www.linkedin.com/company/st%C5%99echy-bohemia/',
            
            'googleMap' => 'https://goo.gl/maps/qWirrSdATmjKyqjy5',
            'mapyCz' => 'https://mapy.cz/s/loradajudo',
            
            'mainEmail' => 'info@strechybohemia.cz',
            'storePhone' => '+420 608 524 294',
            'realizationPhone' => '+420 739 405 068',
            
            'companyName' => 'Střechy Bohemia s.r.o.',
            'street' => ' Turovec 34',
            'city' => 'Turovec',
            'zip' => '391 21',
            
            'companyId' => '25176072',
            'companyVatId' => 'CZ25176072'
        ];
        
        return $data[$key];
    }
}