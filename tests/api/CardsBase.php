<?php

namespace App\Tests\api;

use ApiTester;
use App\Tests\BasicTest;
use function PHPUnit\Framework\assertEquals;



/**
 * Cards base class
 */
class CardsBase extends BasicTest

{

//    protected ?string $testLIMITToken = 'integer';
//    protected ?string $testGROUPToken = 'integer';


    /**
     * Generic risk data
     * @var array
     */
    protected function ensureRisk(ApiTester $I)
    {
        $riskData = [

        "instance" => "test",
        "merchant" => "test",

        "products" => ["test"],
        "questionnaire" => [
            "months_of_doing_business" => 0,
            "source_of_funds" => "test"
        ],
        "acquiring" => [
            [
                "projected_monthly_volume" => 0,
                "type" => "test"
            ]
        ],


        "company" => []

    ];
$I->sendPost('/v1/company',$riskData );
    $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 450);

        $I->seeResponseMatchesJsonType([
        
            "code" => 'integer',
    "data"=> [
            "total_score"=> 'integer',
        "details"=> [
                "business_line"=> [
                    "description"=> "string",
                "risk_score"=> 'integer',
                "values"=> "string",
                "levels"=> 'null'


            ],
            "source_of_funds"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "instance"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "merchant"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "business_activity"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "country_incorporation"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "country_directors"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "country_ubo"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "country_mother"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "business_duration"=> [
                    "description"=> 'string',
                "risk_score"=> 'integer',
                "values"=> 'integer',
                "levels"=> 'null'


            ],
            "bank_account"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "pep_sip"=> [
                    "description"=> 'string',
                "risk_score"=> 'null',
                "values"=> 'string',
                "levels"=> 'null'


            ],
            "turnover"=> [
                    "description"=> 'string',
                "risk_score"=> 'integer',
                "values"=> 'string',
                "levels"=> 'null'


            ]
        ],
        "total_evaluation"=> 'string'
    ]
]);
        

    }



}

