<?php

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;
use Strategio\Helper\CareerHelper;
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
                'suppressParagraphs' => false,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
    
        $this->addRequest('jobs', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 100,
                'desc' => false,
                'labels' => ['pracovni-pozice'],
                'suppressLabels' => true,
                'suppressFiles' => true,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
    
        $responses = $this->dispatchRequests('Career');
        
        $articleContents = $responses['article']->getBody()->getContents();
        if ($responses['article']->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($responses['article'], $articleContents);
        }
    
        $jobData = [];
        if ($responses['jobs']->getStatusCode() === Response::HTTP_OK) {
            $jobData = json_decode($responses['jobs']->getBody()->getContents(), true);
        }
    
        $this->template->data = json_decode($articleContents, true);
        
        $this->template->jobData = $jobData;
        $this->template->jobSalaries = CareerHelper::getSalaries($jobData['items']);
        $this->template->jobShortNames = CareerHelper::getShortJobNames($jobData['items']);
    }
}