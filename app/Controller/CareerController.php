<?php

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Response;

class CareerController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/career.latte')]
    public function index(): void
    {
        $this->addRequest('article', 'POST', "article/show-one", [
            'json' => [
                'slug' => 'kariera',
                'labels' => [],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
    
        $responses = $this->dispatchRequests('Career');
        $response = $responses['article'];
        $contents = $response->getBody()->getContents();
    
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }

        $this->template->data = json_decode($contents, true);
    }
}