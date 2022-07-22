<?php

namespace LegitHealth\DapiBundle;

use LegitHealth\Dapi\MediaAnalyzer as DapiMediaAnalyzer;
use LegitHealth\Dapi\MediaAnalyzerArguments\FollowUpArguments;
use LegitHealth\Dapi\MediaAnalyzerArguments\PredictArguments;
use LegitHealth\Dapi\MediaAnalyzerResponse\MediaAnalyzerResponse;

class MediaAnalyzer
{
    private DapiMediaAnalyzer $dapiMediaAnalyzer;

    public function __construct(string $apiUrl, string $apiKey)
    {
        $this->dapiMediaAnalyzer = new DapiMediaAnalyzer($apiUrl, $apiKey);
    }

    public function predict(PredictArguments $arguments): MediaAnalyzerResponse
    {
        return $this->dapiMediaAnalyzer->predict($arguments);
    }

    public function followUp(FollowUpArguments $arguments): MediaAnalyzerResponse
    {
        return $this->dapiMediaAnalyzer->followUp($arguments);
    }
}
