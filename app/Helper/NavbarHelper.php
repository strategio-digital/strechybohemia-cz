<?php

namespace Strategio\Helper;

use Symfony\Component\HttpFoundation\Request;

class NavbarHelper
{
    /**
     * @param array<int, array{name:string, link:string, active:bool, dropdown:null|array<int, array{name:string|null, link:string|null, active:bool}>}> $items
     * @param Request $request
     * @return array<int, array{name:string, link:string, active:bool, dropdown:null|array<int, array{name:string|null, link:string|null, active:bool}>}>
     */
    public static function activate(array $items, Request $request): array
    {
        $currentUri = $request->getRequestUri();
        $currentRootUri = '/' . explode('/', $currentUri)[1];
        
        foreach ($items as $key => $item) {
            $dropdown = $item['dropdown'] ?: [];
            $inDropdown = count(array_filter($dropdown, fn($dropdown) => $dropdown['link'] === $currentUri)) !== 0;
            $items[$key]['active'] = $item['link'] === $currentUri || $item['link'] === $currentRootUri || $inDropdown;
            
            foreach ($dropdown as $subKey => $subItem) {
                $items[$key]['dropdown'][$subKey]['active'] = $subItem['link'] === $currentUri;
            }
        }
        
        return $items;
    }
}