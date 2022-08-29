<?php

namespace App\Tests\api\RS;

use App\Tests\api\CardsBase;
use ApiTester;
use function PHPUnit\Framework\assertEquals;

/** Tests if user is able to have a list of risk types
 * @group instanceList
 */
class ListMatrixTypesCest extends CardsBase
{

    /**
     * @group riskListTypes
     */
    public function riskListTypes(ApiTester $I)
    {
        //calculate Risk
        $this->ensureRisk($I);

        // this should be successful
        $I->sendGet("/v1/company/risks/checks");
        $this->checkDefaultResponse($I);
        $I->seeResponseMatchesJsonType([
            'data' => [
                ["description" => "string",
                "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
                ["description" => "string",
                    "code" => "string"
                ],
            ]]);
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[0]; //0 is the first element
        assertEquals($valuesDetails, "Company");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[0]; //0 is the first element
        assertEquals($valuesDetails, "company");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[1]; //0 is the first element
        assertEquals($valuesDetails, "Business lines");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[1]; //0 is the first element
        assertEquals($valuesDetails, "business_line");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[2]; //0 is the first element
        assertEquals($valuesDetails, "Source of funds");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[2]; //0 is the first element
        assertEquals($valuesDetails, "source_of_funds");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[3]; //0 is the first element
        assertEquals($valuesDetails, "Channel");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[3]; //0 is the first element
        assertEquals($valuesDetails, "instance");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[4]; //0 is the first element
        assertEquals($valuesDetails, "Merchant / Innovator");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[4]; //0 is the first element
        assertEquals($valuesDetails, "merchant");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[5]; //0 is the first element
        assertEquals($valuesDetails, "Business activity");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[5]; //0 is the first element
        assertEquals($valuesDetails, "business_activity");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[6]; //0 is the first element
        assertEquals($valuesDetails, "Country of incorporation");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[6]; //0 is the first element
        assertEquals($valuesDetails, "country_incorporation");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[7]; //0 is the first element
        assertEquals($valuesDetails, "Country of residence of directors");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[7]; //0 is the first element
        assertEquals($valuesDetails, "country_directors");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[8]; //0 is the first element
        assertEquals($valuesDetails, "Country of residence of UBOs");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[8]; //0 is the first element
        assertEquals($valuesDetails, "country_ubo");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[9]; //0 is the first element
        assertEquals($valuesDetails, "Mother company location");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[9]; //0 is the first element
        assertEquals($valuesDetails, "country_mother");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[10]; //0 is the first element
        assertEquals($valuesDetails, "Duration being in business (months)");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[10]; //0 is the first element
        assertEquals($valuesDetails, "business_duration");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[11]; //0 is the first element
        assertEquals($valuesDetails, "Bank account");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[11]; //0 is the first element
        assertEquals($valuesDetails, "bank_account");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[12]; //0 is the first element
        assertEquals($valuesDetails, "PEP/SIP");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[12]; //0 is the first element
        assertEquals($valuesDetails, "pep_sip");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].description')[13]; //0 is the first element
        assertEquals($valuesDetails, "Expected turnover");
        $valuesDetails = $I->grabDataFromResponseByJsonPath('$.data[*].code')[13]; //0 is the first element
        assertEquals($valuesDetails, "turnover");
    }


}