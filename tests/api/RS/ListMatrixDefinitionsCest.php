<?php

namespace App\Tests\api\RS;

use App\Tests\api\CardsBase;
use ApiTester;
use function PHPUnit\Framework\assertEquals;

/** Tests if user is able to have a list of risk definitions
 * @group instanceList
 */
class ListMatrixDefinitionsCest extends CardsBase
{

    /**
     * @group riskListCompany
     */
    public function riskListDefinitionsCompany(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with company in url
        $I->sendGet("/v1/company/risks/company/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "general" => [
                    [
                        "id" => "integer",
                        "score" => "integer"
                    ]
                ],
                "values" =>[
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "range" => "string"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "range" => "string"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "range" => "string"
                    ],
                ],
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.general[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 400);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 12);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[0]; //0 is the first element
        assertEquals($valuesDetails, "0-399");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 14);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[1]; //0 is the first element
        assertEquals($valuesDetails, "801-");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 13);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[2]; //0 is the first element
        assertEquals($valuesDetails, "-800");

    }


    /**
     * @group riskListBusinessLine
     */
    public function riskListDefinitionsBusinessLine(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with business_line in url
        $I->sendGet("/v1/company/risks/business_line/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 28);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "qr");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 27);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "e-commerce");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 29);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[2]; //0 is the first element
        assertEquals($valuesDetails, "pos");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[3]; //0 is the first element
        assertEquals($valuesDetails, 1495);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[3]; //0 is the first element
        assertEquals($valuesDetails, "card-issuing");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[3]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[4]; //0 is the first element
        assertEquals($valuesDetails, 1496);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[4]; //0 is the first element
        assertEquals($valuesDetails, "account-opening");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[4]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[5]; //0 is the first element
        assertEquals($valuesDetails, 1497);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[5]; //0 is the first element
        assertEquals($valuesDetails, "account-opening, card-issuing");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[5]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[6]; //0 is the first element
        assertEquals($valuesDetails, 1498);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[6]; //0 is the first element
        assertEquals($valuesDetails, "e-commerce, account-opening, card-issuing");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[6]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[7]; //0 is the first element
        assertEquals($valuesDetails, 1499);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[7]; //0 is the first element
        assertEquals($valuesDetails, "account-opening, e-commerce");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[7]; //0 is the first element
        assertEquals($valuesDetails, -25);


    }

    /**
     * @group riskListSourceOfFunds
     */
    public function riskListSourceOfFunds(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with source_of_funds in url
        $I->sendGet("/v1/company/risks/source_of_funds/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ],
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 39);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 41);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 100);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 40);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 49);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "other");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "high");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 42);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "dividends");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "low");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[2]; //0 is the first element
        assertEquals($valuesDetails, "loans");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "medium");



    }

    /**
     * @group riskListChannel
     */
    public function riskListChannel(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with channel(instance) in url
        $I->sendGet("/v1/company/risks/instance/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 21);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken1");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 22);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "instanceToken2");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, -100);



    }

    /**
     * @group riskListMerchant
     */
    public function riskListMerchant(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with merchant/innovator in url
        $I->sendGet("/v1/company/risks/merchant/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 43);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken1");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 44);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "innovatorToken2");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 20);



    }

    /**
     * @group riskListBusinessActivity
     */
    public function riskListBusinessActivity(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with business_activity in url
        $I->sendGet("/v1/company/risks/business_activity/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ],
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 35);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 100);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 36);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 200);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 34);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 38);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "second-hand-store");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "medium");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 51);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "camera-store");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "low");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 37);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[2]; //0 is the first element
        assertEquals($valuesDetails, "gambling");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "high");



    }

    /**
     * @group riskListCountryOfIncorporation
     */
    public function riskListCountryOfIncorporation(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with country_incorporation in url
        $I->sendGet("/v1/company/risks/country_incorporation/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ],
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "risk" => "string"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 2);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 200);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 3);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 100);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 1);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 10);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "BG");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "medium");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 20);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "DK");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "low");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 19);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[2]; //0 is the first element
        assertEquals($valuesDetails, "RO");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "medium");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[3]; //0 is the first element
        assertEquals($valuesDetails, 11);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[3]; //0 is the first element
        assertEquals($valuesDetails, "AL");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].risk')[3]; //0 is the first element
        assertEquals($valuesDetails, "high");


    }

    /**
     * @group riskListCountryOfDirectors
     */
    public function riskListCountryOfResidenceOfDirectors(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with country_directors in url
        $I->sendGet("/v1/company/risks/country_directors/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 6);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 100);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 4);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, -25);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 5);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 200);


    }

    /**
     * @group riskListCountryOfUBO
     */
    public function riskListCountryOfResidenceOfUBO(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with source_of_funds in url
        $I->sendGet("/v1/company/risks/country_ubo/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 8);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 200);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 9);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 100);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 7);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, -25);


    }

    /**
     * @group riskListCountryMother
     */
    public function riskListMotherCompanyLocation(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with country_mother in url
        $I->sendGet("/v1/company/risks/country_mother/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "general" => [
                    [
                        "id" => "integer",
                        "score" => "integer"
                    ]
                ],

                "values" => [
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "risk" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.general[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 16);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[0]; //0 is the first element
        assertEquals($valuesDetails, "low");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 0);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 18);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[1]; //0 is the first element
        assertEquals($valuesDetails, "high");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 300);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 17);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].risk')[2]; //0 is the first element
        assertEquals($valuesDetails, "medium");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 0);


    }

    /**
     * @group riskListBusinessDuration
     */
    public function riskListDurationBeingInsBusinessMonths(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with business_duration in url
        $I->sendGet("/v1/company/risks/business_duration/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [

                "values" => [
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);


        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 33);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, -150);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[0]; //0 is the first element
        assertEquals($valuesDetails, "37-");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 32);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, -100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[1]; //0 is the first element
        assertEquals($valuesDetails, "13-36");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 31);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 100);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[2]; //0 is the first element
        assertEquals($valuesDetails, "-12");


    }

    /**
     * @group riskBankAccount
     */
    public function riskBankAccount(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with bank_account in url
        $I->sendGet("/v1/company/risks/bank_account/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "nomenclature" => [
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "entity" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 46);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[0]; //0 is the first element
        assertEquals($valuesDetails, "non-eu");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 45);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[1]; //0 is the first element
        assertEquals($valuesDetails, "eu");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, -50);

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 47);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].entity')[2]; //0 is the first element
        assertEquals($valuesDetails, "emoney");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.nomenclature[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 100);



    }

    /**
     * @group riskListPepSip
     */
    public function riskListPepSip(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with pep_sip in url
        $I->sendGet("/v1/company/risks/pep_sip/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                "general" => [
                    [
                        "id" => "integer",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.general[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 600);


    }

    /**
     * @group riskListTurnover
     */
    public function riskListExpectedTurnover(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // test to list definitions with turnover in url
        $I->sendGet("/v1/company/risks/turnover/definitions");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [

                "values" => [
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ],
                    [
                        "id" => "integer",
                        "range" => "string",
                        "score" => "integer"
                    ]
                ]
            ]
        ]);


        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[0]; //0 is the first element
        assertEquals($valuesDetails, 25);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[0]; //0 is the first element
        assertEquals($valuesDetails, 200);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[0]; //0 is the first element
        assertEquals($valuesDetails, "200001-1000000");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[1]; //0 is the first element
        assertEquals($valuesDetails, 26);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[1]; //0 is the first element
        assertEquals($valuesDetails, 300);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[1]; //0 is the first element
        assertEquals($valuesDetails, "1000000-");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[2]; //0 is the first element
        assertEquals($valuesDetails, 24);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[2]; //0 is the first element
        assertEquals($valuesDetails, 50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[2]; //0 is the first element
        assertEquals($valuesDetails, "10001-200000");

        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].id')[3]; //0 is the first element
        assertEquals($valuesDetails, 23);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].score')[3]; //0 is the first element
        assertEquals($valuesDetails, -50);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data.values[*].range')[3]; //0 is the first element
        assertEquals($valuesDetails, "-10000");


    }





}