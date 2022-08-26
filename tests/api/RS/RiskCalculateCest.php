<?php

namespace App\Tests\api\RS;

use App\Tests\api\CardsBase;
use ApiTester;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;


class RiskCalculateCest extends CardsBase
{


    /** Tests are for validating risk calculate with predefined products in risk matrix
     * business lines:
     *
     * e-commerce : 50
     * pos       : -50
     * qr        : -25
     * @group riskTypes
     */

//products
    public function RiskCalculator(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["e-commerce", "pos", "qr"],
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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "e-commerce", "pos", "qr" value in "products" array
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 375);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_line.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_line.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "e-commerce, pos, qr");


        //medium
        $params2 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["pos"],
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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if risk level is medium when total_score is 400
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 350);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");

    }


    /** Tests are for validating risk calculate with predefined source of funds in risk matrix
     * source of funds:
     *
     * dividends : low
     * loans     : medium
     * other     : high
     *
     * low       : -25
     * medium    : 50
     * high      : 100
     * @group riskSourceOfFunds
     */

//dividends
    public function RiskCalculatorSourceOfFunds(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "dividends"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => [

                ]
            ]

        ];
        //Check if user able to risk calculate with "dividends" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 375);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "dividends");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");


        //loans

        $params2 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "loans"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => [

                ]
            ]

        ];
        //Check if user able to risk calculate with "loans" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 450);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "loans");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");


        //other


        $params3 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "other"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => [

                ]
            ]

        ];
        //Check if user able to risk calculate with "other" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "other");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }


    /** Tests are for validating risk calculate with predefined instance in risk matrix
     * instance ( psp ):
     *
     * instanceToken1 : -50
     * instanceToken2 : -100
     * @group riskInstance
     */

//instanceToken1
    public function RiskCalculatorInstance(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "instanceToken1",
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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "instanceToken1" value in "instance" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 350);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken1");


        //instanceToken2
        //low total_evaluation

        $params2 = [

            "instance" => "instanceToken2",
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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "instanceToken2" value in "instance" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 300);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken2");

    }

    /** Tests are for validating risk calculate with predefined master merchant(innovator) in risk matrix
     * master_merchant ( innnovator ):
     *
     * innovatorToken1 : 50
     * innovatorToken2 : 20
     * @group riskMasterMerchant
     */

//innovatorToken1
    public function RiskCalculatorMasterMerchant(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "test",
            "merchant" => "test",
            "master_merchant" => "innovatorToken1",

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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "innovatorToken1" value in "master_merchant" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 450);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken1");


//innovatorToken1

        //create risk
        $this->ensureRisk($I);
        $params2 = [

            "instance" => "test",
            "merchant" => "test",
            "master_merchant" => "innovatorToken2",

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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "innovatorToken2" value in "master_merchant" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 420);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 20);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken2");

    }

    /** Tests are for validating risk calculate with predefined business_activities(industries) in risk matrix
     * business_activity ( industries ):
     *
     * camera-store        : low
     * second-hand-store   : medium
     * gambling            : high
     *
     * low       : -50
     * medium    : 100
     * high      : 200
     * @group riskBusinessActivity
     */

//camera-store
    public function RiskCalculatorBusinessActivities(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "business_activity" => "camera-store",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "camera-store" value in "business_activity" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 350);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "camera-store");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");


        $params2 = [

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


            "company" => [
                "business_activity" => "second-hand-store",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "second-hand-store" value in "business_activity" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "second-hand-store");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");


        //gambling

        $params3 = [

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


            "company" => [
                "business_activity" => "gambling",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "gambling" value in "business_activity" field
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 600);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "gambling");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }

    /** Tests are for validating risk calculate with predefined country of incorporation(country of company) in risk matrix
     * country of incorporation (country of company):
     *
     * BG  : medium
     * DK  : low
     * RO  : medium
     * AL  : high
     *
     * low       : -25
     * medium    : 100
     * high      : 200
     * @group riskCountryOfIncorporation
     */

//BG
    public function RiskCalculatorCountryOfIncorporation(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "country" => "BG",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "BG" value in "country" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "BG");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");


        //RO

        //create risk
        $this->ensureRisk($I);
        $params2 = [

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


            "company" => [
                "country" => "RO",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "RO" value in "country" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "RO");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");


        //DK

        //create risk
        $this->ensureRisk($I);
        $params3 = [

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


            "company" => [
                "country" => "DK",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "DK" value in "country" field
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 375);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "DK");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");


        //AL

        //create risk
        $this->ensureRisk($I);
        $params4 = [

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


            "company" => [
                "country" => "AL",
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "AL" value in "country" field
        $I->sendPost('/v1/company', $params4);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 600);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }

    /** Tests are for validating risk calculate with predefined country of incorporation(country of directors) in risk matrix
     * country of directors ( if different than country of incorporation):
     *
     * low       : -25
     * medium    : 100
     * high      : 200
     * @group riskCountryOfDirectors
     */

//if the same country of directors with country of incorporation
    public function RiskCalculatorCountryOfDirectors(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["ceo"],
                        "country" => "BG",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "BG" value in "country" field in company_members
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 0);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "");


        //if the different country of directors than country of incorporation

        $params2 = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["ceo"],
                        "country" => "AL",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "AL" value in "country" field in company_members
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 700);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }

    /** Tests are for validating risk calculate with predefined country of incorporation(country of ubos) in risk matrix
     * country of ubos ( if different than country of incorporation):
     *
     * low       : -25
     * medium    : 100
     * high      : 200
     * @group riskCountryOfUbos
     */

//if the same country of ubos with country of incorporation
    public function RiskCalculatorCountryOfUbos(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["ubo"],
                        "country" => "BG",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "BG" value in "country" field in company_members when type ubo
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 0);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "");


        //if different country of ubos than country of incorporation

        //create risk
        $this->ensureRisk($I);
        $params2 = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["ubo"],
                        "country" => "AL",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "AL" value in "country" field in company_members when type is "ubo"
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 700);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }
    /** Tests are for validating risk calculate with predefined mother country(legal-entity) in risk matrix
     * mother company country ( legal-entity country, if different than country of incorporation ):
     *
     * low                :
     * medium             :
     * high               : 300
     * no country mother  :-50
     * @group riskCountryMother
     */

//if the same country of mother with country of incorporation
    public function RiskCalculatorCountryMother(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["legal-entity"],
                        "country" => "BG"
                    ]]]
        ];
        //Check if user able to risk calculate with "BG" value in "country" field in company_members when type ubo
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 0);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "BG");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");


        //if different country of mother than country of incorporation


        $params2 = [

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


            "company" => [
                "country" => "BG",
                "company_members" => [
                    [
                        "type" => ["legal-entity"],
                        "country" => "AL"
                    ]]]
        ];
        //Check if user able to risk calculate with "BG" value in "country" field in company_members when type ubo
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 850);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "high");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 300);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");


        //if without country of mother


        $params3 = [

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


            "company" => [

                "company_members" =>
                    []
            ]
        ];
        //Check if user able to risk calculate without "country" field in company_members
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "NULL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_mother.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


    }

    /** Tests are for validating risk calculate with predefined months of business(Duration being in business) in risk matrix
     * Duration being in business (months of doing business):
     *
     * 0-12      : 100
     * 13-36     : -100
     * 37-       : -150
     * @group riskMonthsOfDoingBusiness
     */

//if 0 months of doing business
    public function RiskCalculatorMonthsOfDoingBusiness(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 0  in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 0);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //if 6 months of doing business
        //create risk
        $this->ensureRisk($I);
        $params2 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 6,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 6 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 6);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //if 12 months of doing business

        $params3 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 12,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 12 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 12);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //if 13 months of doing business

        $params4 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 13,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 13 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params4);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 200);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 13);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //if 24 months of doing business

        $params5 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 24,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 24 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params5);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 200);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 24);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //if 36 months of doing business

        $params6 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 36,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 36 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params6);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 200);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 36);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //if 37 months of doing business

        $params7 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 37,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 37 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params7);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 150);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -150);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 37);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //if 100 months of doing business

        $params8 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 100,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,
                    "type" => "test"
                ]
            ],


            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 100 in "months_of_doing_business" field in questionnaire
        $I->sendPost('/v1/company', $params8);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 150);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -150);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.values')[0]; //0 is the first element
        assertEquals($valuesDetails, 100);
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_duration.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

    }

    /** Tests are for validating risk calculate with predefined bank account( IBAN or account_number + sort_code )(calculates only when valid product) in risk matrix
     * business lines:
     * EU bank account     : -50
     * Non-EU bank account : 50
     * E-Money             : 100 ( NOT IMPLEMENTED YET )
     * @group riskCountryBankAccount
     */

//EU bank account
    public function RiskCalculatorBankAccount(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["e-commerce", "pos", "qr"],
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
            "payout_details" => [
                [
                    "currency" => "BG",
                    "iban" => "BG80BNBG96611020345678", //EU bank account     : -50; Non-EU bank account : 50; E-Money             : 100 ( NOT IMPLEMENTED YET )
                    "account_number" => "12345678",
                    "sort_code" => "123456"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "BG80BNBG96611020345678" value in "iban" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 325);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "eu");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //non-EU bank account
        $this->ensureRisk($I);
        $params2 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["e-commerce", "pos", "qr"],
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
            "payout_details" => [
                [
                    "currency" => "BG",
                    "iban" => "BH67BMAG00001299123456", //EU bank account     : -50; Non-EU bank account : 50; E-Money             : 100 ( NOT IMPLEMENTED YET )
                    "account_number" => "12345678",
                    "sort_code" => "123456"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with "BH67BMAG00001299123456" value in "iban" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 425);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "non-eu");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.bank_account.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);
        }
        /** Tests are for validating risk calculate with predefined PEP or SIP in risk matrix
         * PEP or SIP:
         * true           : 600
         * @group riskPepOrSip
         */

//false Pep and Sip
        public function RiskCalculatorPepOrSip(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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

            "company" => [
                "company_members" => [
                    [
                        "type" => [""],

                        "is_pep" => false,
                        "is_sip" => false
                    ],
                ]
            ]

        ];
        //Check if user able to risk calculate with bool false in "is_pep" and "is_sip" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, null);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "NULL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //true Pep
        //create risk
        $this->ensureRisk($I);
        $params2 = [

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

            "company" => [
                "company_members" => [
                    [
                        "type" => [""],

                        "is_pep" => true,
                        "is_sip" => false
                    ],
                ]
            ]

        ];
        //Check if user able to risk calculate with bool true in "is_pep" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 1000);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "high");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 600);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "YES");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);


        //true Sip

        $params3 = [

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

            "company" => [
                "company_members" => [
                    [
                        "type" => [""],

                        "is_pep" => false,
                        "is_sip" => true
                    ],
                ]
            ]

        ];
        //Check if user able to risk calculate with bool true in "is_sip" field
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 1000);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "high");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 600);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "YES");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.pep_sip.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

    }

    /** Tests are for validating risk calculate with predefined expected turnover ( projected monthly volume ) in risk matrix
     * Expected turnover ( projected monthly volume ):
     * 0 - 10000           : -50
     * 10001 - 200000      : 50
     * 200001 - 1000000    : 200
     * 1000000 -           : 300
     * @group riskProjectedMonthlyVolume
     */

//projected monthly volume 0
    public function RiskCalculatorProjectedMonthlyVolume(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 0,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 0 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 0");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 9999
        $params2 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 9999,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 9999 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params2);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 9999");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 10000
        $params3 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 10000,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 10000 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params3);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 10000");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 10001
        $params4 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 10001,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 10001 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params4);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 10001");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 10002
        $params5 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 10002,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 10002 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params5);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 10002");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 199999
        $params6 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 199999,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 10002 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params6);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 199999");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 200000
        $params7 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 200000,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 200000 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params7);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 200000");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 200001
        $params8 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 200001,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 200001 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params8);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 200001");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 200002
        $params9 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 200002,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 200002 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params9);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 200002");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 999999
        $params10 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 999999,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 999999 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params10);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 999999");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 1000000
        $params11 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 1000000,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 1000000 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params11);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 1000000");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 1000001
        $params12 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 1000001,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 1000001 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params12);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 750);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 300);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 1000001");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);

        //projected monthly volume 2000000
        $params14 = [

            "instance" => "test",
            "merchant" => "test",

            "products" => ["test"],
            "questionnaire" => [
                "months_of_doing_business" => 0,
                "source_of_funds" => "test"
            ],
            "acquiring" => [
                [
                    "projected_monthly_volume" => 2000000,//turnover
                    "type" => "test"
                ]
            ],

            "company" => [
                "company_members" => []
            ]

        ];
        //Check if user able to risk calculate with number 2000000 "projected_monthly_volume" field
        $I->sendPost('/v1/company', $params14);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 750);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 300);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "test - 2000000");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.turnover.levels')[0]; //0 is the first element
        assertEquals($levelDetails, null);
    }
}
