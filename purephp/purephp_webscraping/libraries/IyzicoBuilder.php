<?php
namespace Libraries;

use IyzipayBootstrap;
use Models\VT;

require_once(VENDOR . 'iyzico/iyzipay-php/IyzipayBootstrap.php');
IyzipayBootstrap::init();

class IyzicoBuilder
{
    protected $options;
    protected $request;
    protected $basketItems;

    public function __construct()
    {
//    $this->baglantiPDO = new parent();
//    $ayarlarInfos = $this->baglantiPDO->VeriGetir("ayarlar", "WHERE ID=?", array(1), "ORDER BY ID ASC", 1);
//    $apiKey = $this->sifrele($ayarlarInfos[0]["iyzi_api_key"]);
        $VT = new VT();

        $ayarlarInfos = $VT->VeriGetir("ayarlar", "WHERE ID=?", array(1), "ORDER BY ID ASC", 1);
        $apiKey = $VT->sifrele($ayarlarInfos[0]["iyzi_api_key"]);
        $secretKey = $VT->sifrele($ayarlarInfos[0]["iyzi_secret_key"]);
        $baseURL = $ayarlarInfos[0]["iyzi_base_url"];

        //aldığın bilgiler ile iyzico option parametrelerini doldur
        $this->options = new \Iyzipay\Options();
        $this->options->setApiKey($apiKey);
        $this->options->setSecretKey($secretKey);
        $this->options->setBaseUrl($baseURL);
        $this->basketItems = [];
    }

    public function setForm(array $params)
    {
        $this->request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $this->request->setLocale(\Iyzipay\Model\Locale::TR);
        $this->request->setConversationId($params["conversationID"]);
        $this->request->setPrice($params["price"]);
        $this->request->setPaidPrice($params["paidPrice"]);
        $this->request->setCurrency(\Iyzipay\Model\Currency::TL);
        $this->request->setBasketId($params["basketID"]);
        $this->request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $this->request->setCallbackUrl($params["callbackurl"]);
        $this->request->setEnabledInstallments(array(2, 3, 6, 9));

        return $this;
    }

    public function setBuyer(array $params)
    {
        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($params["id"]);
        $buyer->setName($params["name"]);
        $buyer->setSurname($params["surname"]);
        $buyer->setGsmNumber($params["phone"]);
        $buyer->setEmail($params["email"]);
        $buyer->setIdentityNumber($params["identity"]);
        $buyer->setRegistrationAddress($params["adress"]);
        $buyer->setIp($params["ip"]);
        $buyer->setCity($params["city"]);
        $buyer->setCountry($params["country"]);
        $this->request->setBuyer($buyer);

        return $this;
    }

    public function setShipping(array $params)
    {
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($params["name"]);
        $shippingAddress->setCity($params["city"]);
        $shippingAddress->setCountry($params["country"]);
        $shippingAddress->setAddress($params["adress"]);
        $this->request->setShippingAddress($shippingAddress);

        return $this;
    }

    public function setBilling(array $params)
    {
        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($params["name"]);
        $billingAddress->setCity($params["city"]);
        $billingAddress->setCountry($params["country"]);
        $billingAddress->setAddress($params["adress"]);
        $this->request->setBillingAddress($billingAddress);

        return $this;
    }

    public function setItems(array $items)
    {
        foreach ($items as $key => $value) {
            $basketItem = new \Iyzipay\Model\BasketItem();
            $basketItem->setId($value["id"]);
            $basketItem->setName($value["name"]);
            $basketItem->setCategory1($value["category"]);
            $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $basketItem->setPrice($value["kdvDahilFiyat"]);
            array_push($this->basketItems, $basketItem);
        }
        $this->request->setBasketItems($this->basketItems);

        return $this;
    }

    public function paymentForm()
    {
//    $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());
        $form = \Iyzipay\Model\CheckoutFormInitialize::create($this->request, $this->options);
        return $form;
    }

    public function callbackForm($token, $conversationID)
    {
        $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setToken($token);
        $request->setConversationId($conversationID);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $this->options);

        return $checkoutForm;
    }
}
