<?php

namespace LegitHealth\DapiBundle;

use LegitHealth\Dapi\MediaAnalyzer as DapiMediaAnalyzer;
use LegitHealth\Dapi\MediaAnalyzerArguments\MediaAnalyzerArguments;
use LegitHealth\Dapi\MediaAnalyzerResponse\DiagnosisSupportResponse;
use LegitHealth\Dapi\MediaAnalyzerResponse\MediaAnalyzerResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MediaAnalyzer
{
    private DapiMediaAnalyzer $dapiMediaAnalyzer;

    public function __construct(private HttpClientInterface $dapiHttpClient)
    {
        $this->dapiMediaAnalyzer = DapiMediaAnalyzer::createWithHttpClient($dapiHttpClient);
    }

    public function predict(MediaAnalyzerArguments $arguments): MediaAnalyzerResponse
    {
        return $this->dapiMediaAnalyzer->predict($arguments);
    }

    public function diagnosisSupport(MediaAnalyzerArguments $arguments): DiagnosisSupportResponse
    {
        return $this->dapiMediaAnalyzer->diagnosisSupport($arguments);
    }

    public function followUp(MediaAnalyzerArguments $arguments): MediaAnalyzerResponse
    {
        return $this->dapiMediaAnalyzer->followUp($arguments);
    }
}
