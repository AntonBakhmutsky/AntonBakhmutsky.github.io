<?php

namespace ITLeague\Certificates;

use CSaleDiscount;
use Exception;

class Certificate
{
    private int $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    /**
     * @throws Exception
     */
    public function createCoupon(): string
    {
        return Coupon::create($this->getDiscountId())->getCode();
    }

    private function getDiscountId(): int
    {
        $saleDiscountDb = CSaleDiscount::GetList(
            ['DATE_CREATE' => 'DESC'],
            ['ACTIVE' => 'Y', 'XML_ID' => "certificate_$this->rating"],
            false,
            false,
            ['ID']
        );

        if ($saleDiscount = $saleDiscountDb->Fetch()) {
            return (int)$saleDiscount['ID'];
        } else {
            if ($discountId = CSaleDiscount::Add(
                [
                    "LID" => SITE_ID,
                    "SITE_ID" => SITE_ID,
                    "NAME" => "Сертификат $this->rating руб",
                    "LAST_LEVEL_DISCOUNT" => "N",
                    "LAST_DISCOUNT" => "N",
                    'XML_ID' => "certificate_$this->rating",
                    "ACTIVE" => "Y",
                    "CURRENCY" => "RUB",
                    "USER_GROUPS" => [2],
                    'ACTIONS' => [
                        'CLASS_ID' => 'CondGroup',
                        'DATA' => ['All' => 'AND'],
                        'CHILDREN' => [
                            [
                                'CLASS_ID' => 'ActSaleBsktGrp',
                                'DATA' =>
                                    [
                                        'Type' => 'Discount',
                                        'Value' => $this->rating,
                                        'Unit' => 'CurAll',
                                        'Max' => 0,
                                        'All' => 'AND',
                                        'True' => 'True',
                                    ],
                                'CHILDREN' => []
                            ],
                        ]
                    ],
                    'CONDITIONS' => [
                        'CLASS_ID' => 'CondGroup',
                        'DATA' => [
                            'All' => 'AND',
                            'True' => 'True',
                        ],
                        'CHILDREN' => []
                    ]
                ]
            )) {
                return (int)$discountId;
            } else {
                global $APPLICATION;
                throw new Exception($APPLICATION->LAST_ERROR);
            }
        }
    }
}