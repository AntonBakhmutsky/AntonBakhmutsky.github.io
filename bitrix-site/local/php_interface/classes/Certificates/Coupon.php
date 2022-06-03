<?php

namespace ITLeague\Certificates;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Internals\DiscountCouponTable;
use Exception;

class Coupon
{
    private string $code;
    private DateTime $activeTo;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @throws Exception
     */
    public static function create(int $discountId): Coupon
    {
        $coupon = self::generateCoupon(true);
        $result = DiscountCouponTable::add([
            'DISCOUNT_ID' => $discountId,
            'COUPON' => $coupon,
            'TYPE' => DiscountCouponTable::TYPE_ONE_ORDER,
            'MAX_USE' => 1
        ]);
        if ($result->isSuccess()) {
            return new self($coupon);
        } else {
            throw new Exception(implode(', ', $result->getErrorMessages()));
        }
    }

    public static function generateCoupon($check = false): string
    {
        $check = ($check === true);

        $allchars = 'ABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';
        $charsLen = mb_strlen($allchars) - 1;

        do {
            $resultCorrect = true;
            $result = '';
            for ($i = 0; $i < 10; $i++) {
                $result .= mb_substr($allchars, rand(0, $charsLen), 1);
            }
            if ($check) {
                $existCoupon = DiscountCouponsManager::isExist($result);
                $resultCorrect = empty($existCoupon);
            }
        } while (!$resultCorrect);
        return $result;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getActiveTo(): DateTime
    {
        if (!isset($this->activeTo)) {
            $coupon = DiscountCouponTable::getList(['filter' => ['COUPON' => $this->getCode()], 'limit' => '1'])->fetchObject();
            $coupon->setActiveTo($this->activeTo = (new DateTime())->add('90days'));
            $coupon->save();
        }
        return $this->activeTo;
    }
}