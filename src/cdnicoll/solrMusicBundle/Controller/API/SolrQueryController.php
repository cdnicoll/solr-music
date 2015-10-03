<?php

namespace cdnicoll\solrMusicBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SolrQueryController extends Controller
{
    public function getPaginatedTracksAction($start, $end)
    {
        $solrService = $this->get('solr.service');
        $all = $solrService->getPaginatedTracks($start, $end);

        return new Response($all, 200);
    }
}
