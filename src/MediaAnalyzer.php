<?php

namespace LegitHealth\DapiBundle;

use LegitHealth\Dapi\MediaAnalyzer as DapiMediaAnalyzer;
use LegitHealth\Dapi\MediaAnalyzerArguments\{
    DiagnosisSupportArguments,
    PredictArguments,
    SeverityAssessmentArguments
};
use LegitHealth\Dapi\MediaAnalyzerResponse\{
    DiagnosisSupportResponse,
    PredictResponse,
    SeverityAssessmentResponse
};
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MediaAnalyzer
{
    private DapiMediaAnalyzer $dapiMediaAnalyzer;

    public function __construct(private HttpClientInterface $dapiHttpClient)
    {
        $this->dapiMediaAnalyzer = DapiMediaAnalyzer::createWithHttpClient($dapiHttpClient);
    }

    public function diagnosisSupport(DiagnosisSupportArguments $arguments): DiagnosisSupportResponse
    {
        return $this->dapiMediaAnalyzer->diagnosisSupport($arguments);
    }

    public function severityAssessment(SeverityAssessmentArguments $arguments): SeverityAssessmentResponse
    {
        return $this->dapiMediaAnalyzer->severityAssessment($arguments);
    }

    /**
     * @deprecated
     */
    public function predict(PredictArguments $arguments): PredictResponse
    {
        return $this->dapiMediaAnalyzer->predict($arguments);
    }
}
