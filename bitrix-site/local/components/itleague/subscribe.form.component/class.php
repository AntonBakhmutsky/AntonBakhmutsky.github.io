<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use ITLeague\Components\BaseComponent;
use ITLeague\Subscription\ListRubricTable;
use ITLeague\Subscription\SubscriptionRubricTable;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class SubscribeFormComponent extends BaseComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;
    protected array $modules = ['subscribe'];
    
    protected function listKeysSignedParameters(): array
    {
        return ['RUBRIC'];
    }
    
    public function onPrepareComponentParams($arParams): array
    {
        $this->errorCollection = new ErrorCollection();
        $arParams['RUBRIC'] = trim($arParams['RUBRIC']);
        return parent::onPrepareComponentParams($arParams);
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Exception
     */
    public function subscribeAction(string $email): bool
    {
        if (strlen($email) === 0 || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ArgumentException('Email is invalid!', 'email');
        }
        
        $subscription = new CSubscription;
        if ($existingSubscription = $this->getSubscription($email)) {
            $fields = [
                "ACTIVE" => "Y",
                'USER_ID' => $this->getUserId(),
                "RUB_ID" => array_unique(array_merge($this->getNewRubricIds() ?? [], $this->getExistingRubricIds($existingSubscription['ID']))),
                "CONFIRMED" => "Y",
                "CONFIRM_CODE" => $existingSubscription["CONFIRM_CODE"]
            ];
            if (! $subscription->Update($existingSubscription['ID'], $fields)) {
                throw new Exception($subscription->LAST_ERROR);
            }
        } else {
            $fields = [
                "RUB_ID" => $this->getNewRubricIds() ?? [],
                'USER_ID' => $this->getUserId(),
                "FORMAT" => "html",
                "EMAIL" => $email,
                "ACTIVE" => "Y",
                "SEND_CONFIRM" => 'N'
            ];
            
            $subscriptionId = $subscription->Add($fields);
            $existingSubscription = $this->getSubscription($email) ?? '';
            
            if (! $subscription->Update(
                $subscriptionId,
                [
                    "CONFIRMED" => "Y",
                    "CONFIRM_CODE" => $existingSubscription["CONFIRM_CODE"]
                ]
            )) {
                throw new Exception($subscription->LAST_ERROR);
            }
        }
        
        return true;
    }
    
    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    private function getNewRubricIds(): ?array
    {
        if ($this->arParams['RUBRIC'] !== '') {
            return ListRubricTable::query()
                ->setFilter(
                    [
                        '=ACTIVE' => 'Y',
                        [
                            'LOGIC' => 'OR',
                            ['=CODE' => $this->arParams['RUBRIC']],
                            ['CODE' => $this->arParams['RUBRIC'] . ':%']
                        ]
                    ]
                )
                ->setSelect(['ID'])
                ->fetchCollection()->getIdList();
        }
        
        return null;
    }
    
    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    public function getExistingRubricIds(int $subscriptionId): array
    {
        return SubscriptionRubricTable::query()
            ->setFilter(['=SUBSCRIPTION_ID' => $subscriptionId])
            ->setSelect(['LIST_RUBRIC_ID'])
            ->fetchCollection()->getListRubricIdList();
    }
    
    private function getSubscription(string $email): ?array
    {
        if ($subscription = CSubscription::GetByEmail($email, $this->getUserId())->Fetch()) {
            return $subscription;
        }
        return null;
    }
    
    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    public function executeComponent()
    {
        if (count($this->getNewRubricIds()) > 0) {
            $this->includeComponentTemplate();
        }
    }
    
    public function configureActions(): array
    {
        return [
            'subscribe' => [
                '-prefilters' => [
                    Authentication::class,
                ],
            ]
        ];
    }
    
    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }
    
    public function getErrorByCode($code): ?\Bitrix\Main\Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }
    
}
