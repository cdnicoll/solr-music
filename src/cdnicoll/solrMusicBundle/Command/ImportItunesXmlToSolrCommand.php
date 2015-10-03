<?php
namespace cdnicoll\solrMusicBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportItunesXmlToSolrCommand extends ContainerAwareCommand
{
    const TYPE_TRACK = 'track';
    const TYPE_PLAYLIST = 'playlist';

    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * @var \cdnicoll\solrMusicBundle\Services\iTunesXMLParserService
     */
    protected $iTunesParserService;

    /**
     * @var \cdnicoll\solrMusicBundle\Services\SolrService
     */
    protected $solrService;

    /**
     * @var \Symfony\Component\Console\Formatter\OutputFormatter
     */
    protected $tableOutput;


    /**
     * Configure command
     *
     * @input String $smlPath path to XML file
     */
    protected function configure()
    {
        $this
            ->setName('solrMusic:importItunesXmlToSolr')
            ->setDescription('iTunes XML file to import into Solr')
            ->addArgument(
                'xmlPath',
                InputArgument::REQUIRED,
                'Path to XML file'
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->tableOutput = $this->getHelper('table');
        $this->iTunesParserService = $this->getContainer()->get('itunes.xml.parser');
        $this->solrService = $this->getContainer()->get('solr.service');

        // Get file and check the file exists
        $xmlFile = $this->input->getArgument('xmlPath');
        if(!file_exists($xmlFile)) {
            exit('failed to open '.$xmlFile);
        }

        // Parse the XML
        $xmlObj = $this->iTunesParserService->parseXMLPlst($xmlFile);

        // Import into solr
        $this->importTracks($xmlObj);
        $this->importPlaylists($xmlObj);

    }

    protected function importTracks($xmlObj)
    {
        $keys = array('id', 'songName_s','album_s','artist_s', 'playCount_i', 'rating_i');
        $this->tableOutput->setHeaders($keys);

        foreach($xmlObj['Tracks'] as $track) {
            if($track->Kind !== "Book") {
                $playCount = property_exists($track, 'Play Count') ? $track->{'Play Count'} : 0;
                $rating = property_exists($track, 'Rating') ? $track->Rating : 0;

                $solrData['id'] = $track->{'Track ID'};
                $solrData['songName_s'] = $track->Name;
                $solrData['album_s'] = $track->Album;
                $solrData['artist_s'] = $track->Artist;
                $solrData['playCount_i'] = $playCount;
                $solrData['rating_i'] = $rating;
                $solrData['size_i']  = $track->Size;
                $solrData['totalTime_i'] = $track->{'Total Time'};
                $solrData['type']  = self::TYPE_TRACK;

                $this->solrService->insertRow($solrData);

                $tableOutput[] = [$solrData['id'], $solrData['songName_s'], $solrData['album_s'], $solrData['artist_s'], $solrData['playCount_i'], $solrData['rating_i']];
            }
        }

        $this->tableOutput->setRows($tableOutput);
        $this->tableOutput->render($this->output);
    }

    protected function importPlaylists($xmlObj)
    {
        $keys = ['id', 'distinguishedKind_i', 'name_s'];
        $this->tableOutput->setHeaders($keys);

        foreach($xmlObj['Playlists'] as $playList) {
            $trackIds = [];
            $distinguishedKind = property_exists($playList, 'Distinguished Kind') ? $playList->{'Distinguished Kind'} : 0;

            if(!property_exists($playList, 'Playlist Items')) {
                continue;
            }

            $solrData['id'] = $playList->{'Playlist ID'};
            $solrData['distinguishedKind_i'] = $distinguishedKind;
            $solrData['name_s'] = $playList->Name;
            $solrData['type'] = self::TYPE_PLAYLIST;

            foreach($playList->{'Playlist Items'} as $playListTrackId) {
                $trackIds[] = $playListTrackId->{'Track ID'};
            }

            $solrData['playListItems'] = $trackIds;

            $this->solrService->insertRow($solrData);

            $tableOutput[] = [$solrData['id'], $solrData['distinguishedKind_i'], $solrData['name_s']];
        }

        $this->tableOutput->setRows($tableOutput);
        $this->tableOutput->render($this->output);

    }
}