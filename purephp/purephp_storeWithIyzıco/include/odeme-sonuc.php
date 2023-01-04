<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"

      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?=SITE?>dest/css/profil.css">

<?

if (!empty($_SESSION["siparisKodu"]))

{


//SMS GÖNDER
try {
$client = new SoapClient("http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl");

$msg  = 'test message';
$gsm  = array('905xxxxxxxxx','905xxxxxxxxy' , '905xxxxxxxxz');

$Result = $client -> smsGonder1NV2(
	array(
		'username'=>'850302xxxx', 
		'password' => 'xxxx',
		'header' => '850302xxxx', 
		'msg' => '', 
		'gsm' => $gsm,  
		'filter' => '', 
		'startdate'  => '', 
		'stopdate'  => '', 
		'encoding' => ''  
	)
);

} catch (Exception $exc) {
	// Hata olusursa yakala
	echo "Soap Hatasi Olustu: " . $exc->getMessage();
}

require '../vendor/autoload.php';

use Bulut\FITApi\FITInvoiceService;
$service = new \Bulut\FITApi\FITInvoiceService(['username'=> '8erMnQl9', 'password'=>'ww#HINk3'], true);

$docRefences = [];

$uuid = \Bulut\eFaturaUBL\XMLHelper::CreateGUID();

$invoice = new \Bulut\eFaturaUBL\Invoice();
$invoice->UBLVersionID = "2.1"; //uluslararası fatura standardı 2.1
$invoice->CustomizationID = "TR1.2"; //fakat GİB UBLTR olarak isimlendirdiği Türkiye'ye özgü 1.2 efatura formatını kullanıyor.
$invoice->ProfileID = "TICARIFATURA"; //ticari ve temel olarak iki çeşittir. ticari faturalarda sistem yanıtı(application response) döner.
#$invoice->ID = "FIT2017000000021"; //Eğer fatura ID FIT tarafından oluşacak ise, ID alanı boş, CUST_INV_ID alanı dolu gelmelidir. Eğer kullanıcı firma tarafından oluşacak ise, ID alanı dolu CUST_INV_ID alanı boş olarak gönderilmeli.
$invoice->CopyIndicator = "false"; //kopyası mı, asıl süret mi olduğu belirlenir
$invoice->UUID = $uuid; //fatura UUID
$invoice->IssueDate = "FATURA_TARIHI"; //Y-m-d fatura tarihi
$invoice->InvoiceTypeCode = "SATIS"; //gönderilecek fatura çeşidi, satış, iade vs.
$invoice->Note = ["Test not"]; //isteğe bağlı not alanı
$invoice->DocumentCurrencyCode = "TRY"; //efatura para birimi
$invoice->LineCountNumeric = 1;  //fatura kalemlerinin sayısı

//Fatura ID otomatik oluşacak ise bu alanı göndermelisiniz.
$invoice_Document_Refence = new \Bulut\eFaturaUBL\DocumentReference();
$invoice_Document_Refence->ID = \Bulut\eFaturaUBL\XMLHelper::CreateGUID();
$invoice_Document_Refence->IssueDate = date('Y-m-d', strtotime($tarih));
$invoice_Document_Refence->DocumentTypeCode = "CUST_INV_ID";
$docRefences[] = $invoice_Document_Refence;

$invoice->AdditionalDocumentReference = $docRefences;

$invoice_AccountSupplierParty = new \Bulut\eFaturaUBL\AccountingSupplierParty();
$invoice_AccountSupplierParty_Party = new \Bulut\eFaturaUBL\Party();
$invoice_AccountSupplierParty_Party->WebsiteURI = "http://unlembilisim.com";

$invoice_AccountSupplierParty_Party_Identifi = new \Bulut\eFaturaUBL\PartyIdentification();
$invoice_AccountSupplierParty_Party_Identifi->ID = ['val'=> '12345678901', 'attrs' => ['schemeID="VKN"']];
$invoice_AccountSupplierParty_Party->PartyIdentification = $invoice_AccountSupplierParty_Party_Identifi;

$invoice_AccountSupplierParty_Party_Name = new \Bulut\eFaturaUBL\PartyName();
$invoice_AccountSupplierParty_Party_Name->Name = "Orhan Gazi Başlı";
$invoice_AccountSupplierParty_Party->PartyName = $invoice_AccountSupplierParty_Party_Name;

$invoice_AccountSupplierParty_Party_Person = new \Bulut\eFaturaUBL\Person();
$invoice_AccountSupplierParty_Party_Person->FirstName = "Orhan Gazi";
$invoice_AccountSupplierParty_Party_Person->FamilyName = "Başlı";
$invoice_AccountSupplierParty_Party->Person = $invoice_AccountSupplierParty_Party_Person;

$invoice_AccountSupplierParty_Party_PostalAdd = new \Bulut\eFaturaUBL\PostalAddress();
$invoice_AccountSupplierParty_Party_PostalAdd->Room = "kapi no";
$invoice_AccountSupplierParty_Party_PostalAdd->StreetName = "cadde";
$invoice_AccountSupplierParty_Party_PostalAdd->BuildingName = "bina";
$invoice_AccountSupplierParty_Party_PostalAdd->BuildingNumber = "bina no";
$invoice_AccountSupplierParty_Party_PostalAdd->CitySubdivisionName = "mahalle";
$invoice_AccountSupplierParty_Party_PostalAdd->CityName = "şehir";
$invoice_AccountSupplierParty_Party_PostalAdd->PostalZone = "posta kodu";
$invoice_AccountSupplierParty_Party_PostalAdd->Region = "asd";

$invoice_AccountSupplierParty_Party_PostalAdd_Country = new \Bulut\eFaturaUBL\Country();
$invoice_AccountSupplierParty_Party_PostalAdd_Country->Name = "Türkiye";

$invoice_AccountSupplierParty_Party_PostalAdd->Country = $invoice_AccountSupplierParty_Party_PostalAdd_Country;
$invoice_AccountSupplierParty_Party->PostalAddress = $invoice_AccountSupplierParty_Party_PostalAdd;

$invoice_AccountSupplierParty_Party_TaxSchema = new \Bulut\eFaturaUBL\PartyTaxScheme();
$invoice_AccountSupplierParty_Party_TaxSchema_Schema = new \Bulut\eFaturaUBL\TaxScheme();
$invoice_AccountSupplierParty_Party_TaxSchema_Schema->Name = "erciyes";
$invoice_AccountSupplierParty_Party_TaxSchema->TaxScheme = $invoice_AccountSupplierParty_Party_TaxSchema_Schema;
$invoice_AccountSupplierParty_Party->PartyTaxScheme = $invoice_AccountSupplierParty_Party_TaxSchema;

$invoice_AccountSupplierParty_Party_Contact = new \Bulut\eFaturaUBL\Contact();
$invoice_AccountSupplierParty_Party_Contact->Telephone = "telef";
$invoice_AccountSupplierParty_Party_Contact->Telefax = "Telefax";
$invoice_AccountSupplierParty_Party_Contact->ElectronicMail = "ElectronicMail";
$invoice_AccountSupplierParty_Party->Contact = $invoice_AccountSupplierParty_Party_Contact;

$invoice_AccountSupplierParty->Party = $invoice_AccountSupplierParty_Party;

$invoice->AccountingSupplierParty = $invoice_AccountSupplierParty;

//Customer
$invoice_AccountCustomerParty = new \Bulut\eFaturaUBL\AccountingCustomerParty();
$invoice_AccountCustomerParty_Party = new \Bulut\eFaturaUBL\Party();
$invoice_AccountCustomerParty_Party->WebsiteURI = "http://unlembilisim.com";

$invoice_AccountCustomerParty_Party_Identifi = new \Bulut\eFaturaUBL\PartyIdentification();
$invoice_AccountCustomerParty_Party_Identifi->ID = ['val'=> "12345678901", 'attrs' => ['schemeID="VKN"']];
$invoice_AccountCustomerParty_Party->PartyIdentification = $invoice_AccountCustomerParty_Party_Identifi;

$invoice_AccountCustomerParty_Party_Name = new \Bulut\eFaturaUBL\PartyName();
$invoice_AccountCustomerParty_Party_Name->Name = "GIB";
$invoice_AccountCustomerParty_Party->PartyName = $invoice_AccountCustomerParty_Party_Name;

$invoice_AccountCustomerParty_Party_PostalAdd = new \Bulut\eFaturaUBL\PostalAddress();
$invoice_AccountCustomerParty_Party_PostalAdd->Room = "kapi no";
$invoice_AccountCustomerParty_Party_PostalAdd->StreetName = "cadde";
$invoice_AccountCustomerParty_Party_PostalAdd->BuildingName = "bina";
$invoice_AccountCustomerParty_Party_PostalAdd->BuildingNumber = "bina no";
$invoice_AccountCustomerParty_Party_PostalAdd->CitySubdivisionName = "mahalle";
$invoice_AccountCustomerParty_Party_PostalAdd->CityName = "şehir";
$invoice_AccountCustomerParty_Party_PostalAdd->PostalZone = "posta kodu";
$invoice_AccountCustomerParty_Party_PostalAdd->Region = "asd";

$invoice_AccountCustomerParty_Party_PostalAdd_Country = new \Bulut\eFaturaUBL\Country();
$invoice_AccountCustomerParty_Party_PostalAdd_Country->Name = "Türkiye";

$invoice_AccountCustomerParty_Party_PostalAdd->Country = $invoice_AccountCustomerParty_Party_PostalAdd_Country;
$invoice_AccountCustomerParty_Party->PostalAddress = $invoice_AccountCustomerParty_Party_PostalAdd;

$invoice_AccountCustomerParty_Party_TaxSchema = new \Bulut\eFaturaUBL\PartyTaxScheme();
$invoice_AccountCustomerParty_Party_TaxSchema_Schema = new \Bulut\eFaturaUBL\TaxScheme();
$invoice_AccountCustomerParty_Party_TaxSchema_Schema->Name = "erciyes";
$invoice_AccountCustomerParty_Party_TaxSchema->TaxScheme = $invoice_AccountCustomerParty_Party_TaxSchema_Schema;
$invoice_AccountCustomerParty_Party->PartyTaxScheme = $invoice_AccountCustomerParty_Party_TaxSchema;

$invoice_AccountCustomerParty_Party_Contact = new \Bulut\eFaturaUBL\Contact();
$invoice_AccountCustomerParty_Party_Contact->Telephone = "telef";
$invoice_AccountCustomerParty_Party_Contact->Telefax = "Telefax";
$invoice_AccountCustomerParty_Party_Contact->ElectronicMail = "ElectronicMail";
$invoice_AccountCustomerParty_Party->Contact = $invoice_AccountCustomerParty_Party_Contact;

$invoice_AccountCustomerParty->Party = $invoice_AccountCustomerParty_Party;

$invoice->AccountingCustomerParty= $invoice_AccountCustomerParty;

$invoice_Allowence = new \Bulut\eFaturaUBL\AllowanceCharge();
$invoice_Allowence->ChargeIndicator = "false";
$invoice_Allowence->Amount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];
$invoice->AllowanceCharge = $invoice_Allowence;

$invoice_TaxTotal = new \Bulut\eFaturaUBL\TaxTotal();
$invoice_TaxTotal->TaxAmount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];

$invoice_TaxTotal_SubTotal = new \Bulut\eFaturaUBL\TaxSubtotal();
$invoice_TaxTotal_SubTotal->TaxableAmount = ["val" => "0.99", 'attrs' => ['currencyID="TRY"']];
$invoice_TaxTotal_SubTotal->TaxAmount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];

$invoice_TaxTotal_SubTotal_Category = new \Bulut\eFaturaUBL\TaxCategory();
$invoice_TaxTotal_SubTotal_Category_Schema = new \Bulut\eFaturaUBL\TaxScheme();
$invoice_TaxTotal_SubTotal_Category_Schema->Name = "KDV";
$invoice_TaxTotal_SubTotal_Category_Schema->TaxTypeCode = "0015";

$invoice_TaxTotal_SubTotal_Category->TaxScheme = $invoice_TaxTotal_SubTotal_Category_Schema;
$invoice_TaxTotal_SubTotal->TaxCategory = $invoice_TaxTotal_SubTotal_Category;
$invoice_TaxTotal->TaxSubtotal = $invoice_TaxTotal_SubTotal;

$invoice->TaxTotal = $invoice_TaxTotal;

$invoice_LegalMonetary = new \Bulut\eFaturaUBL\LegalMonetaryTotal();
$invoice_LegalMonetary->LineExtensionAmount = ["val" => "1", 'attrs' => ['currencyID="TRY"']];
$invoice_LegalMonetary->TaxExclusiveAmount = ["val" => "0.99", 'attrs' => ['currencyID="TRY"']];
$invoice_LegalMonetary->TaxInclusiveAmount = ["val" => "1", 'attrs' => ['currencyID="TRY"']];
$invoice_LegalMonetary->AllowanceTotalAmount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];
$invoice_LegalMonetary->PayableAmount = ["val" => "1", 'attrs' => ['currencyID="TRY"']];

$invoice->LegalMonetaryTotal = $invoice_LegalMonetary;

$invoice_line = new \Bulut\eFaturaUBL\InvoiceLine();
$invoice_line->ID = "1";
$invoice_line->InvoicedQuantity = ["val" => "1", 'attrs' => ['unitCode="CMT"']];
$invoice_line->LineExtensionAmount = ["val" => "0.99", 'attrs' => ['currencyID="TRY"']];

$invoice_line_allowence = new \Bulut\eFaturaUBL\AllowanceCharge();
$invoice_line_allowence->ChargeIndicator = "false";
$invoice_line_allowence->MultiplierFactorNumeric = "0.01";
$invoice_line_allowence->Amount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];
$invoice_line_allowence->BaseAmount = ["val" => "1", 'attrs' => ['currencyID="TRY"']];
$invoice_line->AllowanceCharge = $invoice_line_allowence;

$invoice_line_taxtotal = new \Bulut\eFaturaUBL\TaxTotal();
$invoice_line_taxtotal->TaxAmount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];;

$invoice_line_taxtotal_sub = new \Bulut\eFaturaUBL\TaxSubtotal();
$invoice_line_taxtotal_sub->TaxableAmount = ["val" => "0.99", 'attrs' => ['currencyID="TRY"']];
$invoice_line_taxtotal_sub->TaxAmount = ["val" => "0.01", 'attrs' => ['currencyID="TRY"']];
$invoice_line_taxtotal_sub->Percent = "18";

$invoice_line_taxtotal_sub_category = new \Bulut\eFaturaUBL\TaxCategory();
$invoice_line_taxtotal_sub_category_schema = new \Bulut\eFaturaUBL\TaxScheme();
$invoice_line_taxtotal_sub_category_schema->Name = "KDV";
$invoice_line_taxtotal_sub_category_schema->TaxTypeCode = "0015";

$invoice_line_taxtotal_sub_category->TaxScheme = $invoice_line_taxtotal_sub_category_schema;
$invoice_line_taxtotal_sub->TaxCategory = $invoice_line_taxtotal_sub_category;

$invoice_line_taxtotal->TaxSubtotal = $invoice_line_taxtotal_sub;
$invoice_line->TaxTotal = $invoice_line_taxtotal;

$invoice_line_item = new \Bulut\eFaturaUBL\Item();
$invoice_line_item->Name = "Test Ürün";
$invoice_line->Item = $invoice_line_item;

$invoice_line_price = new \Bulut\eFaturaUBL\Price();
$invoice_line_price->PriceAmount = ["val" => "1", 'attrs' => ['currencyID="TRY"']];
$invoice_line->Price = $invoice_line_price;

$invoice->InvoiceLine = [$invoice_line];

$xml = new \Bulut\eFaturaUBL\XMLHelper($invoice);

//FATURA GÖNDER BAŞLADI
$destination = 'temp/'.$uuid.'.zip';
$zip = new ZipArchive();
if($zip->open($destination,ZIPARCHIVE::CREATE) !== true) {
    return false;
}

$zip->addFromString($uuid.'.xml', $xml);
$zip->close();

$sendUblRequest = new \Bulut\InvoiceService\SendUBL();
$sendUblRequest->setVKNTCKN("12345678901");
$sendUblRequest->setDocType("INVOICE"); // veya APP_RESP
$sendUblRequest->setReceiverIdentifier("ALICI_PK");
$sendUblRequest->setSenderIdentifier("GONDERICI_GB");
$sendUblRequest->setDocData(base64_encode(file_get_contents($destination)));
unlink($destination);

$result = $service->SendUBLRequest($sendUblRequest);
//FATURA GÖNDER BİTTİ
?>

<section class="options-wrapper">

    <div class="container">

        <div class="row">

                <div class="col-md-5">

                    <div id="confirm">

                        <div class="icon icon--order-success svg add_bottom_15">

                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">

                                <g fill="none" stroke="#8EC343" stroke-width="2">

                                    <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>

                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>

                                </g>

                            </svg>

                        </div>

                        <?php

                            if ($_SESSION["odemetipi"]==1)

                            {

                                ?>

                                <h2 style="color: white;margin-top: 10px;">Siparişiniz Oluşturuldu</h2>

                                <p  style="color: white">Siparişinizi <strong  style="color: crimson"><?=$_SESSION["siparisKodu"]?></strong> nolu numara üzerinden takip edebilirsiniz</p>

                                <?php

                            }

                        ?>

                        <?php

                        if ($_SESSION["odemetipi"]==2)

                        {

                            ?>

                            <h2 style="color: white;margin-top: 10px;">Siparişiniz Oluşturuldu</h2>

                            <p  style="color: white">Siparişinizi <a href="<?SITE?>hesabim"><strong  style="color: crimson"><?=$_SESSION["siparisKodu"]?></strong></a> nolu numara üzerinden takip edebilirsiniz.</p>

                            <?php

                        }

                        ?>

                        <?php

                        if ($_SESSION["odemetipi"]==3)

                        {

                            ?>

                            <h2 style="color: white;margin-top: 10px;">Siparişiniz Oluşturuldu</h2>

                            <p  style="color: white">Siparişinizi <strong style="color: crimson"><?=$_SESSION["siparisKodu"]?></strong> nolu numara üzerinden takip edebilirsiniz. (Kapıda Ödeme)</p>

                            <?php

                        }

                        ?>

                    </div>

                </div>

            </div>

            <!-- /row -->

        </div>

        <!-- /container -->



</section>

    <?php



}

else

{

    ?>

    <meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">



<?php

}

?>



