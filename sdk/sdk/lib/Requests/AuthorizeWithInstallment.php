<?php

namespace B2P\Requests;

use B2P\Attributes\RequestParam;
use B2P\Common\ConfigManager;
use B2P\Models\Parameters\Id;
use B2P\Models\Parameters\ShopCart;
use B2P\Models\Parameters\Signature;

class AuthorizeWithInstallment extends AbstractClientRequest
{
    const PATH = 'webapi/custom/svkb/AuthorizeWithInstallment';
    const METHOD = 'POST';

    /**
     * @var Id Уникальный идентификатор Заказа в ПЦ
     */
    #[RequestParam(required: true)]
    protected Id $id;

    /**
     * @var ShopCart base64-кодированный json-объект с товарными позициями заказа. При наличии участвует в формировании подписи
     */
    #[RequestParam(required: false)]
    protected ShopCart $shop_cart;

    public function __construct(ConfigManager $configManager, $params = [])
    {
        parent::__construct($configManager, $params);
        $this->shop_cart = new ShopCart('');
    }

    protected function getSignature(): string
    {
        return Signature::make([$this->sector, $this->id, $this->shop_cart, $this->configManager->getPass()]);
    }
}