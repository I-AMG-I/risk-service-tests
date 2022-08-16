<?php

namespace App\Tests\api\LS;

use App\Tests\api\CardsBase;
use ApiTester;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;


class RiskCalculateCest extends CardsBase
{


    /** Tests are for validating risk calculate with predefined products in risk matrix
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


            "company" => []

        ];
        //Check if user able to risk calculate with "e-commerce", "pos", "qr" value in "products" array
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 425);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_line.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_line.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "e-commerce, pos, qr");

    }

    //medium
    public function RiskCalculator2(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => []

        ];
        //Check if risk level is medium when total_score is 400
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");

    }


    /** Tests are for validating risk calculate with predefined source of funds in risk matrix
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


            "company" => []

        ];
        //Check if user able to risk calculate with "dividends" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 425);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "dividends");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");

    }

    //loans
    public function RiskCalculatorSourceOfFunds2(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => []

        ];
        //Check if user able to risk calculate with "loans" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "loans");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.source_of_funds.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");

    }

    //other
    public function RiskCalculatorSourceOfFunds3(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => []

        ];
        //Check if user able to risk calculate with "other" value in "source_of_funds" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 550);
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


            "company" => []

        ];
        //Check if user able to risk calculate with "instanceToken1" value in "instance" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken1");

    }

    //instanceToken2
    //low total_evaluation
    public function RiskCalculatorInstance2(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => []

        ];
        //Check if user able to risk calculate with "instanceToken2" value in "instance" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 350);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "low");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.instance.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken2");

    }

    /** Tests are for validating risk calculate with predefined master merchant(innovator) in risk matrix
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


            "company" => []

        ];
        //Check if user able to risk calculate with "innovatorToken1" value in "master_merchant" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 500);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken1");

    }

//innovatorToken1
    public function RiskCalculatorMasterMerchant2(ApiTester $I)
    {
        //create risk
        $this->ensureRisk($I);
        $params = [

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


            "company" => []

        ];
        //Check if user able to risk calculate with "innovatorToken2" value in "master_merchant" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 470);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 20);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.merchant.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken2");

    }

    /** Tests are for validating risk calculate with predefined business_activities(industries) in risk matrix
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
                "business_activity" => "camera-store"
            ]

        ];
        //Check if user able to risk calculate with "camera-store" value in "business_activity" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 400);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "camera-store");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");

    }

    //second-hand-store
    public function RiskCalculatorBusinessActivities2(ApiTester $I)
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
                "business_activity" => "second-hand-store"
            ]

        ];
        //Check if user able to risk calculate with "second-hand-store" value in "business_activity" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "second-hand-store");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.business_activity.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");

    }

    //gambling
    public function RiskCalculatorBusinessActivities3(ApiTester $I)
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
                "business_activity" => "gambling"
            ]

        ];
        //Check if user able to risk calculate with "gambling" value in "business_activity" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
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
                "country" => "BG"
            ]

        ];
        //Check if user able to risk calculate with "BG" value in "country" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "BG");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");

    }


    //RO
    public function RiskCalculatorCountryOfIncorporation2(ApiTester $I)
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
                "country" => "RO"
            ]

        ];
        //Check if user able to risk calculate with "RO" value in "country" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "RO");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "medium");

    }

    //DK
    public function RiskCalculatorCountryOfIncorporation3(ApiTester $I)
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
                "country" => "DK"
            ]

        ];
        //Check if user able to risk calculate with "DK" value in "country" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 425);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, -25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "DK");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_incorporation.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "low");

    }

    //AL
    public function RiskCalculatorCountryOfIncorporation4(ApiTester $I)
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
                "country" => "AL"
            ]

        ];
        //Check if user able to risk calculate with "AL" value in "country" field
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 650);
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
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 0);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_directors.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "");

    }

    //if the different country of directors than country of incorporation
    public function RiskCalculatorCountryOfDirectors2(ApiTester $I)
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
                        "country" => "AL",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "AL" value in "country" field in company_members
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 750);
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
        assertEquals($details, 550);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 0);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "");

    }

    //if the different country of ubos than country of incorporation
    public function RiskCalculatorCountryOfUbos2(ApiTester $I)
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
                        "country" => "AL",
                        "is_pep" => false,
                        "is_sip" => false
                    ]]]
        ];
        //Check if user able to risk calculate with "AL" value in "country" field in company_members when type is "ubo"
        $I->sendPost('/v1/company', $params);
        $this->checkDefaultResponse($I);
        $details = $I->grabDataFromResponseByJsonPath('$.data.total_score')[0]; //0 is the first element
        assertEquals($details, 750);
        $detailsRisk = $I->grabDataFromResponseByJsonPath('$.data.total_evaluation')[0]; //0 is the first element
        assertEquals($detailsRisk, "medium");
        $risk_scoreDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.risk_score')[0]; //0 is the first element
        assertEquals($risk_scoreDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.values')[0]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $levelDetails = $I->grabDataFromResponseByJsonPath('$.data.details.country_ubo.levels')[0]; //0 is the first element
        assertEquals($levelDetails, "high");

    }
}
