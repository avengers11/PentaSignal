<?php
use WeStacks\TeleBot\TeleBot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;


function binanceSpotPrices($cryptos)
{
  $json = '[
      {
      "symbol": "ETHBTC",
      "price": "16.1"
      },
      {
      "symbol": "LTCBTC",
      "price": "0.00090200"
      },
      {
      "symbol": "BNBBTC",
      "price": "0.00699700"
      },
      {
      "symbol": "NEOBTC",
      "price": "0.00006620"
      },
      {
      "symbol": "QTUMETH",
      "price": "0.00133400"
      },
      {
      "symbol": "EOSETH",
      "price": "0.00039520"
      },
      {
      "symbol": "SNTETH",
      "price": "0.00001700"
      },
      {
      "symbol": "BNTETH",
      "price": "0.00020260"
      },
      {
      "symbol": "BCCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GASBTC",
      "price": "0.00004140"
      },
      {
      "symbol": "BNBETH",
      "price": "0.37190000"
      },
      {
      "symbol": "BTCUSDT",
      "price": "84800.00000000"
      },
      {
      "symbol": "ETHUSDT",
      "price": "1595.90000000"
      },
      {
      "symbol": "HSRBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "OAXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DNTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MCOETH",
      "price": "0.00000000"
      },
      {
      "symbol": "ICNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MCOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "WTCBTC",
      "price": "0.00000024"
      },
      {
      "symbol": "WTCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "LRCBTC",
      "price": "0.00000110"
      },
      {
      "symbol": "LRCETH",
      "price": "0.00005881"
      },
      {
      "symbol": "QTUMBTC",
      "price": "0.00002500"
      },
      {
      "symbol": "YOYOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "OMGBTC",
      "price": "0.00003080"
      },
      {
      "symbol": "OMGETH",
      "price": "0.00079100"
      },
      {
      "symbol": "ZRXBTC",
      "price": "0.00000301"
      },
      {
      "symbol": "ZRXETH",
      "price": "0.00009940"
      },
      {
      "symbol": "STRATBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "STRATETH",
      "price": "0.00000000"
      },
      {
      "symbol": "SNGLSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SNGLSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BQXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BQXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "KNCBTC",
      "price": "0.00000414"
      },
      {
      "symbol": "KNCETH",
      "price": "0.00039410"
      },
      {
      "symbol": "FUNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "FUNETH",
      "price": "0.00000146"
      },
      {
      "symbol": "SNMBTC",
      "price": "0.00000057"
      },
      {
      "symbol": "SNMETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NEOETH",
      "price": "0.00477500"
      },
      {
      "symbol": "IOTABTC",
      "price": "0.00000194"
      },
      {
      "symbol": "IOTAETH",
      "price": "0.00010283"
      },
      {
      "symbol": "LINKBTC",
      "price": "0.00015290"
      },
      {
      "symbol": "LINKETH",
      "price": "0.00812500"
      },
      {
      "symbol": "XVGBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "XVGETH",
      "price": "0.00000281"
      },
      {
      "symbol": "SALTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SALTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MDABTC",
      "price": "0.00000000"
      },
      {
      "symbol": "MDAETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MTLBTC",
      "price": "0.00000975"
      },
      {
      "symbol": "MTLETH",
      "price": "0.00068340"
      },
      {
      "symbol": "SUBBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SUBETH",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSBTC",
      "price": "0.00000745"
      },
      {
      "symbol": "SNTBTC",
      "price": "0.00000032"
      },
      {
      "symbol": "ETCETH",
      "price": "0.00994000"
      },
      {
      "symbol": "ETCBTC",
      "price": "0.00018710"
      },
      {
      "symbol": "MTHBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "MTHETH",
      "price": "0.00000000"
      },
      {
      "symbol": "ENGBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ENGETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DNTBTC",
      "price": "0.00000186"
      },
      {
      "symbol": "ZECBTC",
      "price": "0.00037340"
      },
      {
      "symbol": "ZECETH",
      "price": "0.01997000"
      },
      {
      "symbol": "BNTBTC",
      "price": "0.00000794"
      },
      {
      "symbol": "ASTBTC",
      "price": "0.00000124"
      },
      {
      "symbol": "ASTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DASHBTC",
      "price": "0.00025010"
      },
      {
      "symbol": "DASHETH",
      "price": "0.01330000"
      },
      {
      "symbol": "OAXBTC",
      "price": "0.00000038"
      },
      {
      "symbol": "ICNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BTGBTC",
      "price": "0.00091300"
      },
      {
      "symbol": "BTGETH",
      "price": "0.00000000"
      },
      {
      "symbol": "EVXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "EVXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "REQBTC",
      "price": "0.00000125"
      },
      {
      "symbol": "REQETH",
      "price": "0.00000000"
      },
      {
      "symbol": "VIBBTC",
      "price": "0.00000051"
      },
      {
      "symbol": "VIBETH",
      "price": "0.00003450"
      },
      {
      "symbol": "HSRETH",
      "price": "0.00000000"
      },
      {
      "symbol": "TRXBTC",
      "price": "0.00000286"
      },
      {
      "symbol": "TRXETH",
      "price": "0.00015152"
      },
      {
      "symbol": "POWRBTC",
      "price": "0.00000211"
      },
      {
      "symbol": "POWRETH",
      "price": "0.00011230"
      },
      {
      "symbol": "ARKBTC",
      "price": "0.00001679"
      },
      {
      "symbol": "ARKETH",
      "price": "0.00000000"
      },
      {
      "symbol": "YOYOETH",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPBTC",
      "price": "0.00002440"
      },
      {
      "symbol": "XRPETH",
      "price": "0.00129670"
      },
      {
      "symbol": "MODBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "MODETH",
      "price": "0.00000000"
      },
      {
      "symbol": "ENJBTC",
      "price": "0.00000079"
      },
      {
      "symbol": "ENJETH",
      "price": "0.00006172"
      },
      {
      "symbol": "STORJBTC",
      "price": "0.00000353"
      },
      {
      "symbol": "STORJETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBUSDT",
      "price": "593.46000000"
      },
      {
      "symbol": "VENBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "YOYOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "POWRBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "VENBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "VENETH",
      "price": "0.00000000"
      },
      {
      "symbol": "KMDBTC",
      "price": "0.00000157"
      },
      {
      "symbol": "KMDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NULSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "RCNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RCNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RCNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NULSBTC",
      "price": "0.00000030"
      },
      {
      "symbol": "NULSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RDNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RDNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RDNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "XMRBTC",
      "price": "0.00228700"
      },
      {
      "symbol": "XMRETH",
      "price": "0.04032000"
      },
      {
      "symbol": "DLTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "WTCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DLTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "DLTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AMBBTC",
      "price": "0.00000010"
      },
      {
      "symbol": "AMBETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AMBBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BCCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BCCUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BCCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BATBTC",
      "price": "0.00000156"
      },
      {
      "symbol": "BATETH",
      "price": "0.00010630"
      },
      {
      "symbol": "BATBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ARNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ARNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GVTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GVTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "CDTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CDTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GXSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GXSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NEOUSDT",
      "price": "5.60000000"
      },
      {
      "symbol": "NEOBNB",
      "price": "0.03836000"
      },
      {
      "symbol": "POEBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "POEETH",
      "price": "0.00000000"
      },
      {
      "symbol": "QSPBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "QSPETH",
      "price": "0.00000000"
      },
      {
      "symbol": "QSPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BTSBTC",
      "price": "0.00000043"
      },
      {
      "symbol": "BTSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BTSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "XZCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "XZCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "XZCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LSKBTC",
      "price": "0.00000616"
      },
      {
      "symbol": "LSKETH",
      "price": "0.00033730"
      },
      {
      "symbol": "LSKBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TNTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "TNTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "FUELBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "FUELETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MANABTC",
      "price": "0.00000336"
      },
      {
      "symbol": "MANAETH",
      "price": "0.00017830"
      },
      {
      "symbol": "BCDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DGDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "DGDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "IOTABNB",
      "price": "0.00071700"
      },
      {
      "symbol": "ADXBTC",
      "price": "0.00000101"
      },
      {
      "symbol": "ADXETH",
      "price": "0.00005360"
      },
      {
      "symbol": "ADXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ADABTC",
      "price": "0.00000738"
      },
      {
      "symbol": "ADAETH",
      "price": "0.00039170"
      },
      {
      "symbol": "PPTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "PPTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "CMTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CMTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "CMTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMBTC",
      "price": "0.00000288"
      },
      {
      "symbol": "XLMETH",
      "price": "0.00015331"
      },
      {
      "symbol": "XLMBNB",
      "price": "0.00030360"
      },
      {
      "symbol": "CNDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CNDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "CNDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LENDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "LENDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "WABIBTC",
      "price": "0.00000030"
      },
      {
      "symbol": "WABIETH",
      "price": "0.00000000"
      },
      {
      "symbol": "WABIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCETH",
      "price": "0.04793000"
      },
      {
      "symbol": "LTCUSDT",
      "price": "76.50000000"
      },
      {
      "symbol": "LTCBNB",
      "price": "0.12880000"
      },
      {
      "symbol": "TNBBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "TNBETH",
      "price": "0.00000000"
      },
      {
      "symbol": "WAVESBTC",
      "price": "0.00001626"
      },
      {
      "symbol": "WAVESETH",
      "price": "0.00029800"
      },
      {
      "symbol": "WAVESBNB",
      "price": "0.00513000"
      },
      {
      "symbol": "GTOBTC",
      "price": "0.00000077"
      },
      {
      "symbol": "GTOETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GTOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ICXBTC",
      "price": "0.00000116"
      },
      {
      "symbol": "ICXETH",
      "price": "0.00011790"
      },
      {
      "symbol": "ICXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "OSTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "OSTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "OSTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ELFBTC",
      "price": "0.00000274"
      },
      {
      "symbol": "ELFETH",
      "price": "0.00014330"
      },
      {
      "symbol": "AIONBTC",
      "price": "0.00000139"
      },
      {
      "symbol": "AIONETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AIONBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NEBLBTC",
      "price": "0.00001200"
      },
      {
      "symbol": "NEBLBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BRDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BRDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BRDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MCOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "EDOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "EDOETH",
      "price": "0.00000000"
      },
      {
      "symbol": "WINGSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "WINGSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NAVBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NAVETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NAVBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "TRIGBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "TRIGETH",
      "price": "0.00000000"
      },
      {
      "symbol": "TRIGBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "APPCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "APPCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "APPCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "VIBEBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "VIBEETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RLCBTC",
      "price": "0.00001330"
      },
      {
      "symbol": "RLCETH",
      "price": "0.00070470"
      },
      {
      "symbol": "RLCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "INSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "INSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "PIVXBTC",
      "price": "0.00000153"
      },
      {
      "symbol": "PIVXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "IOSTBTC",
      "price": "0.00000010"
      },
      {
      "symbol": "IOSTETH",
      "price": "0.00000372"
      },
      {
      "symbol": "CHATBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CHATETH",
      "price": "0.00000000"
      },
      {
      "symbol": "STEEMBTC",
      "price": "0.00000173"
      },
      {
      "symbol": "STEEMETH",
      "price": "0.00009230"
      },
      {
      "symbol": "STEEMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NANOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NANOETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NANOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "VIABTC",
      "price": "0.00000000"
      },
      {
      "symbol": "VIAETH",
      "price": "0.00000000"
      },
      {
      "symbol": "VIABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BLZBTC",
      "price": "0.00000060"
      },
      {
      "symbol": "BLZETH",
      "price": "0.00004159"
      },
      {
      "symbol": "BLZBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "AEBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "AEETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AEBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "RPXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RPXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RPXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NCASHBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NCASHETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NCASHBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "POABTC",
      "price": "0.00000000"
      },
      {
      "symbol": "POAETH",
      "price": "0.00000000"
      },
      {
      "symbol": "POABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ZILBTC",
      "price": "0.00000014"
      },
      {
      "symbol": "ZILETH",
      "price": "0.00000738"
      },
      {
      "symbol": "ZILBNB",
      "price": "0.00008858"
      },
      {
      "symbol": "ONTBTC",
      "price": "0.00000173"
      },
      {
      "symbol": "ONTETH",
      "price": "0.00012530"
      },
      {
      "symbol": "ONTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "STORMBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "STORMETH",
      "price": "0.00000000"
      },
      {
      "symbol": "STORMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "QTUMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "QTUMUSDT",
      "price": "2.11800000"
      },
      {
      "symbol": "XEMBTC",
      "price": "0.00000192"
      },
      {
      "symbol": "XEMETH",
      "price": "0.00000000"
      },
      {
      "symbol": "XEMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "WANBTC",
      "price": "0.00000125"
      },
      {
      "symbol": "WANETH",
      "price": "0.00009270"
      },
      {
      "symbol": "WANBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "WPRBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "WPRETH",
      "price": "0.00000000"
      },
      {
      "symbol": "QLCBTC",
      "price": "0.00000021"
      },
      {
      "symbol": "QLCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "SYSBTC",
      "price": "0.00000047"
      },
      {
      "symbol": "SYSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "SYSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "QLCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "GRSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GRSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "ADAUSDT",
      "price": "0.62520000"
      },
      {
      "symbol": "ADABNB",
      "price": "0.00105200"
      },
      {
      "symbol": "CLOAKBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CLOAKETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GNTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GNTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GNTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LOOMBTC",
      "price": "0.00000075"
      },
      {
      "symbol": "LOOMETH",
      "price": "0.00003231"
      },
      {
      "symbol": "LOOMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPUSDT",
      "price": "2.06910000"
      },
      {
      "symbol": "BCNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCNETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BCNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "REPBTC",
      "price": "0.00034130"
      },
      {
      "symbol": "REPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BTCTUSD",
      "price": "84886.48000000"
      },
      {
      "symbol": "TUSDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHTUSD",
      "price": "1598.38000000"
      },
      {
      "symbol": "TUSDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "TUSDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ZENBTC",
      "price": "0.00010390"
      },
      {
      "symbol": "ZENETH",
      "price": "0.00399100"
      },
      {
      "symbol": "ZENBNB",
      "price": "0.03290000"
      },
      {
      "symbol": "SKYBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SKYETH",
      "price": "0.00000000"
      },
      {
      "symbol": "SKYBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSUSDT",
      "price": "0.63290000"
      },
      {
      "symbol": "EOSBNB",
      "price": "0.00258300"
      },
      {
      "symbol": "CVCBTC",
      "price": "0.00000566"
      },
      {
      "symbol": "CVCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "CVCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "THETABTC",
      "price": "0.00000785"
      },
      {
      "symbol": "THETAETH",
      "price": "0.00050170"
      },
      {
      "symbol": "THETABNB",
      "price": "0.00273600"
      },
      {
      "symbol": "XRPBNB",
      "price": "0.00348690"
      },
      {
      "symbol": "TUSDUSDT",
      "price": "0.99810000"
      },
      {
      "symbol": "IOTAUSDT",
      "price": "0.16460000"
      },
      {
      "symbol": "XLMUSDT",
      "price": "0.24470000"
      },
      {
      "symbol": "IOTXBTC",
      "price": "0.00000022"
      },
      {
      "symbol": "IOTXETH",
      "price": "0.00001129"
      },
      {
      "symbol": "QKCBTC",
      "price": "0.00000010"
      },
      {
      "symbol": "QKCETH",
      "price": "0.00000430"
      },
      {
      "symbol": "AGIBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "AGIETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AGIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NXSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NXSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NXSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ENJBNB",
      "price": "0.00136800"
      },
      {
      "symbol": "DATABTC",
      "price": "0.00000020"
      },
      {
      "symbol": "DATAETH",
      "price": "0.00002034"
      },
      {
      "symbol": "ONTUSDT",
      "price": "0.14700000"
      },
      {
      "symbol": "TRXBNB",
      "price": "0.00040730"
      },
      {
      "symbol": "TRXUSDT",
      "price": "0.24180000"
      },
      {
      "symbol": "ETCUSDT",
      "price": "15.88000000"
      },
      {
      "symbol": "ETCBNB",
      "price": "0.02668000"
      },
      {
      "symbol": "ICXUSDT",
      "price": "0.09900000"
      },
      {
      "symbol": "SCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SCETH",
      "price": "0.00000211"
      },
      {
      "symbol": "NPXSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NPXSETH",
      "price": "0.00000000"
      },
      {
      "symbol": "VENUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "KEYBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "KEYETH",
      "price": "0.00000227"
      },
      {
      "symbol": "NASBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NASETH",
      "price": "0.00000000"
      },
      {
      "symbol": "NASBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MFTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "MFTETH",
      "price": "0.00000433"
      },
      {
      "symbol": "MFTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DENTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "DENTETH",
      "price": "0.00000043"
      },
      {
      "symbol": "ARDRBTC",
      "price": "0.00000122"
      },
      {
      "symbol": "ARDRETH",
      "price": "0.00000000"
      },
      {
      "symbol": "ARDRBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NULSUSDT",
      "price": "0.02580000"
      },
      {
      "symbol": "HOTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "HOTETH",
      "price": "0.00000062"
      },
      {
      "symbol": "VETBTC",
      "price": "0.00000028"
      },
      {
      "symbol": "VETETH",
      "price": "0.00001468"
      },
      {
      "symbol": "VETUSDT",
      "price": "0.02336000"
      },
      {
      "symbol": "VETBNB",
      "price": "0.00003937"
      },
      {
      "symbol": "DOCKBTC",
      "price": "0.00000005"
      },
      {
      "symbol": "DOCKETH",
      "price": "0.00000000"
      },
      {
      "symbol": "POLYBTC",
      "price": "0.00001384"
      },
      {
      "symbol": "POLYBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "PHXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "PHXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "PHXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "HCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "HCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "GOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "GOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "PAXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "PAXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "PAXUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "PAXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "RVNBTC",
      "price": "0.00000013"
      },
      {
      "symbol": "DCRBTC",
      "price": "0.00021850"
      },
      {
      "symbol": "DCRBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "USDCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MITHBTC",
      "price": "0.00000080"
      },
      {
      "symbol": "MITHBNB",
      "price": "0.00004410"
      },
      {
      "symbol": "BCHABCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHSVBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHABCUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHSVUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BTCPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "RENBTC",
      "price": "0.00000043"
      },
      {
      "symbol": "RENBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBTUSD",
      "price": "594.49000000"
      },
      {
      "symbol": "XRPTUSD",
      "price": "2.06920000"
      },
      {
      "symbol": "EOSTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBUSDC",
      "price": "593.52000000"
      },
      {
      "symbol": "BTCUSDC",
      "price": "84800.01000000"
      },
      {
      "symbol": "ETHUSDC",
      "price": "1595.97000000"
      },
      {
      "symbol": "XRPUSDC",
      "price": "2.06910000"
      },
      {
      "symbol": "EOSUSDC",
      "price": "0.63290000"
      },
      {
      "symbol": "XLMUSDC",
      "price": "0.24470000"
      },
      {
      "symbol": "USDCUSDT",
      "price": "1.00010000"
      },
      {
      "symbol": "ADATUSD",
      "price": "0.38470000"
      },
      {
      "symbol": "TRXTUSD",
      "price": "0.05986000"
      },
      {
      "symbol": "NEOTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "TRXXRP",
      "price": "0.11700000"
      },
      {
      "symbol": "XZCXRP",
      "price": "0.00000000"
      },
      {
      "symbol": "PAXTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "USDCTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "USDCPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "LINKUSDT",
      "price": "12.97000000"
      },
      {
      "symbol": "LINKTUSD",
      "price": "14.42300000"
      },
      {
      "symbol": "LINKPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "LINKUSDC",
      "price": "12.97000000"
      },
      {
      "symbol": "WAVESUSDT",
      "price": "1.07600000"
      },
      {
      "symbol": "WAVESTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "WAVESPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "WAVESUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHABCTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHABCPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHABCUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHSVTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHSVPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHSVUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCTUSD",
      "price": "83.07000000"
      },
      {
      "symbol": "LTCPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCUSDC",
      "price": "76.49000000"
      },
      {
      "symbol": "TRXPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "TRXUSDC",
      "price": "0.24180000"
      },
      {
      "symbol": "BTTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBUSDS",
      "price": "0.00000000"
      },
      {
      "symbol": "BTCUSDS",
      "price": "0.00000000"
      },
      {
      "symbol": "USDSUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "USDSPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "USDSTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "USDSUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ONGBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ONGBTC",
      "price": "0.00000238"
      },
      {
      "symbol": "ONGUSDT",
      "price": "0.20120000"
      },
      {
      "symbol": "HOTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "HOTUSDT",
      "price": "0.00096700"
      },
      {
      "symbol": "ZILUSDT",
      "price": "0.01176000"
      },
      {
      "symbol": "ZRXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ZRXUSDT",
      "price": "0.25600000"
      },
      {
      "symbol": "FETBNB",
      "price": "0.00096400"
      },
      {
      "symbol": "FETBTC",
      "price": "0.00000676"
      },
      {
      "symbol": "FETUSDT",
      "price": "0.57400000"
      },
      {
      "symbol": "BATUSDT",
      "price": "0.13200000"
      },
      {
      "symbol": "XMRBNB",
      "price": "0.33210000"
      },
      {
      "symbol": "XMRUSDT",
      "price": "118.70000000"
      },
      {
      "symbol": "ZECBNB",
      "price": "0.10260000"
      },
      {
      "symbol": "ZECUSDT",
      "price": "31.70000000"
      },
      {
      "symbol": "ZECPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ZECTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ZECUSDC",
      "price": "55.80000000"
      },
      {
      "symbol": "IOSTUSDT",
      "price": "0.00376500"
      },
      {
      "symbol": "CELRBNB",
      "price": "0.00005294"
      },
      {
      "symbol": "CELRBTC",
      "price": "0.00000009"
      },
      {
      "symbol": "CELRUSDT",
      "price": "0.00910000"
      },
      {
      "symbol": "ADAPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ADAUSDC",
      "price": "0.62520000"
      },
      {
      "symbol": "NEOPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "NEOUSDC",
      "price": "5.60000000"
      },
      {
      "symbol": "DASHBNB",
      "price": "0.11830000"
      },
      {
      "symbol": "DASHUSDT",
      "price": "21.21000000"
      },
      {
      "symbol": "NANOUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "OMGBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "OMGUSDT",
      "price": "0.38300000"
      },
      {
      "symbol": "THETAUSDT",
      "price": "0.66600000"
      },
      {
      "symbol": "ENJUSDT",
      "price": "0.06700000"
      },
      {
      "symbol": "MITHUSDT",
      "price": "0.00345000"
      },
      {
      "symbol": "MATICBNB",
      "price": "0.00073400"
      },
      {
      "symbol": "MATICBTC",
      "price": "0.00000667"
      },
      {
      "symbol": "MATICUSDT",
      "price": "0.37940000"
      },
      {
      "symbol": "ATOMBNB",
      "price": "0.00739000"
      },
      {
      "symbol": "ATOMBTC",
      "price": "0.00004940"
      },
      {
      "symbol": "ATOMUSDT",
      "price": "4.20000000"
      },
      {
      "symbol": "ATOMUSDC",
      "price": "4.19600000"
      },
      {
      "symbol": "ATOMPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ATOMTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ETCUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ETCPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ETCTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BATUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "BATPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BATTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "PHBBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "PHBBTC",
      "price": "0.00000552"
      },
      {
      "symbol": "PHBUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "PHBTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "PHBPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "TFUELBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TFUELBTC",
      "price": "0.00000045"
      },
      {
      "symbol": "TFUELUSDT",
      "price": "0.03768000"
      },
      {
      "symbol": "TFUELUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "TFUELTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "TFUELPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ONEBNB",
      "price": "0.00004537"
      },
      {
      "symbol": "ONEBTC",
      "price": "0.00000014"
      },
      {
      "symbol": "ONEUSDT",
      "price": "0.01119000"
      },
      {
      "symbol": "ONETUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ONEPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ONEUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "FTMBNB",
      "price": "0.00101440"
      },
      {
      "symbol": "FTMBTC",
      "price": "0.00000743"
      },
      {
      "symbol": "FTMUSDT",
      "price": "0.69940000"
      },
      {
      "symbol": "FTMTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "FTMPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "FTMUSDC",
      "price": "0.69860000"
      },
      {
      "symbol": "BTCBBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BCPTUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ALGOBNB",
      "price": "0.00058250"
      },
      {
      "symbol": "ALGOBTC",
      "price": "0.00000225"
      },
      {
      "symbol": "ALGOUSDT",
      "price": "0.19060000"
      },
      {
      "symbol": "ALGOTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ALGOPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ALGOUSDC",
      "price": "0.19050000"
      },
      {
      "symbol": "USDSBUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "USDSBUSDS",
      "price": "0.00000000"
      },
      {
      "symbol": "GTOUSDT",
      "price": "0.01233000"
      },
      {
      "symbol": "GTOPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "GTOTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "GTOUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ERDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ERDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ERDUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "ERDPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ERDUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "DOGEBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DOGEBTC",
      "price": "0.00000185"
      },
      {
      "symbol": "DOGEUSDT",
      "price": "0.15697000"
      },
      {
      "symbol": "DOGEPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "DOGEUSDC",
      "price": "0.15697000"
      },
      {
      "symbol": "DUSKBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DUSKBTC",
      "price": "0.00000091"
      },
      {
      "symbol": "DUSKUSDT",
      "price": "0.07770000"
      },
      {
      "symbol": "DUSKUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "DUSKPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BGBPUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ANKRBNB",
      "price": "0.00008560"
      },
      {
      "symbol": "ANKRBTC",
      "price": "0.00000022"
      },
      {
      "symbol": "ANKRUSDT",
      "price": "0.01842000"
      },
      {
      "symbol": "ANKRTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ANKRPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ANKRUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "ONTPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "ONTUSDC",
      "price": "0.14680000"
      },
      {
      "symbol": "WINBNB",
      "price": "0.00000010"
      },
      {
      "symbol": "WINBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "WINUSDT",
      "price": "0.00004784"
      },
      {
      "symbol": "WINUSDC",
      "price": "0.00009730"
      },
      {
      "symbol": "COSBNB",
      "price": "0.00002678"
      },
      {
      "symbol": "COSBTC",
      "price": "0.00000008"
      },
      {
      "symbol": "COSUSDT",
      "price": "0.00321200"
      },
      {
      "symbol": "TUSDBTUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "NPXSUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "NPXSUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "COCOSBNB",
      "price": "0.00559000"
      },
      {
      "symbol": "COCOSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "COCOSUSDT",
      "price": "1.75460000"
      },
      {
      "symbol": "MTLUSDT",
      "price": "0.82900000"
      },
      {
      "symbol": "TOMOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TOMOBTC",
      "price": "0.00003699"
      },
      {
      "symbol": "TOMOUSDT",
      "price": "1.38190000"
      },
      {
      "symbol": "TOMOUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "PERLBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "PERLBTC",
      "price": "0.00000113"
      },
      {
      "symbol": "PERLUSDC",
      "price": "0.00000000"
      },
      {
      "symbol": "PERLUSDT",
      "price": "0.00460000"
      },
      {
      "symbol": "DENTUSDT",
      "price": "0.00068400"
      },
      {
      "symbol": "MFTUSDT",
      "price": "0.00525400"
      },
      {
      "symbol": "KEYUSDT",
      "price": "0.00125300"
      },
      {
      "symbol": "STORMUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "DOCKUSDT",
      "price": "0.00390000"
      },
      {
      "symbol": "WANUSDT",
      "price": "0.10670000"
      },
      {
      "symbol": "FUNUSDT",
      "price": "0.00624300"
      },
      {
      "symbol": "CVCUSDT",
      "price": "0.10900000"
      },
      {
      "symbol": "BTTTRX",
      "price": "0.00000000"
      },
      {
      "symbol": "WINTRX",
      "price": "0.00019970"
      },
      {
      "symbol": "CHZBNB",
      "price": "0.00006330"
      },
      {
      "symbol": "CHZBTC",
      "price": "0.00000045"
      },
      {
      "symbol": "CHZUSDT",
      "price": "0.03759000"
      },
      {
      "symbol": "BANDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BANDBTC",
      "price": "0.00000836"
      },
      {
      "symbol": "BANDUSDT",
      "price": "0.71300000"
      },
      {
      "symbol": "BNBBUSD",
      "price": "251.80000000"
      },
      {
      "symbol": "BTCBUSD",
      "price": "42769.40000000"
      },
      {
      "symbol": "BUSDUSDT",
      "price": "1.00030000"
      },
      {
      "symbol": "BEAMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BEAMBTC",
      "price": "0.00000716"
      },
      {
      "symbol": "BEAMUSDT",
      "price": "0.06520000"
      },
      {
      "symbol": "XTZBNB",
      "price": "0.00288300"
      },
      {
      "symbol": "XTZBTC",
      "price": "0.00000593"
      },
      {
      "symbol": "XTZUSDT",
      "price": "0.50300000"
      },
      {
      "symbol": "RENUSDT",
      "price": "0.04274000"
      },
      {
      "symbol": "RVNUSDT",
      "price": "0.01096000"
      },
      {
      "symbol": "HCUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "HBARBNB",
      "price": "0.00027711"
      },
      {
      "symbol": "HBARBTC",
      "price": "0.00000193"
      },
      {
      "symbol": "HBARUSDT",
      "price": "0.16442000"
      },
      {
      "symbol": "NKNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NKNBTC",
      "price": "0.00000048"
      },
      {
      "symbol": "NKNUSDT",
      "price": "0.04080000"
      },
      {
      "symbol": "XRPBUSD",
      "price": "0.63450000"
      },
      {
      "symbol": "ETHBUSD",
      "price": "2281.12000000"
      },
      {
      "symbol": "BCHABCBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCBUSD",
      "price": "72.37000000"
      },
      {
      "symbol": "LINKBUSD",
      "price": "14.07100000"
      },
      {
      "symbol": "ETCBUSD",
      "price": "19.03000000"
      },
      {
      "symbol": "STXBNB",
      "price": "0.00104800"
      },
      {
      "symbol": "STXBTC",
      "price": "0.00000735"
      },
      {
      "symbol": "STXUSDT",
      "price": "0.62300000"
      },
      {
      "symbol": "KAVABNB",
      "price": "0.00276000"
      },
      {
      "symbol": "KAVABTC",
      "price": "0.00000496"
      },
      {
      "symbol": "KAVAUSDT",
      "price": "0.42150000"
      },
      {
      "symbol": "BUSDNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "BTCNGN",
      "price": "99822596.00000000"
      },
      {
      "symbol": "ARPABNB",
      "price": "0.00015470"
      },
      {
      "symbol": "ARPABTC",
      "price": "0.00000026"
      },
      {
      "symbol": "ARPAUSDT",
      "price": "0.02201000"
      },
      {
      "symbol": "TRXBUSD",
      "price": "0.10329000"
      },
      {
      "symbol": "EOSBUSD",
      "price": "0.63400000"
      },
      {
      "symbol": "IOTXUSDT",
      "price": "0.01800000"
      },
      {
      "symbol": "RLCUSDT",
      "price": "1.13200000"
      },
      {
      "symbol": "MCOUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMBUSD",
      "price": "0.11970000"
      },
      {
      "symbol": "ADABUSD",
      "price": "0.63740000"
      },
      {
      "symbol": "CTXCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "CTXCBTC",
      "price": "0.00000075"
      },
      {
      "symbol": "CTXCUSDT",
      "price": "0.06340000"
      },
      {
      "symbol": "BCHBNB",
      "price": "0.56300000"
      },
      {
      "symbol": "BCHBTC",
      "price": "0.00395300"
      },
      {
      "symbol": "BCHUSDT",
      "price": "335.30000000"
      },
      {
      "symbol": "BCHUSDC",
      "price": "335.40000000"
      },
      {
      "symbol": "BCHTUSD",
      "price": "322.00000000"
      },
      {
      "symbol": "BCHPAX",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHBUSD",
      "price": "236.00000000"
      },
      {
      "symbol": "BTCRUB",
      "price": "3900027.00000000"
      },
      {
      "symbol": "ETHRUB",
      "price": "181477.60000000"
      },
      {
      "symbol": "XRPRUB",
      "price": "56.31000000"
      },
      {
      "symbol": "BNBRUB",
      "price": "22422.22000000"
      },
      {
      "symbol": "TROYBNB",
      "price": "0.00001060"
      },
      {
      "symbol": "TROYBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "TROYUSDT",
      "price": "0.00006900"
      },
      {
      "symbol": "BUSDRUB",
      "price": "90.39000000"
      },
      {
      "symbol": "QTUMBUSD",
      "price": "2.53700000"
      },
      {
      "symbol": "VETBUSD",
      "price": "0.02120000"
      },
      {
      "symbol": "VITEBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "VITEBTC",
      "price": "0.00000007"
      },
      {
      "symbol": "VITEUSDT",
      "price": "0.00086000"
      },
      {
      "symbol": "FTTBNB",
      "price": "0.00513000"
      },
      {
      "symbol": "FTTBTC",
      "price": "0.00008560"
      },
      {
      "symbol": "FTTUSDT",
      "price": "0.82240000"
      },
      {
      "symbol": "BTCTRY",
      "price": "3231795.00000000"
      },
      {
      "symbol": "BNBTRY",
      "price": "22614.00000000"
      },
      {
      "symbol": "BUSDTRY",
      "price": "29.33000000"
      },
      {
      "symbol": "ETHTRY",
      "price": "60810.00000000"
      },
      {
      "symbol": "XRPTRY",
      "price": "78.88000000"
      },
      {
      "symbol": "USDTTRY",
      "price": "38.10000000"
      },
      {
      "symbol": "USDTRUB",
      "price": "91.10000000"
      },
      {
      "symbol": "BTCEUR",
      "price": "74443.43000000"
      },
      {
      "symbol": "ETHEUR",
      "price": "1400.83000000"
      },
      {
      "symbol": "BNBEUR",
      "price": "521.00000000"
      },
      {
      "symbol": "XRPEUR",
      "price": "1.81710000"
      },
      {
      "symbol": "EURBUSD",
      "price": "1.07570000"
      },
      {
      "symbol": "EURUSDT",
      "price": "1.13920000"
      },
      {
      "symbol": "OGNBNB",
      "price": "0.00038300"
      },
      {
      "symbol": "OGNBTC",
      "price": "0.00000066"
      },
      {
      "symbol": "OGNUSDT",
      "price": "0.05580000"
      },
      {
      "symbol": "DREPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DREPBTC",
      "price": "0.00000039"
      },
      {
      "symbol": "DREPUSDT",
      "price": "0.02560000"
      },
      {
      "symbol": "BULLUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BULLBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BEARUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BEARBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBULLUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBULLBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBEARUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBEARBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "TCTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TCTBTC",
      "price": "0.00000016"
      },
      {
      "symbol": "TCTUSDT",
      "price": "0.00312000"
      },
      {
      "symbol": "WRXBNB",
      "price": "0.00039800"
      },
      {
      "symbol": "WRXBTC",
      "price": "0.00000455"
      },
      {
      "symbol": "WRXUSDT",
      "price": "0.01730000"
      },
      {
      "symbol": "ICXBUSD",
      "price": "0.16420000"
      },
      {
      "symbol": "BTSUSDT",
      "price": "0.00540000"
      },
      {
      "symbol": "BTSBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "LSKUSDT",
      "price": "0.52200000"
      },
      {
      "symbol": "BNTUSDT",
      "price": "0.38580000"
      },
      {
      "symbol": "BNTBUSD",
      "price": "0.35990000"
      },
      {
      "symbol": "LTOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LTOBTC",
      "price": "0.00000038"
      },
      {
      "symbol": "LTOUSDT",
      "price": "0.03220000"
      },
      {
      "symbol": "ATOMBUSD",
      "price": "11.21900000"
      },
      {
      "symbol": "DASHBUSD",
      "price": "25.83000000"
      },
      {
      "symbol": "NEOBUSD",
      "price": "6.73000000"
      },
      {
      "symbol": "WAVESBUSD",
      "price": "2.21600000"
      },
      {
      "symbol": "XTZBUSD",
      "price": "0.67100000"
      },
      {
      "symbol": "EOSBULLUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSBULLBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSBEARUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSBEARBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPBULLUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPBULLBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPBEARUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XRPBEARBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BATBUSD",
      "price": "0.17090000"
      },
      {
      "symbol": "ENJBUSD",
      "price": "0.26070000"
      },
      {
      "symbol": "NANOBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ONTBUSD",
      "price": "0.15740000"
      },
      {
      "symbol": "RVNBUSD",
      "price": "0.01525000"
      },
      {
      "symbol": "STRATBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "STRATBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "STRATUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "AIONBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "AIONUSDT",
      "price": "0.00943000"
      },
      {
      "symbol": "MBLBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MBLBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "MBLUSDT",
      "price": "0.00246700"
      },
      {
      "symbol": "COTIBNB",
      "price": "0.00021230"
      },
      {
      "symbol": "COTIBTC",
      "price": "0.00000082"
      },
      {
      "symbol": "COTIUSDT",
      "price": "0.06977000"
      },
      {
      "symbol": "ALGOBUSD",
      "price": "0.20710000"
      },
      {
      "symbol": "BTTBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "TOMOBUSD",
      "price": "1.78070000"
      },
      {
      "symbol": "XMRBUSD",
      "price": "170.20000000"
      },
      {
      "symbol": "ZECBUSD",
      "price": "25.50000000"
      },
      {
      "symbol": "BNBBULLUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBBULLBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBBEARUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBBEARBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "STPTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "STPTBTC",
      "price": "0.00000054"
      },
      {
      "symbol": "STPTUSDT",
      "price": "0.04543000"
      },
      {
      "symbol": "BTCZAR",
      "price": "1618474.00000000"
      },
      {
      "symbol": "ETHZAR",
      "price": "30409.00000000"
      },
      {
      "symbol": "BNBZAR",
      "price": "0.00000000"
      },
      {
      "symbol": "USDTZAR",
      "price": "19.10000000"
      },
      {
      "symbol": "BUSDZAR",
      "price": "18.85000000"
      },
      {
      "symbol": "BTCBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "BNBBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "WTCUSDT",
      "price": "0.01030000"
      },
      {
      "symbol": "DATABUSD",
      "price": "0.02344000"
      },
      {
      "symbol": "DATAUSDT",
      "price": "0.01674000"
      },
      {
      "symbol": "XZCUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "SOLBNB",
      "price": "0.23500000"
      },
      {
      "symbol": "SOLBTC",
      "price": "0.00164560"
      },
      {
      "symbol": "SOLUSDT",
      "price": "139.54000000"
      },
      {
      "symbol": "SOLBUSD",
      "price": "74.62000000"
      },
      {
      "symbol": "BTCIDRT",
      "price": "0.00"
      },
      {
      "symbol": "BNBIDRT",
      "price": "0.00"
      },
      {
      "symbol": "USDTIDRT",
      "price": "15907.00"
      },
      {
      "symbol": "BUSDIDRT",
      "price": "0.00"
      },
      {
      "symbol": "CTSIBTC",
      "price": "0.00000071"
      },
      {
      "symbol": "CTSIUSDT",
      "price": "0.06040000"
      },
      {
      "symbol": "CTSIBNB",
      "price": "0.00079830"
      },
      {
      "symbol": "CTSIBUSD",
      "price": "0.16420000"
      },
      {
      "symbol": "HIVEBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "HIVEBTC",
      "price": "0.00000285"
      },
      {
      "symbol": "HIVEUSDT",
      "price": "0.24180000"
      },
      {
      "symbol": "CHRBNB",
      "price": "0.00043770"
      },
      {
      "symbol": "CHRBTC",
      "price": "0.00000105"
      },
      {
      "symbol": "CHRUSDT",
      "price": "0.08880000"
      },
      {
      "symbol": "BTCUPUSDT",
      "price": "16.60000000"
      },
      {
      "symbol": "BTCDOWNUSDT",
      "price": "0.00118500"
      },
      {
      "symbol": "GXSUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "ARDRUSDT",
      "price": "0.10365000"
      },
      {
      "symbol": "ERDBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "LENDUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "HBARBUSD",
      "price": "0.06020000"
      },
      {
      "symbol": "MATICBUSD",
      "price": "0.86590000"
      },
      {
      "symbol": "WRXBUSD",
      "price": "0.11050000"
      },
      {
      "symbol": "ZILBUSD",
      "price": "0.01583000"
      },
      {
      "symbol": "MDTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MDTBTC",
      "price": "0.00000030"
      },
      {
      "symbol": "MDTUSDT",
      "price": "0.02788000"
      },
      {
      "symbol": "STMXBTC",
      "price": "0.00000016"
      },
      {
      "symbol": "STMXETH",
      "price": "0.00000292"
      },
      {
      "symbol": "STMXUSDT",
      "price": "0.00456500"
      },
      {
      "symbol": "KNCBUSD",
      "price": "0.63700000"
      },
      {
      "symbol": "KNCUSDT",
      "price": "0.35150000"
      },
      {
      "symbol": "REPBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "REPUSDT",
      "price": "4.73000000"
      },
      {
      "symbol": "LRCBUSD",
      "price": "0.17280000"
      },
      {
      "symbol": "LRCUSDT",
      "price": "0.09380000"
      },
      {
      "symbol": "IQBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "IQBUSD",
      "price": "0.00502000"
      },
      {
      "symbol": "PNTBTC",
      "price": "0.00000864"
      },
      {
      "symbol": "PNTUSDT",
      "price": "0.03500000"
      },
      {
      "symbol": "BTCGBP",
      "price": "35986.75000000"
      },
      {
      "symbol": "ETHGBP",
      "price": "1974.32000000"
      },
      {
      "symbol": "XRPGBP",
      "price": "0.52570000"
      },
      {
      "symbol": "BNBGBP",
      "price": "267.40000000"
      },
      {
      "symbol": "GBPBUSD",
      "price": "1.23900000"
      },
      {
      "symbol": "DGBBTC",
      "price": "0.00000009"
      },
      {
      "symbol": "DGBBUSD",
      "price": "0.00632000"
      },
      {
      "symbol": "BTCUAH",
      "price": "3652164.00000000"
      },
      {
      "symbol": "USDTUAH",
      "price": "43.07000000"
      },
      {
      "symbol": "COMPBTC",
      "price": "0.00047400"
      },
      {
      "symbol": "COMPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "COMPBUSD",
      "price": "45.79000000"
      },
      {
      "symbol": "COMPUSDT",
      "price": "40.04000000"
      },
      {
      "symbol": "BTCBIDR",
      "price": "1042508253.00"
      },
      {
      "symbol": "ETHBIDR",
      "price": "47041943.00"
      },
      {
      "symbol": "BNBBIDR",
      "price": "3335250.00"
      },
      {
      "symbol": "BUSDBIDR",
      "price": "15559.00"
      },
      {
      "symbol": "USDTBIDR",
      "price": "15980.00"
      },
      {
      "symbol": "BKRWUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BKRWBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "SCUSDT",
      "price": "0.00335700"
      },
      {
      "symbol": "ZENUSDT",
      "price": "8.80000000"
      },
      {
      "symbol": "SXPBTC",
      "price": "0.00000253"
      },
      {
      "symbol": "SXPBNB",
      "price": "0.00044000"
      },
      {
      "symbol": "SXPBUSD",
      "price": "0.37210000"
      },
      {
      "symbol": "SNXBTC",
      "price": "0.00000754"
      },
      {
      "symbol": "SNXBNB",
      "price": "0.01057000"
      },
      {
      "symbol": "SNXBUSD",
      "price": "1.93600000"
      },
      {
      "symbol": "SNXUSDT",
      "price": "0.63800000"
      },
      {
      "symbol": "ETHUPUSDT",
      "price": "11.65100000"
      },
      {
      "symbol": "ETHDOWNUSDT",
      "price": "0.04570000"
      },
      {
      "symbol": "ADAUPUSDT",
      "price": "0.10400000"
      },
      {
      "symbol": "ADADOWNUSDT",
      "price": "0.00191700"
      },
      {
      "symbol": "LINKUPUSDT",
      "price": "0.00608000"
      },
      {
      "symbol": "LINKDOWNUSDT",
      "price": "0.00089500"
      },
      {
      "symbol": "VTHOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "VTHOBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "VTHOUSDT",
      "price": "0.00268700"
      },
      {
      "symbol": "DCRBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "DGBUSDT",
      "price": "0.00989000"
      },
      {
      "symbol": "GBPUSDT",
      "price": "1.18000000"
      },
      {
      "symbol": "STORJBUSD",
      "price": "0.23710000"
      },
      {
      "symbol": "SXPUSDT",
      "price": "0.21430000"
      },
      {
      "symbol": "IRISBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "IRISBTC",
      "price": "0.00000014"
      },
      {
      "symbol": "IRISBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "MKRBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MKRBTC",
      "price": "0.01599000"
      },
      {
      "symbol": "MKRUSDT",
      "price": "1357.00000000"
      },
      {
      "symbol": "MKRBUSD",
      "price": "1293.00000000"
      },
      {
      "symbol": "DAIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DAIBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "DAIUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "DAIBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "RUNEBNB",
      "price": "0.00188500"
      },
      {
      "symbol": "RUNEBTC",
      "price": "0.00001383"
      },
      {
      "symbol": "RUNEBUSD",
      "price": "5.46200000"
      },
      {
      "symbol": "MANABUSD",
      "price": "0.43880000"
      },
      {
      "symbol": "DOGEBUSD",
      "price": "0.09742000"
      },
      {
      "symbol": "LENDBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ZRXBUSD",
      "price": "0.16890000"
      },
      {
      "symbol": "DCRUSDT",
      "price": "12.49000000"
      },
      {
      "symbol": "STORJUSDT",
      "price": "0.29800000"
      },
      {
      "symbol": "XRPBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "ADABKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "BTCAUD",
      "price": "37210.08000000"
      },
      {
      "symbol": "ETHAUD",
      "price": "2565.09000000"
      },
      {
      "symbol": "AUDBUSD",
      "price": "0.72550000"
      },
      {
      "symbol": "FIOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "FIOBTC",
      "price": "0.00000018"
      },
      {
      "symbol": "FIOBUSD",
      "price": "0.01922000"
      },
      {
      "symbol": "BNBUPUSDT",
      "price": "61.80000000"
      },
      {
      "symbol": "BNBDOWNUSDT",
      "price": "0.00215100"
      },
      {
      "symbol": "XTZUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XTZDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "AVABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "AVABTC",
      "price": "0.00000698"
      },
      {
      "symbol": "AVABUSD",
      "price": "0.47000000"
      },
      {
      "symbol": "USDTBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "BUSDBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "IOTABUSD",
      "price": "0.14310000"
      },
      {
      "symbol": "MANAUSDT",
      "price": "0.28500000"
      },
      {
      "symbol": "XRPAUD",
      "price": "0.70000000"
      },
      {
      "symbol": "BNBAUD",
      "price": "421.10000000"
      },
      {
      "symbol": "AUDUSDT",
      "price": "0.72520000"
      },
      {
      "symbol": "BALBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BALBTC",
      "price": "0.00003122"
      },
      {
      "symbol": "BALBUSD",
      "price": "3.15000000"
      },
      {
      "symbol": "YFIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "YFIBTC",
      "price": "0.05420000"
      },
      {
      "symbol": "YFIBUSD",
      "price": "5325.00000000"
      },
      {
      "symbol": "YFIUSDT",
      "price": "4594.00000000"
      },
      {
      "symbol": "BLZBUSD",
      "price": "0.05530000"
      },
      {
      "symbol": "KMDBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BALUSDT",
      "price": "0.96700000"
      },
      {
      "symbol": "BLZUSDT",
      "price": "0.05820000"
      },
      {
      "symbol": "IRISUSDT",
      "price": "0.00521000"
      },
      {
      "symbol": "KMDUSDT",
      "price": "0.13290000"
      },
      {
      "symbol": "BTCDAI",
      "price": "84819.25000000"
      },
      {
      "symbol": "ETHDAI",
      "price": "1593.40000000"
      },
      {
      "symbol": "BNBDAI",
      "price": "561.90000000"
      },
      {
      "symbol": "USDTDAI",
      "price": "1.00000000"
      },
      {
      "symbol": "BUSDDAI",
      "price": "1.00000000"
      },
      {
      "symbol": "JSTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "JSTBTC",
      "price": "0.00000036"
      },
      {
      "symbol": "JSTBUSD",
      "price": "0.02103000"
      },
      {
      "symbol": "JSTUSDT",
      "price": "0.03070000"
      },
      {
      "symbol": "SRMBNB",
      "price": "0.00084000"
      },
      {
      "symbol": "SRMBTC",
      "price": "0.00001523"
      },
      {
      "symbol": "SRMBUSD",
      "price": "0.03530000"
      },
      {
      "symbol": "SRMUSDT",
      "price": "0.24442000"
      },
      {
      "symbol": "ANTBNB",
      "price": "0.01764000"
      },
      {
      "symbol": "ANTBTC",
      "price": "0.00014320"
      },
      {
      "symbol": "ANTBUSD",
      "price": "4.30300000"
      },
      {
      "symbol": "ANTUSDT",
      "price": "7.40700000"
      },
      {
      "symbol": "CRVBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "CRVBTC",
      "price": "0.00000720"
      },
      {
      "symbol": "CRVBUSD",
      "price": "0.50410000"
      },
      {
      "symbol": "CRVUSDT",
      "price": "0.61020000"
      },
      {
      "symbol": "SANDBNB",
      "price": "0.00066800"
      },
      {
      "symbol": "SANDBTC",
      "price": "0.00000313"
      },
      {
      "symbol": "SANDUSDT",
      "price": "0.26610000"
      },
      {
      "symbol": "SANDBUSD",
      "price": "0.32610000"
      },
      {
      "symbol": "OCEANBNB",
      "price": "0.00104400"
      },
      {
      "symbol": "OCEANBTC",
      "price": "0.00000964"
      },
      {
      "symbol": "OCEANBUSD",
      "price": "0.28480000"
      },
      {
      "symbol": "OCEANUSDT",
      "price": "0.61230000"
      },
      {
      "symbol": "NMRBTC",
      "price": "0.00008810"
      },
      {
      "symbol": "NMRBUSD",
      "price": "11.43000000"
      },
      {
      "symbol": "NMRUSDT",
      "price": "7.49000000"
      },
      {
      "symbol": "DOTBNB",
      "price": "0.00653000"
      },
      {
      "symbol": "DOTBTC",
      "price": "0.00004580"
      },
      {
      "symbol": "DOTBUSD",
      "price": "7.37300000"
      },
      {
      "symbol": "DOTUSDT",
      "price": "3.88200000"
      },
      {
      "symbol": "LUNABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNABTC",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNABUSD",
      "price": "0.94420000"
      },
      {
      "symbol": "LUNAUSDT",
      "price": "0.16800000"
      },
      {
      "symbol": "IDEXBTC",
      "price": "0.00000035"
      },
      {
      "symbol": "IDEXBUSD",
      "price": "0.04879000"
      },
      {
      "symbol": "RSRBNB",
      "price": "0.00000852"
      },
      {
      "symbol": "RSRBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RSRBUSD",
      "price": "0.00184000"
      },
      {
      "symbol": "RSRUSDT",
      "price": "0.00734300"
      },
      {
      "symbol": "PAXGBNB",
      "price": "6.46900000"
      },
      {
      "symbol": "PAXGBTC",
      "price": "0.03952000"
      },
      {
      "symbol": "PAXGBUSD",
      "price": "1941.00000000"
      },
      {
      "symbol": "PAXGUSDT",
      "price": "3351.00000000"
      },
      {
      "symbol": "WNXMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "WNXMBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "WNXMBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "WNXMUSDT",
      "price": "73.26000000"
      },
      {
      "symbol": "TRBBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TRBBTC",
      "price": "0.00031400"
      },
      {
      "symbol": "TRBBUSD",
      "price": "90.12000000"
      },
      {
      "symbol": "TRBUSDT",
      "price": "26.68000000"
      },
      {
      "symbol": "ETHNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "DOTBIDR",
      "price": "72297.00"
      },
      {
      "symbol": "LINKAUD",
      "price": "7.98600000"
      },
      {
      "symbol": "SXPAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "BZRXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BZRXBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BZRXBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "BZRXUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "WBTCBTC",
      "price": "0.99960000"
      },
      {
      "symbol": "WBTCETH",
      "price": "53.25000000"
      },
      {
      "symbol": "SUSHIBNB",
      "price": "0.00269800"
      },
      {
      "symbol": "SUSHIBTC",
      "price": "0.00000692"
      },
      {
      "symbol": "SUSHIBUSD",
      "price": "0.56600000"
      },
      {
      "symbol": "SUSHIUSDT",
      "price": "0.58700000"
      },
      {
      "symbol": "YFIIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "YFIIBTC",
      "price": "0.07249000"
      },
      {
      "symbol": "YFIIBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "YFIIUSDT",
      "price": "435.50000000"
      },
      {
      "symbol": "KSMBNB",
      "price": "0.09080000"
      },
      {
      "symbol": "KSMBTC",
      "price": "0.00015810"
      },
      {
      "symbol": "KSMBUSD",
      "price": "18.87000000"
      },
      {
      "symbol": "KSMUSDT",
      "price": "13.48000000"
      },
      {
      "symbol": "EGLDBNB",
      "price": "0.02433000"
      },
      {
      "symbol": "EGLDBTC",
      "price": "0.00017050"
      },
      {
      "symbol": "EGLDBUSD",
      "price": "41.53000000"
      },
      {
      "symbol": "EGLDUSDT",
      "price": "14.45000000"
      },
      {
      "symbol": "DIABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "DIABTC",
      "price": "0.00000456"
      },
      {
      "symbol": "DIABUSD",
      "price": "0.23840000"
      },
      {
      "symbol": "DIAUSDT",
      "price": "0.38710000"
      },
      {
      "symbol": "RUNEUSDT",
      "price": "1.17200000"
      },
      {
      "symbol": "FIOUSDT",
      "price": "0.01477000"
      },
      {
      "symbol": "UMABTC",
      "price": "0.00001300"
      },
      {
      "symbol": "UMAUSDT",
      "price": "1.10400000"
      },
      {
      "symbol": "EOSUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "TRXUPUSDT",
      "price": "0.03854000"
      },
      {
      "symbol": "TRXDOWNUSDT",
      "price": "1.13900000"
      },
      {
      "symbol": "XRPUPUSDT",
      "price": "0.08550000"
      },
      {
      "symbol": "XRPDOWNUSDT",
      "price": "0.00008172"
      },
      {
      "symbol": "DOTUPUSDT",
      "price": "0.09600000"
      },
      {
      "symbol": "DOTDOWNUSDT",
      "price": "16.73700000"
      },
      {
      "symbol": "SRMBIDR",
      "price": "0.00"
      },
      {
      "symbol": "ONEBIDR",
      "price": "0.00"
      },
      {
      "symbol": "LINKTRY",
      "price": "494.10000000"
      },
      {
      "symbol": "USDTNGN",
      "price": "1518.40000000"
      },
      {
      "symbol": "BELBNB",
      "price": "0.00253800"
      },
      {
      "symbol": "BELBTC",
      "price": "0.00000543"
      },
      {
      "symbol": "BELBUSD",
      "price": "0.53560000"
      },
      {
      "symbol": "BELUSDT",
      "price": "0.46010000"
      },
      {
      "symbol": "WINGBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "WINGBTC",
      "price": "0.00010930"
      },
      {
      "symbol": "SWRVBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "SWRVBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "WINGBUSD",
      "price": "5.79000000"
      },
      {
      "symbol": "WINGUSDT",
      "price": "1.22500000"
      },
      {
      "symbol": "LTCUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "LENDBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "SXPEUR",
      "price": "0.26540000"
      },
      {
      "symbol": "CREAMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "CREAMBUSD",
      "price": "19.86000000"
      },
      {
      "symbol": "UNIBNB",
      "price": "0.01464000"
      },
      {
      "symbol": "UNIBTC",
      "price": "0.00006210"
      },
      {
      "symbol": "UNIBUSD",
      "price": "4.58000000"
      },
      {
      "symbol": "UNIUSDT",
      "price": "5.27200000"
      },
      {
      "symbol": "NBSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NBSUSDT",
      "price": "0.00166000"
      },
      {
      "symbol": "OXTBTC",
      "price": "0.00000079"
      },
      {
      "symbol": "OXTUSDT",
      "price": "0.06700000"
      },
      {
      "symbol": "SUNBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SUNUSDT",
      "price": "0.01671000"
      },
      {
      "symbol": "AVAXBNB",
      "price": "0.03308000"
      },
      {
      "symbol": "AVAXBTC",
      "price": "0.00023160"
      },
      {
      "symbol": "AVAXBUSD",
      "price": "38.99000000"
      },
      {
      "symbol": "AVAXUSDT",
      "price": "19.64000000"
      },
      {
      "symbol": "HNTBTC",
      "price": "0.00023570"
      },
      {
      "symbol": "HNTUSDT",
      "price": "4.67000000"
      },
      {
      "symbol": "BAKEBNB",
      "price": "0.00060280"
      },
      {
      "symbol": "BURGERBNB",
      "price": "0.00153600"
      },
      {
      "symbol": "SXPBIDR",
      "price": "0.00"
      },
      {
      "symbol": "LINKBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "FLMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "FLMBTC",
      "price": "0.00000026"
      },
      {
      "symbol": "FLMBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "FLMUSDT",
      "price": "0.02300000"
      },
      {
      "symbol": "SCRTBTC",
      "price": "0.00000241"
      },
      {
      "symbol": "SCRTETH",
      "price": "0.00016400"
      },
      {
      "symbol": "CAKEBNB",
      "price": "0.00333200"
      },
      {
      "symbol": "CAKEBUSD",
      "price": "1.54000000"
      },
      {
      "symbol": "SPARTABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "UNIUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "UNIDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "ORNBTC",
      "price": "0.00001586"
      },
      {
      "symbol": "ORNUSDT",
      "price": "1.05300000"
      },
      {
      "symbol": "TRXNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "SXPTRY",
      "price": "8.16900000"
      },
      {
      "symbol": "UTKBTC",
      "price": "0.00000045"
      },
      {
      "symbol": "UTKUSDT",
      "price": "0.03031000"
      },
      {
      "symbol": "XVSBNB",
      "price": "0.00851000"
      },
      {
      "symbol": "XVSBTC",
      "price": "0.00005950"
      },
      {
      "symbol": "XVSBUSD",
      "price": "7.03000000"
      },
      {
      "symbol": "XVSUSDT",
      "price": "5.04000000"
      },
      {
      "symbol": "ALPHABNB",
      "price": "0.00029900"
      },
      {
      "symbol": "ALPHABTC",
      "price": "0.00000035"
      },
      {
      "symbol": "ALPHABUSD",
      "price": "0.07710000"
      },
      {
      "symbol": "ALPHAUSDT",
      "price": "0.03040000"
      },
      {
      "symbol": "VIDTBTC",
      "price": "0.00000002"
      },
      {
      "symbol": "VIDTBUSD",
      "price": "0.02305000"
      },
      {
      "symbol": "AAVEBNB",
      "price": "0.15170000"
      },
      {
      "symbol": "BTCBRL",
      "price": "497233.00000000"
      },
      {
      "symbol": "USDTBRL",
      "price": "5.86300000"
      },
      {
      "symbol": "AAVEBTC",
      "price": "0.00165600"
      },
      {
      "symbol": "AAVEETH",
      "price": "0.08812000"
      },
      {
      "symbol": "AAVEBUSD",
      "price": "93.00000000"
      },
      {
      "symbol": "AAVEUSDT",
      "price": "140.63000000"
      },
      {
      "symbol": "AAVEBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "NEARBNB",
      "price": "0.00367500"
      },
      {
      "symbol": "NEARBTC",
      "price": "0.00002566"
      },
      {
      "symbol": "NEARBUSD",
      "price": "2.24900000"
      },
      {
      "symbol": "NEARUSDT",
      "price": "2.17500000"
      },
      {
      "symbol": "SXPUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "SXPDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "DOTBKRW",
      "price": "0.00000000"
      },
      {
      "symbol": "SXPGBP",
      "price": "0.00000000"
      },
      {
      "symbol": "FILBNB",
      "price": "0.00656000"
      },
      {
      "symbol": "FILBTC",
      "price": "0.00003100"
      },
      {
      "symbol": "FILBUSD",
      "price": "4.55400000"
      },
      {
      "symbol": "FILUSDT",
      "price": "2.63300000"
      },
      {
      "symbol": "FILUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "FILDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "YFIUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "YFIDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "INJBNB",
      "price": "0.01403000"
      },
      {
      "symbol": "INJBTC",
      "price": "0.00009840"
      },
      {
      "symbol": "INJBUSD",
      "price": "25.46400000"
      },
      {
      "symbol": "INJUSDT",
      "price": "8.33000000"
      },
      {
      "symbol": "AERGOBTC",
      "price": "0.00000257"
      },
      {
      "symbol": "AERGOBUSD",
      "price": "0.10030000"
      },
      {
      "symbol": "LINKEUR",
      "price": "11.37000000"
      },
      {
      "symbol": "ONEBUSD",
      "price": "0.01505000"
      },
      {
      "symbol": "EASYETH",
      "price": "0.00000000"
      },
      {
      "symbol": "AUDIOBTC",
      "price": "0.00000076"
      },
      {
      "symbol": "AUDIOBUSD",
      "price": "0.15270000"
      },
      {
      "symbol": "AUDIOUSDT",
      "price": "0.06410000"
      },
      {
      "symbol": "CTKBNB",
      "price": "0.00056200"
      },
      {
      "symbol": "CTKBTC",
      "price": "0.00000394"
      },
      {
      "symbol": "CTKBUSD",
      "price": "0.53400000"
      },
      {
      "symbol": "CTKUSDT",
      "price": "0.33400000"
      },
      {
      "symbol": "BCHUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BCHDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BOTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "BOTBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ETHBRL",
      "price": "9352.90000000"
      },
      {
      "symbol": "DOTEUR",
      "price": "3.40900000"
      },
      {
      "symbol": "AKROBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "AKROUSDT",
      "price": "0.00098100"
      },
      {
      "symbol": "KP3RBNB",
      "price": "0.20250000"
      },
      {
      "symbol": "KP3RBUSD",
      "price": "45.39000000"
      },
      {
      "symbol": "AXSBNB",
      "price": "0.00391000"
      },
      {
      "symbol": "AXSBTC",
      "price": "0.00002740"
      },
      {
      "symbol": "AXSBUSD",
      "price": "5.88000000"
      },
      {
      "symbol": "AXSUSDT",
      "price": "2.32400000"
      },
      {
      "symbol": "HARDBNB",
      "price": "0.00059200"
      },
      {
      "symbol": "HARDBTC",
      "price": "0.00000318"
      },
      {
      "symbol": "HARDBUSD",
      "price": "0.10910000"
      },
      {
      "symbol": "HARDUSDT",
      "price": "0.00950000"
      },
      {
      "symbol": "BNBBRL",
      "price": "3479.00000000"
      },
      {
      "symbol": "LTCEUR",
      "price": "67.16000000"
      },
      {
      "symbol": "RENBTCBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RENBTCETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DNTBUSD",
      "price": "0.03600000"
      },
      {
      "symbol": "DNTUSDT",
      "price": "0.03600000"
      },
      {
      "symbol": "SLPETH",
      "price": "0.00000095"
      },
      {
      "symbol": "ADAEUR",
      "price": "0.54900000"
      },
      {
      "symbol": "LTCNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "CVPETH",
      "price": "0.00032000"
      },
      {
      "symbol": "CVPBUSD",
      "price": "0.34300000"
      },
      {
      "symbol": "STRAXBTC",
      "price": "0.00000072"
      },
      {
      "symbol": "STRAXETH",
      "price": "0.00031880"
      },
      {
      "symbol": "STRAXBUSD",
      "price": "0.47100000"
      },
      {
      "symbol": "STRAXUSDT",
      "price": "0.06095000"
      },
      {
      "symbol": "FORBTC",
      "price": "0.00000006"
      },
      {
      "symbol": "FORBUSD",
      "price": "0.01703000"
      },
      {
      "symbol": "UNFIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "UNFIBTC",
      "price": "0.00001850"
      },
      {
      "symbol": "UNFIBUSD",
      "price": "7.81500000"
      },
      {
      "symbol": "UNFIUSDT",
      "price": "1.34100000"
      },
      {
      "symbol": "FRONTETH",
      "price": "0.00000000"
      },
      {
      "symbol": "FRONTBUSD",
      "price": "0.33220000"
      },
      {
      "symbol": "BCHABUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ROSEBTC",
      "price": "0.00000031"
      },
      {
      "symbol": "ROSEBUSD",
      "price": "0.06826000"
      },
      {
      "symbol": "ROSEUSDT",
      "price": "0.02571000"
      },
      {
      "symbol": "AVAXTRY",
      "price": "748.00000000"
      },
      {
      "symbol": "BUSDBRL",
      "price": "4.99100000"
      },
      {
      "symbol": "AVAUSDT",
      "price": "0.59120000"
      },
      {
      "symbol": "SYSBUSD",
      "price": "0.08180000"
      },
      {
      "symbol": "XEMUSDT",
      "price": "0.01596000"
      },
      {
      "symbol": "HEGICETH",
      "price": "0.00000000"
      },
      {
      "symbol": "HEGICBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "AAVEUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "AAVEDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "PROMBNB",
      "price": "0.01443000"
      },
      {
      "symbol": "PROMBUSD",
      "price": "4.42400000"
      },
      {
      "symbol": "XRPBRL",
      "price": "12.12900000"
      },
      {
      "symbol": "XRPNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "SKLBTC",
      "price": "0.00000025"
      },
      {
      "symbol": "SKLBUSD",
      "price": "0.02150000"
      },
      {
      "symbol": "SKLUSDT",
      "price": "0.02085000"
      },
      {
      "symbol": "BCHEUR",
      "price": "294.40000000"
      },
      {
      "symbol": "YFIEUR",
      "price": "4835.00000000"
      },
      {
      "symbol": "ZILBIDR",
      "price": "253.40"
      },
      {
      "symbol": "SUSDBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SUSDETH",
      "price": "0.00000000"
      },
      {
      "symbol": "SUSDUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "COVERETH",
      "price": "0.00000000"
      },
      {
      "symbol": "COVERBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "GLMBTC",
      "price": "0.00000316"
      },
      {
      "symbol": "GLMETH",
      "price": "0.00015020"
      },
      {
      "symbol": "GHSTETH",
      "price": "0.00081750"
      },
      {
      "symbol": "GHSTBUSD",
      "price": "0.95700000"
      },
      {
      "symbol": "SUSHIUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "SUSHIDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XLMDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "LINKBRL",
      "price": "75.86000000"
      },
      {
      "symbol": "LINKNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "LTCRUB",
      "price": "6383.10000000"
      },
      {
      "symbol": "TRXTRY",
      "price": "9.21000000"
      },
      {
      "symbol": "XLMEUR",
      "price": "0.21430000"
      },
      {
      "symbol": "DFETH",
      "price": "0.00000000"
      },
      {
      "symbol": "DFBUSD",
      "price": "0.03600000"
      },
      {
      "symbol": "GRTBTC",
      "price": "0.00000096"
      },
      {
      "symbol": "GRTETH",
      "price": "0.00005124"
      },
      {
      "symbol": "GRTUSDT",
      "price": "0.08170000"
      },
      {
      "symbol": "JUVBTC",
      "price": "0.00013770"
      },
      {
      "symbol": "JUVBUSD",
      "price": "2.06500000"
      },
      {
      "symbol": "JUVUSDT",
      "price": "0.97400000"
      },
      {
      "symbol": "PSGBTC",
      "price": "0.00006930"
      },
      {
      "symbol": "PSGBUSD",
      "price": "3.01900000"
      },
      {
      "symbol": "PSGUSDT",
      "price": "1.93300000"
      },
      {
      "symbol": "BUSDBVND",
      "price": "0.00"
      },
      {
      "symbol": "USDTBVND",
      "price": "0.00"
      },
      {
      "symbol": "1INCHBTC",
      "price": "0.00000206"
      },
      {
      "symbol": "1INCHUSDT",
      "price": "0.17450000"
      },
      {
      "symbol": "REEFBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "REEFUSDT",
      "price": "0.00068800"
      },
      {
      "symbol": "OGBTC",
      "price": "0.00004560"
      },
      {
      "symbol": "OGUSDT",
      "price": "3.87100000"
      },
      {
      "symbol": "ATMBTC",
      "price": "0.00009440"
      },
      {
      "symbol": "ATMUSDT",
      "price": "1.06900000"
      },
      {
      "symbol": "ASRBTC",
      "price": "0.00013390"
      },
      {
      "symbol": "ASRUSDT",
      "price": "1.06700000"
      },
      {
      "symbol": "CELOBTC",
      "price": "0.00000363"
      },
      {
      "symbol": "CELOUSDT",
      "price": "0.30700000"
      },
      {
      "symbol": "RIFBTC",
      "price": "0.00000050"
      },
      {
      "symbol": "RIFUSDT",
      "price": "0.04250000"
      },
      {
      "symbol": "CHZTRY",
      "price": "1.43300000"
      },
      {
      "symbol": "XLMTRY",
      "price": "9.31400000"
      },
      {
      "symbol": "LINKGBP",
      "price": "13.17300000"
      },
      {
      "symbol": "GRTEUR",
      "price": "0.07170000"
      },
      {
      "symbol": "BTCSTBTC",
      "price": "0.00033100"
      },
      {
      "symbol": "BTCSTBUSD",
      "price": "1.16000000"
      },
      {
      "symbol": "BTCSTUSDT",
      "price": "5.35000000"
      },
      {
      "symbol": "TRUBTC",
      "price": "0.00000040"
      },
      {
      "symbol": "TRUBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "TRUUSDT",
      "price": "0.03360000"
      },
      {
      "symbol": "DEXEETH",
      "price": "0.00137800"
      },
      {
      "symbol": "DEXEBUSD",
      "price": "2.10000000"
      },
      {
      "symbol": "EOSEUR",
      "price": "0.76200000"
      },
      {
      "symbol": "LTCBRL",
      "price": "447.60000000"
      },
      {
      "symbol": "USDCBUSD",
      "price": "0.99990000"
      },
      {
      "symbol": "TUSDBUSD",
      "price": "0.99660000"
      },
      {
      "symbol": "PAXBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "CKBBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CKBBUSD",
      "price": "0.00265000"
      },
      {
      "symbol": "CKBUSDT",
      "price": "0.00449200"
      },
      {
      "symbol": "TWTBTC",
      "price": "0.00001229"
      },
      {
      "symbol": "TWTBUSD",
      "price": "0.79240000"
      },
      {
      "symbol": "TWTUSDT",
      "price": "0.77380000"
      },
      {
      "symbol": "FIROBTC",
      "price": "0.00002005"
      },
      {
      "symbol": "FIROETH",
      "price": "0.00000000"
      },
      {
      "symbol": "FIROUSDT",
      "price": "0.30000000"
      },
      {
      "symbol": "BETHETH",
      "price": "0.99960000"
      },
      {
      "symbol": "DOGEEUR",
      "price": "0.13778000"
      },
      {
      "symbol": "DOGETRY",
      "price": "5.98200000"
      },
      {
      "symbol": "DOGEAUD",
      "price": "0.09449000"
      },
      {
      "symbol": "DOGEBRL",
      "price": "0.92060000"
      },
      {
      "symbol": "DOTNGN",
      "price": "0.00000000"
      },
      {
      "symbol": "PROSETH",
      "price": "0.00021600"
      },
      {
      "symbol": "LITBTC",
      "price": "0.00000775"
      },
      {
      "symbol": "LITBUSD",
      "price": "0.81200000"
      },
      {
      "symbol": "LITUSDT",
      "price": "0.74300000"
      },
      {
      "symbol": "BTCVAI",
      "price": "0.00000000"
      },
      {
      "symbol": "BUSDVAI",
      "price": "1.01500000"
      },
      {
      "symbol": "SFPBTC",
      "price": "0.00000555"
      },
      {
      "symbol": "SFPBUSD",
      "price": "0.59920000"
      },
      {
      "symbol": "SFPUSDT",
      "price": "0.46820000"
      },
      {
      "symbol": "DOGEGBP",
      "price": "0.07759000"
      },
      {
      "symbol": "DOTTRY",
      "price": "148.00000000"
      },
      {
      "symbol": "FXSBTC",
      "price": "0.00002740"
      },
      {
      "symbol": "FXSBUSD",
      "price": "6.96400000"
      },
      {
      "symbol": "DODOBTC",
      "price": "0.00000051"
      },
      {
      "symbol": "DODOBUSD",
      "price": "0.12330000"
      },
      {
      "symbol": "DODOUSDT",
      "price": "0.04320000"
      },
      {
      "symbol": "FRONTBTC",
      "price": "0.00001405"
      },
      {
      "symbol": "EASYBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "CAKEBTC",
      "price": "0.00002325"
      },
      {
      "symbol": "CAKEUSDT",
      "price": "1.97300000"
      },
      {
      "symbol": "BAKEBUSD",
      "price": "0.14260000"
      },
      {
      "symbol": "UFTETH",
      "price": "0.00016940"
      },
      {
      "symbol": "UFTBUSD",
      "price": "0.20610000"
      },
      {
      "symbol": "1INCHBUSD",
      "price": "0.25190000"
      },
      {
      "symbol": "BANDBUSD",
      "price": "1.53900000"
      },
      {
      "symbol": "GRTBUSD",
      "price": "0.10520000"
      },
      {
      "symbol": "IOSTBUSD",
      "price": "0.00700000"
      },
      {
      "symbol": "OMGBUSD",
      "price": "0.46600000"
      },
      {
      "symbol": "REEFBUSD",
      "price": "0.00139400"
      },
      {
      "symbol": "ACMBTC",
      "price": "0.00009050"
      },
      {
      "symbol": "ACMBUSD",
      "price": "2.07300000"
      },
      {
      "symbol": "ACMUSDT",
      "price": "0.78900000"
      },
      {
      "symbol": "AUCTIONBTC",
      "price": "0.00013430"
      },
      {
      "symbol": "AUCTIONBUSD",
      "price": "8.04000000"
      },
      {
      "symbol": "PHABTC",
      "price": "0.00000119"
      },
      {
      "symbol": "PHABUSD",
      "price": "0.10340000"
      },
      {
      "symbol": "DOTGBP",
      "price": "3.01500000"
      },
      {
      "symbol": "ADATRY",
      "price": "23.81000000"
      },
      {
      "symbol": "ADABRL",
      "price": "3.64900000"
      },
      {
      "symbol": "ADAGBP",
      "price": "0.51300000"
      },
      {
      "symbol": "TVKBTC",
      "price": "0.00000145"
      },
      {
      "symbol": "TVKBUSD",
      "price": "0.02043000"
      },
      {
      "symbol": "BADGERBTC",
      "price": "0.00000903"
      },
      {
      "symbol": "BADGERBUSD",
      "price": "2.07900000"
      },
      {
      "symbol": "BADGERUSDT",
      "price": "0.76200000"
      },
      {
      "symbol": "FISBTC",
      "price": "0.00000161"
      },
      {
      "symbol": "FISBUSD",
      "price": "0.24380000"
      },
      {
      "symbol": "FISUSDT",
      "price": "0.13610000"
      },
      {
      "symbol": "DOTBRL",
      "price": "22.76000000"
      },
      {
      "symbol": "ADAAUD",
      "price": "0.50540000"
      },
      {
      "symbol": "HOTTRY",
      "price": "0.03678000"
      },
      {
      "symbol": "EGLDEUR",
      "price": "12.66000000"
      },
      {
      "symbol": "OMBTC",
      "price": "0.00000715"
      },
      {
      "symbol": "OMBUSD",
      "price": "0.01891000"
      },
      {
      "symbol": "OMUSDT",
      "price": "0.60620000"
      },
      {
      "symbol": "PONDBTC",
      "price": "0.00000010"
      },
      {
      "symbol": "PONDBUSD",
      "price": "0.00936000"
      },
      {
      "symbol": "PONDUSDT",
      "price": "0.00830000"
      },
      {
      "symbol": "DEGOBTC",
      "price": "0.00003540"
      },
      {
      "symbol": "DEGOBUSD",
      "price": "1.34700000"
      },
      {
      "symbol": "DEGOUSDT",
      "price": "1.85600000"
      },
      {
      "symbol": "AVAXEUR",
      "price": "17.21000000"
      },
      {
      "symbol": "BTTTRY",
      "price": "0.00000000"
      },
      {
      "symbol": "CHZBRL",
      "price": "0.30210000"
      },
      {
      "symbol": "UNIEUR",
      "price": "4.85600000"
      },
      {
      "symbol": "ALICEBTC",
      "price": "0.00000631"
      },
      {
      "symbol": "ALICEBUSD",
      "price": "0.72600000"
      },
      {
      "symbol": "ALICEUSDT",
      "price": "0.41900000"
      },
      {
      "symbol": "CHZBUSD",
      "price": "0.07460000"
      },
      {
      "symbol": "CHZEUR",
      "price": "0.05300000"
      },
      {
      "symbol": "CHZGBP",
      "price": "0.05720000"
      },
      {
      "symbol": "BIFIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BIFIBUSD",
      "price": "359.60000000"
      },
      {
      "symbol": "LINABTC",
      "price": "0.00000008"
      },
      {
      "symbol": "LINABUSD",
      "price": "0.01013100"
      },
      {
      "symbol": "LINAUSDT",
      "price": "0.00033700"
      },
      {
      "symbol": "ADARUB",
      "price": "34.49000000"
      },
      {
      "symbol": "ENJBRL",
      "price": "1.32800000"
      },
      {
      "symbol": "ENJEUR",
      "price": "0.19460000"
      },
      {
      "symbol": "MATICEUR",
      "price": "0.34440000"
      },
      {
      "symbol": "NEOTRY",
      "price": "213.40000000"
      },
      {
      "symbol": "PERPBTC",
      "price": "0.00000430"
      },
      {
      "symbol": "PERPBUSD",
      "price": "0.54698000"
      },
      {
      "symbol": "PERPUSDT",
      "price": "0.24140000"
      },
      {
      "symbol": "RAMPBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RAMPBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "RAMPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "SUPERBTC",
      "price": "0.00000639"
      },
      {
      "symbol": "SUPERBUSD",
      "price": "0.07270000"
      },
      {
      "symbol": "SUPERUSDT",
      "price": "0.54300000"
      },
      {
      "symbol": "CFXBTC",
      "price": "0.00000084"
      },
      {
      "symbol": "CFXBUSD",
      "price": "0.15400000"
      },
      {
      "symbol": "CFXUSDT",
      "price": "0.07070000"
      },
      {
      "symbol": "ENJGBP",
      "price": "0.36760000"
      },
      {
      "symbol": "EOSTRY",
      "price": "24.10000000"
      },
      {
      "symbol": "LTCGBP",
      "price": "63.56000000"
      },
      {
      "symbol": "LUNAEUR",
      "price": "0.00000000"
      },
      {
      "symbol": "RVNTRY",
      "price": "0.41720000"
      },
      {
      "symbol": "THETAEUR",
      "price": "0.61400000"
      },
      {
      "symbol": "XVGBUSD",
      "price": "0.00365100"
      },
      {
      "symbol": "EPSBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "EPSBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "EPSUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "AUTOBTC",
      "price": "0.00324000"
      },
      {
      "symbol": "AUTOBUSD",
      "price": "95.10000000"
      },
      {
      "symbol": "AUTOUSDT",
      "price": "95.30000000"
      },
      {
      "symbol": "TKOBTC",
      "price": "0.00000397"
      },
      {
      "symbol": "TKOBIDR",
      "price": "3360.00"
      },
      {
      "symbol": "TKOBUSD",
      "price": "0.20820000"
      },
      {
      "symbol": "TKOUSDT",
      "price": "0.15080000"
      },
      {
      "symbol": "PUNDIXETH",
      "price": "0.00016660"
      },
      {
      "symbol": "PUNDIXUSDT",
      "price": "0.29060000"
      },
      {
      "symbol": "BTTBRL",
      "price": "0.00000000"
      },
      {
      "symbol": "BTTEUR",
      "price": "0.00000000"
      },
      {
      "symbol": "HOTEUR",
      "price": "0.00178900"
      },
      {
      "symbol": "WINEUR",
      "price": "0.00004197"
      },
      {
      "symbol": "TLMBTC",
      "price": "0.00000006"
      },
      {
      "symbol": "TLMBUSD",
      "price": "0.00941000"
      },
      {
      "symbol": "TLMUSDT",
      "price": "0.00503000"
      },
      {
      "symbol": "1INCHUPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "1INCHDOWNUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BTGBUSD",
      "price": "17.62000000"
      },
      {
      "symbol": "BTGUSDT",
      "price": "17.65000000"
      },
      {
      "symbol": "HOTBUSD",
      "price": "0.00105800"
      },
      {
      "symbol": "BNBUAH",
      "price": "26372.00000000"
      },
      {
      "symbol": "ONTTRY",
      "price": "5.60200000"
      },
      {
      "symbol": "VETEUR",
      "price": "0.02049000"
      },
      {
      "symbol": "VETGBP",
      "price": "0.01430000"
      },
      {
      "symbol": "WINBRL",
      "price": "0.00065760"
      },
      {
      "symbol": "MIRBTC",
      "price": "0.00000838"
      },
      {
      "symbol": "MIRBUSD",
      "price": "0.13237000"
      },
      {
      "symbol": "MIRUSDT",
      "price": "0.14168000"
      },
      {
      "symbol": "BARBTC",
      "price": "0.00014100"
      },
      {
      "symbol": "BARBUSD",
      "price": "2.53300000"
      },
      {
      "symbol": "BARUSDT",
      "price": "1.63600000"
      },
      {
      "symbol": "FORTHBTC",
      "price": "0.00002899"
      },
      {
      "symbol": "FORTHBUSD",
      "price": "3.02700000"
      },
      {
      "symbol": "FORTHUSDT",
      "price": "2.45800000"
      },
      {
      "symbol": "CAKEGBP",
      "price": "2.71400000"
      },
      {
      "symbol": "DOGERUB",
      "price": "6.94000000"
      },
      {
      "symbol": "HOTBRL",
      "price": "0.00000000"
      },
      {
      "symbol": "WRXEUR",
      "price": "0.00000000"
      },
      {
      "symbol": "EZBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "EZETH",
      "price": "0.00000000"
      },
      {
      "symbol": "BAKEUSDT",
      "price": "0.12430000"
      },
      {
      "symbol": "BURGERBUSD",
      "price": "0.32080000"
      },
      {
      "symbol": "BURGERUSDT",
      "price": "0.01720000"
      },
      {
      "symbol": "SLPBUSD",
      "price": "0.00148700"
      },
      {
      "symbol": "SLPUSDT",
      "price": "0.00152200"
      },
      {
      "symbol": "TRXAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "TRXEUR",
      "price": "0.21220000"
      },
      {
      "symbol": "VETTRY",
      "price": "0.89030000"
      },
      {
      "symbol": "SHIBUSDT",
      "price": "0.00001238"
      },
      {
      "symbol": "SHIBBUSD",
      "price": "0.00000931"
      },
      {
      "symbol": "ICPBTC",
      "price": "0.00005740"
      },
      {
      "symbol": "ICPBNB",
      "price": "0.01680000"
      },
      {
      "symbol": "ICPBUSD",
      "price": "3.89700000"
      },
      {
      "symbol": "ICPUSDT",
      "price": "4.87400000"
      },
      {
      "symbol": "SHIBEUR",
      "price": "0.00001086"
      },
      {
      "symbol": "SHIBRUB",
      "price": "0.00000000"
      },
      {
      "symbol": "ETCEUR",
      "price": "20.00000000"
      },
      {
      "symbol": "ETCBRL",
      "price": "0.00000000"
      },
      {
      "symbol": "DOGEBIDR",
      "price": "955.00"
      },
      {
      "symbol": "ARBTC",
      "price": "0.00006550"
      },
      {
      "symbol": "ARBNB",
      "price": "0.02183000"
      },
      {
      "symbol": "ARBUSD",
      "price": "3.85200000"
      },
      {
      "symbol": "ARUSDT",
      "price": "5.55000000"
      },
      {
      "symbol": "POLSBTC",
      "price": "0.00001859"
      },
      {
      "symbol": "POLSBNB",
      "price": "0.00265000"
      },
      {
      "symbol": "POLSBUSD",
      "price": "0.25670000"
      },
      {
      "symbol": "POLSUSDT",
      "price": "0.30790000"
      },
      {
      "symbol": "MDXBTC",
      "price": "0.00000077"
      },
      {
      "symbol": "MDXBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MDXBUSD",
      "price": "0.06440000"
      },
      {
      "symbol": "MDXUSDT",
      "price": "0.03450000"
      },
      {
      "symbol": "MASKBNB",
      "price": "0.00180800"
      },
      {
      "symbol": "MASKBUSD",
      "price": "3.58700000"
      },
      {
      "symbol": "MASKUSDT",
      "price": "1.08800000"
      },
      {
      "symbol": "LPTBTC",
      "price": "0.00004850"
      },
      {
      "symbol": "LPTBNB",
      "price": "0.00691000"
      },
      {
      "symbol": "LPTBUSD",
      "price": "6.16000000"
      },
      {
      "symbol": "LPTUSDT",
      "price": "4.11200000"
      },
      {
      "symbol": "ETHUAH",
      "price": "97990.00000000"
      },
      {
      "symbol": "MATICBRL",
      "price": "2.12500000"
      },
      {
      "symbol": "SOLEUR",
      "price": "122.53000000"
      },
      {
      "symbol": "SHIBBRL",
      "price": "0.00007237"
      },
      {
      "symbol": "AGIXBTC",
      "price": "0.00000969"
      },
      {
      "symbol": "ICPEUR",
      "price": "4.27400000"
      },
      {
      "symbol": "MATICGBP",
      "price": "0.81900000"
      },
      {
      "symbol": "SHIBTRY",
      "price": "0.00047160"
      },
      {
      "symbol": "MATICBIDR",
      "price": "8382.00"
      },
      {
      "symbol": "MATICRUB",
      "price": "76.47000000"
      },
      {
      "symbol": "NUBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "NUBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "NUBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "NUUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "XVGUSDT",
      "price": "0.00450200"
      },
      {
      "symbol": "RLCBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "CELRBUSD",
      "price": "0.01148000"
      },
      {
      "symbol": "ATMBUSD",
      "price": "2.42000000"
      },
      {
      "symbol": "ZENBUSD",
      "price": "7.19000000"
      },
      {
      "symbol": "FTMBUSD",
      "price": "0.42180000"
      },
      {
      "symbol": "THETABUSD",
      "price": "0.61600000"
      },
      {
      "symbol": "WINBUSD",
      "price": "0.00006940"
      },
      {
      "symbol": "KAVABUSD",
      "price": "0.62400000"
      },
      {
      "symbol": "XEMBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ATABTC",
      "price": "0.00000068"
      },
      {
      "symbol": "ATABNB",
      "price": "0.00036900"
      },
      {
      "symbol": "ATABUSD",
      "price": "0.07920000"
      },
      {
      "symbol": "ATAUSDT",
      "price": "0.05690000"
      },
      {
      "symbol": "GTCBTC",
      "price": "0.00000688"
      },
      {
      "symbol": "GTCBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "GTCBUSD",
      "price": "0.95200000"
      },
      {
      "symbol": "GTCUSDT",
      "price": "0.28000000"
      },
      {
      "symbol": "TORNBTC",
      "price": "0.00023980"
      },
      {
      "symbol": "TORNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TORNBUSD",
      "price": "1.69000000"
      },
      {
      "symbol": "TORNUSDT",
      "price": "4.06000000"
      },
      {
      "symbol": "MATICTRY",
      "price": "12.92000000"
      },
      {
      "symbol": "ETCGBP",
      "price": "0.00000000"
      },
      {
      "symbol": "SOLGBP",
      "price": "88.08000000"
      },
      {
      "symbol": "BAKEBTC",
      "price": "0.00000146"
      },
      {
      "symbol": "COTIBUSD",
      "price": "0.03732000"
      },
      {
      "symbol": "KEEPBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "KEEPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "KEEPBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "KEEPUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "SOLTRY",
      "price": "5317.10000000"
      },
      {
      "symbol": "RUNEGBP",
      "price": "1.27800000"
      },
      {
      "symbol": "SOLBRL",
      "price": "818.00000000"
      },
      {
      "symbol": "SCBUSD",
      "price": "0.00366400"
      },
      {
      "symbol": "CHRBUSD",
      "price": "0.10850000"
      },
      {
      "symbol": "STMXBUSD",
      "price": "0.00585100"
      },
      {
      "symbol": "HNTBUSD",
      "price": "1.22800000"
      },
      {
      "symbol": "FTTBUSD",
      "price": "1.13000000"
      },
      {
      "symbol": "DOCKBUSD",
      "price": "0.01527000"
      },
      {
      "symbol": "ADABIDR",
      "price": "3965.00"
      },
      {
      "symbol": "ERNBNB",
      "price": "0.00669000"
      },
      {
      "symbol": "ERNBUSD",
      "price": "1.47100000"
      },
      {
      "symbol": "ERNUSDT",
      "price": "2.18300000"
      },
      {
      "symbol": "KLAYBTC",
      "price": "0.00000185"
      },
      {
      "symbol": "KLAYBNB",
      "price": "0.00061800"
      },
      {
      "symbol": "KLAYBUSD",
      "price": "0.13540000"
      },
      {
      "symbol": "KLAYUSDT",
      "price": "0.12550000"
      },
      {
      "symbol": "RUNEEUR",
      "price": "3.76200000"
      },
      {
      "symbol": "MATICAUD",
      "price": "1.21410000"
      },
      {
      "symbol": "DOTRUB",
      "price": "493.50000000"
      },
      {
      "symbol": "UTKBUSD",
      "price": "0.05610000"
      },
      {
      "symbol": "IOTXBUSD",
      "price": "0.02148000"
      },
      {
      "symbol": "PHAUSDT",
      "price": "0.10060000"
      },
      {
      "symbol": "SOLRUB",
      "price": "5467.00000000"
      },
      {
      "symbol": "RUNEAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "BUSDUAH",
      "price": "41.12000000"
      },
      {
      "symbol": "BONDBTC",
      "price": "0.00003108"
      },
      {
      "symbol": "BONDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BONDBUSD",
      "price": "4.26200000"
      },
      {
      "symbol": "BONDUSDT",
      "price": "2.15200000"
      },
      {
      "symbol": "MLNBTC",
      "price": "0.00011280"
      },
      {
      "symbol": "MLNBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MLNBUSD",
      "price": "15.73000000"
      },
      {
      "symbol": "MLNUSDT",
      "price": "8.54000000"
      },
      {
      "symbol": "GRTTRY",
      "price": "3.10800000"
      },
      {
      "symbol": "CAKEBRL",
      "price": "0.00000000"
      },
      {
      "symbol": "ICPRUB",
      "price": "0.00000000"
      },
      {
      "symbol": "DOTAUD",
      "price": "6.63100000"
      },
      {
      "symbol": "AAVEBRL",
      "price": "0.00000000"
      },
      {
      "symbol": "EOSAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "DEXEUSDT",
      "price": "15.06100000"
      },
      {
      "symbol": "LTOBUSD",
      "price": "0.05590000"
      },
      {
      "symbol": "ADXBUSD",
      "price": "0.13340000"
      },
      {
      "symbol": "QUICKBTC",
      "price": "0.00000074"
      },
      {
      "symbol": "QUICKBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "QUICKBUSD",
      "price": "74.10000000"
      },
      {
      "symbol": "C98USDT",
      "price": "0.05510000"
      },
      {
      "symbol": "C98BUSD",
      "price": "0.13430000"
      },
      {
      "symbol": "C98BNB",
      "price": "0.00080500"
      },
      {
      "symbol": "C98BTC",
      "price": "0.00000162"
      },
      {
      "symbol": "CLVBTC",
      "price": "0.00000029"
      },
      {
      "symbol": "CLVBNB",
      "price": "0.00026430"
      },
      {
      "symbol": "CLVBUSD",
      "price": "0.03282000"
      },
      {
      "symbol": "CLVUSDT",
      "price": "0.02937000"
      },
      {
      "symbol": "QNTBTC",
      "price": "0.00077200"
      },
      {
      "symbol": "QNTBNB",
      "price": "0.40150000"
      },
      {
      "symbol": "QNTBUSD",
      "price": "85.50000000"
      },
      {
      "symbol": "QNTUSDT",
      "price": "65.60000000"
      },
      {
      "symbol": "FLOWBTC",
      "price": "0.00000436"
      },
      {
      "symbol": "FLOWBNB",
      "price": "0.00247400"
      },
      {
      "symbol": "FLOWBUSD",
      "price": "0.51300000"
      },
      {
      "symbol": "FLOWUSDT",
      "price": "0.37000000"
      },
      {
      "symbol": "XECBUSD",
      "price": "0.00003100"
      },
      {
      "symbol": "AXSBRL",
      "price": "38.36000000"
      },
      {
      "symbol": "AXSAUD",
      "price": "8.66000000"
      },
      {
      "symbol": "TVKUSDT",
      "price": "0.05405000"
      },
      {
      "symbol": "MINABTC",
      "price": "0.00000255"
      },
      {
      "symbol": "MINABNB",
      "price": "0.00166600"
      },
      {
      "symbol": "MINABUSD",
      "price": "0.37790000"
      },
      {
      "symbol": "MINAUSDT",
      "price": "0.21640000"
      },
      {
      "symbol": "RAYBNB",
      "price": "0.00386800"
      },
      {
      "symbol": "RAYBUSD",
      "price": "0.17010000"
      },
      {
      "symbol": "RAYUSDT",
      "price": "2.20800000"
      },
      {
      "symbol": "FARMBTC",
      "price": "0.00075100"
      },
      {
      "symbol": "FARMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "FARMBUSD",
      "price": "21.12000000"
      },
      {
      "symbol": "FARMUSDT",
      "price": "29.47000000"
      },
      {
      "symbol": "ALPACABTC",
      "price": "0.00000234"
      },
      {
      "symbol": "ALPACABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ALPACABUSD",
      "price": "0.14390000"
      },
      {
      "symbol": "ALPACAUSDT",
      "price": "0.05480000"
      },
      {
      "symbol": "TLMTRY",
      "price": "0.19220000"
      },
      {
      "symbol": "QUICKUSDT",
      "price": "0.02690000"
      },
      {
      "symbol": "ORNBUSD",
      "price": "0.55190000"
      },
      {
      "symbol": "MBOXBTC",
      "price": "0.00000102"
      },
      {
      "symbol": "MBOXBNB",
      "price": "0.00069200"
      },
      {
      "symbol": "MBOXBUSD",
      "price": "0.20900000"
      },
      {
      "symbol": "MBOXUSDT",
      "price": "0.04810000"
      },
      {
      "symbol": "VGXBTC",
      "price": "0.00002524"
      },
      {
      "symbol": "VGXETH",
      "price": "0.00034800"
      },
      {
      "symbol": "FORUSDT",
      "price": "0.00306000"
      },
      {
      "symbol": "REQUSDT",
      "price": "0.10600000"
      },
      {
      "symbol": "GHSTUSDT",
      "price": "0.47400000"
      },
      {
      "symbol": "TRURUB",
      "price": "2.98000000"
      },
      {
      "symbol": "FISBRL",
      "price": "1.78100000"
      },
      {
      "symbol": "WAXPUSDT",
      "price": "0.02433000"
      },
      {
      "symbol": "WAXPBUSD",
      "price": "0.04170000"
      },
      {
      "symbol": "WAXPBNB",
      "price": "0.00017060"
      },
      {
      "symbol": "WAXPBTC",
      "price": "0.00000029"
      },
      {
      "symbol": "TRIBEBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "TRIBEBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "TRIBEBUSD",
      "price": "0.20570000"
      },
      {
      "symbol": "TRIBEUSDT",
      "price": "0.20180000"
      },
      {
      "symbol": "GNOUSDT",
      "price": "107.80000000"
      },
      {
      "symbol": "GNOBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "GNOBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "GNOBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ARPATRY",
      "price": "0.83720000"
      },
      {
      "symbol": "PROMBTC",
      "price": "0.00008960"
      },
      {
      "symbol": "MTLBUSD",
      "price": "1.35300000"
      },
      {
      "symbol": "OGNBUSD",
      "price": "0.11290000"
      },
      {
      "symbol": "XECUSDT",
      "price": "0.00002035"
      },
      {
      "symbol": "C98BRL",
      "price": "1.30800000"
      },
      {
      "symbol": "SOLAUD",
      "price": "28.48000000"
      },
      {
      "symbol": "XRPBIDR",
      "price": "7835.00"
      },
      {
      "symbol": "POLYBUSD",
      "price": "0.27000000"
      },
      {
      "symbol": "ELFUSDT",
      "price": "0.22720000"
      },
      {
      "symbol": "DYDXUSDT",
      "price": "0.59110000"
      },
      {
      "symbol": "DYDXBUSD",
      "price": "3.77100000"
      },
      {
      "symbol": "DYDXBNB",
      "price": "0.00333300"
      },
      {
      "symbol": "DYDXBTC",
      "price": "0.00000697"
      },
      {
      "symbol": "ELFBUSD",
      "price": "0.34030000"
      },
      {
      "symbol": "POLYUSDT",
      "price": "0.26960000"
      },
      {
      "symbol": "IDEXUSDT",
      "price": "0.02286000"
      },
      {
      "symbol": "VIDTUSDT",
      "price": "0.00115000"
      },
      {
      "symbol": "SOLBIDR",
      "price": "311087.00"
      },
      {
      "symbol": "AXSBIDR",
      "price": "72500.00"
      },
      {
      "symbol": "BTCUSDP",
      "price": "19435.03000000"
      },
      {
      "symbol": "ETHUSDP",
      "price": "1344.37000000"
      },
      {
      "symbol": "BNBUSDP",
      "price": "282.09000000"
      },
      {
      "symbol": "USDPBUSD",
      "price": "1.00000000"
      },
      {
      "symbol": "USDPUSDT",
      "price": "0.99990000"
      },
      {
      "symbol": "GALAUSDT",
      "price": "0.01539000"
      },
      {
      "symbol": "GALABUSD",
      "price": "0.02957000"
      },
      {
      "symbol": "GALABNB",
      "price": "0.00002877"
      },
      {
      "symbol": "GALABTC",
      "price": "0.00000019"
      },
      {
      "symbol": "FTMBIDR",
      "price": "3413.00"
      },
      {
      "symbol": "ALGOBIDR",
      "price": "0.00"
      },
      {
      "symbol": "CAKEAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "KSMAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "WAVESRUB",
      "price": "0.00000000"
      },
      {
      "symbol": "SUNBUSD",
      "price": "0.00544000"
      },
      {
      "symbol": "ILVUSDT",
      "price": "13.07000000"
      },
      {
      "symbol": "ILVBUSD",
      "price": "39.06000000"
      },
      {
      "symbol": "ILVBNB",
      "price": "0.17900000"
      },
      {
      "symbol": "ILVBTC",
      "price": "0.00015300"
      },
      {
      "symbol": "RENBUSD",
      "price": "0.04539800"
      },
      {
      "symbol": "YGGUSDT",
      "price": "0.17790000"
      },
      {
      "symbol": "YGGBUSD",
      "price": "0.40530000"
      },
      {
      "symbol": "YGGBNB",
      "price": "0.00068700"
      },
      {
      "symbol": "YGGBTC",
      "price": "0.00000209"
      },
      {
      "symbol": "STXBUSD",
      "price": "0.67560000"
      },
      {
      "symbol": "SYSUSDT",
      "price": "0.03890000"
      },
      {
      "symbol": "DFUSDT",
      "price": "0.05835000"
      },
      {
      "symbol": "SOLUSDC",
      "price": "139.55000000"
      },
      {
      "symbol": "ARPARUB",
      "price": "4.92800000"
      },
      {
      "symbol": "LTCUAH",
      "price": "3191.00000000"
      },
      {
      "symbol": "FETBUSD",
      "price": "0.49150000"
      },
      {
      "symbol": "ARPABUSD",
      "price": "0.04660000"
      },
      {
      "symbol": "LSKBUSD",
      "price": "0.84400000"
      },
      {
      "symbol": "AVAXBIDR",
      "price": "266752.00"
      },
      {
      "symbol": "ALICEBIDR",
      "price": "29103.00"
      },
      {
      "symbol": "FIDAUSDT",
      "price": "0.07370000"
      },
      {
      "symbol": "FIDABUSD",
      "price": "0.17820000"
      },
      {
      "symbol": "FIDABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "FIDABTC",
      "price": "0.00000088"
      },
      {
      "symbol": "DENTBUSD",
      "price": "0.00070700"
      },
      {
      "symbol": "FRONTUSDT",
      "price": "0.88000000"
      },
      {
      "symbol": "CVPUSDT",
      "price": "0.03390000"
      },
      {
      "symbol": "AGLDBTC",
      "price": "0.00001028"
      },
      {
      "symbol": "AGLDBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "AGLDBUSD",
      "price": "0.82700000"
      },
      {
      "symbol": "AGLDUSDT",
      "price": "0.87500000"
      },
      {
      "symbol": "RADBTC",
      "price": "0.00001387"
      },
      {
      "symbol": "RADBNB",
      "price": "0.01032000"
      },
      {
      "symbol": "RADBUSD",
      "price": "1.32100000"
      },
      {
      "symbol": "RADUSDT",
      "price": "0.74700000"
      },
      {
      "symbol": "UNIAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "HIVEBUSD",
      "price": "0.27580000"
      },
      {
      "symbol": "STPTBUSD",
      "price": "0.04185000"
      },
      {
      "symbol": "BETABTC",
      "price": "0.00000067"
      },
      {
      "symbol": "BETABNB",
      "price": "0.00033500"
      },
      {
      "symbol": "BETABUSD",
      "price": "0.06354000"
      },
      {
      "symbol": "BETAUSDT",
      "price": "0.00036000"
      },
      {
      "symbol": "SHIBAUD",
      "price": "0.00001121"
      },
      {
      "symbol": "RAREBTC",
      "price": "0.00000070"
      },
      {
      "symbol": "RAREBNB",
      "price": "0.00069100"
      },
      {
      "symbol": "RAREBUSD",
      "price": "0.05960000"
      },
      {
      "symbol": "RAREUSDT",
      "price": "0.05890000"
      },
      {
      "symbol": "AVAXBRL",
      "price": "115.00000000"
      },
      {
      "symbol": "AVAXAUD",
      "price": "17.91000000"
      },
      {
      "symbol": "LUNAAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "TROYBUSD",
      "price": "0.00226900"
      },
      {
      "symbol": "AXSETH",
      "price": "0.00145700"
      },
      {
      "symbol": "FTMETH",
      "price": "0.00021480"
      },
      {
      "symbol": "SOLETH",
      "price": "0.08743000"
      },
      {
      "symbol": "SSVBTC",
      "price": "0.00006740"
      },
      {
      "symbol": "SSVETH",
      "price": "0.00358600"
      },
      {
      "symbol": "LAZIOTRY",
      "price": "36.26000000"
      },
      {
      "symbol": "LAZIOEUR",
      "price": "2.54800000"
      },
      {
      "symbol": "LAZIOBTC",
      "price": "0.00003995"
      },
      {
      "symbol": "LAZIOUSDT",
      "price": "0.95300000"
      },
      {
      "symbol": "CHESSBTC",
      "price": "0.00000272"
      },
      {
      "symbol": "CHESSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "CHESSBUSD",
      "price": "0.12000000"
      },
      {
      "symbol": "CHESSUSDT",
      "price": "0.06100000"
      },
      {
      "symbol": "FTMAUD",
      "price": "0.42000000"
      },
      {
      "symbol": "FTMBRL",
      "price": "1.92300000"
      },
      {
      "symbol": "SCRTBUSD",
      "price": "0.26290000"
      },
      {
      "symbol": "ADXUSDT",
      "price": "0.08550000"
      },
      {
      "symbol": "AUCTIONUSDT",
      "price": "11.40000000"
      },
      {
      "symbol": "CELOBUSD",
      "price": "0.47000000"
      },
      {
      "symbol": "FTMRUB",
      "price": "36.85000000"
      },
      {
      "symbol": "NUAUD",
      "price": "0.00000000"
      },
      {
      "symbol": "NURUB",
      "price": "0.00000000"
      },
      {
      "symbol": "REEFTRY",
      "price": "0.02349000"
      },
      {
      "symbol": "REEFBIDR",
      "price": "0.00"
      },
      {
      "symbol": "SHIBDOGE",
      "price": "0.00007870"
      },
      {
      "symbol": "DARUSDT",
      "price": "0.21707000"
      },
      {
      "symbol": "DARBUSD",
      "price": "0.07995000"
      },
      {
      "symbol": "DARBNB",
      "price": "0.00037248"
      },
      {
      "symbol": "DARBTC",
      "price": "0.00000157"
      },
      {
      "symbol": "BNXBTC",
      "price": "0.00000384"
      },
      {
      "symbol": "BNXBNB",
      "price": "0.00122700"
      },
      {
      "symbol": "BNXBUSD",
      "price": "0.27430000"
      },
      {
      "symbol": "BNXUSDT",
      "price": "1.78190000"
      },
      {
      "symbol": "RGTUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "RGTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "RGTBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "RGTBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LAZIOBUSD",
      "price": "1.64400000"
      },
      {
      "symbol": "OXTBUSD",
      "price": "0.05130000"
      },
      {
      "symbol": "MANATRY",
      "price": "10.86000000"
      },
      {
      "symbol": "ALGORUB",
      "price": "12.60000000"
      },
      {
      "symbol": "SHIBUAH",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNABIDR",
      "price": "0.00"
      },
      {
      "symbol": "AUDUSDC",
      "price": "0.64770000"
      },
      {
      "symbol": "MOVRBTC",
      "price": "0.00006270"
      },
      {
      "symbol": "MOVRBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "MOVRBUSD",
      "price": "3.69000000"
      },
      {
      "symbol": "MOVRUSDT",
      "price": "5.32600000"
      },
      {
      "symbol": "CITYBTC",
      "price": "0.00006030"
      },
      {
      "symbol": "CITYBNB",
      "price": "0.01454000"
      },
      {
      "symbol": "CITYBUSD",
      "price": "2.96400000"
      },
      {
      "symbol": "CITYUSDT",
      "price": "1.01000000"
      },
      {
      "symbol": "ENSBTC",
      "price": "0.00017040"
      },
      {
      "symbol": "ENSBNB",
      "price": "0.03091000"
      },
      {
      "symbol": "ENSBUSD",
      "price": "6.96000000"
      },
      {
      "symbol": "ENSUSDT",
      "price": "14.42000000"
      },
      {
      "symbol": "SANDETH",
      "price": "0.00014660"
      },
      {
      "symbol": "DOTETH",
      "price": "0.00243400"
      },
      {
      "symbol": "MATICETH",
      "price": "0.00016160"
      },
      {
      "symbol": "ANKRBUSD",
      "price": "0.01906000"
      },
      {
      "symbol": "SANDTRY",
      "price": "10.14000000"
      },
      {
      "symbol": "MANABRL",
      "price": "1.66100000"
      },
      {
      "symbol": "KP3RUSDT",
      "price": "16.48000000"
      },
      {
      "symbol": "QIUSDT",
      "price": "0.00838000"
      },
      {
      "symbol": "QIBUSD",
      "price": "0.00507000"
      },
      {
      "symbol": "QIBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "QIBTC",
      "price": "0.00000012"
      },
      {
      "symbol": "PORTOBTC",
      "price": "0.00002103"
      },
      {
      "symbol": "PORTOUSDT",
      "price": "0.95400000"
      },
      {
      "symbol": "PORTOTRY",
      "price": "36.21000000"
      },
      {
      "symbol": "PORTOEUR",
      "price": "2.71500000"
      },
      {
      "symbol": "POWRUSDT",
      "price": "0.17920000"
      },
      {
      "symbol": "POWRBUSD",
      "price": "0.15040000"
      },
      {
      "symbol": "AVAXETH",
      "price": "0.01230000"
      },
      {
      "symbol": "SLPTRY",
      "price": "0.05804000"
      },
      {
      "symbol": "FISTRY",
      "price": "0.00000000"
      },
      {
      "symbol": "LRCTRY",
      "price": "3.57000000"
      },
      {
      "symbol": "CHRETH",
      "price": "0.00007080"
      },
      {
      "symbol": "FISBIDR",
      "price": "0.00"
      },
      {
      "symbol": "VGXUSDT",
      "price": "0.01800000"
      },
      {
      "symbol": "GALAETH",
      "price": "0.00000965"
      },
      {
      "symbol": "JASMYUSDT",
      "price": "0.01504000"
      },
      {
      "symbol": "JASMYBUSD",
      "price": "0.00359300"
      },
      {
      "symbol": "JASMYBNB",
      "price": "0.00001767"
      },
      {
      "symbol": "JASMYBTC",
      "price": "0.00000017"
      },
      {
      "symbol": "AMPBTC",
      "price": "0.00000010"
      },
      {
      "symbol": "AMPBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "AMPBUSD",
      "price": "0.00142900"
      },
      {
      "symbol": "AMPUSDT",
      "price": "0.00357000"
      },
      {
      "symbol": "PLABTC",
      "price": "0.00000465"
      },
      {
      "symbol": "PLABNB",
      "price": "0.00069680"
      },
      {
      "symbol": "PLABUSD",
      "price": "0.14770000"
      },
      {
      "symbol": "PLAUSDT",
      "price": "0.23470000"
      },
      {
      "symbol": "PYRBTC",
      "price": "0.00001378"
      },
      {
      "symbol": "PYRBUSD",
      "price": "3.90300000"
      },
      {
      "symbol": "PYRUSDT",
      "price": "1.16400000"
      },
      {
      "symbol": "RNDRBTC",
      "price": "0.00010320"
      },
      {
      "symbol": "RNDRUSDT",
      "price": "7.03000000"
      },
      {
      "symbol": "RNDRBUSD",
      "price": "3.04000000"
      },
      {
      "symbol": "ALCXBTC",
      "price": "0.00023730"
      },
      {
      "symbol": "ALCXBUSD",
      "price": "10.73000000"
      },
      {
      "symbol": "ALCXUSDT",
      "price": "8.48000000"
      },
      {
      "symbol": "SANTOSBTC",
      "price": "0.00002867"
      },
      {
      "symbol": "SANTOSUSDT",
      "price": "2.42800000"
      },
      {
      "symbol": "SANTOSBRL",
      "price": "20.00000000"
      },
      {
      "symbol": "SANTOSTRY",
      "price": "92.55000000"
      },
      {
      "symbol": "MCBTC",
      "price": "0.00001400"
      },
      {
      "symbol": "MCBUSD",
      "price": "0.26570000"
      },
      {
      "symbol": "MCUSDT",
      "price": "0.48610000"
      },
      {
      "symbol": "BELTRY",
      "price": "17.52000000"
      },
      {
      "symbol": "COCOSBUSD",
      "price": "1.75890000"
      },
      {
      "symbol": "DENTTRY",
      "price": "0.02603000"
      },
      {
      "symbol": "ENJTRY",
      "price": "2.55200000"
      },
      {
      "symbol": "NEORUB",
      "price": "734.00000000"
      },
      {
      "symbol": "SANDAUD",
      "price": "0.63590000"
      },
      {
      "symbol": "SLPBIDR",
      "price": "32.30"
      },
      {
      "symbol": "ANYBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "ANYBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "ANYUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "BICOBTC",
      "price": "0.00000129"
      },
      {
      "symbol": "BICOBUSD",
      "price": "0.25140000"
      },
      {
      "symbol": "BICOUSDT",
      "price": "0.10930000"
      },
      {
      "symbol": "FLUXBTC",
      "price": "0.00000301"
      },
      {
      "symbol": "FLUXBUSD",
      "price": "0.32650000"
      },
      {
      "symbol": "FLUXUSDT",
      "price": "0.25540000"
      },
      {
      "symbol": "ALICETRY",
      "price": "15.92000000"
      },
      {
      "symbol": "FXSUSDT",
      "price": "1.83700000"
      },
      {
      "symbol": "GALABRL",
      "price": "0.09040000"
      },
      {
      "symbol": "GALATRY",
      "price": "0.58640000"
      },
      {
      "symbol": "LUNATRY",
      "price": "6.40000000"
      },
      {
      "symbol": "REQBUSD",
      "price": "0.06330000"
      },
      {
      "symbol": "SANDBRL",
      "price": "1.80700000"
      },
      {
      "symbol": "MANABIDR",
      "price": "10781.00"
      },
      {
      "symbol": "SANDBIDR",
      "price": "6598.00"
      },
      {
      "symbol": "VOXELBTC",
      "price": "0.00000216"
      },
      {
      "symbol": "VOXELBNB",
      "price": "0.00069340"
      },
      {
      "symbol": "VOXELBUSD",
      "price": "0.13250000"
      },
      {
      "symbol": "VOXELUSDT",
      "price": "0.13170000"
      },
      {
      "symbol": "COSBUSD",
      "price": "0.00517000"
      },
      {
      "symbol": "CTXCBUSD",
      "price": "0.11500000"
      },
      {
      "symbol": "FTMTRY",
      "price": "24.82000000"
      },
      {
      "symbol": "MANABNB",
      "price": "0.00155000"
      },
      {
      "symbol": "MINATRY",
      "price": "8.25000000"
      },
      {
      "symbol": "XTZTRY",
      "price": "29.03000000"
      },
      {
      "symbol": "HIGHBTC",
      "price": "0.00001415"
      },
      {
      "symbol": "HIGHBUSD",
      "price": "1.42100000"
      },
      {
      "symbol": "HIGHUSDT",
      "price": "0.55400000"
      },
      {
      "symbol": "CVXBTC",
      "price": "0.00008550"
      },
      {
      "symbol": "CVXBUSD",
      "price": "2.59700000"
      },
      {
      "symbol": "CVXUSDT",
      "price": "2.19700000"
      },
      {
      "symbol": "PEOPLEBTC",
      "price": "0.00000016"
      },
      {
      "symbol": "PEOPLEBUSD",
      "price": "0.00950000"
      },
      {
      "symbol": "PEOPLEUSDT",
      "price": "0.01357000"
      },
      {
      "symbol": "OOKIBUSD",
      "price": "0.00162900"
      },
      {
      "symbol": "OOKIUSDT",
      "price": "0.00011900"
      },
      {
      "symbol": "COCOSTRY",
      "price": "36.66000000"
      },
      {
      "symbol": "GXSBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "LINKBNB",
      "price": "0.02186000"
      },
      {
      "symbol": "LUNAETH",
      "price": "0.00000000"
      },
      {
      "symbol": "MDTBUSD",
      "price": "0.04578000"
      },
      {
      "symbol": "NULSBUSD",
      "price": "0.17850000"
      },
      {
      "symbol": "SPELLBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "SPELLUSDT",
      "price": "0.00054620"
      },
      {
      "symbol": "SPELLBUSD",
      "price": "0.00039730"
      },
      {
      "symbol": "USTBTC",
      "price": "0.00000000"
      },
      {
      "symbol": "USTBUSD",
      "price": "0.00000000"
      },
      {
      "symbol": "USTUSDT",
      "price": "0.00000000"
      },
      {
      "symbol": "JOEBTC",
      "price": "0.00000199"
      },
      {
      "symbol": "JOEBUSD",
      "price": "0.21880000"
      },
      {
      "symbol": "JOEUSDT",
      "price": "0.16890000"
      },
      {
      "symbol": "ATOMETH",
      "price": "0.00263000"
      },
      {
      "symbol": "DUSKBUSD",
      "price": "0.14310000"
      },
      {
      "symbol": "EGLDETH",
      "price": "0.00906000"
      },
      {
      "symbol": "ICPETH",
      "price": "0.00305300"
      },
      {
      "symbol": "LUNABRL",
      "price": "0.00000000"
      },
      {
      "symbol": "LUNAUST",
      "price": "0.00000000"
      },
      {
      "symbol": "NEARETH",
      "price": "0.00136500"
      },
      {
      "symbol": "ROSEBNB",
      "price": "0.00015340"
      },
      {
      "symbol": "VOXELETH",
      "price": "0.00020220"
      },
      {
      "symbol": "ALICEBNB",
      "price": "0.00524000"
      },
      {
      "symbol": "ATOMTRY",
      "price": "159.90000000"
      },
      {
      "symbol": "ETHUST",
      "price": "0.00000000"
      },
      {
      "symbol": "GALAAUD",
      "price": "0.03960000"
      },
      {
      "symbol": "LRCBNB",
      "price": "0.00083900"
      },
      {
      "symbol": "ONEETH",
      "price": "0.00000617"
      },
      {
      "symbol": "OOKIBNB",
      "price": "0.00001491"
      },
      {
      "symbol": "ACHBTC",
      "price": "0.00000030"
      },
      {
      "symbol": "ACHBUSD",
      "price": "0.01646000"
      },
      {
      "symbol": "ACHUSDT",
      "price": "0.02485000"
      },
      {
      "symbol": "IMXBTC",
      "price": "0.00000573"
      },
      {
      "symbol": "IMXBUSD",
      "price": "0.65080000"
      },
      {
      "symbol": "IMXUSDT",
      "price": "0.48700000"
      },
      {
      "symbol": "GLMRBTC",
      "price": "0.00000082"
      },
      {
      "symbol": "GLMRBUSD",
      "price": "0.20650000"
      },
      {
      "symbol": "GLMRUSDT",
      "price": "0.06950000"
      },
      {
      "symbol": "ATOMBIDR",
      "price": "0.00"
      },
      {
      "symbol": "DYDXETH",
      "price": "0.00000000"
      },
      {
      "symbol": "FARMETH",
      "price": "0.00000000"
      },
      {
      "symbol": "FORBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ICPTRY",
      "price": "185.60000000"
      },
      {
      "symbol": "JASMYETH",
      "price": "0.00000302"
      },
      {
      "symbol": "LINABNB",
      "price": "0.00000000"
      },
      {
      "symbol": "OOKIETH",
      "price": "0.00000251"
      },
      {
      "symbol": "ROSEETH",
      "price": "0.00001645"
      },
      {
      "symbol": "UMABUSD",
      "price": "1.32700000"
      },
      {
      "symbol": "UNIETH",
      "price": "0.00330400"
      },
      {
      "symbol": "XTZETH",
      "price": "0.00044000"
      },
      {
      "symbol": "LOKABTC",
      "price": "0.00000087"
      },
      {
      "symbol": "LOKABNB",
      "price": "0.00104270"
      },
      {
      "symbol": "LOKABUSD",
      "price": "0.18490000"
      },
      {
      "symbol": "LOKAUSDT",
      "price": "0.07530000"
      },
      {
      "symbol": "ATOMBRL",
      "price": "66.35000000"
      },
      {
      "symbol": "BNBUST",
      "price": "0.00000000"
      },
      {
      "symbol": "CRVETH",
      "price": "0.00020780"
      },
      {
      "symbol": "HIGHBNB",
      "price": "0.00455700"
      },
      {
      "symbol": "NEARRUB",
      "price": "183.40000000"
      },
      {
      "symbol": "ROSETRY",
      "price": "0.97700000"
      },
      {
      "symbol": "SCRTUSDT",
      "price": "0.20510000"
      },
      {
      "symbol": "API3BTC",
      "price": "0.00000876"
      },
      {
      "symbol": "API3BUSD",
      "price": "1.00000000"
      },
      {
      "symbol": "API3USDT",
      "price": "0.74300000"
      },
      {
      "symbol": "BTTCUSDT",
      "price": "0.00000060"
      },
      {
      "symbol": "BTTCUSDC",
      "price": "0.00000078"
      },
      {
      "symbol": "BTTCTRY",
      "price": "0.00002313"
      },
      {
      "symbol": "ACABTC",
      "price": "0.00000037"
      },
      {
      "symbol": "ACABUSD",
      "price": "0.04640000"
      },
      {
      "symbol": "ACAUSDT",
      "price": "0.03090000"
      },
      {
      "symbol": "ANCBTC",
      "price": "0.00000186"
      },
      {
      "symbol": "ANCBUSD",
      "price": "0.02872000"
      },
      {
      "symbol": "ANCUSDT",
      "price": "0.03151000"
      },
      {
      "symbol": "BDOTDOT",
      "price": "0.99820000"
      },
      {
      "symbol": "XNOBTC",
      "price": "0.00001132"
      },
      {
      "symbol": "XNOETH",
      "price": "0.00050170"
      },
      {
      "symbol": "XNOBUSD",
      "price": "0.66300000"
      },
      {
      "symbol": "XNOUSDT",
      "price": "0.95700000"
      },
      {
      "symbol": "COSTRY",
      "price": "0.12220000"
      },
      {
      "symbol": "KAVAETH",
      "price": "0.00030660"
      },
      {
      "symbol": "MCBNB",
      "price": "0.00069800"
      },
      {
      "symbol": "ONETRY",
      "price": "0.42650000"
      },
      {
      "symbol": "WOOBTC",
      "price": "0.00000064"
      },
      {
      "symbol": "WOOBNB",
      "price": "0.00114100"
      },
      {
      "symbol": "WOOBUSD",
      "price": "0.16450000"
      },
      {
      "symbol": "WOOUSDT",
      "price": "0.05940000"
      },
      {
      "symbol": "CELRETH",
      "price": "0.00000789"
      },
      {
      "symbol": "PEOPLEBNB",
      "price": "0.00004675"
      },
      {
      "symbol": "SLPBNB",
      "price": "0.00000884"
      },
      {
      "symbol": "SPELLBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "SPELLTRY",
      "price": "0.02078000"
      },
      {
      "symbol": "TFUELBUSD",
      "price": "0.04390000"
      },
      {
      "symbol": "AXSTRY",
      "price": "88.30000000"
      },
      {
      "symbol": "DARTRY",
      "price": "7.66600000"
      },
      {
      "symbol": "NEARTRY",
      "price": "82.90000000"
      },
      {
      "symbol": "IDEXBNB",
      "price": "0.00019820"
      },
      {
      "symbol": "ALPINEEUR",
      "price": "2.19600000"
      },
      {
      "symbol": "ALPINETRY",
      "price": "28.38000000"
      },
      {
      "symbol": "ALPINEUSDT",
      "price": "0.74600000"
      },
      {
      "symbol": "ALPINEBTC",
      "price": "0.00002994"
      },
      {
      "symbol": "TUSDT",
      "price": "0.01813000"
      },
      {
      "symbol": "TBUSD",
      "price": "0.02312000"
      },
      {
      "symbol": "API3BNB",
      "price": "0.00000000"
      },
      {
      "symbol": "BETAETH",
      "price": "0.00003349"
      },
      {
      "symbol": "INJTRY",
      "price": "317.20000000"
      },
      {
      "symbol": "TLMBNB",
      "price": "0.00000000"
      },
      {
      "symbol": "ASTRBUSD",
      "price": "0.05000000"
      },
      {
      "symbol": "ASTRUSDT",
      "price": "0.02709000"
      },
      {
      "symbol": "API3TRY",
      "price": "28.29000000"
      },
      {
      "symbol": "GLMRBNB",
      "price": "0.00102100"
      },
      {
      "symbol": "MBOXTRY",
      "price": "1.83500000"
      },
      {
      "symbol": "NBTBIDR",
      "price": "39.10"
      },
      {
      "symbol": "NBTUSDT",
      "price": "0.00252000"
      },
      {
      "symbol": "GMTBTC",
      "price": "0.00000071"
      },
      {
      "symbol": "GMTBNB",
      "price": "0.00076900"
      },
      {
      "symbol": "GMTBUSD",
      "price": "0.22700000"
      },
      {
      "symbol": "GMTUSDT",
      "price": "0.06020000"
      },
      {
      "symbol": "ANCBNB",
      "price": "0.00012880"
      },
      {
      "symbol": "ATOMEUR",
      "price": "3.67400000"
      },
      {
      "symbol": "GALAEUR",
      "price": "0.01351000"
      },
      {
      "symbol": "KSMETH",
      "price": "0.02114000"
      },
      {
      "symbol": "UMATRY",
      "price": "42.03000000"
      },
      {
      "symbol": "KDABTC",
      "price": "0.00000550"
      },
      {
      "symbol": "KDABUSD",
      "price": "0.42000000"
      },
      {
      "symbol": "KDAUSDT",
      "price": "0.46720000"
      },
      {
      "symbol": "APEUSDT",
      "price": "0.46270000"
      },
      {
      "symbol": "APEBUSD",
      "price": "1.42300000"
      },
      {
      "symbol": "APEBTC",
      "price": "0.00000544"
      },
      {
      "symbol": "ALPINEBUSD",
      "price": "1.74900000"
      },
      {
      "symbol": "LUNAGBP",
      "price": "0.00000000"
      },
      {
      "symbol": "NEAREUR",
      "price": "1.91100000"
      },
      {
      "symbol": "TWTTRY",
      "price": "29.50000000"
      },
      {
      "symbol": "WAVESEUR",
      "price": "1.35400000"
      },
      {
      "symbol": "APEEUR",
      "price": "1.50800000"
      },
      {
      "symbol": "APEGBP",
      "price": "3.30500000"
      },
      {
      "symbol": "APETRY",
      "price": "17.64000000"
      },
      {
      "symbol": "BSWUSDT",
      "price": "0.02370000"
      },
      {
      "symbol": "BSWBUSD",
      "price": "0.06700000"
      },
      {
      "symbol": "BSWBNB",
      "price": "0.00029870"
      },
      {
      "symbol": "APEBNB",
      "price": "0.00527700"
      },
      {
      "symbol": "GMTBRL",
      "price": "1.32500000"
      },
      {
      "symbol": "GMTETH",
      "price": "0.00010150"
      },
      {
      "symbol": "JASMYTRY",
      "price": "0.57300000"
      },
      {
      "symbol": "SANTOSBUSD",
      "price": "2.91700000"
      },
      {
      "symbol": "APEAUD",
      "price": "4.07200000"
      },
      {
      "symbol": "BIFIUSDT",
      "price": "156.00000000"
      },
      {
      "symbol": "GMTEUR",
      "price": "0.05300000"
      },
      {
      "symbol": "IMXBNB",
      "price": "0.00236200"
      },
      {
      "symbol": "RUNEETH",
      "price": "0.00073260"
      },
      {
      "symbol": "AVAXGBP",
      "price": "14.18000000"
      },
      {
      "symbol": "MULTIBTC",
      "price": "0.00003673"
      },
      {
      "symbol": "MULTIBUSD",
      "price": "2.09700000"
      },
      {
      "symbol": "MULTIUSDT",
      "price": "0.83400000"
      },
      {
      "symbol": "APEETH",
      "price": "0.00029190"
      },
      {
      "symbol": "BSWETH",
      "price": "0.00013660"
      },
      {
      "symbol": "FILTRY",
      "price": "100.26000000"
      },
      {
      "symbol": "FTMEUR",
      "price": "0.68090000"
      },
      {
      "symbol": "GMTGBP",
      "price": "0.21070000"
      },
      {
      "symbol": "ZILTRY",
      "price": "0.44780000"
      },
      {
      "symbol": "GMTTRY",
      "price": "2.29600000"
      },
      {
      "symbol": "WAVESTRY",
      "price": "36.02000000"
      },
      {
      "symbol": "BTCUST",
      "price": "0.00000000"
      },
      {
      "symbol": "ASTRBTC",
      "price": "0.00000032"
      },
      {
      "symbol": "ASTRETH",
      "price": "0.00003108"
      },
      {
      "symbol": "BSWTRY",
      "price": "0.90300000"
      },
      {
      "symbol": "FTTETH",
      "price": "0.00114100"
      },
      {
      "symbol": "FUNBNB",
      "price": "0.00001888"
      },
      {
      "symbol": "PORTOBUSD",
      "price": "1.75700000"
      },
      {
      "symbol": "STEEMUSDT",
      "price": "0.14730000"
      },
      {
      "symbol": "ZILEUR",
      "price": "0.02063000"
      },
      {
      "symbol": "APEBRL",
      "price": "22.16000000"
      },
      {
      "symbol": "AUDIOTRY",
      "price": "2.44100000"
      },
      {
      "symbol": "BTTCBUSD",
      "price": "0.00000045"
      },
      {
      "symbol": "GMTAUD",
      "price": "0.56950000"
      },
      {
      "symbol": "MBLBUSD",
      "price": "0.00265800"
      },
      {
      "symbol": "MOBUSDT",
      "price": "0.06230000"
      },
      {
      "symbol": "MOBBUSD",
      "price": "0.55000000"
      },
      {
      "symbol": "MOBBTC",
      "price": "0.00000094"
      },
      {
      "symbol": "NEXOUSDT",
      "price": "1.02000000"
      },
      {
      "symbol": "NEXOBUSD",
      "price": "0.62700000"
      },
      {
      "symbol": "NEXOBTC",
      "price": "0.00001202"
      },
      {
      "symbol": "REIUSDT",
      "price": "0.02355000"
      },
      {
      "symbol": "REIBNB",
      "price": "0.00008210"
      },
      {
      "symbol": "REIETH",
      "price": "0.00001928"
      },
      {
      "symbol": "GALUSDT",
      "price": "2.54200000"
      },
      {
      "symbol": "GALBUSD",
      "price": "1.35100000"
      },
      {
      "symbol": "GALBNB",
      "price": "0.00489300"
      },
      {
      "symbol": "GALBTC",
      "price": "0.00004073"
      },
      {
      "symbol": "JASMYEUR",
      "price": "0.00456800"
      },
      {
      "symbol": "KNCBNB",
      "price": "0.00255000"
      },
      {
      "symbol": "SHIBGBP",
      "price": "0.00000696"
      },
      {
      "symbol": "GALEUR",
      "price": "0.99500000"
      },
      {
      "symbol": "GALTRY",
      "price": "84.24000000"
      },
      {
      "symbol": "LDOBUSD",
      "price": "1.74400000"
      },
      {
      "symbol": "LDOUSDT",
      "price": "0.71300000"
      },
      {
      "symbol": "LDOBTC",
      "price": "0.00000840"
      },
      {
      "symbol": "ENSTRY",
      "price": "549.00000000"
      },
      {
      "symbol": "DAREUR",
      "price": "0.12133000"
      },
      {
      "symbol": "DARETH",
      "price": "0.00010140"
      },
      {
      "symbol": "ALGOETH",
      "price": "0.00004447"
      },
      {
      "symbol": "ALGOTRY",
      "price": "7.24000000"
      },
      {
      "symbol": "GALETH",
      "price": "0.00076200"
      },
      {
      "symbol": "EPXUSDT",
      "price": "0.00001940"
      },
      {
      "symbol": "EPXBUSD",
      "price": "0.00016980"
      },
      {
      "symbol": "RUNETRY",
      "price": "31.38000000"
      },
      {
      "symbol": "GALBRL",
      "price": "8.68000000"
      },
      {
      "symbol": "STEEMBUSD",
      "price": "0.18470000"
      },
      {
      "symbol": "CVCBUSD",
      "price": "0.06880000"
      },
      {
      "symbol": "REIBUSD",
      "price": "0.03079000"
      },
      {
      "symbol": "DREPBUSD",
      "price": "0.25360000"
      },
      {
      "symbol": "AKROBUSD",
      "price": "0.00618000"
      },
      {
      "symbol": "PUNDIXBUSD",
      "price": "0.33360000"
      },
      {
      "symbol": "LUNCBUSD",
      "price": "0.00017100"
      },
      {
      "symbol": "USTCBUSD",
      "price": "0.01326580"
      },
      {
      "symbol": "OPBTC",
      "price": "0.00000836"
      },
      {
      "symbol": "OPBUSD",
      "price": "1.80300000"
      },
      {
      "symbol": "OPUSDT",
      "price": "0.70900000"
      },
      {
      "symbol": "OGBUSD",
      "price": "4.41600000"
      },
      {
      "symbol": "KEYBUSD",
      "price": "0.00543000"
      },
      {
      "symbol": "ASRBUSD",
      "price": "2.15900000"
      },
      {
      "symbol": "FIROBUSD",
      "price": "1.44100000"
      },
      {
      "symbol": "NKNBUSD",
      "price": "0.09720000"
      },
      {
      "symbol": "OPBNB",
      "price": "0.00281800"
      },
      {
      "symbol": "OPEUR",
      "price": "0.62200000"
      },
      {
      "symbol": "GTOBUSD",
      "price": "0.02863000"
      },
      {
      "symbol": "SNXETH",
      "price": "0.00076800"
      },
      {
      "symbol": "WBTCBUSD",
      "price": "40760.13000000"
      },
      {
      "symbol": "BELETH",
      "price": "0.00041170"
      },
      {
      "symbol": "LITETH",
      "price": "0.00035510"
      },
      {
      "symbol": "LEVERUSDT",
      "price": "0.00054300"
      },
      {
      "symbol": "LEVERBUSD",
      "price": "0.00130800"
      },
      {
      "symbol": "BURGERETH",
      "price": "0.00045000"
      },
      {
      "symbol": "PEOPLEETH",
      "price": "0.00000668"
      },
      {
      "symbol": "UNFIETH",
      "price": "0.00224100"
      },
      {
      "symbol": "BONDETH",
      "price": "0.00266500"
      },
      {
      "symbol": "STORJTRY",
      "price": "11.34000000"
      },
      {
      "symbol": "OPETH",
      "price": "0.00044400"
      },
      {
      "symbol": "ETCTRY",
      "price": "599.90000000"
      },
      {
      "symbol": "WINGETH",
      "price": "0.00352100"
      },
      {
      "symbol": "FILETH",
      "price": "0.00165000"
      },
      {
      "symbol": "GLMBUSD",
      "price": "0.17860000"
      },
      {
      "symbol": "SSVBUSD",
      "price": "15.74000000"
      },
      {
      "symbol": "STGBTC",
      "price": "0.00000226"
      },
      {
      "symbol": "STGBUSD",
      "price": "0.41400000"
      },
      {
      "symbol": "STGUSDT",
      "price": "0.19160000"
      },
      {
      "symbol": "ANKRTRY",
      "price": "0.69980000"
      },
      {
      "symbol": "ARKBUSD",
      "price": "0.53560000"
      },
      {
      "symbol": "BETHBUSD",
      "price": "1551.73000000"
      },
      {
      "symbol": "LOOMBUSD",
      "price": "0.04003000"
      },
      {
      "symbol": "SNMBUSD",
      "price": "0.01470000"
      },
      {
      "symbol": "AMBBUSD",
      "price": "0.00796000"
      },
      {
      "symbol": "LUNCUSDT",
      "price": "0.00006124"
      },
      {
      "symbol": "PHBBUSD",
      "price": "0.65880000"
      },
      {
      "symbol": "GASBUSD",
      "price": "9.21600000"
      },
      {
      "symbol": "NEBLBUSD",
      "price": "0.35400000"
      },
      {
      "symbol": "PROSBUSD",
      "price": "0.31500000"
      },
      {
      "symbol": "VIBBUSD",
      "price": "0.04217000"
      },
      {
      "symbol": "GMXBTC",
      "price": "0.00033200"
      },
      {
      "symbol": "GMXBUSD",
      "price": "31.67000000"
      },
      {
      "symbol": "GMXUSDT",
      "price": "15.23000000"
      },
      {
      "symbol": "AGIXBUSD",
      "price": "0.29947000"
      },
      {
      "symbol": "NEBLUSDT",
      "price": "0.35500000"
      },
      {
      "symbol": "SNTBUSD",
      "price": "0.02283000"
      },
      {
      "symbol": "POLYXBTC",
      "price": "0.00000176"
      },
      {
      "symbol": "POLYXBUSD",
      "price": "0.12170000"
      },
      {
      "symbol": "POLYXUSDT",
      "price": "0.15050000"
      },
      {
      "symbol": "APTBTC",
      "price": "0.00005755"
      },
      {
      "symbol": "APTUSDT",
      "price": "4.87800000"
      },
      {
      "symbol": "APTBUSD",
      "price": "7.31980000"
      },
      {
      "symbol": "BTCPLN",
      "price": "319832.00000000"
      },
      {
      "symbol": "ETHPLN",
      "price": "6004.00000000"
      },
      {
      "symbol": "BUSDPLN",
      "price": "4.06500000"
      },
      {
      "symbol": "APTEUR",
      "price": "4.27500000"
      },
      {
      "symbol": "APTTRY",
      "price": "186.00000000"
      },
      {
      "symbol": "APTBRL",
      "price": "39.76000000"
      },
      {
      "symbol": "QKCBUSD",
      "price": "0.00869500"
      },
      {
      "symbol": "OSMOBTC",
      "price": "0.00000884"
      },
      {
      "symbol": "OSMOUSDT",
      "price": "0.21870000"
      },
      {
      "symbol": "OSMOBUSD",
      "price": "0.46400000"
      },
      {
      "symbol": "HFTBTC",
      "price": "0.00000076"
      },
      {
      "symbol": "HFTBUSD",
      "price": "0.25890000"
      },
      {
      "symbol": "HFTUSDT",
      "price": "0.06490000"
      },
      {
      "symbol": "ARPAETH",
      "price": "0.00002363"
      },
      {
      "symbol": "PHBUSDT",
      "price": "0.47200000"
      },
      {
      "symbol": "VITEBUSD",
      "price": "0.01726000"
      },
      {
      "symbol": "HOOKBTC",
      "price": "0.00000788"
      },
      {
      "symbol": "HOOKUSDT",
      "price": "0.13190000"
      },
      {
      "symbol": "HOOKBUSD",
      "price": "0.89410000"
      },
      {
      "symbol": "HOOKBNB",
      "price": "0.00319530"
      },
      {
      "symbol": "MAGICBTC",
      "price": "0.00000166"
      },
      {
      "symbol": "MAGICBUSD",
      "price": "0.55850000"
      },
      {
      "symbol": "MAGICUSDT",
      "price": "0.14050000"
      },
      {
      "symbol": "BUSDRON",
      "price": "4.62800000"
      },
      {
      "symbol": "HIFIETH",
      "price": "0.00025310"
      },
      {
      "symbol": "HIFIUSDT",
      "price": "0.14310000"
      },
      {
      "symbol": "RPLBTC",
      "price": "0.00064100"
      },
      {
      "symbol": "RPLBUSD",
      "price": "24.17000000"
      },
      {
      "symbol": "RPLUSDT",
      "price": "4.31000000"
      },
      {
      "symbol": "PROSUSDT",
      "price": "0.03720000"
      },
      {
      "symbol": "FETTRY",
      "price": "21.83000000"
      },
      {
      "symbol": "GFTBUSD",
      "price": "0.02911000"
      },
      {
      "symbol": "AGIXUSDT",
      "price": "0.61410000"
      },
      {
      "symbol": "APTETH",
      "price": "0.00305700"
      },
      {
      "symbol": "BTCRON",
      "price": "379074.00000000"
      },
      {
      "symbol": "GNSUSDT",
      "price": "1.39300000"
      },
      {
      "symbol": "GNSBTC",
      "price": "0.00007210"
      },
      {
      "symbol": "SYNBTC",
      "price": "0.00001152"
      },
      {
      "symbol": "SYNUSDT",
      "price": "0.16150000"
      },
      {
      "symbol": "VIBUSDT",
      "price": "0.02439000"
      },
      {
      "symbol": "SSVUSDT",
      "price": "5.66000000"
      },
      {
      "symbol": "LQTYUSDT",
      "price": "0.60500000"
      },
      {
      "symbol": "LQTYBTC",
      "price": "0.00000841"
      },
      {
      "symbol": "AMBUSDT",
      "price": "0.00032000"
      },
      {
      "symbol": "BETHUSDT",
      "price": "1556.27000000"
      },
      {
      "symbol": "CFXTRY",
      "price": "2.68300000"
      },
      {
      "symbol": "STXTRY",
      "price": "23.73000000"
      },
      {
      "symbol": "USTCUSDT",
      "price": "0.01245000"
      },
      {
      "symbol": "GASUSDT",
      "price": "3.50900000"
      },
      {
      "symbol": "GLMUSDT",
      "price": "0.26840000"
      },
      {
      "symbol": "PROMUSDT",
      "price": "5.85400000"
      },
      {
      "symbol": "QKCUSDT",
      "price": "0.00777700"
      },
      {
      "symbol": "UFTUSDT",
      "price": "0.00890000"
      },
      {
      "symbol": "IDBTC",
      "price": "0.00000223"
      },
      {
      "symbol": "IDBNB",
      "price": "0.00094930"
      },
      {
      "symbol": "IDUSDT",
      "price": "0.18940000"
      },
      {
      "symbol": "ARBBTC",
      "price": "0.00000356"
      },
      {
      "symbol": "ARBUSDT",
      "price": "0.30160000"
      },
      {
      "symbol": "AGIXTRY",
      "price": "20.14000000"
      },
      {
      "symbol": "LOOMUSDT",
      "price": "0.04831000"
      },
      {
      "symbol": "OAXUSDT",
      "price": "0.03580000"
      },
      {
      "symbol": "ARBTUSD",
      "price": "0.30280000"
      },
      {
      "symbol": "ARBTRY",
      "price": "11.47000000"
      },
      {
      "symbol": "ARBEUR",
      "price": "0.26460000"
      },
      {
      "symbol": "IDTUSD",
      "price": "0.88208000"
      },
      {
      "symbol": "IDTRY",
      "price": "7.21000000"
      },
      {
      "symbol": "IDEUR",
      "price": "0.18769000"
      },
      {
      "symbol": "LDOTUSD",
      "price": "2.46700000"
      },
      {
      "symbol": "MATICTUSD",
      "price": "0.50430000"
      },
      {
      "symbol": "OPTUSD",
      "price": "2.99700000"
      },
      {
      "symbol": "SOLTUSD",
      "price": "139.91000000"
      },
      {
      "symbol": "SSVTUSD",
      "price": "45.55000000"
      },
      {
      "symbol": "RDNTBTC",
      "price": "0.00000107"
      },
      {
      "symbol": "RDNTUSDT",
      "price": "0.02074000"
      },
      {
      "symbol": "RDNTTUSD",
      "price": "0.30100000"
      },
      {
      "symbol": "ARBRUB",
      "price": "95.10000000"
      },
      {
      "symbol": "JOETRY",
      "price": "12.22000000"
      },
      {
      "symbol": "MAGICTRY",
      "price": "5.35000000"
      },
      {
      "symbol": "USDTPLN",
      "price": "3.76900000"
      },
      {
      "symbol": "ACHTRY",
      "price": "0.94620000"
      },
      {
      "symbol": "XVSTRY",
      "price": "191.70000000"
      },
      {
      "symbol": "EGLDRON",
      "price": "63.00000000"
      },
      {
      "symbol": "USDTRON",
      "price": "4.59800000"
      },
      {
      "symbol": "USDTARS",
      "price": "1208.90000000"
      },
      {
      "symbol": "DOGETUSD",
      "price": "0.15665000"
      },
      {
      "symbol": "WBTCUSDT",
      "price": "84786.49000000"
      },
      {
      "symbol": "EDUUSDT",
      "price": "0.11840000"
      },
      {
      "symbol": "EDUTUSD",
      "price": "1.06098000"
      },
      {
      "symbol": "EDUBNB",
      "price": "0.00181050"
      },
      {
      "symbol": "EDUBTC",
      "price": "0.00000324"
      },
      {
      "symbol": "EDUEUR",
      "price": "0.47455000"
      },
      {
      "symbol": "EDUTRY",
      "price": "4.51000000"
      },
      {
      "symbol": "SUIUSDT",
      "price": "2.13490000"
      },
      {
      "symbol": "SUITUSD",
      "price": "4.06690000"
      },
      {
      "symbol": "SUIBTC",
      "price": "0.00002517"
      },
      {
      "symbol": "SUIBNB",
      "price": "0.00359900"
      },
      {
      "symbol": "SUIEUR",
      "price": "1.87040000"
      },
      {
      "symbol": "SUITRY",
      "price": "81.35000000"
      },
      {
      "symbol": "AERGOUSDT",
      "price": "0.06350000"
      },
      {
      "symbol": "RNDRTRY",
      "price": "233.63000000"
      },
      {
      "symbol": "PEPEUSDT",
      "price": "0.00000749"
      },
      {
      "symbol": "PEPETUSD",
      "price": "0.00002351"
      },
      {
      "symbol": "FLOKIUSDT",
      "price": "0.00005832"
      },
      {
      "symbol": "FLOKITUSD",
      "price": "0.00003203"
      },
      {
      "symbol": "OGTRY",
      "price": "147.40000000"
      },
      {
      "symbol": "PEPETRY",
      "price": "0.00028542"
      },
      {
      "symbol": "WBETHETH",
      "price": "1.06690000"
      },
      {
      "symbol": "ASTUSDT",
      "price": "0.02610000"
      },
      {
      "symbol": "SNTUSDT",
      "price": "0.02720000"
      },
      {
      "symbol": "FLOKITRY",
      "price": "0.00222200"
      },
      {
      "symbol": "CITYTRY",
      "price": "38.50000000"
      },
      {
      "symbol": "COMBOUSDT",
      "price": "0.02760000"
      },
      {
      "symbol": "COMBOBNB",
      "price": "0.00227200"
      },
      {
      "symbol": "COMBOTRY",
      "price": "1.05000000"
      },
      {
      "symbol": "LTCTRY",
      "price": "2914.00000000"
      },
      {
      "symbol": "RADTRY",
      "price": "28.49000000"
      },
      {
      "symbol": "BTCARS",
      "price": "102552306.00000000"
      },
      {
      "symbol": "OPTRY",
      "price": "27.02000000"
      },
      {
      "symbol": "PAXGTRY",
      "price": "127667.00000000"
      },
      {
      "symbol": "MAVBTC",
      "price": "0.00000064"
      },
      {
      "symbol": "MAVUSDT",
      "price": "0.05463000"
      },
      {
      "symbol": "MAVTUSD",
      "price": "0.21940000"
      },
      {
      "symbol": "CFXTUSD",
      "price": "0.22120000"
      },
      {
      "symbol": "PENDLEBTC",
      "price": "0.00003684"
      },
      {
      "symbol": "PENDLEUSDT",
      "price": "3.12200000"
      },
      {
      "symbol": "PENDLETUSD",
      "price": "2.70440000"
      },
      {
      "symbol": "MAVTRY",
      "price": "2.08000000"
      },
      {
      "symbol": "OCEANTRY",
      "price": "20.10000000"
      },
      {
      "symbol": "TUSDTRY",
      "price": "35.34000000"
      },
      {
      "symbol": "ARBETH",
      "price": "0.00018870"
      },
      {
      "symbol": "BCHTRY",
      "price": "12808.00000000"
      },
      {
      "symbol": "XVGTRY",
      "price": "0.17150000"
      },
      {
      "symbol": "XVGTUSD",
      "price": "0.00626900"
      },
      {
      "symbol": "ARKMUSDT",
      "price": "0.50500000"
      },
      {
      "symbol": "ARKMTUSD",
      "price": "1.15100000"
      },
      {
      "symbol": "ARKMTRY",
      "price": "19.25000000"
      },
      {
      "symbol": "ARKMBNB",
      "price": "0.00085200"
      },
      {
      "symbol": "ARKMBTC",
      "price": "0.00000596"
      },
      {
      "symbol": "WBETHUSDT",
      "price": "1701.59000000"
      },
      {
      "symbol": "ACATRY",
      "price": "1.17300000"
      },
      {
      "symbol": "AVAXTUSD",
      "price": "27.66000000"
      },
      {
      "symbol": "COMPTUSD",
      "price": "84.22000000"
      },
      {
      "symbol": "COMPTRY",
      "price": "1524.00000000"
      },
      {
      "symbol": "XECTRY",
      "price": "0.00077630"
      },
      {
      "symbol": "QUICKTUSD",
      "price": "0.04668000"
      },
      {
      "symbol": "WLDUSDT",
      "price": "0.75500000"
      },
      {
      "symbol": "WLDBTC",
      "price": "0.00000891"
      },
      {
      "symbol": "BNBFDUSD",
      "price": "594.18000000"
      },
      {
      "symbol": "FDUSDBUSD",
      "price": "1.00000000"
      },
      {
      "symbol": "FDUSDUSDT",
      "price": "0.99890000"
      },
      {
      "symbol": "ARKMRUB",
      "price": "40.11000000"
      },
      {
      "symbol": "WLDTRY",
      "price": "28.79000000"
      },
      {
      "symbol": "WLDRUB",
      "price": "218.30000000"
      },
      {
      "symbol": "AMPTRY",
      "price": "0.13610000"
      },
      {
      "symbol": "OGNTRY",
      "price": "2.12800000"
      },
      {
      "symbol": "BTCFDUSD",
      "price": "84889.84000000"
      },
      {
      "symbol": "ETHFDUSD",
      "price": "1597.49000000"
      },
      {
      "symbol": "ASRTRY",
      "price": "40.65000000"
      },
      {
      "symbol": "ATMTRY",
      "price": "40.68000000"
      },
      {
      "symbol": "ACMTRY",
      "price": "55.29000000"
      },
      {
      "symbol": "BARTRY",
      "price": "62.30000000"
      },
      {
      "symbol": "JUVTRY",
      "price": "37.05000000"
      },
      {
      "symbol": "PSGTRY",
      "price": "73.54000000"
      },
      {
      "symbol": "SEIBNB",
      "price": "0.00028930"
      },
      {
      "symbol": "SEIBTC",
      "price": "0.00000203"
      },
      {
      "symbol": "SEIFDUSD",
      "price": "0.17210000"
      },
      {
      "symbol": "SEITRY",
      "price": "6.53300000"
      },
      {
      "symbol": "SEIUSDT",
      "price": "0.17190000"
      },
      {
      "symbol": "CYBERBNB",
      "price": "0.00198500"
      },
      {
      "symbol": "CYBERBTC",
      "price": "0.00001390"
      },
      {
      "symbol": "CYBERFDUSD",
      "price": "1.20200000"
      },
      {
      "symbol": "CYBERTRY",
      "price": "44.80000000"
      },
      {
      "symbol": "CYBERUSDT",
      "price": "1.17900000"
      },
      {
      "symbol": "CYBERTUSD",
      "price": "3.76500000"
      },
      {
      "symbol": "SEITUSD",
      "price": "0.36330000"
      },
      {
      "symbol": "LPTTRY",
      "price": "156.20000000"
      },
      {
      "symbol": "UNITRY",
      "price": "200.80000000"
      },
      {
      "symbol": "SOLFDUSD",
      "price": "139.70000000"
      },
      {
      "symbol": "TOMOTRY",
      "price": "40.26000000"
      },
      {
      "symbol": "UNFITRY",
      "price": "46.10000000"
      },
      {
      "symbol": "XRPFDUSD",
      "price": "2.07120000"
      },
      {
      "symbol": "DOGEFDUSD",
      "price": "0.15714000"
      },
      {
      "symbol": "CYBERETH",
      "price": "0.00074400"
      },
      {
      "symbol": "MTLTRY",
      "price": "38.80000000"
      },
      {
      "symbol": "ARKUSDT",
      "price": "0.52750000"
      },
      {
      "symbol": "CREAMUSDT",
      "price": "2.10000000"
      },
      {
      "symbol": "GFTUSDT",
      "price": "0.00196000"
      },
      {
      "symbol": "IQUSDT",
      "price": "0.00428700"
      },
      {
      "symbol": "USDTVAI",
      "price": "1.01300000"
      },
      {
      "symbol": "ARBFDUSD",
      "price": "0.30120000"
      },
      {
      "symbol": "FDUSDTRY",
      "price": "38.07000000"
      },
      {
      "symbol": "FRONTTRY",
      "price": "30.14000000"
      },
      {
      "symbol": "SUIFDUSD",
      "price": "2.13850000"
      },
      {
      "symbol": "NTRNBTC",
      "price": "0.00000621"
      },
      {
      "symbol": "NTRNUSDT",
      "price": "0.13020000"
      },
      {
      "symbol": "NTRNBNB",
      "price": "0.00021800"
      },
      {
      "symbol": "FILFDUSD",
      "price": "2.63500000"
      },
      {
      "symbol": "FRONTTUSD",
      "price": "0.91380000"
      },
      {
      "symbol": "LEVERTRY",
      "price": "0.02071000"
      },
      {
      "symbol": "LTCFDUSD",
      "price": "76.53000000"
      },
      {
      "symbol": "ADAFDUSD",
      "price": "0.62580000"
      },
      {
      "symbol": "RUNETUSD",
      "price": "5.50100000"
      },
      {
      "symbol": "TRBTRY",
      "price": "1016.00000000"
      },
      {
      "symbol": "ATOMFDUSD",
      "price": "4.20000000"
      },
      {
      "symbol": "AVAXFDUSD",
      "price": "19.63000000"
      },
      {
      "symbol": "BANDTRY",
      "price": "37.91000000"
      },
      {
      "symbol": "BCHFDUSD",
      "price": "335.70000000"
      },
      {
      "symbol": "LOOMTRY",
      "price": "1.65400000"
      },
      {
      "symbol": "MATICFDUSD",
      "price": "0.37950000"
      },
      {
      "symbol": "ALGOFDUSD",
      "price": "0.12140000"
      },
      {
      "symbol": "DOTFDUSD",
      "price": "3.88700000"
      },
      {
      "symbol": "FTMFDUSD",
      "price": "0.70080000"
      },
      {
      "symbol": "LINKFDUSD",
      "price": "12.98000000"
      },
      {
      "symbol": "NEARFDUSD",
      "price": "2.17600000"
      },
      {
      "symbol": "STRAXTRY",
      "price": "2.32100000"
      },
      {
      "symbol": "TIABTC",
      "price": "0.00002930"
      },
      {
      "symbol": "TIAUSDT",
      "price": "2.48000000"
      },
      {
      "symbol": "TIATRY",
      "price": "94.50000000"
      },
      {
      "symbol": "MEMEBNB",
      "price": "0.00004107"
      },
      {
      "symbol": "MEMEUSDT",
      "price": "0.00220000"
      },
      {
      "symbol": "MEMEFDUSD",
      "price": "0.00220500"
      },
      {
      "symbol": "MEMETUSD",
      "price": "0.02722000"
      },
      {
      "symbol": "MEMETRY",
      "price": "0.08380000"
      },
      {
      "symbol": "ORDIBTC",
      "price": "0.00007780"
      },
      {
      "symbol": "ORDIUSDT",
      "price": "6.55000000"
      },
      {
      "symbol": "ORDITRY",
      "price": "250.00000000"
      },
      {
      "symbol": "EGLDFDUSD",
      "price": "14.69000000"
      },
      {
      "symbol": "FETFDUSD",
      "price": "0.57400000"
      },
      {
      "symbol": "GASFDUSD",
      "price": "2.78500000"
      },
      {
      "symbol": "INJETH",
      "price": "0.00522800"
      },
      {
      "symbol": "INJTUSD",
      "price": "26.23000000"
      },
      {
      "symbol": "OPFDUSD",
      "price": "0.70900000"
      },
      {
      "symbol": "ORDIFDUSD",
      "price": "6.58000000"
      },
      {
      "symbol": "ORDITUSD",
      "price": "36.89000000"
      },
      {
      "symbol": "RNDRFDUSD",
      "price": "7.02900000"
      },
      {
      "symbol": "SHIBTUSD",
      "price": "0.00001766"
      },
      {
      "symbol": "BEAMXUSDT",
      "price": "0.00639000"
      },
      {
      "symbol": "ARKTRY",
      "price": "20.10000000"
      },
      {
      "symbol": "BEAMXTRY",
      "price": "0.24320000"
      },
      {
      "symbol": "CAKETRY",
      "price": "75.09000000"
      },
      {
      "symbol": "CAKETUSD",
      "price": "2.77400000"
      },
      {
      "symbol": "DYDXFDUSD",
      "price": "0.59120000"
      },
      {
      "symbol": "PIVXUSDT",
      "price": "0.12880000"
      },
      {
      "symbol": "RUNEFDUSD",
      "price": "1.17100000"
      },
      {
      "symbol": "TIATUSD",
      "price": "6.40000000"
      },
      {
      "symbol": "DOTTUSD",
      "price": "7.09800000"
      },
      {
      "symbol": "GALAFDUSD",
      "price": "0.01539000"
      },
      {
      "symbol": "WLDFDUSD",
      "price": "0.75700000"
      },
      {
      "symbol": "GASTRY",
      "price": "133.60000000"
      },
      {
      "symbol": "NTRNTRY",
      "price": "4.95000000"
      },
      {
      "symbol": "VICBTC",
      "price": "0.00000276"
      },
      {
      "symbol": "VICUSDT",
      "price": "0.20690000"
      },
      {
      "symbol": "VICTRY",
      "price": "7.86000000"
      },
      {
      "symbol": "BLURBTC",
      "price": "0.00000117"
      },
      {
      "symbol": "BLURUSDT",
      "price": "0.10160000"
      },
      {
      "symbol": "BLURTRY",
      "price": "3.87000000"
      },
      {
      "symbol": "BLURFDUSD",
      "price": "0.20900000"
      },
      {
      "symbol": "SUPERFDUSD",
      "price": "0.60120000"
      },
      {
      "symbol": "USTCFDUSD",
      "price": "0.01829000"
      },
      {
      "symbol": "USTCTRY",
      "price": "0.47400000"
      },
      {
      "symbol": "DYDXTRY",
      "price": "22.47000000"
      },
      {
      "symbol": "VANRYUSDT",
      "price": "0.02560000"
      },
      {
      "symbol": "VANRYBTC",
      "price": "0.00000027"
      },
      {
      "symbol": "BTCAEUR",
      "price": "51466.50000000"
      },
      {
      "symbol": "AEURUSDT",
      "price": "1.04570000"
      },
      {
      "symbol": "ETHAEUR",
      "price": "2700.00000000"
      },
      {
      "symbol": "EURAEUR",
      "price": "1.08310000"
      },
      {
      "symbol": "AUCTIONFDUSD",
      "price": "11.39000000"
      },
      {
      "symbol": "IOTAFDUSD",
      "price": "0.14040000"
      },
      {
      "symbol": "LUNCTRY",
      "price": "0.00233500"
      },
      {
      "symbol": "SUPERTRY",
      "price": "20.67000000"
      },
      {
      "symbol": "JTOUSDT",
      "price": "1.67400000"
      },
      {
      "symbol": "JTOFDUSD",
      "price": "1.67500000"
      },
      {
      "symbol": "JTOTRY",
      "price": "63.70000000"
      },
      {
      "symbol": "1000SATSUSDT",
      "price": "0.00003980"
      },
      {
      "symbol": "1000SATSFDUSD",
      "price": "0.00003990"
      },
      {
      "symbol": "1000SATSTRY",
      "price": "0.00151200"
      },
      {
      "symbol": "SHIBFDUSD",
      "price": "0.00001239"
      },
      {
      "symbol": "SANDFDUSD",
      "price": "0.26640000"
      },
      {
      "symbol": "MEMEETH",
      "price": "0.00000576"
      },
      {
      "symbol": "IOTATRY",
      "price": "6.26700000"
      },
      {
      "symbol": "INJFDUSD",
      "price": "8.36000000"
      },
      {
      "symbol": "FIDATRY",
      "price": "2.81100000"
      },
      {
      "symbol": "BONKUSDT",
      "price": "0.00001238"
      },
      {
      "symbol": "BONKFDUSD",
      "price": "0.00001239"
      },
      {
      "symbol": "BONKTRY",
      "price": "0.00047220"
      },
      {
      "symbol": "ACEFDUSD",
      "price": "2.02200000"
      },
      {
      "symbol": "ACEUSDT",
      "price": "0.57100000"
      },
      {
      "symbol": "ACEBNB",
      "price": "0.00894000"
      },
      {
      "symbol": "ACEBTC",
      "price": "0.00002169"
      },
      {
      "symbol": "ACETRY",
      "price": "21.73000000"
      },
      {
      "symbol": "BLZFDUSD",
      "price": "0.12600000"
      },
      {
      "symbol": "RARETRY",
      "price": "2.25000000"
      },
      {
      "symbol": "VANRYTRY",
      "price": "0.98100000"
      },
      {
      "symbol": "NFPBTC",
      "price": "0.00000080"
      },
      {
      "symbol": "NFPUSDT",
      "price": "0.06680000"
      },
      {
      "symbol": "NFPBNB",
      "price": "0.00056200"
      },
      {
      "symbol": "NFPFDUSD",
      "price": "0.06660000"
      },
      {
      "symbol": "NFPTUSD",
      "price": "0.39750000"
      },
      {
      "symbol": "NFPTRY",
      "price": "2.55000000"
      },
      {
      "symbol": "ARBUSDC",
      "price": "0.30170000"
      },
      {
      "symbol": "AVAXUSDC",
      "price": "19.63000000"
      },
      {
      "symbol": "DOTUSDC",
      "price": "3.88200000"
      },
      {
      "symbol": "INJUSDC",
      "price": "8.34000000"
      },
      {
      "symbol": "MATICUSDC",
      "price": "0.37910000"
      },
      {
      "symbol": "OPUSDC",
      "price": "0.70900000"
      },
      {
      "symbol": "ORDIUSDC",
      "price": "6.56000000"
      },
      {
      "symbol": "AIBTC",
      "price": "0.00000159"
      },
      {
      "symbol": "AIUSDT",
      "price": "0.13500000"
      },
      {
      "symbol": "AIBNB",
      "price": "0.00022790"
      },
      {
      "symbol": "AIFDUSD",
      "price": "0.13500000"
      },
      {
      "symbol": "AITUSD",
      "price": "0.51400000"
      },
      {
      "symbol": "AITRY",
      "price": "5.15000000"
      },
      {
      "symbol": "ICPFDUSD",
      "price": "4.87200000"
      },
      {
      "symbol": "LDOFDUSD",
      "price": "0.71400000"
      },
      {
      "symbol": "MOVRTRY",
      "price": "202.70000000"
      },
      {
      "symbol": "XAIBTC",
      "price": "0.00000089"
      },
      {
      "symbol": "XAIUSDT",
      "price": "0.04850000"
      },
      {
      "symbol": "XAIBNB",
      "price": "0.00103800"
      },
      {
      "symbol": "XAIFDUSD",
      "price": "0.04890000"
      },
      {
      "symbol": "XAITUSD",
      "price": "0.89860000"
      },
      {
      "symbol": "XAITRY",
      "price": "1.85000000"
      },
      {
      "symbol": "SKLTRY",
      "price": "0.79300000"
      },
      {
      "symbol": "STXFDUSD",
      "price": "0.62400000"
      },
      {
      "symbol": "TIAFDUSD",
      "price": "2.48400000"
      },
      {
      "symbol": "MANTABTC",
      "price": "0.00000238"
      },
      {
      "symbol": "MANTAUSDT",
      "price": "0.20200000"
      },
      {
      "symbol": "MANTABNB",
      "price": "0.00157000"
      },
      {
      "symbol": "MANTAFDUSD",
      "price": "0.20200000"
      },
      {
      "symbol": "MANTATRY",
      "price": "7.68000000"
      },
      {
      "symbol": "ENSFDUSD",
      "price": "14.45000000"
      },
      {
      "symbol": "ETCFDUSD",
      "price": "15.88000000"
      },
      {
      "symbol": "SUIUSDC",
      "price": "2.13440000"
      },
      {
      "symbol": "TIAUSDC",
      "price": "2.48100000"
      },
      {
      "symbol": "CHZFDUSD",
      "price": "0.08760000"
      },
      {
      "symbol": "MANTAUSDC",
      "price": "0.20200000"
      },
      {
      "symbol": "ALTBTC",
      "price": "0.00000033"
      },
      {
      "symbol": "ALTUSDT",
      "price": "0.02864000"
      },
      {
      "symbol": "ALTBNB",
      "price": "0.00004830"
      },
      {
      "symbol": "ALTFDUSD",
      "price": "0.02869000"
      },
      {
      "symbol": "ALTTRY",
      "price": "1.09100000"
      },
      {
      "symbol": "APTFDUSD",
      "price": "4.88000000"
      },
      {
      "symbol": "BLURUSDC",
      "price": "0.10160000"
      },
      {
      "symbol": "JUPUSDT",
      "price": "0.40200000"
      },
      {
      "symbol": "JUPFDUSD",
      "price": "0.40140000"
      },
      {
      "symbol": "JUPTRY",
      "price": "15.28000000"
      },
      {
      "symbol": "ALTUSDC",
      "price": "0.02868000"
      },
      {
      "symbol": "MAGICFDUSD",
      "price": "0.90500000"
      },
      {
      "symbol": "SEIUSDC",
      "price": "0.17200000"
      },
      {
      "symbol": "PYTHBTC",
      "price": "0.00000167"
      },
      {
      "symbol": "PYTHUSDT",
      "price": "0.14170000"
      },
      {
      "symbol": "PYTHFDUSD",
      "price": "0.14160000"
      },
      {
      "symbol": "PYTHTRY",
      "price": "5.39000000"
      },
      {
      "symbol": "RONINBTC",
      "price": "0.00000589"
      },
      {
      "symbol": "RONINUSDT",
      "price": "0.49900000"
      },
      {
      "symbol": "RONINFDUSD",
      "price": "0.50000000"
      },
      {
      "symbol": "RONINTRY",
      "price": "19.02000000"
      },
      {
      "symbol": "DYMBTC",
      "price": "0.00001452"
      },
      {
      "symbol": "DYMUSDT",
      "price": "0.28600000"
      },
      {
      "symbol": "DYMFDUSD",
      "price": "1.34000000"
      },
      {
      "symbol": "DYMTRY",
      "price": "10.91000000"
      },
      {
      "symbol": "JUPUSDC",
      "price": "0.40190000"
      },
      {
      "symbol": "PENDLEFDUSD",
      "price": "3.11300000"
      },
      {
      "symbol": "PIXELBTC",
      "price": "0.00000146"
      },
      {
      "symbol": "PIXELBNB",
      "price": "0.00022800"
      },
      {
      "symbol": "PIXELUSDT",
      "price": "0.03075000"
      },
      {
      "symbol": "PIXELFDUSD",
      "price": "0.15530000"
      },
      {
      "symbol": "PIXELTRY",
      "price": "1.17200000"
      },
      {
      "symbol": "STRKBTC",
      "price": "0.00000155"
      },
      {
      "symbol": "STRKUSDT",
      "price": "0.13150000"
      },
      {
      "symbol": "STRKFDUSD",
      "price": "0.13160000"
      },
      {
      "symbol": "STRKTRY",
      "price": "5.00000000"
      },
      {
      "symbol": "FILUSDC",
      "price": "2.63200000"
      },
      {
      "symbol": "HBARTRY",
      "price": "6.26600000"
      },
      {
      "symbol": "PENDLETRY",
      "price": "118.70000000"
      },
      {
      "symbol": "WLDUSDC",
      "price": "0.75500000"
      },
      {
      "symbol": "CKBTRY",
      "price": "0.17080000"
      },
      {
      "symbol": "COTITRY",
      "price": "2.65200000"
      },
      {
      "symbol": "LDOTRY",
      "price": "27.16000000"
      },
      {
      "symbol": "UNIUSDC",
      "price": "5.26500000"
      },
      {
      "symbol": "PORTALBTC",
      "price": "0.00000097"
      },
      {
      "symbol": "PORTALUSDT",
      "price": "0.08210000"
      },
      {
      "symbol": "PORTALBNB",
      "price": "0.00013840"
      },
      {
      "symbol": "PORTALFDUSD",
      "price": "0.08190000"
      },
      {
      "symbol": "PORTALTRY",
      "price": "3.12900000"
      },
      {
      "symbol": "PDABTC",
      "price": "0.00000079"
      },
      {
      "symbol": "PDAUSDT",
      "price": "0.01323000"
      },
      {
      "symbol": "AXLBTC",
      "price": "0.00000354"
      },
      {
      "symbol": "AXLUSDT",
      "price": "0.30010000"
      },
      {
      "symbol": "AXLFDUSD",
      "price": "0.61060000"
      },
      {
      "symbol": "AXLTRY",
      "price": "11.43000000"
      },
      {
      "symbol": "PEPEFDUSD",
      "price": "0.00000750"
      },
      {
      "symbol": "PIXELUSDC",
      "price": "0.03098000"
      },
      {
      "symbol": "STRKUSDC",
      "price": "0.13140000"
      },
      {
      "symbol": "UNIFDUSD",
      "price": "5.26900000"
      },
      {
      "symbol": "OMTRY",
      "price": "23.11000000"
      },
      {
      "symbol": "THETATRY",
      "price": "25.34000000"
      },
      {
      "symbol": "WIFBTC",
      "price": "0.00000507"
      },
      {
      "symbol": "WIFUSDT",
      "price": "0.43000000"
      },
      {
      "symbol": "WIFFDUSD",
      "price": "0.43100000"
      },
      {
      "symbol": "WIFTRY",
      "price": "16.39000000"
      },
      {
      "symbol": "AGIXFDUSD",
      "price": "0.61880000"
      },
      {
      "symbol": "PEPEUSDC",
      "price": "0.00000749"
      },
      {
      "symbol": "SHIBUSDC",
      "price": "0.00001238"
      },
      {
      "symbol": "THETAFDUSD",
      "price": "0.67500000"
      },
      {
      "symbol": "ARTRY",
      "price": "210.70000000"
      },
      {
      "symbol": "METISBTC",
      "price": "0.00053900"
      },
      {
      "symbol": "METISUSDT",
      "price": "14.48000000"
      },
      {
      "symbol": "METISFDUSD",
      "price": "49.49000000"
      },
      {
      "symbol": "METISTRY",
      "price": "550.00000000"
      },
      {
      "symbol": "BNBJPY",
      "price": "84477.00000000"
      },
      {
      "symbol": "BTCJPY",
      "price": "12081078.00000000"
      },
      {
      "symbol": "ETHJPY",
      "price": "227256.00000000"
      },
      {
      "symbol": "FLOKIFDUSD",
      "price": "0.00005839"
      },
      {
      "symbol": "GRTFDUSD",
      "price": "0.08170000"
      },
      {
      "symbol": "NEARUSDC",
      "price": "2.17500000"
      },
      {
      "symbol": "SNXTRY",
      "price": "24.34000000"
      },
      {
      "symbol": "AEVOBTC",
      "price": "0.00000113"
      },
      {
      "symbol": "AEVOUSDT",
      "price": "0.09580000"
      },
      {
      "symbol": "AEVOBNB",
      "price": "0.00077700"
      },
      {
      "symbol": "AEVOFDUSD",
      "price": "0.09590000"
      },
      {
      "symbol": "AEVOTRY",
      "price": "3.65000000"
      },
      {
      "symbol": "FETUSDC",
      "price": "0.57300000"
      },
      {
      "symbol": "IMXTRY",
      "price": "38.57000000"
      },
      {
      "symbol": "EURUSDC",
      "price": "1.13920000"
      },
      {
      "symbol": "BOMETRY",
      "price": "0.04810000"
      },
      {
      "symbol": "BOMEBTC",
      "price": "0.00000006"
      },
      {
      "symbol": "BOMEUSDT",
      "price": "0.00126000"
      },
      {
      "symbol": "BOMEFDUSD",
      "price": "0.00126100"
      },
      {
      "symbol": "ETHFIBTC",
      "price": "0.00000790"
      },
      {
      "symbol": "ETHFIUSDT",
      "price": "0.48200000"
      },
      {
      "symbol": "ETHFIBNB",
      "price": "0.00252300"
      },
      {
      "symbol": "ETHFIFDUSD",
      "price": "0.48800000"
      },
      {
      "symbol": "ETHFITRY",
      "price": "18.35000000"
      },
      {
      "symbol": "AAVETRY",
      "price": "5348.00000000"
      },
      {
      "symbol": "ARKMFDUSD",
      "price": "0.50500000"
      },
      {
      "symbol": "CRVTRY",
      "price": "23.24000000"
      },
      {
      "symbol": "FETBRL",
      "price": "4.33000000"
      },
      {
      "symbol": "RAYFDUSD",
      "price": "2.20800000"
      },
      {
      "symbol": "RNDREUR",
      "price": "6.47500000"
      },
      {
      "symbol": "BONKUSDC",
      "price": "0.00001239"
      },
      {
      "symbol": "FLOKIUSDC",
      "price": "0.00005832"
      },
      {
      "symbol": "MKRTRY",
      "price": "51640.00000000"
      },
      {
      "symbol": "RAYTRY",
      "price": "84.31000000"
      },
      {
      "symbol": "RNDRBRL",
      "price": "39.58000000"
      },
      {
      "symbol": "ENABTC",
      "price": "0.00000333"
      },
      {
      "symbol": "ENAUSDT",
      "price": "0.28260000"
      },
      {
      "symbol": "ENABNB",
      "price": "0.00047740"
      },
      {
      "symbol": "ENAFDUSD",
      "price": "0.28330000"
      },
      {
      "symbol": "ENATRY",
      "price": "10.77500000"
      },
      {
      "symbol": "LQTYFDUSD",
      "price": "0.65100000"
      },
      {
      "symbol": "MASKTRY",
      "price": "41.40000000"
      },
      {
      "symbol": "PENDLEUSDC",
      "price": "3.12500000"
      },
      {
      "symbol": "RDNTTRY",
      "price": "0.79100000"
      },
      {
      "symbol": "WBTC",
      "price": "0.00000088"
      },
      {
      "symbol": "WUSDT",
      "price": "0.07410000"
      },
      {
      "symbol": "WFDUSD",
      "price": "0.07410000"
      },
      {
      "symbol": "WTRY",
      "price": "2.82100000"
      },
      {
      "symbol": "BOMEUSDC",
      "price": "0.00126300"
      },
      {
      "symbol": "JTOUSDC",
      "price": "1.67600000"
      },
      {
      "symbol": "WIFUSDC",
      "price": "0.43000000"
      },
      {
      "symbol": "TNSRBTC",
      "price": "0.00000142"
      },
      {
      "symbol": "TNSRUSDT",
      "price": "0.13380000"
      },
      {
      "symbol": "TNSRFDUSD",
      "price": "0.13420000"
      },
      {
      "symbol": "TNSRTRY",
      "price": "5.10000000"
      },
      {
      "symbol": "SAGABTC",
      "price": "0.00000271"
      },
      {
      "symbol": "SAGAUSDT",
      "price": "0.23030000"
      },
      {
      "symbol": "SAGABNB",
      "price": "0.00038800"
      },
      {
      "symbol": "SAGAFDUSD",
      "price": "0.23010000"
      },
      {
      "symbol": "SAGATRY",
      "price": "8.78000000"
      },
      {
      "symbol": "USDTMXN",
      "price": "19.95000000"
      },
      {
      "symbol": "CKBUSDC",
      "price": "0.00449300"
      },
      {
      "symbol": "ENAUSDC",
      "price": "0.28270000"
      },
      {
      "symbol": "ETHFIUSDC",
      "price": "0.48200000"
      },
      {
      "symbol": "YGGUSDC",
      "price": "0.17820000"
      },
      {
      "symbol": "USDTCZK",
      "price": "22.90000000"
      },
      {
      "symbol": "TAOBTC",
      "price": "0.00360100"
      },
      {
      "symbol": "TAOUSDT",
      "price": "305.60000000"
      },
      {
      "symbol": "TAOFDUSD",
      "price": "305.70000000"
      },
      {
      "symbol": "TAOTRY",
      "price": "11644.00000000"
      },
      {
      "symbol": "CFXUSDC",
      "price": "0.07070000"
      },
      {
      "symbol": "RNDRUSDC",
      "price": "7.04100000"
      },
      {
      "symbol": "RUNEUSDC",
      "price": "1.17200000"
      },
      {
      "symbol": "SAGAUSDC",
      "price": "0.23030000"
      },
      {
      "symbol": "POLYXTRY",
      "price": "5.73000000"
      },
      {
      "symbol": "OMNIBTC",
      "price": "0.00002440"
      },
      {
      "symbol": "OMNIUSDT",
      "price": "2.06000000"
      },
      {
      "symbol": "OMNIBNB",
      "price": "0.01361000"
      },
      {
      "symbol": "OMNIFDUSD",
      "price": "2.07000000"
      },
      {
      "symbol": "OMNITRY",
      "price": "78.90000000"
      },
      {
      "symbol": "APTUSDC",
      "price": "4.87800000"
      },
      {
      "symbol": "GALAUSDC",
      "price": "0.01539000"
      },
      {
      "symbol": "OMNIBRL",
      "price": "40.20000000"
      },
      {
      "symbol": "STXUSDC",
      "price": "0.62300000"
      },
      {
      "symbol": "ICPUSDC",
      "price": "4.86500000"
      },
      {
      "symbol": "OMNIUSDC",
      "price": "2.07000000"
      },
      {
      "symbol": "PEPEBRL",
      "price": "0.00004384"
      },
      {
      "symbol": "YGGTRY",
      "price": "6.78000000"
      },
      {
      "symbol": "ADAJPY",
      "price": "89.03000000"
      },
      {
      "symbol": "SHIBJPY",
      "price": "0.00176000"
      },
      {
      "symbol": "SOLJPY",
      "price": "19885.00000000"
      },
      {
      "symbol": "XRPJPY",
      "price": "294.77000000"
      },
      {
      "symbol": "REZBTC",
      "price": "0.00000018"
      },
      {
      "symbol": "REZUSDT",
      "price": "0.01282000"
      },
      {
      "symbol": "REZBNB",
      "price": "0.00008310"
      },
      {
      "symbol": "REZFDUSD",
      "price": "0.03438000"
      },
      {
      "symbol": "REZTRY",
      "price": "0.48800000"
      },
      {
      "symbol": "EGLDTRY",
      "price": "550.20000000"
      },
      {
      "symbol": "PHBTRY",
      "price": "17.93000000"
      },
      {
      "symbol": "RSRTRY",
      "price": "0.27890000"
      },
      {
      "symbol": "BBBTC",
      "price": "0.00000128"
      },
      {
      "symbol": "BBUSDT",
      "price": "0.10780000"
      },
      {
      "symbol": "BBBNB",
      "price": "0.00018150"
      },
      {
      "symbol": "BBFDUSD",
      "price": "0.10830000"
      },
      {
      "symbol": "BBTRY",
      "price": "4.11000000"
      },
      {
      "symbol": "FRONTUSDC",
      "price": "0.88300000"
      },
      {
      "symbol": "PEOPLETRY",
      "price": "0.51800000"
      },
      {
      "symbol": "TRBUSDC",
      "price": "26.69000000"
      },
      {
      "symbol": "NOTUSDT",
      "price": "0.00190800"
      },
      {
      "symbol": "NOTBNB",
      "price": "0.00001353"
      },
      {
      "symbol": "NOTFDUSD",
      "price": "0.00191000"
      },
      {
      "symbol": "NOTTRY",
      "price": "0.07260000"
      },
      {
      "symbol": "ARKMUSDC",
      "price": "0.50400000"
      },
      {
      "symbol": "ARUSDC",
      "price": "5.54000000"
      },
      {
      "symbol": "BBUSDC",
      "price": "0.10800000"
      },
      {
      "symbol": "CRVUSDC",
      "price": "0.61010000"
      },
      {
      "symbol": "PEOPLEUSDC",
      "price": "0.01355000"
      },
      {
      "symbol": "ARFDUSD",
      "price": "5.55000000"
      },
      {
      "symbol": "ENAEUR",
      "price": "0.27700000"
      },
      {
      "symbol": "PEPEEUR",
      "price": "0.00000657"
      },
      {
      "symbol": "REZUSDC",
      "price": "0.01277000"
      },
      {
      "symbol": "TRBFDUSD",
      "price": "59.44000000"
      },
      {
      "symbol": "USDCTRY",
      "price": "38.10000000"
      },
      {
      "symbol": "BTCMXN",
      "price": "1691500.00000000"
      },
      {
      "symbol": "XRPMXN",
      "price": "41.55400000"
      },
      {
      "symbol": "ENSUSDC",
      "price": "14.40000000"
      },
      {
      "symbol": "LDOUSDC",
      "price": "0.71300000"
      },
      {
      "symbol": "NOTUSDC",
      "price": "0.00190900"
      },
      {
      "symbol": "NEARBRL",
      "price": "12.86000000"
      },
      {
      "symbol": "HIGHTRY",
      "price": "21.10000000"
      },
      {
      "symbol": "PEOPLEFDUSD",
      "price": "0.01361000"
      },
      {
      "symbol": "TNSRUSDC",
      "price": "0.13400000"
      },
      {
      "symbol": "USDTCOP",
      "price": "4263.00000000"
      },
      {
      "symbol": "IOBTC",
      "price": "0.00000772"
      },
      {
      "symbol": "IOUSDT",
      "price": "0.65400000"
      },
      {
      "symbol": "IOBNB",
      "price": "0.00110200"
      },
      {
      "symbol": "IOFDUSD",
      "price": "0.65500000"
      },
      {
      "symbol": "IOTRY",
      "price": "24.83000000"
      },
      {
      "symbol": "NOTBRL",
      "price": "0.03755000"
      },
      {
      "symbol": "TRUTRY",
      "price": "1.28300000"
      },
      {
      "symbol": "WIFEUR",
      "price": "0.37800000"
      },
      {
      "symbol": "ZKBTC",
      "price": "0.00000060"
      },
      {
      "symbol": "ZKUSDT",
      "price": "0.05050000"
      },
      {
      "symbol": "ZKFDUSD",
      "price": "0.05050000"
      },
      {
      "symbol": "ZKTRY",
      "price": "1.92200000"
      },
      {
      "symbol": "LISTAUSDT",
      "price": "0.18310000"
      },
      {
      "symbol": "LISTABNB",
      "price": "0.00031110"
      },
      {
      "symbol": "LISTAFDUSD",
      "price": "0.18300000"
      },
      {
      "symbol": "LISTATRY",
      "price": "7.00000000"
      },
      {
      "symbol": "ZROBTC",
      "price": "0.00002975"
      },
      {
      "symbol": "ZROUSDT",
      "price": "2.52900000"
      },
      {
      "symbol": "ZROFDUSD",
      "price": "2.52300000"
      },
      {
      "symbol": "ZROTRY",
      "price": "96.50000000"
      },
      {
      "symbol": "LISTABRL",
      "price": "2.17600000"
      },
      {
      "symbol": "BAKETRY",
      "price": "4.72000000"
      },
      {
      "symbol": "WIFBRL",
      "price": "2.53000000"
      },
      {
      "symbol": "ZKUSDC",
      "price": "0.05040000"
      },
      {
      "symbol": "ZROUSDC",
      "price": "2.53100000"
      },
      {
      "symbol": "IOUSDC",
      "price": "0.65400000"
      },
      {
      "symbol": "1000SATSUSDC",
      "price": "0.00003970"
      },
      {
      "symbol": "BNXTRY",
      "price": "65.30000000"
      },
      {
      "symbol": "ETHARS",
      "price": "1944776.00000000"
      },
      {
      "symbol": "GUSDT",
      "price": "0.01413000"
      },
      {
      "symbol": "GTRY",
      "price": "0.53900000"
      },
      {
      "symbol": "BANANABTC",
      "price": "0.00019870"
      },
      {
      "symbol": "BANANAUSDT",
      "price": "16.95000000"
      },
      {
      "symbol": "BANANABNB",
      "price": "0.02829000"
      },
      {
      "symbol": "BANANAFDUSD",
      "price": "17.04000000"
      },
      {
      "symbol": "BANANATRY",
      "price": "646.00000000"
      },
      {
      "symbol": "RENDERBTC",
      "price": "0.00005062"
      },
      {
      "symbol": "RENDERUSDT",
      "price": "4.29500000"
      },
      {
      "symbol": "RENDERFDUSD",
      "price": "4.29700000"
      },
      {
      "symbol": "RENDERUSDC",
      "price": "4.29600000"
      },
      {
      "symbol": "RENDERTRY",
      "price": "163.70000000"
      },
      {
      "symbol": "RENDEREUR",
      "price": "3.77200000"
      },
      {
      "symbol": "RENDERBRL",
      "price": "25.04000000"
      },
      {
      "symbol": "TONBTC",
      "price": "0.00003519"
      },
      {
      "symbol": "TONUSDT",
      "price": "2.98400000"
      },
      {
      "symbol": "TONFDUSD",
      "price": "2.98900000"
      },
      {
      "symbol": "TONTRY",
      "price": "113.60000000"
      },
      {
      "symbol": "BONKBRL",
      "price": "0.00007280"
      },
      {
      "symbol": "NOTEUR",
      "price": "0.00283000"
      },
      {
      "symbol": "DOGEJPY",
      "price": "22.41000000"
      },
      {
      "symbol": "MATICJPY",
      "price": "54.46000000"
      },
      {
      "symbol": "NEARJPY",
      "price": "311.10000000"
      },
      {
      "symbol": "TONUSDC",
      "price": "2.98500000"
      },
      {
      "symbol": "AAVEFDUSD",
      "price": "140.51000000"
      },
      {
      "symbol": "DOGSUSDT",
      "price": "0.00012000"
      },
      {
      "symbol": "DOGSBNB",
      "price": "0.00000064"
      },
      {
      "symbol": "DOGSFDUSD",
      "price": "0.00012030"
      },
      {
      "symbol": "DOGSTRY",
      "price": "0.00458000"
      },
      {
      "symbol": "EUREURI",
      "price": "0.99980000"
      },
      {
      "symbol": "EURIUSDT",
      "price": "1.13930000"
      },
      {
      "symbol": "DOGSBRL",
      "price": "0.00100600"
      },
      {
      "symbol": "DOGSUSDC",
      "price": "0.00012000"
      },
      {
      "symbol": "RAREBRL",
      "price": "0.68690000"
      },
      {
      "symbol": "RAREUSDC",
      "price": "0.05900000"
      },
      {
      "symbol": "SLFBTC",
      "price": "0.00000248"
      },
      {
      "symbol": "SLFTRY",
      "price": "7.99000000"
      },
      {
      "symbol": "SLFUSDC",
      "price": "0.20990000"
      },
      {
      "symbol": "SLFUSDT",
      "price": "0.20990000"
      },
      {
      "symbol": "AAVEUSDC",
      "price": "140.61000000"
      },
      {
      "symbol": "SUNTRY",
      "price": "0.63630000"
      },
      {
      "symbol": "STMXTRY",
      "price": "0.16520000"
      },
      {
      "symbol": "POLBNB",
      "price": "0.00032100"
      },
      {
      "symbol": "POLBRL",
      "price": "1.11600000"
      },
      {
      "symbol": "POLBTC",
      "price": "0.00000224"
      },
      {
      "symbol": "POLETH",
      "price": "0.00011970"
      },
      {
      "symbol": "POLEUR",
      "price": "0.16700000"
      },
      {
      "symbol": "POLFDUSD",
      "price": "0.19050000"
      },
      {
      "symbol": "POLJPY",
      "price": "27.04000000"
      },
      {
      "symbol": "POLTRY",
      "price": "7.25000000"
      },
      {
      "symbol": "POLUSDC",
      "price": "0.19030000"
      },
      {
      "symbol": "POLUSDT",
      "price": "0.19040000"
      },
      {
      "symbol": "NEIROUSDT",
      "price": "0.00018628"
      },
      {
      "symbol": "TURBOUSDT",
      "price": "0.00210200"
      },
      {
      "symbol": "1MBABYDOGEUSDT",
      "price": "0.00127240"
      },
      {
      "symbol": "CATIUSDT",
      "price": "0.08310000"
      },
      {
      "symbol": "CATIBNB",
      "price": "0.00045600"
      },
      {
      "symbol": "CATIFDUSD",
      "price": "0.08350000"
      },
      {
      "symbol": "CATITRY",
      "price": "3.17000000"
      },
      {
      "symbol": "1MBABYDOGEFDUSD",
      "price": "0.00127360"
      },
      {
      "symbol": "1MBABYDOGETRY",
      "price": "0.04847000"
      },
      {
      "symbol": "CATIBRL",
      "price": "1.91000000"
      },
      {
      "symbol": "BTCEURI",
      "price": "74357.12000000"
      },
      {
      "symbol": "NEIROFDUSD",
      "price": "0.00018643"
      },
      {
      "symbol": "NEIROTRY",
      "price": "0.00711000"
      },
      {
      "symbol": "HMSTRUSDT",
      "price": "0.00260400"
      },
      {
      "symbol": "HMSTRBNB",
      "price": "0.00000387"
      },
      {
      "symbol": "HMSTRFDUSD",
      "price": "0.00260500"
      },
      {
      "symbol": "HMSTRTRY",
      "price": "0.09920000"
      },
      {
      "symbol": "EIGENBTC",
      "price": "0.00001000"
      },
      {
      "symbol": "EIGENUSDT",
      "price": "0.85000000"
      },
      {
      "symbol": "EIGENFDUSD",
      "price": "0.85100000"
      },
      {
      "symbol": "EIGENTRY",
      "price": "32.34000000"
      },
      {
      "symbol": "NEIROBRL",
      "price": "0.00205300"
      },
      {
      "symbol": "NEIROEUR",
      "price": "0.00034972"
      },
      {
      "symbol": "BNSOLSOL",
      "price": "1.04570000"
      },
      {
      "symbol": "SCRUSDT",
      "price": "0.24300000"
      },
      {
      "symbol": "SUIBRL",
      "price": "12.55000000"
      },
      {
      "symbol": "TURBOTRY",
      "price": "0.07980000"
      },
      {
      "symbol": "BNSOLUSDT",
      "price": "145.90000000"
      },
      {
      "symbol": "LUMIAUSDT",
      "price": "0.29400000"
      },
      {
      "symbol": "SCRBTC",
      "price": "0.00000286"
      },
      {
      "symbol": "SCRFDUSD",
      "price": "0.24300000"
      },
      {
      "symbol": "SCRTRY",
      "price": "9.22000000"
      },
      {
      "symbol": "KAIAUSDT",
      "price": "0.10200000"
      },
      {
      "symbol": "COWUSDT",
      "price": "0.28410000"
      },
      {
      "symbol": "CETUSUSDT",
      "price": "0.10390000"
      },
      {
      "symbol": "PNUTUSDT",
      "price": "0.13670000"
      },
      {
      "symbol": "ACTUSDT",
      "price": "0.06200000"
      },
      {
      "symbol": "ACTTRY",
      "price": "2.36000000"
      },
      {
      "symbol": "COWTRY",
      "price": "10.80000000"
      },
      {
      "symbol": "CETUSTRY",
      "price": "3.95000000"
      },
      {
      "symbol": "TROYTRY",
      "price": "0.00240000"
      },
      {
      "symbol": "PNUTTRY",
      "price": "5.20000000"
      },
      {
      "symbol": "ACTFDUSD",
      "price": "0.06200000"
      },
      {
      "symbol": "ACTUSDC",
      "price": "0.06180000"
      },
      {
      "symbol": "NEIROUSDC",
      "price": "0.00018634"
      },
      {
      "symbol": "PNUTBTC",
      "price": "0.00000161"
      },
      {
      "symbol": "PNUTFDUSD",
      "price": "0.13700000"
      },
      {
      "symbol": "PNUTUSDC",
      "price": "0.13660000"
      },
      {
      "symbol": "USUALUSDT",
      "price": "0.12680000"
      },
      {
      "symbol": "ACTBRL",
      "price": "0.32200000"
      },
      {
      "symbol": "ACTEUR",
      "price": "0.05430000"
      },
      {
      "symbol": "CATIUSDC",
      "price": "0.08310000"
      },
      {
      "symbol": "ETHEURI",
      "price": "1401.49000000"
      },
      {
      "symbol": "LUMIATRY",
      "price": "11.21000000"
      },
      {
      "symbol": "PNUTBRL",
      "price": "0.80100000"
      },
      {
      "symbol": "PNUTEUR",
      "price": "0.12010000"
      },
      {
      "symbol": "APEFDUSD",
      "price": "0.46340000"
      },
      {
      "symbol": "FDUSDUSDC",
      "price": "0.99900000"
      },
      {
      "symbol": "HBARUSDC",
      "price": "0.16439000"
      },
      {
      "symbol": "OMUSDC",
      "price": "0.60620000"
      },
      {
      "symbol": "RAYUSDC",
      "price": "2.21000000"
      },
      {
      "symbol": "TAOUSDC",
      "price": "305.50000000"
      },
      {
      "symbol": "TURBOFDUSD",
      "price": "0.00230900"
      },
      {
      "symbol": "THEBTC",
      "price": "0.00000295"
      },
      {
      "symbol": "THEBNB",
      "price": "0.00060430"
      },
      {
      "symbol": "THEFDUSD",
      "price": "0.24930000"
      },
      {
      "symbol": "THETRY",
      "price": "9.49700000"
      },
      {
      "symbol": "THEUSDT",
      "price": "0.25010000"
      },
      {
      "symbol": "APEUSDC",
      "price": "0.46270000"
      },
      {
      "symbol": "BOMEEUR",
      "price": "0.00110800"
      },
      {
      "symbol": "EIGENUSDC",
      "price": "0.85100000"
      },
      {
      "symbol": "HBARFDUSD",
      "price": "0.16450000"
      },
      {
      "symbol": "MEMEUSDC",
      "price": "0.00220000"
      },
      {
      "symbol": "TROYUSDC",
      "price": "0.00006500"
      },
      {
      "symbol": "WLDEUR",
      "price": "0.66200000"
      },
      {
      "symbol": "1MBABYDOGEUSDC",
      "price": "0.00127330"
      },
      {
      "symbol": "CETUSUSDC",
      "price": "0.10390000"
      },
      {
      "symbol": "COWUSDC",
      "price": "0.28350000"
      },
      {
      "symbol": "DYDXUSDC",
      "price": "0.59080000"
      },
      {
      "symbol": "HMSTRUSDC",
      "price": "0.00260400"
      },
      {
      "symbol": "TURBOUSDC",
      "price": "0.00210100"
      },
      {
      "symbol": "ENABRL",
      "price": "1.66200000"
      },
      {
      "symbol": "EOSFDUSD",
      "price": "0.62890000"
      },
      {
      "symbol": "KAIAUSDC",
      "price": "0.10200000"
      },
      {
      "symbol": "SANDUSDC",
      "price": "0.26620000"
      },
      {
      "symbol": "XLMFDUSD",
      "price": "0.24480000"
      },
      {
      "symbol": "CHZUSDC",
      "price": "0.03762000"
      },
      {
      "symbol": "PYTHUSDC",
      "price": "0.14170000"
      },
      {
      "symbol": "RSRUSDC",
      "price": "0.00734400"
      },
      {
      "symbol": "RSRFDUSD",
      "price": "0.00574400"
      },
      {
      "symbol": "WUSDC",
      "price": "0.07400000"
      },
      {
      "symbol": "XTZUSDC",
      "price": "0.50300000"
      },
      {
      "symbol": "ACXUSDT",
      "price": "0.19860000"
      },
      {
      "symbol": "ORCAUSDT",
      "price": "2.78000000"
      },
      {
      "symbol": "MOVEBTC",
      "price": "0.00000273"
      },
      {
      "symbol": "MOVEUSDT",
      "price": "0.23140000"
      },
      {
      "symbol": "MOVEBNB",
      "price": "0.00039060"
      },
      {
      "symbol": "MOVEFDUSD",
      "price": "0.23280000"
      },
      {
      "symbol": "MOVETRY",
      "price": "8.83100000"
      },
      {
      "symbol": "MEBTC",
      "price": "0.00000952"
      },
      {
      "symbol": "MEUSDT",
      "price": "0.80900000"
      },
      {
      "symbol": "MEFDUSD",
      "price": "0.81000000"
      },
      {
      "symbol": "METRY",
      "price": "30.81000000"
      },
      {
      "symbol": "ACXUSDC",
      "price": "0.19840000"
      },
      {
      "symbol": "ORCAUSDC",
      "price": "2.77900000"
      },
      {
      "symbol": "ACXFDUSD",
      "price": "0.19910000"
      },
      {
      "symbol": "ORCAFDUSD",
      "price": "2.78700000"
      },
      {
      "symbol": "ACXTRY",
      "price": "7.58000000"
      },
      {
      "symbol": "ORCATRY",
      "price": "106.10000000"
      },
      {
      "symbol": "KSMTRY",
      "price": "513.00000000"
      },
      {
      "symbol": "CELOTRY",
      "price": "11.70000000"
      },
      {
      "symbol": "HIVEFDUSD",
      "price": "0.24650000"
      },
      {
      "symbol": "HIVEUSDC",
      "price": "0.24130000"
      },
      {
      "symbol": "IDEXFDUSD",
      "price": "0.02290000"
      },
      {
      "symbol": "IDEXUSDC",
      "price": "0.02288000"
      },
      {
      "symbol": "TLMFDUSD",
      "price": "0.00511000"
      },
      {
      "symbol": "TLMUSDC",
      "price": "0.00500000"
      },
      {
      "symbol": "VELODROMEUSDT",
      "price": "0.04500000"
      },
      {
      "symbol": "VANAUSDT",
      "price": "5.16700000"
      },
      {
      "symbol": "VANABNB",
      "price": "0.00866000"
      },
      {
      "symbol": "VANAFDUSD",
      "price": "5.18300000"
      },
      {
      "symbol": "VANATRY",
      "price": "196.80000000"
      },
      {
      "symbol": "1000CATUSDT",
      "price": "0.00563000"
      },
      {
      "symbol": "1000CATBNB",
      "price": "0.00000960"
      },
      {
      "symbol": "1000CATFDUSD",
      "price": "0.00565000"
      },
      {
      "symbol": "1000CATTRY",
      "price": "0.21400000"
      },
      {
      "symbol": "PENGUUSDT",
      "price": "0.00493500"
      },
      {
      "symbol": "PENGUBNB",
      "price": "0.00000732"
      },
      {
      "symbol": "PENGUFDUSD",
      "price": "0.00495300"
      },
      {
      "symbol": "PENGUTRY",
      "price": "0.18800000"
      },
      {
      "symbol": "USUALBTC",
      "price": "0.00000150"
      },
      {
      "symbol": "USUALFDUSD",
      "price": "0.12680000"
      },
      {
      "symbol": "USUALTRY",
      "price": "4.83000000"
      },
      {
      "symbol": "1000CATUSDC",
      "price": "0.00563000"
      },
      {
      "symbol": "PENGUUSDC",
      "price": "0.00493300"
      },
      {
      "symbol": "BIOUSDT",
      "price": "0.05260000"
      },
      {
      "symbol": "BIOBNB",
      "price": "0.00008737"
      },
      {
      "symbol": "BIOFDUSD",
      "price": "0.05190000"
      },
      {
      "symbol": "BIOTRY",
      "price": "2.00200000"
      },
      {
      "symbol": "BIOUSDC",
      "price": "0.05260000"
      },
      {
      "symbol": "HIVETRY",
      "price": "9.19000000"
      },
      {
      "symbol": "MOVEUSDC",
      "price": "0.23150000"
      },
      {
      "symbol": "PHATRY",
      "price": "3.83000000"
      },
      {
      "symbol": "SUSHITRY",
      "price": "22.33000000"
      },
      {
      "symbol": "DUSDT",
      "price": "0.04146000"
      },
      {
      "symbol": "DTRY",
      "price": "1.58100000"
      },
      {
      "symbol": "APTJPY",
      "price": "693.80000000"
      },
      {
      "symbol": "SUIJPY",
      "price": "304.32000000"
      },
      {
      "symbol": "XLMJPY",
      "price": "34.79000000"
      },
      {
      "symbol": "PEPEJPY",
      "price": "0.00106700"
      },
      {
      "symbol": "PHAUSDC",
      "price": "0.10050000"
      },
      {
      "symbol": "USDCPLN",
      "price": "3.76800000"
      },
      {
      "symbol": "STEEMUSDC",
      "price": "0.14740000"
      },
      {
      "symbol": "USUALUSDC",
      "price": "0.12680000"
      },
      {
      "symbol": "AIXBTUSDT",
      "price": "0.08340000"
      },
      {
      "symbol": "AIXBTUSDC",
      "price": "0.08350000"
      },
      {
      "symbol": "CGPTUSDT",
      "price": "0.07460000"
      },
      {
      "symbol": "CGPTUSDC",
      "price": "0.07450000"
      },
      {
      "symbol": "COOKIEUSDT",
      "price": "0.09560000"
      },
      {
      "symbol": "COOKIEUSDC",
      "price": "0.09590000"
      },
      {
      "symbol": "SBTC",
      "price": "0.00000553"
      },
      {
      "symbol": "SBNB",
      "price": "0.00078800"
      },
      {
      "symbol": "SETH",
      "price": "0.00029450"
      },
      {
      "symbol": "SEUR",
      "price": "0.41090000"
      },
      {
      "symbol": "SFDUSD",
      "price": "0.46860000"
      },
      {
      "symbol": "STRY",
      "price": "17.86000000"
      },
      {
      "symbol": "SUSDC",
      "price": "0.46850000"
      },
      {
      "symbol": "SUSDT",
      "price": "0.46840000"
      },
      {
      "symbol": "IOTXJPY",
      "price": "2.57000000"
      },
      {
      "symbol": "SEIJPY",
      "price": "24.47000000"
      },
      {
      "symbol": "SOLVUSDT",
      "price": "0.02563000"
      },
      {
      "symbol": "SOLVBNB",
      "price": "0.00004318"
      },
      {
      "symbol": "SOLVFDUSD",
      "price": "0.02570000"
      },
      {
      "symbol": "SOLVTRY",
      "price": "0.97900000"
      },
      {
      "symbol": "TRUMPUSDT",
      "price": "8.23000000"
      },
      {
      "symbol": "TRUMPUSDC",
      "price": "8.23000000"
      },
      {
      "symbol": "AIXBTTRY",
      "price": "3.17000000"
      },
      {
      "symbol": "TRUMPTRY",
      "price": "313.70000000"
      },
      {
      "symbol": "ANIMEUSDT",
      "price": "0.01821000"
      },
      {
      "symbol": "ANIMEUSDC",
      "price": "0.01827000"
      },
      {
      "symbol": "ANIMEBNB",
      "price": "0.00003086"
      },
      {
      "symbol": "ANIMEFDUSD",
      "price": "0.01823000"
      },
      {
      "symbol": "ANIMETRY",
      "price": "0.69400000"
      },
      {
      "symbol": "BERABTC",
      "price": "0.00004013"
      },
      {
      "symbol": "BERAUSDT",
      "price": "3.38800000"
      },
      {
      "symbol": "BERAUSDC",
      "price": "3.39000000"
      },
      {
      "symbol": "BERAFDUSD",
      "price": "3.38700000"
      },
      {
      "symbol": "BERABNB",
      "price": "0.00570400"
      },
      {
      "symbol": "BERATRY",
      "price": "128.83000000"
      },
      {
      "symbol": "1000CHEEMSUSDT",
      "price": "0.00136800"
      },
      {
      "symbol": "1000CHEEMSUSDC",
      "price": "0.00137200"
      },
      {
      "symbol": "TSTUSDT",
      "price": "0.07160000"
      },
      {
      "symbol": "TSTUSDC",
      "price": "0.07150000"
      },
      {
      "symbol": "LAYERBTC",
      "price": "0.00002566"
      },
      {
      "symbol": "LAYERUSDT",
      "price": "2.18040000"
      },
      {
      "symbol": "LAYERUSDC",
      "price": "2.18320000"
      },
      {
      "symbol": "LAYERBNB",
      "price": "0.00371860"
      },
      {
      "symbol": "LAYERFDUSD",
      "price": "2.17970000"
      },
      {
      "symbol": "LAYERTRY",
      "price": "83.17000000"
      },
      {
      "symbol": "QTUMTRY",
      "price": "80.60000000"
      },
      {
      "symbol": "TRUMPEUR",
      "price": "7.20000000"
      },
      {
      "symbol": "VTHOTRY",
      "price": "0.10240000"
      },
      {
      "symbol": "HEIBTC",
      "price": "0.00000423"
      },
      {
      "symbol": "HEIUSDT",
      "price": "0.35880000"
      },
      {
      "symbol": "CAKEUSDC",
      "price": "1.97300000"
      },
      {
      "symbol": "HEIUSDC",
      "price": "0.35850000"
      },
      {
      "symbol": "TRUMPFDUSD",
      "price": "8.25000000"
      },
      {
      "symbol": "TSTFDUSD",
      "price": "0.07270000"
      },
      {
      "symbol": "BNXUSDC",
      "price": "1.77830000"
      },
      {
      "symbol": "LTCJPY",
      "price": "10884.00000000"
      },
      {
      "symbol": "BCHJPY",
      "price": "47739.00000000"
      },
      {
      "symbol": "LINKJPY",
      "price": "1843.00000000"
      },
      {
      "symbol": "KAITOBTC",
      "price": "0.00000918"
      },
      {
      "symbol": "KAITOUSDT",
      "price": "0.77040000"
      },
      {
      "symbol": "KAITOUSDC",
      "price": "0.77070000"
      },
      {
      "symbol": "KAITOBNB",
      "price": "0.00131650"
      },
      {
      "symbol": "KAITOFDUSD",
      "price": "0.77280000"
      },
      {
      "symbol": "KAITOTRY",
      "price": "29.40900000"
      },
      {
      "symbol": "ETHMXN",
      "price": "31735.00000000"
      },
      {
      "symbol": "KAITOBRL",
      "price": "4.54800000"
      },
      {
      "symbol": "SOLMXN",
      "price": "2775.00000000"
      },
      {
      "symbol": "BNBARS",
      "price": "719117.00000000"
      },
      {
      "symbol": "SOLARS",
      "price": "170183.00000000"
      },
      {
      "symbol": "TRUMPBRL",
      "price": "48.15000000"
      },
      {
      "symbol": "TRXFDUSD",
      "price": "0.24210000"
      },
      {
      "symbol": "TSTTRY",
      "price": "2.72300000"
      },
      {
      "symbol": "SHELLBTC",
      "price": "0.00000155"
      },
      {
      "symbol": "SHELLUSDT",
      "price": "0.13110000"
      },
      {
      "symbol": "SHELLUSDC",
      "price": "0.13150000"
      },
      {
      "symbol": "SHELLBNB",
      "price": "0.00022320"
      },
      {
      "symbol": "SHELLFDUSD",
      "price": "0.13050000"
      },
      {
      "symbol": "SHELLTRY",
      "price": "5.01000000"
      },
      {
      "symbol": "REDUSDT",
      "price": "0.39490000"
      },
      {
      "symbol": "GPSUSDT",
      "price": "0.01810000"
      },
      {
      "symbol": "GPSUSDC",
      "price": "0.01820000"
      },
      {
      "symbol": "GPSFDUSD",
      "price": "0.01830000"
      },
      {
      "symbol": "GPSTRY",
      "price": "0.69200000"
      },
      {
      "symbol": "GPSBNB",
      "price": "0.00003050"
      },
      {
      "symbol": "REDBTC",
      "price": "0.00000465"
      },
      {
      "symbol": "REDUSDC",
      "price": "0.39530000"
      },
      {
      "symbol": "REDFDUSD",
      "price": "0.39540000"
      },
      {
      "symbol": "REDTRY",
      "price": "15.05000000"
      },
      {
      "symbol": "CHESSUSDC",
      "price": "0.06080000"
      },
      {
      "symbol": "EGLDUSDC",
      "price": "14.46000000"
      },
      {
      "symbol": "OSMOUSDC",
      "price": "0.21850000"
      },
      {
      "symbol": "UTKUSDC",
      "price": "0.03026000"
      },
      {
      "symbol": "TUSDC",
      "price": "0.01811000"
      },
      {
      "symbol": "CVCUSDC",
      "price": "0.10930000"
      },
      {
      "symbol": "EURIUSDC",
      "price": "1.13940000"
      },
      {
      "symbol": "SYNUSDC",
      "price": "0.16180000"
      },
      {
      "symbol": "USDCRON",
      "price": "4.35300000"
      },
      {
      "symbol": "VELODROMEUSDC",
      "price": "0.04500000"
      },
      {
      "symbol": "EPICUSDT",
      "price": "1.50800000"
      },
      {
      "symbol": "DFUSDC",
      "price": "0.05828000"
      },
      {
      "symbol": "EPICUSDC",
      "price": "1.50800000"
      },
      {
      "symbol": "GMXUSDC",
      "price": "15.22000000"
      },
      {
      "symbol": "MKRUSDC",
      "price": "1355.00000000"
      },
      {
      "symbol": "RPLUSDC",
      "price": "4.32000000"
      },
      {
      "symbol": "BMTUSDT",
      "price": "0.08040000"
      },
      {
      "symbol": "BMTUSDC",
      "price": "0.08020000"
      },
      {
      "symbol": "BMTBNB",
      "price": "0.00013600"
      },
      {
      "symbol": "BMTFDUSD",
      "price": "0.07990000"
      },
      {
      "symbol": "BMTTRY",
      "price": "3.05800000"
      },
      {
      "symbol": "FORMUSDC",
      "price": "2.10310000"
      },
      {
      "symbol": "FORMUSDT",
      "price": "2.10190000"
      },
      {
      "symbol": "FORMTRY",
      "price": "80.14000000"
      },
      {
      "symbol": "XUSDUSDT",
      "price": "1.00030000"
      },
      {
      "symbol": "IOTAUSDC",
      "price": "0.16430000"
      },
      {
      "symbol": "JUVUSDC",
      "price": "0.98000000"
      },
      {
      "symbol": "THEUSDC",
      "price": "0.24960000"
      },
      {
      "symbol": "VANRYUSDC",
      "price": "0.02560000"
      },
      {
      "symbol": "USDCCZK",
      "price": "22.05000000"
      },
      {
      "symbol": "NILUSDT",
      "price": "0.37000000"
      },
      {
      "symbol": "NILBNB",
      "price": "0.00062380"
      },
      {
      "symbol": "NILFDUSD",
      "price": "0.37100000"
      },
      {
      "symbol": "NILUSDC",
      "price": "0.37000000"
      },
      {
      "symbol": "NILTRY",
      "price": "14.12000000"
      },
      {
      "symbol": "BEAMXUSDC",
      "price": "0.00638000"
      },
      {
      "symbol": "VANAUSDC",
      "price": "5.16900000"
      },
      {
      "symbol": "PARTIFDUSD",
      "price": "0.16350000"
      },
      {
      "symbol": "PARTITRY",
      "price": "6.09000000"
      },
      {
      "symbol": "PARTIUSDT",
      "price": "0.15980000"
      },
      {
      "symbol": "PARTIUSDC",
      "price": "0.16080000"
      },
      {
      "symbol": "PARTIBNB",
      "price": "0.00027051"
      },
      {
      "symbol": "MUBARAKUSDT",
      "price": "0.02860000"
      },
      {
      "symbol": "MUBARAKUSDC",
      "price": "0.02850000"
      },
      {
      "symbol": "TUTUSDT",
      "price": "0.02698000"
      },
      {
      "symbol": "BROCCOLI714USDT",
      "price": "0.02645000"
      },
      {
      "symbol": "TUTUSDC",
      "price": "0.02704000"
      },
      {
      "symbol": "BANANAS31USDT",
      "price": "0.00523700"
      },
      {
      "symbol": "BANANAS31USDC",
      "price": "0.00524400"
      },
      {
      "symbol": "BROCCOLI714USDC",
      "price": "0.02633000"
      },
      {
      "symbol": "GUNUSDT",
      "price": "0.05269000"
      },
      {
      "symbol": "GUNBNB",
      "price": "0.00008837"
      },
      {
      "symbol": "GUNFDUSD",
      "price": "0.05275000"
      },
      {
      "symbol": "GUNTRY",
      "price": "2.00800000"
      },
      {
      "symbol": "THETAUSDC",
      "price": "0.66400000"
      },
      {
      "symbol": "API3USDC",
      "price": "0.74300000"
      },
      {
      "symbol": "AUCTIONTRY",
      "price": "431.80000000"
      },
      {
      "symbol": "AUCTIONUSDC",
      "price": "11.41000000"
      },
      {
      "symbol": "BANANAUSDC",
      "price": "16.98000000"
      },
      {
      "symbol": "GUNUSDC",
      "price": "0.05266000"
      },
      {
      "symbol": "QNTUSDC",
      "price": "65.40000000"
      },
      {
      "symbol": "VETUSDC",
      "price": "0.02336000"
      },
      {
      "symbol": "ZENUSDC",
      "price": "8.83000000"
      },
      {
      "symbol": "BABYUSDT",
      "price": "0.07547000"
      },
      {
      "symbol": "BABYUSDC",
      "price": "0.07553000"
      },
      {
      "symbol": "BABYBNB",
      "price": "0.00012638"
      },
      {
      "symbol": "BABYFDUSD",
      "price": "0.07502000"
      },
      {
      "symbol": "BABYTRY",
      "price": "2.87500000"
      },
      {
      "symbol": "ONDOUSDT",
      "price": "0.84590000"
      },
      {
      "symbol": "ONDOUSDC",
      "price": "0.84580000"
      },
      {
      "symbol": "BIGTIMEUSDT",
      "price": "0.07093000"
      },
      {
      "symbol": "BIGTIMEUSDC",
      "price": "0.07087000"
      },
      {
      "symbol": "VIRTUALUSDT",
      "price": "0.57050000"
      },
      {
      "symbol": "VIRTUALUSDC",
      "price": "0.57080000"
      },
      {
      "symbol": "KERNELBNB",
      "price": "0.00035610"
      },
      {
      "symbol": "KERNELFDUSD",
      "price": "0.21160000"
      },
      {
      "symbol": "KERNELTRY",
      "price": "8.02000000"
      },
      {
      "symbol": "KERNELUSDC",
      "price": "0.21040000"
      },
      {
      "symbol": "KERNELUSDT",
      "price": "0.21060000"
      },
      {
      "symbol": "WCTTRY",
      "price": "18.52000000"
      },
      {
      "symbol": "WCTFDUSD",
      "price": "0.48620000"
      },
      {
      "symbol": "WCTBNB",
      "price": "0.00081910"
      },
      {
      "symbol": "WCTUSDC",
      "price": "0.48590000"
      },
      {
      "symbol": "WCTUSDT",
      "price": "0.48580000"
      },
      {
      "symbol": "PAXGUSDC",
      "price": "3356.00000000"
      },
      {
      "symbol": "ONDOTRY",
      "price": "32.20000000"
      },
      {
      "symbol": "BABYEUR",
      "price": "0.06635000"
      }
  ]';

  $data = json_decode($json, true);

  // Flatten collection and convert to array
  $flattened = collect($data)
      ->flatMap(fn($item) => [$item['symbol'] => $item['price']])
      ->toArray();
  
  // Select multiple symbols
  $symbols = $cryptos;
  $selected = array_intersect_key($flattened, array_flip($symbols));
  
  // Return response
  return $selected;
}

function bybitSpotPrices($cryptos)
{
    $json = '{
        "retCode": 0,
        "retMsg": "OK",
        "result": {
          "category": "spot",
          "list": [
            {
              "symbol": "MSTARUSDT",
              "bid1Price": "0.006711",
              "bid1Size": "1228.2",
              "ask1Price": "0.006726",
              "ask1Size": "746.79",
              "lastPrice": "0.00669",
              "prevPrice24h": "0.008435",
              "price24hPcnt": "-0.2069",
              "highPrice24h": "0.008498",
              "lowPrice24h": "0.00553",
              "turnover24h": "229730.45976886",
              "volume24h": "32910458.29"
            },
            {
              "symbol": "INTERUSDT",
              "bid1Price": "0.819",
              "bid1Size": "36.06",
              "ask1Price": "0.8201",
              "ask1Size": "7.99",
              "lastPrice": "0.819",
              "prevPrice24h": "0.8146",
              "price24hPcnt": "0.0054",
              "highPrice24h": "0.8284",
              "lowPrice24h": "0.802",
              "turnover24h": "25107.700201",
              "volume24h": "30792.97"
            },
            {
              "symbol": "AARKUSDT",
              "bid1Price": "0.001622",
              "bid1Size": "11285.72",
              "ask1Price": "0.001635",
              "ask1Size": "10519.97",
              "lastPrice": "0.001629",
              "prevPrice24h": "0.001781",
              "price24hPcnt": "-0.0853",
              "highPrice24h": "0.002167",
              "lowPrice24h": "0.00157",
              "turnover24h": "984333.64212808",
              "volume24h": "525816723.69"
            },
            {
              "symbol": "CYBERUSDT",
              "bid1Price": "1.1671",
              "bid1Size": "227.33",
              "ask1Price": "1.1687",
              "ask1Size": "22.25",
              "lastPrice": "1.1685",
              "prevPrice24h": "1.1289",
              "price24hPcnt": "0.0351",
              "highPrice24h": "1.2069",
              "lowPrice24h": "1.1168",
              "turnover24h": "144967.6109",
              "volume24h": "124823.57",
              "usdIndexPrice": "1.166934"
            },
            {
              "symbol": "BTTUSDT",
              "bid1Price": "0.0000006031",
              "bid1Size": "579206333",
              "ask1Price": "0.0000006045",
              "ask1Size": "540502652",
              "lastPrice": "0.0000006044",
              "prevPrice24h": "0.0000006103",
              "price24hPcnt": "-0.0097",
              "highPrice24h": "0.0000006143",
              "lowPrice24h": "0.0000006031",
              "turnover24h": "71921.5989139766",
              "volume24h": "118145975648"
            },
            {
              "symbol": "XTERUSDT",
              "bid1Price": "0.32271",
              "bid1Size": "48.8",
              "ask1Price": "0.32272",
              "ask1Size": "39.4",
              "lastPrice": "0.32271",
              "prevPrice24h": "0.31895",
              "price24hPcnt": "0.0118",
              "highPrice24h": "0.324",
              "lowPrice24h": "0.31352",
              "turnover24h": "2267207.893004",
              "volume24h": "7100141.3"
            },
            {
              "symbol": "KASTAUSDT",
              "bid1Price": "0.012259",
              "bid1Size": "7555.6",
              "ask1Price": "0.012286",
              "ask1Size": "1281.5",
              "lastPrice": "0.012285",
              "prevPrice24h": "0.012147",
              "price24hPcnt": "0.0114",
              "highPrice24h": "0.012334",
              "lowPrice24h": "0.012121",
              "turnover24h": "14615.6422129",
              "volume24h": "1197526.1"
            },
            {
              "symbol": "ELXUSDT",
              "bid1Price": "0.0906",
              "bid1Size": "1300",
              "ask1Price": "0.0907",
              "ask1Size": "1851.3",
              "lastPrice": "0.0906",
              "prevPrice24h": "0.0908",
              "price24hPcnt": "-0.0022",
              "highPrice24h": "0.094",
              "lowPrice24h": "0.0888",
              "turnover24h": "556814.28169",
              "volume24h": "6061895"
            },
            {
              "symbol": "BTCUSDQ",
              "bid1Price": "84768.99",
              "bid1Size": "0.000051",
              "ask1Price": "84838.99",
              "ask1Size": "0.0006",
              "lastPrice": "84768.99",
              "prevPrice24h": "85179.24",
              "price24hPcnt": "-0.0048",
              "highPrice24h": "85454.48",
              "lowPrice24h": "84768.99",
              "turnover24h": "1844.95996897",
              "volume24h": "0.02168"
            },
            {
              "symbol": "ROAMUSDT",
              "bid1Price": "0.3311",
              "bid1Size": "62.33",
              "ask1Price": "0.3314",
              "ask1Size": "118.65",
              "lastPrice": "0.3312",
              "prevPrice24h": "0.3266",
              "price24hPcnt": "0.0141",
              "highPrice24h": "0.3562",
              "lowPrice24h": "0.2939",
              "turnover24h": "3391399.162264",
              "volume24h": "10342403.91"
            },
            {
              "symbol": "ESEUSDT",
              "bid1Price": "0.009091",
              "bid1Size": "2008.03",
              "ask1Price": "0.009108",
              "ask1Size": "1818.18",
              "lastPrice": "0.009105",
              "prevPrice24h": "0.010111",
              "price24hPcnt": "-0.0995",
              "highPrice24h": "0.011051",
              "lowPrice24h": "0.0088",
              "turnover24h": "92707.24282616",
              "volume24h": "9436218.3"
            },
            {
              "symbol": "MOZUSDT",
              "bid1Price": "0.008933",
              "bid1Size": "1114",
              "ask1Price": "0.008946",
              "ask1Size": "6200",
              "lastPrice": "0.00894",
              "prevPrice24h": "0.008484",
              "price24hPcnt": "0.0537",
              "highPrice24h": "0.008983",
              "lowPrice24h": "0.00837",
              "turnover24h": "668312.34422",
              "volume24h": "77468322"
            },
            {
              "symbol": "DOTUSDC",
              "bid1Price": "3.865",
              "bid1Size": "31.06",
              "ask1Price": "3.867",
              "ask1Size": "57.598",
              "lastPrice": "3.864",
              "prevPrice24h": "3.73",
              "price24hPcnt": "0.0359",
              "highPrice24h": "3.951",
              "lowPrice24h": "3.719",
              "turnover24h": "62604.008029",
              "volume24h": "16311.9",
              "usdIndexPrice": "3.864136"
            },
            {
              "symbol": "ZILUSDT",
              "bid1Price": "0.01166",
              "bid1Size": "39350",
              "ask1Price": "0.01167",
              "ask1Size": "26474.2",
              "lastPrice": "0.01168",
              "prevPrice24h": "0.0119",
              "price24hPcnt": "-0.0185",
              "highPrice24h": "0.01199",
              "lowPrice24h": "0.01162",
              "turnover24h": "159774.655333",
              "volume24h": "13541141",
              "usdIndexPrice": "0.0116601"
            },
            {
              "symbol": "BERAUSDT",
              "bid1Price": "3.353",
              "bid1Size": "89.45",
              "ask1Price": "3.355",
              "ask1Size": "7.56",
              "lastPrice": "3.356",
              "prevPrice24h": "3.37",
              "price24hPcnt": "-0.0042",
              "highPrice24h": "3.486",
              "lowPrice24h": "3.313",
              "turnover24h": "920937.89958",
              "volume24h": "270852.83",
              "usdIndexPrice": "3.355471"
            },
            {
              "symbol": "BLURUSDT",
              "bid1Price": "0.1009",
              "bid1Size": "3330",
              "ask1Price": "0.101",
              "ask1Size": "3330",
              "lastPrice": "0.1009",
              "prevPrice24h": "0.0997",
              "price24hPcnt": "0.0120",
              "highPrice24h": "0.1047",
              "lowPrice24h": "0.0991",
              "turnover24h": "303067.712547",
              "volume24h": "2978455.3",
              "usdIndexPrice": "0.100884"
            },
            {
              "symbol": "APEXUSDT",
              "bid1Price": "0.7144",
              "bid1Size": "324.98",
              "ask1Price": "0.7146",
              "ask1Size": "250.82",
              "lastPrice": "0.7144",
              "prevPrice24h": "0.7122",
              "price24hPcnt": "0.0031",
              "highPrice24h": "0.7242",
              "lowPrice24h": "0.7012",
              "turnover24h": "11779167.192092",
              "volume24h": "16608780.35"
            },
            {
              "symbol": "PRIMEUSDT",
              "bid1Price": "2.428",
              "bid1Size": "43.1",
              "ask1Price": "2.431",
              "ask1Size": "4.94",
              "lastPrice": "2.43",
              "prevPrice24h": "2.317",
              "price24hPcnt": "0.0488",
              "highPrice24h": "2.654",
              "lowPrice24h": "2.203",
              "turnover24h": "539039.91969",
              "volume24h": "225028.34"
            },
            {
              "symbol": "FLOCKUSDT",
              "bid1Price": "0.05278",
              "bid1Size": "886.03",
              "ask1Price": "0.05287",
              "ask1Size": "974.81",
              "lastPrice": "0.05278",
              "prevPrice24h": "0.04891",
              "price24hPcnt": "0.0791",
              "highPrice24h": "0.05558",
              "lowPrice24h": "0.04863",
              "turnover24h": "436675.2260927",
              "volume24h": "8481748.41"
            },
            {
              "symbol": "LUCEUSDT",
              "bid1Price": "0.00912",
              "bid1Size": "5488",
              "ask1Price": "0.00914",
              "ask1Size": "10905",
              "lastPrice": "0.00913",
              "prevPrice24h": "0.00897",
              "price24hPcnt": "0.0178",
              "highPrice24h": "0.00932",
              "lowPrice24h": "0.00787",
              "turnover24h": "1502486.15471",
              "volume24h": "173531521"
            },
            {
              "symbol": "ETHFIUSDT",
              "bid1Price": "0.473",
              "bid1Size": "10181.04",
              "ask1Price": "0.474",
              "ask1Size": "3105.85",
              "lastPrice": "0.473",
              "prevPrice24h": "0.448",
              "price24hPcnt": "0.0558",
              "highPrice24h": "0.497",
              "lowPrice24h": "0.445",
              "turnover24h": "1128468.30859",
              "volume24h": "2343775.6",
              "usdIndexPrice": "0.472532"
            },
            {
              "symbol": "PONKEUSDT",
              "bid1Price": "0.08332",
              "bid1Size": "3591.03",
              "ask1Price": "0.08338",
              "ask1Size": "5833.56",
              "lastPrice": "0.08326",
              "prevPrice24h": "0.08413",
              "price24hPcnt": "-0.0103",
              "highPrice24h": "0.08602",
              "lowPrice24h": "0.08034",
              "turnover24h": "908027.3152406",
              "volume24h": "10879889.3"
            },
            {
              "symbol": "WLDUSDC",
              "bid1Price": "0.751",
              "bid1Size": "694.25",
              "ask1Price": "0.752",
              "ask1Size": "717.97",
              "lastPrice": "0.751",
              "prevPrice24h": "0.717",
              "price24hPcnt": "0.0474",
              "highPrice24h": "0.773",
              "lowPrice24h": "0.713",
              "turnover24h": "121388.209232",
              "volume24h": "162332.35",
              "usdIndexPrice": "0.751317"
            },
            {
              "symbol": "WLDUSDT",
              "bid1Price": "0.751",
              "bid1Size": "8846.41",
              "ask1Price": "0.752",
              "ask1Size": "1946.44",
              "lastPrice": "0.752",
              "prevPrice24h": "0.717",
              "price24hPcnt": "0.0488",
              "highPrice24h": "0.773",
              "lowPrice24h": "0.712",
              "turnover24h": "2108229.196883",
              "volume24h": "2814497.38",
              "usdIndexPrice": "0.751317"
            },
            {
              "symbol": "PAALUSDT",
              "bid1Price": "0.12677",
              "bid1Size": "832",
              "ask1Price": "0.1271",
              "ask1Size": "832",
              "lastPrice": "0.12675",
              "prevPrice24h": "0.12851",
              "price24hPcnt": "-0.0137",
              "highPrice24h": "0.13144",
              "lowPrice24h": "0.12606",
              "turnover24h": "93218.17646",
              "volume24h": "726809"
            },
            {
              "symbol": "DOP1USDT",
              "bid1Price": "0.0003",
              "bid1Size": "845831",
              "ask1Price": "0.0003006",
              "ask1Size": "29585",
              "lastPrice": "0.0003003",
              "prevPrice24h": "0.0003059",
              "price24hPcnt": "-0.0183",
              "highPrice24h": "0.0003174",
              "lowPrice24h": "0.0003002",
              "turnover24h": "77711.7473867",
              "volume24h": "253221386"
            },
            {
              "symbol": "SPELLUSDT",
              "bid1Price": "0.0005382",
              "bid1Size": "16172.1",
              "ask1Price": "0.0005388",
              "ask1Size": "16057.9",
              "lastPrice": "0.0005401",
              "prevPrice24h": "0.0005323",
              "price24hPcnt": "0.0147",
              "highPrice24h": "0.0005649",
              "lowPrice24h": "0.0005275",
              "turnover24h": "68671.14965014",
              "volume24h": "125174085.2"
            },
            {
              "symbol": "BBQUSDT",
              "bid1Price": "0.0189",
              "bid1Size": "2783",
              "ask1Price": "0.01895",
              "ask1Size": "4915",
              "lastPrice": "0.01891",
              "prevPrice24h": "0.01929",
              "price24hPcnt": "-0.0197",
              "highPrice24h": "0.02048",
              "lowPrice24h": "0.01889",
              "turnover24h": "307167.96057",
              "volume24h": "15680878"
            },
            {
              "symbol": "MEUSDT",
              "bid1Price": "0.792",
              "bid1Size": "6704.92",
              "ask1Price": "0.794",
              "ask1Size": "1570.53",
              "lastPrice": "0.793",
              "prevPrice24h": "0.818",
              "price24hPcnt": "-0.0306",
              "highPrice24h": "0.834",
              "lowPrice24h": "0.793",
              "turnover24h": "583233.36031",
              "volume24h": "717755.76",
              "usdIndexPrice": "0.79331"
            },
            {
              "symbol": "APPUSDT",
              "bid1Price": "0.003865",
              "bid1Size": "541.91",
              "ask1Price": "0.003873",
              "ask1Size": "25819.77",
              "lastPrice": "0.003881",
              "prevPrice24h": "0.003624",
              "price24hPcnt": "0.0709",
              "highPrice24h": "0.004205",
              "lowPrice24h": "0.003581",
              "turnover24h": "482042.9758594",
              "volume24h": "123713419.46"
            },
            {
              "symbol": "BABYDOGEUSDT",
              "bid1Price": "0.000000001266",
              "bid1Size": "3214457592351.2",
              "ask1Price": "0.000000001268",
              "ask1Size": "2774524760382.1",
              "lastPrice": "0.000000001266",
              "prevPrice24h": "0.000000001279",
              "price24hPcnt": "-0.0102",
              "highPrice24h": "0.000000001301",
              "lowPrice24h": "0.000000001255",
              "turnover24h": "509799.9458738069813",
              "volume24h": "400255105717683.6",
              "usdIndexPrice": "0.000000001266"
            },
            {
              "symbol": "USDTTRY",
              "bid1Price": "38.04",
              "bid1Size": "178941",
              "ask1Price": "38.12",
              "ask1Size": "120908.1",
              "lastPrice": "38.08",
              "prevPrice24h": "38.11",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "38.15",
              "lowPrice24h": "38.02",
              "turnover24h": "1042144.703",
              "volume24h": "27352.8"
            },
            {
              "symbol": "ENJUSDT",
              "bid1Price": "0.06585",
              "bid1Size": "164.95",
              "ask1Price": "0.06592",
              "ask1Size": "10496.35",
              "lastPrice": "0.06584",
              "prevPrice24h": "0.06448",
              "price24hPcnt": "0.0211",
              "highPrice24h": "0.06857",
              "lowPrice24h": "0.06383",
              "turnover24h": "403055.0686904",
              "volume24h": "6115284.3",
              "usdIndexPrice": "0.0658024"
            },
            {
              "symbol": "GOATUSDT",
              "bid1Price": "0.0489",
              "bid1Size": "27043",
              "ask1Price": "0.049",
              "ask1Size": "55172",
              "lastPrice": "0.0489",
              "prevPrice24h": "0.0467",
              "price24hPcnt": "0.0471",
              "highPrice24h": "0.0516",
              "lowPrice24h": "0.0458",
              "turnover24h": "429153.6603",
              "volume24h": "8674748",
              "usdIndexPrice": "0.0489445"
            },
            {
              "symbol": "FITFIUSDT",
              "bid1Price": "0.001544",
              "bid1Size": "688.34",
              "ask1Price": "0.001549",
              "ask1Size": "355.86",
              "lastPrice": "0.001549",
              "prevPrice24h": "0.001556",
              "price24hPcnt": "-0.0045",
              "highPrice24h": "0.001562",
              "lowPrice24h": "0.001512",
              "turnover24h": "44789.6394016",
              "volume24h": "29140674.25"
            },
            {
              "symbol": "POKTUSDT",
              "bid1Price": "0.01458",
              "bid1Size": "1286.01",
              "ask1Price": "0.01459",
              "ask1Size": "7243.28",
              "lastPrice": "0.0146",
              "prevPrice24h": "0.01038",
              "price24hPcnt": "0.4066",
              "highPrice24h": "0.02238",
              "lowPrice24h": "0.0103",
              "turnover24h": "235792.5536473",
              "volume24h": "15040338.21"
            },
            {
              "symbol": "XZKUSDT",
              "bid1Price": "0.007497",
              "bid1Size": "1332.03",
              "ask1Price": "0.007503",
              "ask1Size": "30.62",
              "lastPrice": "0.007503",
              "prevPrice24h": "0.007929",
              "price24hPcnt": "-0.0537",
              "highPrice24h": "0.008037",
              "lowPrice24h": "0.007478",
              "turnover24h": "108633.20482757",
              "volume24h": "14021488.02"
            },
            {
              "symbol": "MORPHOUSDT",
              "bid1Price": "0.9183",
              "bid1Size": "16",
              "ask1Price": "0.9192",
              "ask1Size": "247.5",
              "lastPrice": "0.9188",
              "prevPrice24h": "0.9218",
              "price24hPcnt": "-0.0033",
              "highPrice24h": "0.9534",
              "lowPrice24h": "0.9133",
              "turnover24h": "390845.38536",
              "volume24h": "418814.9",
              "usdIndexPrice": "0.917501"
            },
            {
              "symbol": "XRPUSDT",
              "bid1Price": "2.0638",
              "bid1Size": "1384.35",
              "ask1Price": "2.0639",
              "ask1Size": "938.42",
              "lastPrice": "2.0638",
              "prevPrice24h": "2.0858",
              "price24hPcnt": "-0.0105",
              "highPrice24h": "2.0977",
              "lowPrice24h": "2.0629",
              "turnover24h": "29696537.938564",
              "volume24h": "14264888.07",
              "usdIndexPrice": "2.063591"
            },
            {
              "symbol": "VVVUSDT",
              "bid1Price": "2.207",
              "bid1Size": "11.68",
              "ask1Price": "2.212",
              "ask1Size": "66.53",
              "lastPrice": "2.209",
              "prevPrice24h": "2.195",
              "price24hPcnt": "0.0064",
              "highPrice24h": "2.302",
              "lowPrice24h": "2.164",
              "turnover24h": "68250.27172",
              "volume24h": "30652.38"
            },
            {
              "symbol": "STXUSDT",
              "bid1Price": "0.6168",
              "bid1Size": "472.5",
              "ask1Price": "0.6169",
              "ask1Size": "472.5",
              "lastPrice": "0.6167",
              "prevPrice24h": "0.6087",
              "price24hPcnt": "0.0131",
              "highPrice24h": "0.6463",
              "lowPrice24h": "0.6007",
              "turnover24h": "2781254.566307",
              "volume24h": "4465988.7",
              "usdIndexPrice": "0.616839"
            },
            {
              "symbol": "KASUSDT",
              "bid1Price": "0.07706",
              "bid1Size": "6724.91",
              "ask1Price": "0.07708",
              "ask1Size": "1610.28",
              "lastPrice": "0.07708",
              "prevPrice24h": "0.07771",
              "price24hPcnt": "-0.0081",
              "highPrice24h": "0.07901",
              "lowPrice24h": "0.0766",
              "turnover24h": "1826459.6678557",
              "volume24h": "23496061.09",
              "usdIndexPrice": "0.0770726"
            },
            {
              "symbol": "BTC3SUSDT",
              "bid1Price": "0.01804",
              "bid1Size": "8387.7197",
              "ask1Price": "0.01807",
              "ask1Size": "2514.3806",
              "lastPrice": "0.01807",
              "prevPrice24h": "0.0176",
              "price24hPcnt": "0.0267",
              "highPrice24h": "0.01808",
              "lowPrice24h": "0.01738",
              "turnover24h": "121685.706741444",
              "volume24h": "6883855.4149"
            },
            {
              "symbol": "PORT3USDT",
              "bid1Price": "0.02257",
              "bid1Size": "553.7",
              "ask1Price": "0.02262",
              "ask1Size": "510.62",
              "lastPrice": "0.02258",
              "prevPrice24h": "0.02261",
              "price24hPcnt": "-0.0013",
              "highPrice24h": "0.02287",
              "lowPrice24h": "0.0223",
              "turnover24h": "169797.8200439",
              "volume24h": "7542739.7"
            },
            {
              "symbol": "MYRIAUSDT",
              "bid1Price": "0.000789",
              "bid1Size": "26252.44",
              "ask1Price": "0.0007911",
              "ask1Size": "54951.75",
              "lastPrice": "0.00079",
              "prevPrice24h": "0.0007585",
              "price24hPcnt": "0.0415",
              "highPrice24h": "0.0008515",
              "lowPrice24h": "0.000712",
              "turnover24h": "216891.931359029",
              "volume24h": "272583796.11"
            },
            {
              "symbol": "ONDOEUR",
              "bid1Price": "0.738",
              "bid1Size": "16.66",
              "ask1Price": "0.7391",
              "ask1Size": "271.83",
              "lastPrice": "0.741",
              "prevPrice24h": "0.7367",
              "price24hPcnt": "0.0058",
              "highPrice24h": "0.7559",
              "lowPrice24h": "0.7334",
              "turnover24h": "2468.917494",
              "volume24h": "3313.36"
            },
            {
              "symbol": "UXLINKUSDT",
              "bid1Price": "0.4355",
              "bid1Size": "247.5",
              "ask1Price": "0.4356",
              "ask1Size": "525.22",
              "lastPrice": "0.4355",
              "prevPrice24h": "0.4348",
              "price24hPcnt": "0.0016",
              "highPrice24h": "0.4565",
              "lowPrice24h": "0.4324",
              "turnover24h": "640221.083582",
              "volume24h": "1453800.26",
              "usdIndexPrice": "0.43554"
            },
            {
              "symbol": "XAVAUSDT",
              "bid1Price": "0.2436",
              "bid1Size": "43.73",
              "ask1Price": "0.2441",
              "ask1Size": "43.21",
              "lastPrice": "0.2439",
              "prevPrice24h": "0.2383",
              "price24hPcnt": "0.0235",
              "highPrice24h": "0.2466",
              "lowPrice24h": "0.2383",
              "turnover24h": "49875.61087",
              "volume24h": "205380.09"
            },
            {
              "symbol": "NAKAUSDT",
              "bid1Price": "0.3139",
              "bid1Size": "270",
              "ask1Price": "0.3144",
              "ask1Size": "579.51",
              "lastPrice": "0.3144",
              "prevPrice24h": "0.3152",
              "price24hPcnt": "-0.0025",
              "highPrice24h": "0.321",
              "lowPrice24h": "0.314",
              "turnover24h": "29895.55403",
              "volume24h": "94239.77"
            },
            {
              "symbol": "ATOMUSDT",
              "bid1Price": "4.17",
              "bid1Size": "108",
              "ask1Price": "4.171",
              "ask1Size": "109.8",
              "lastPrice": "4.168",
              "prevPrice24h": "4.155",
              "price24hPcnt": "0.0031",
              "highPrice24h": "4.266",
              "lowPrice24h": "4.147",
              "turnover24h": "1344581.5345653",
              "volume24h": "320063.545",
              "usdIndexPrice": "4.168292"
            },
            {
              "symbol": "SPECUSDT",
              "bid1Price": "1.357",
              "bid1Size": "14.42",
              "ask1Price": "1.359",
              "ask1Size": "208.12",
              "lastPrice": "1.358",
              "prevPrice24h": "1.365",
              "price24hPcnt": "-0.0051",
              "highPrice24h": "1.416",
              "lowPrice24h": "1.351",
              "turnover24h": "301768.30823",
              "volume24h": "219581.28"
            },
            {
              "symbol": "GMTUSDC",
              "bid1Price": "0.05817",
              "bid1Size": "5159.34",
              "ask1Price": "0.05886",
              "ask1Size": "150.38",
              "lastPrice": "0.05813",
              "prevPrice24h": "0.05638",
              "price24hPcnt": "0.0310",
              "highPrice24h": "0.06549",
              "lowPrice24h": "0.05638",
              "turnover24h": "25787.4826574",
              "volume24h": "422997.1",
              "usdIndexPrice": "0.0585222"
            },
            {
              "symbol": "HFTUSDC",
              "bid1Price": "0.0664",
              "bid1Size": "9759.83",
              "ask1Price": "0.0668",
              "ask1Size": "7510.68",
              "lastPrice": "0.0659",
              "prevPrice24h": "0.0566",
              "price24hPcnt": "0.1643",
              "highPrice24h": "0.0665",
              "lowPrice24h": "0.056",
              "turnover24h": "11724.486089",
              "volume24h": "189556",
              "usdIndexPrice": "0.0666365"
            },
            {
              "symbol": "STOPUSDT",
              "bid1Price": "0.0823",
              "bid1Size": "10564",
              "ask1Price": "0.08231",
              "ask1Size": "170",
              "lastPrice": "0.08231",
              "prevPrice24h": "0.0844",
              "price24hPcnt": "-0.0248",
              "highPrice24h": "0.08655",
              "lowPrice24h": "0.082",
              "turnover24h": "305581.02233",
              "volume24h": "3665101"
            },
            {
              "symbol": "USDEUSDC",
              "bid1Price": "0.9992",
              "bid1Size": "3121.69",
              "ask1Price": "0.9993",
              "ask1Size": "45706.9",
              "lastPrice": "0.9992",
              "prevPrice24h": "0.9992",
              "price24hPcnt": "0",
              "highPrice24h": "0.9994",
              "lowPrice24h": "0.9991",
              "turnover24h": "491591.128696",
              "volume24h": "491973.6",
              "usdIndexPrice": "0.999014"
            },
            {
              "symbol": "ETHEUR",
              "bid1Price": "1396.81",
              "bid1Size": "0.05724",
              "ask1Price": "1397.56",
              "ask1Size": "0.05724",
              "lastPrice": "1397.97",
              "prevPrice24h": "1408.75",
              "price24hPcnt": "-0.0077",
              "highPrice24h": "1432.05",
              "lowPrice24h": "1394.69",
              "turnover24h": "26529.1633836",
              "volume24h": "18.81558"
            },
            {
              "symbol": "SQTUSDT",
              "bid1Price": "0.001501",
              "bid1Size": "8030.28",
              "ask1Price": "0.001506",
              "ask1Size": "163861.01",
              "lastPrice": "0.001505",
              "prevPrice24h": "0.00156",
              "price24hPcnt": "-0.0353",
              "highPrice24h": "0.001594",
              "lowPrice24h": "0.001491",
              "turnover24h": "67575.13489874",
              "volume24h": "43691465.93"
            },
            {
              "symbol": "ROSEUSDT",
              "bid1Price": "0.02548",
              "bid1Size": "4050",
              "ask1Price": "0.0255",
              "ask1Size": "31044.48",
              "lastPrice": "0.02552",
              "prevPrice24h": "0.02517",
              "price24hPcnt": "0.0139",
              "highPrice24h": "0.02651",
              "lowPrice24h": "0.02487",
              "turnover24h": "224496.0344764",
              "volume24h": "8776435.31",
              "usdIndexPrice": "0.0255099"
            },
            {
              "symbol": "THNUSDT",
              "bid1Price": "0.00109",
              "bid1Size": "1238231.98",
              "ask1Price": "0.001101",
              "ask1Size": "11405.1",
              "lastPrice": "0.001093",
              "prevPrice24h": "0.001106",
              "price24hPcnt": "-0.0118",
              "highPrice24h": "0.001113",
              "lowPrice24h": "0.00109",
              "turnover24h": "5410.79178228",
              "volume24h": "4900331.14"
            },
            {
              "symbol": "LUNCUSDT",
              "bid1Price": "0.0000607",
              "bid1Size": "400000",
              "ask1Price": "0.00006072",
              "ask1Size": "459408.8",
              "lastPrice": "0.00006072",
              "prevPrice24h": "0.00005957",
              "price24hPcnt": "0.0193",
              "highPrice24h": "0.00006236",
              "lowPrice24h": "0.00005918",
              "turnover24h": "130614.52724469633",
              "volume24h": "2159693151.022",
              "usdIndexPrice": "0.0000607763"
            },
            {
              "symbol": "KAVAUSDT",
              "bid1Price": "0.4203",
              "bid1Size": "6030.77",
              "ask1Price": "0.4204",
              "ask1Size": "2.62",
              "lastPrice": "0.4204",
              "prevPrice24h": "0.4197",
              "price24hPcnt": "0.0017",
              "highPrice24h": "0.4252",
              "lowPrice24h": "0.4169",
              "turnover24h": "1484762.32275",
              "volume24h": "3529288.06",
              "usdIndexPrice": "0.420418"
            },
            {
              "symbol": "DOTUSDT",
              "bid1Price": "3.865",
              "bid1Size": "890.257",
              "ask1Price": "3.866",
              "ask1Size": "177.098",
              "lastPrice": "3.865",
              "prevPrice24h": "3.725",
              "price24hPcnt": "0.0376",
              "highPrice24h": "3.95",
              "lowPrice24h": "3.716",
              "turnover24h": "4269463.543386",
              "volume24h": "1115466.538",
              "usdIndexPrice": "3.864136"
            },
            {
              "symbol": "ZEXUSDT",
              "bid1Price": "0.02732",
              "bid1Size": "349.79",
              "ask1Price": "0.02738",
              "ask1Size": "1432.67",
              "lastPrice": "0.02738",
              "prevPrice24h": "0.02698",
              "price24hPcnt": "0.0148",
              "highPrice24h": "0.0274",
              "lowPrice24h": "0.02669",
              "turnover24h": "16768.0418139",
              "volume24h": "620890.09"
            },
            {
              "symbol": "CATSUSDT",
              "bid1Price": "0.000007862",
              "bid1Size": "2000382",
              "ask1Price": "0.000007883",
              "ask1Size": "1233977",
              "lastPrice": "0.000007889",
              "prevPrice24h": "0.000007914",
              "price24hPcnt": "-0.0032",
              "highPrice24h": "0.000008516",
              "lowPrice24h": "0.000007479",
              "turnover24h": "101299.925809414",
              "volume24h": "12719637841"
            },
            {
              "symbol": "MDAOUSDT",
              "bid1Price": "0.02281",
              "bid1Size": "7887.82",
              "ask1Price": "0.02285",
              "ask1Size": "3943.91",
              "lastPrice": "0.02281",
              "prevPrice24h": "0.02248",
              "price24hPcnt": "0.0147",
              "highPrice24h": "0.02287",
              "lowPrice24h": "0.02231",
              "turnover24h": "21843.8630602",
              "volume24h": "964705.93"
            },
            {
              "symbol": "PARTIUSDT",
              "bid1Price": "0.15999",
              "bid1Size": "1907.5",
              "ask1Price": "0.16015",
              "ask1Size": "405",
              "lastPrice": "0.16002",
              "prevPrice24h": "0.14128",
              "price24hPcnt": "0.1326",
              "highPrice24h": "0.16392",
              "lowPrice24h": "0.14055",
              "turnover24h": "1494742.43407",
              "volume24h": "9847379.7",
              "usdIndexPrice": "0.160128"
            },
            {
              "symbol": "APTUSDT",
              "bid1Price": "4.88",
              "bid1Size": "3356.62",
              "ask1Price": "4.89",
              "ask1Size": "3816.41",
              "lastPrice": "4.89",
              "prevPrice24h": "4.78",
              "price24hPcnt": "0.0230",
              "highPrice24h": "4.96",
              "lowPrice24h": "4.77",
              "turnover24h": "1438472.26809",
              "volume24h": "295022.71",
              "usdIndexPrice": "4.881099"
            },
            {
              "symbol": "TONEUR",
              "bid1Price": "2.611",
              "bid1Size": "76.85",
              "ask1Price": "2.625",
              "ask1Size": "75.84",
              "lastPrice": "2.625",
              "prevPrice24h": "2.629",
              "price24hPcnt": "-0.0015",
              "highPrice24h": "2.633",
              "lowPrice24h": "2.591",
              "turnover24h": "1218.60798",
              "volume24h": "465.22"
            },
            {
              "symbol": "POLUSDT",
              "bid1Price": "0.1889",
              "bid1Size": "20307.96",
              "ask1Price": "0.189",
              "ask1Size": "1353.57",
              "lastPrice": "0.189",
              "prevPrice24h": "0.1894",
              "price24hPcnt": "-0.0021",
              "highPrice24h": "0.1929",
              "lowPrice24h": "0.1889",
              "turnover24h": "735737.130615",
              "volume24h": "3859092.95",
              "usdIndexPrice": "0.188941"
            },
            {
              "symbol": "CHRPUSDT",
              "bid1Price": "0.002014",
              "bid1Size": "16206.06",
              "ask1Price": "0.002021",
              "ask1Size": "6178.94",
              "lastPrice": "0.002024",
              "prevPrice24h": "0.002006",
              "price24hPcnt": "0.0090",
              "highPrice24h": "0.002046",
              "lowPrice24h": "0.001955",
              "turnover24h": "22360.11751943",
              "volume24h": "11180173.29"
            },
            {
              "symbol": "BNBUSDC",
              "bid1Price": "593.5",
              "bid1Size": "11.1984",
              "ask1Price": "594.3",
              "ask1Size": "0.2",
              "lastPrice": "594.2",
              "prevPrice24h": "592.9",
              "price24hPcnt": "0.0022",
              "highPrice24h": "594.8",
              "lowPrice24h": "587.9",
              "turnover24h": "20341.65276",
              "volume24h": "34.395",
              "usdIndexPrice": "593.926864"
            },
            {
              "symbol": "MVUSDT",
              "bid1Price": "0.007748",
              "bid1Size": "12690.98",
              "ask1Price": "0.007758",
              "ask1Size": "1017.12",
              "lastPrice": "0.007748",
              "prevPrice24h": "0.007656",
              "price24hPcnt": "0.0120",
              "highPrice24h": "0.007853",
              "lowPrice24h": "0.007632",
              "turnover24h": "113879.65460146",
              "volume24h": "14718304.96"
            },
            {
              "symbol": "ZRCUSDT",
              "bid1Price": "0.03547",
              "bid1Size": "978",
              "ask1Price": "0.03551",
              "ask1Size": "9856",
              "lastPrice": "0.03559",
              "prevPrice24h": "0.03586",
              "price24hPcnt": "-0.0075",
              "highPrice24h": "0.03665",
              "lowPrice24h": "0.03545",
              "turnover24h": "340182.89706",
              "volume24h": "9440295"
            },
            {
              "symbol": "DEFIUSDT",
              "bid1Price": "0.003706",
              "bid1Size": "320.96",
              "ask1Price": "0.003726",
              "ask1Size": "19629.64",
              "lastPrice": "0.003732",
              "prevPrice24h": "0.003566",
              "price24hPcnt": "0.0466",
              "highPrice24h": "0.00382",
              "lowPrice24h": "0.003521",
              "turnover24h": "31650.01464786",
              "volume24h": "8581407.33"
            },
            {
              "symbol": "SWELLUSDT",
              "bid1Price": "0.00838",
              "bid1Size": "40377",
              "ask1Price": "0.00839",
              "ask1Size": "5921",
              "lastPrice": "0.00838",
              "prevPrice24h": "0.00798",
              "price24hPcnt": "0.0501",
              "highPrice24h": "0.0087",
              "lowPrice24h": "0.00794",
              "turnover24h": "385845.15515",
              "volume24h": "46721857"
            },
            {
              "symbol": "AIXBTUSDT",
              "bid1Price": "0.0824",
              "bid1Size": "17852.24",
              "ask1Price": "0.0825",
              "ask1Size": "20864.78",
              "lastPrice": "0.0824",
              "prevPrice24h": "0.0791",
              "price24hPcnt": "0.0417",
              "highPrice24h": "0.087",
              "lowPrice24h": "0.078",
              "turnover24h": "895820.988616",
              "volume24h": "10974629.64",
              "usdIndexPrice": "0.0824597"
            },
            {
              "symbol": "ARBUSDC",
              "bid1Price": "0.2998",
              "bid1Size": "303.75",
              "ask1Price": "0.2999",
              "ask1Size": "303.75",
              "lastPrice": "0.2996",
              "prevPrice24h": "0.2938",
              "price24hPcnt": "0.0197",
              "highPrice24h": "0.3072",
              "lowPrice24h": "0.2911",
              "turnover24h": "217665.304993",
              "volume24h": "730755.71",
              "usdIndexPrice": "0.299569"
            },
            {
              "symbol": "MVLUSDT",
              "bid1Price": "0.003307",
              "bid1Size": "55407.97",
              "ask1Price": "0.003313",
              "ask1Size": "4757.6",
              "lastPrice": "0.003314",
              "prevPrice24h": "0.003362",
              "price24hPcnt": "-0.0143",
              "highPrice24h": "0.003424",
              "lowPrice24h": "0.003309",
              "turnover24h": "34352.39061893",
              "volume24h": "10186035.12"
            },
            {
              "symbol": "NYMUSDT",
              "bid1Price": "0.05",
              "bid1Size": "9368.55",
              "ask1Price": "0.05001",
              "ask1Size": "314.98",
              "lastPrice": "0.05",
              "prevPrice24h": "0.0508",
              "price24hPcnt": "-0.0157",
              "highPrice24h": "0.0513",
              "lowPrice24h": "0.04978",
              "turnover24h": "57464.0508703",
              "volume24h": "1141779.12"
            },
            {
              "symbol": "SOLOUSDT",
              "bid1Price": "0.23466",
              "bid1Size": "46.65",
              "ask1Price": "0.2351",
              "ask1Size": "52.89",
              "lastPrice": "0.23508",
              "prevPrice24h": "0.23318",
              "price24hPcnt": "0.0081",
              "highPrice24h": "0.24059",
              "lowPrice24h": "0.23027",
              "turnover24h": "84207.1767675",
              "volume24h": "357295.2"
            },
            {
              "symbol": "EGP1USDT",
              "bid1Price": "1.0092",
              "bid1Size": "8.58",
              "ask1Price": "1.0127",
              "ask1Size": "21.4",
              "lastPrice": "1.0131",
              "prevPrice24h": "0.995",
              "price24hPcnt": "0.0182",
              "highPrice24h": "1.5",
              "lowPrice24h": "0.953",
              "turnover24h": "198662.705642",
              "volume24h": "172420.32"
            },
            {
              "symbol": "TONUSDC",
              "bid1Price": "2.976",
              "bid1Size": "57.36",
              "ask1Price": "2.977",
              "ask1Size": "28.68",
              "lastPrice": "2.977",
              "prevPrice24h": "2.998",
              "price24hPcnt": "-0.0070",
              "highPrice24h": "3.008",
              "lowPrice24h": "2.942",
              "turnover24h": "134644.99192",
              "volume24h": "45259.56",
              "usdIndexPrice": "2.975389"
            },
            {
              "symbol": "AAVEUSDT",
              "bid1Price": "139.82",
              "bid1Size": "0.146",
              "ask1Price": "139.83",
              "ask1Size": "3.294",
              "lastPrice": "139.8",
              "prevPrice24h": "139.96",
              "price24hPcnt": "-0.0011",
              "highPrice24h": "143.53",
              "lowPrice24h": "138.29",
              "turnover24h": "4160206.51401",
              "volume24h": "29583.416",
              "usdIndexPrice": "139.824426"
            },
            {
              "symbol": "ETCUSDT",
              "bid1Price": "15.95",
              "bid1Size": "179.4",
              "ask1Price": "15.96",
              "ask1Size": "379.51",
              "lastPrice": "15.95",
              "prevPrice24h": "15.85",
              "price24hPcnt": "0.0063",
              "highPrice24h": "16.05",
              "lowPrice24h": "15.69",
              "turnover24h": "670656.9384",
              "volume24h": "42221.93",
              "usdIndexPrice": "15.955038"
            },
            {
              "symbol": "SMILEUSDT",
              "bid1Price": "0.02221",
              "bid1Size": "2450.4",
              "ask1Price": "0.02232",
              "ask1Size": "1910.1",
              "lastPrice": "0.02227",
              "prevPrice24h": "0.02166",
              "price24hPcnt": "0.0282",
              "highPrice24h": "0.02261",
              "lowPrice24h": "0.02085",
              "turnover24h": "28115.41939",
              "volume24h": "1290279.7"
            },
            {
              "symbol": "VIRTUALUSDT",
              "bid1Price": "0.5645",
              "bid1Size": "1328.71",
              "ask1Price": "0.5647",
              "ask1Size": "169.84",
              "lastPrice": "0.5644",
              "prevPrice24h": "0.5795",
              "price24hPcnt": "-0.0261",
              "highPrice24h": "0.5893",
              "lowPrice24h": "0.5636",
              "turnover24h": "2280611.700772",
              "volume24h": "3960439.55",
              "usdIndexPrice": "0.56403"
            },
            {
              "symbol": "AURORAUSDT",
              "bid1Price": "0.07732",
              "bid1Size": "475.48",
              "ask1Price": "0.07748",
              "ask1Size": "274.55",
              "lastPrice": "0.0774",
              "prevPrice24h": "0.0737",
              "price24hPcnt": "0.0502",
              "highPrice24h": "0.07749",
              "lowPrice24h": "0.0734",
              "turnover24h": "65454.3556873",
              "volume24h": "867627.2"
            },
            {
              "symbol": "METHUSDT",
              "bid1Price": "1688.6",
              "bid1Size": "0.70587",
              "ask1Price": "1691.18",
              "ask1Size": "0.01231",
              "lastPrice": "1690.15",
              "prevPrice24h": "1700.82",
              "price24hPcnt": "-0.0063",
              "highPrice24h": "1736.98",
              "lowPrice24h": "1687.07",
              "turnover24h": "272415.1950407",
              "volume24h": "159.97767",
              "usdIndexPrice": "1690.277207"
            },
            {
              "symbol": "NEARUSDC",
              "bid1Price": "2.175",
              "bid1Size": "196.1",
              "ask1Price": "2.178",
              "ask1Size": "180.6",
              "lastPrice": "2.198",
              "prevPrice24h": "2.118",
              "price24hPcnt": "0.0378",
              "highPrice24h": "2.201",
              "lowPrice24h": "2.112",
              "turnover24h": "1834.5982",
              "volume24h": "853.4",
              "usdIndexPrice": "2.176409"
            },
            {
              "symbol": "MERLUSDT",
              "bid1Price": "0.0771",
              "bid1Size": "12789.38",
              "ask1Price": "0.0773",
              "ask1Size": "9152.19",
              "lastPrice": "0.0772",
              "prevPrice24h": "0.0761",
              "price24hPcnt": "0.0145",
              "highPrice24h": "0.0803",
              "lowPrice24h": "0.0756",
              "turnover24h": "1005211.288832",
              "volume24h": "13021820.41",
              "usdIndexPrice": "0.0771968"
            },
            {
              "symbol": "HATUSDT",
              "bid1Price": "0.00309",
              "bid1Size": "5164.1",
              "ask1Price": "0.0031",
              "ask1Size": "9475.7",
              "lastPrice": "0.0031",
              "prevPrice24h": "0.00321",
              "price24hPcnt": "-0.0343",
              "highPrice24h": "0.00326",
              "lowPrice24h": "0.00294",
              "turnover24h": "629446.206781",
              "volume24h": "202657498.3"
            },
            {
              "symbol": "PEPEUSDT",
              "bid1Price": "0.000007401",
              "bid1Size": "782137049",
              "ask1Price": "0.000007403",
              "ask1Size": "413587268",
              "lastPrice": "0.0000074",
              "prevPrice24h": "0.000007318",
              "price24hPcnt": "0.0112",
              "highPrice24h": "0.000007605",
              "lowPrice24h": "0.000007166",
              "turnover24h": "16430185.989456901",
              "volume24h": "2214881978381",
              "usdIndexPrice": "0.00000739756"
            },
            {
              "symbol": "SHIBUSDT",
              "bid1Price": "0.0000123",
              "bid1Size": "90000000",
              "ask1Price": "0.00001231",
              "ask1Size": "1656767571.8",
              "lastPrice": "0.0000123",
              "prevPrice24h": "0.00001221",
              "price24hPcnt": "0.0074",
              "highPrice24h": "0.00001248",
              "lowPrice24h": "0.00001212",
              "turnover24h": "1208146.46633272611",
              "volume24h": "98338334448.8",
              "usdIndexPrice": "0.0000122937"
            },
            {
              "symbol": "DGBUSDT",
              "bid1Price": "0.009836",
              "bid1Size": "2488.69",
              "ask1Price": "0.009864",
              "ask1Size": "49261.26",
              "lastPrice": "0.009816",
              "prevPrice24h": "0.010165",
              "price24hPcnt": "-0.0343",
              "highPrice24h": "0.010292",
              "lowPrice24h": "0.009816",
              "turnover24h": "77129.35519629",
              "volume24h": "7624342.39"
            },
            {
              "symbol": "ETHUSDE",
              "bid1Price": "1591.38",
              "bid1Size": "1.25781",
              "ask1Price": "1592.17",
              "ask1Size": "1.2572",
              "lastPrice": "1596.03",
              "prevPrice24h": "1605.63",
              "price24hPcnt": "-0.0060",
              "highPrice24h": "1631.83",
              "lowPrice24h": "1587.5",
              "turnover24h": "328046.2771393",
              "volume24h": "203.81402"
            },
            {
              "symbol": "SAROSUSDT",
              "bid1Price": "0.12639",
              "bid1Size": "762.05",
              "ask1Price": "0.12682",
              "ask1Size": "725.73",
              "lastPrice": "0.12682",
              "prevPrice24h": "0.12843",
              "price24hPcnt": "-0.0125",
              "highPrice24h": "0.12856",
              "lowPrice24h": "0.124",
              "turnover24h": "128531.77235994",
              "volume24h": "1018887.94"
            },
            {
              "symbol": "VELARUSDT",
              "bid1Price": "0.01004",
              "bid1Size": "7605.15",
              "ask1Price": "0.01005",
              "ask1Size": "10266.25",
              "lastPrice": "0.01004",
              "prevPrice24h": "0.00941",
              "price24hPcnt": "0.0670",
              "highPrice24h": "0.01017",
              "lowPrice24h": "0.00939",
              "turnover24h": "32708.9715252",
              "volume24h": "3355667.33"
            },
            {
              "symbol": "USDQUSDT",
              "bid1Price": "1",
              "bid1Size": "15613.74",
              "ask1Price": "1.0001",
              "ask1Size": "9612.38",
              "lastPrice": "1",
              "prevPrice24h": "0.9998",
              "price24hPcnt": "0.0002",
              "highPrice24h": "1.0005",
              "lowPrice24h": "0.9998",
              "turnover24h": "6170.075022",
              "volume24h": "6169.3"
            },
            {
              "symbol": "BBLUSDT",
              "bid1Price": "0.0005813",
              "bid1Size": "15503.83",
              "ask1Price": "0.000584",
              "ask1Size": "9002.38",
              "lastPrice": "0.0005898",
              "prevPrice24h": "0.00058",
              "price24hPcnt": "0.0169",
              "highPrice24h": "0.00059",
              "lowPrice24h": "0.000567",
              "turnover24h": "2192.500024392",
              "volume24h": "3790919.02"
            },
            {
              "symbol": "ARTYUSDT",
              "bid1Price": "0.24",
              "bid1Size": "52.05",
              "ask1Price": "0.2405",
              "ask1Size": "50.85",
              "lastPrice": "0.2404",
              "prevPrice24h": "0.2383",
              "price24hPcnt": "0.0088",
              "highPrice24h": "0.2433",
              "lowPrice24h": "0.2376",
              "turnover24h": "18342.860344",
              "volume24h": "76256.94"
            },
            {
              "symbol": "AIOZUSDT",
              "bid1Price": "0.2697",
              "bid1Size": "810",
              "ask1Price": "0.2703",
              "ask1Size": "810",
              "lastPrice": "0.27",
              "prevPrice24h": "0.2716",
              "price24hPcnt": "-0.0059",
              "highPrice24h": "0.278",
              "lowPrice24h": "0.2683",
              "turnover24h": "97098.663549",
              "volume24h": "354674.17"
            },
            {
              "symbol": "BICOUSDT",
              "bid1Price": "0.1089",
              "bid1Size": "810",
              "ask1Price": "0.109",
              "ask1Size": "405",
              "lastPrice": "0.1091",
              "prevPrice24h": "0.107",
              "price24hPcnt": "0.0196",
              "highPrice24h": "0.1139",
              "lowPrice24h": "0.1065",
              "turnover24h": "84384.043876",
              "volume24h": "768359.12",
              "usdIndexPrice": "0.109119"
            },
            {
              "symbol": "MNTUSDC",
              "bid1Price": "0.6613",
              "bid1Size": "874.89",
              "ask1Price": "0.6645",
              "ask1Size": "3152.51",
              "lastPrice": "0.6614",
              "prevPrice24h": "0.658",
              "price24hPcnt": "0.0052",
              "highPrice24h": "0.6727",
              "lowPrice24h": "0.658",
              "turnover24h": "84131.775444",
              "volume24h": "126421.39",
              "usdIndexPrice": "0.661793"
            },
            {
              "symbol": "UNIUSDC",
              "bid1Price": "5.246",
              "bid1Size": "1.52",
              "ask1Price": "5.268",
              "ask1Size": "43.47",
              "lastPrice": "5.284",
              "prevPrice24h": "5.282",
              "price24hPcnt": "0.0004",
              "highPrice24h": "5.361",
              "lowPrice24h": "5.239",
              "turnover24h": "2247.87321",
              "volume24h": "423.97",
              "usdIndexPrice": "5.245078"
            },
            {
              "symbol": "ORDIUSDT",
              "bid1Price": "6.47",
              "bid1Size": "922.02",
              "ask1Price": "6.48",
              "ask1Size": "6.76",
              "lastPrice": "6.48",
              "prevPrice24h": "6.23",
              "price24hPcnt": "0.0401",
              "highPrice24h": "6.7",
              "lowPrice24h": "6.15",
              "turnover24h": "1062640.3136",
              "volume24h": "164147.35",
              "usdIndexPrice": "6.479048"
            },
            {
              "symbol": "SISUSDT",
              "bid1Price": "0.05105",
              "bid1Size": "937.17",
              "ask1Price": "0.0512",
              "ask1Size": "22.38",
              "lastPrice": "0.05106",
              "prevPrice24h": "0.05194",
              "price24hPcnt": "-0.0169",
              "highPrice24h": "0.0531",
              "lowPrice24h": "0.05035",
              "turnover24h": "31966.1349241",
              "volume24h": "615602.9"
            },
            {
              "symbol": "NUTSUSDT",
              "bid1Price": "0.001556",
              "bid1Size": "34000",
              "ask1Price": "0.001561",
              "ask1Size": "29949.68",
              "lastPrice": "0.001561",
              "prevPrice24h": "0.001552",
              "price24hPcnt": "0.0058",
              "highPrice24h": "0.001595",
              "lowPrice24h": "0.001549",
              "turnover24h": "27294.93972451",
              "volume24h": "17399167.08"
            },
            {
              "symbol": "SOLUSDT",
              "bid1Price": "139.42",
              "bid1Size": "277.591",
              "ask1Price": "139.43",
              "ask1Size": "108.524",
              "lastPrice": "139.42",
              "prevPrice24h": "138.91",
              "price24hPcnt": "0.0037",
              "highPrice24h": "141.97",
              "lowPrice24h": "137.67",
              "turnover24h": "88735126.51862",
              "volume24h": "635717.174",
              "usdIndexPrice": "139.409827"
            },
            {
              "symbol": "TRXUSDC",
              "bid1Price": "0.2421",
              "bid1Size": "2881.6",
              "ask1Price": "0.2422",
              "ask1Size": "1959.53",
              "lastPrice": "0.242",
              "prevPrice24h": "0.2424",
              "price24hPcnt": "-0.0017",
              "highPrice24h": "0.2454",
              "lowPrice24h": "0.2408",
              "turnover24h": "76782.819817",
              "volume24h": "315529.27",
              "usdIndexPrice": "0.24211"
            },
            {
              "symbol": "STREAMUSDT",
              "bid1Price": "0.02301",
              "bid1Size": "567.22",
              "ask1Price": "0.02311",
              "ask1Size": "377.99",
              "lastPrice": "0.02306",
              "prevPrice24h": "0.02428",
              "price24hPcnt": "-0.0502",
              "highPrice24h": "0.02585",
              "lowPrice24h": "0.02306",
              "turnover24h": "58733.6312359",
              "volume24h": "2400020.08"
            },
            {
              "symbol": "HBARUSDT",
              "bid1Price": "0.16373",
              "bid1Size": "12307.66",
              "ask1Price": "0.16375",
              "ask1Size": "536.71",
              "lastPrice": "0.16371",
              "prevPrice24h": "0.16684",
              "price24hPcnt": "-0.0188",
              "highPrice24h": "0.16795",
              "lowPrice24h": "0.16357",
              "turnover24h": "6141560.1898394",
              "volume24h": "37017167.97",
              "usdIndexPrice": "0.163704"
            },
            {
              "symbol": "INJUSDT",
              "bid1Price": "8.27",
              "bid1Size": "672.91",
              "ask1Price": "8.28",
              "ask1Size": "1301.47",
              "lastPrice": "8.27",
              "prevPrice24h": "8.14",
              "price24hPcnt": "0.0160",
              "highPrice24h": "8.56",
              "lowPrice24h": "8.1",
              "turnover24h": "1328915.17256",
              "volume24h": "160028.89",
              "usdIndexPrice": "8.274435"
            },
            {
              "symbol": "NOTUSDC",
              "bid1Price": "0.001901",
              "bid1Size": "120285",
              "ask1Price": "0.001915",
              "ask1Size": "896126",
              "lastPrice": "0.001945",
              "prevPrice24h": "0.001908",
              "price24hPcnt": "0.0194",
              "highPrice24h": "0.001952",
              "lowPrice24h": "0.001837",
              "turnover24h": "2210.753639",
              "volume24h": "1168526",
              "usdIndexPrice": "0.00190317"
            },
            {
              "symbol": "MXUSDT",
              "bid1Price": "2.742",
              "bid1Size": "46.64",
              "ask1Price": "2.7468",
              "ask1Size": "3.13",
              "lastPrice": "2.742",
              "prevPrice24h": "2.75",
              "price24hPcnt": "-0.0029",
              "highPrice24h": "2.7685",
              "lowPrice24h": "2.7112",
              "turnover24h": "17757.555935",
              "volume24h": "6460.6"
            },
            {
              "symbol": "DUELUSDT",
              "bid1Price": "0.0012686",
              "bid1Size": "11504.51",
              "ask1Price": "0.001271",
              "ask1Size": "6766.79",
              "lastPrice": "0.001271",
              "prevPrice24h": "0.0013534",
              "price24hPcnt": "-0.0609",
              "highPrice24h": "0.00175",
              "lowPrice24h": "0.0010959",
              "turnover24h": "201003.08607998",
              "volume24h": "142129790.08"
            },
            {
              "symbol": "PURSEUSDT",
              "bid1Price": "0.0000397",
              "bid1Size": "26450881.61",
              "ask1Price": "0.00003983",
              "ask1Size": "226561.15",
              "lastPrice": "0.00003983",
              "prevPrice24h": "0.00003969",
              "price24hPcnt": "0.0035",
              "highPrice24h": "0.00004033",
              "lowPrice24h": "0.00003923",
              "turnover24h": "26639.6289603934",
              "volume24h": "672033462.71"
            },
            {
              "symbol": "XETAUSDT",
              "bid1Price": "0.000919",
              "bid1Size": "43314.07",
              "ask1Price": "0.000922",
              "ask1Size": "27996.56",
              "lastPrice": "0.000922",
              "prevPrice24h": "0.000923",
              "price24hPcnt": "-0.0011",
              "highPrice24h": "0.000949",
              "lowPrice24h": "0.000914",
              "turnover24h": "34896.05998313",
              "volume24h": "37430248.67"
            },
            {
              "symbol": "OMNIUSDT",
              "bid1Price": "2.064",
              "bid1Size": "143.08",
              "ask1Price": "2.065",
              "ask1Size": "123.26",
              "lastPrice": "2.065",
              "prevPrice24h": "1.944",
              "price24hPcnt": "0.0622",
              "highPrice24h": "2.236",
              "lowPrice24h": "1.927",
              "turnover24h": "994673.66821",
              "volume24h": "474209.8",
              "usdIndexPrice": "2.055472"
            },
            {
              "symbol": "ONDOUSDT",
              "bid1Price": "0.8403",
              "bid1Size": "485.54",
              "ask1Price": "0.8404",
              "ask1Size": "694.06",
              "lastPrice": "0.8404",
              "prevPrice24h": "0.846",
              "price24hPcnt": "-0.0066",
              "highPrice24h": "0.8626",
              "lowPrice24h": "0.8361",
              "turnover24h": "5044949.6213086",
              "volume24h": "5939224.45",
              "usdIndexPrice": "0.840314"
            },
            {
              "symbol": "APTRUSDT",
              "bid1Price": "0.001319",
              "bid1Size": "5223",
              "ask1Price": "0.001322",
              "ask1Size": "3932.97",
              "lastPrice": "0.001321",
              "prevPrice24h": "0.001297",
              "price24hPcnt": "0.0185",
              "highPrice24h": "0.001327",
              "lowPrice24h": "0.001287",
              "turnover24h": "31833.3878045",
              "volume24h": "24241966.91"
            },
            {
              "symbol": "A8USDT",
              "bid1Price": "0.1254",
              "bid1Size": "33.99",
              "ask1Price": "0.1257",
              "ask1Size": "4997.77",
              "lastPrice": "0.1254",
              "prevPrice24h": "0.1289",
              "price24hPcnt": "-0.0272",
              "highPrice24h": "0.1312",
              "lowPrice24h": "0.125",
              "turnover24h": "340574.605743",
              "volume24h": "2645654.31"
            },
            {
              "symbol": "VETUSDT",
              "bid1Price": "0.02328",
              "bid1Size": "40273",
              "ask1Price": "0.02329",
              "ask1Size": "15688",
              "lastPrice": "0.02329",
              "prevPrice24h": "0.02328",
              "price24hPcnt": "0.0004",
              "highPrice24h": "0.02394",
              "lowPrice24h": "0.02314",
              "turnover24h": "2986705.54617",
              "volume24h": "127478246"
            },
            {
              "symbol": "FILUSDT",
              "bid1Price": "2.617",
              "bid1Size": "184.95",
              "ask1Price": "2.618",
              "ask1Size": "2345.61",
              "lastPrice": "2.616",
              "prevPrice24h": "2.51",
              "price24hPcnt": "0.0422",
              "highPrice24h": "2.661",
              "lowPrice24h": "2.478",
              "turnover24h": "2945335.85903",
              "volume24h": "1137384.91",
              "usdIndexPrice": "2.61411"
            },
            {
              "symbol": "XDCUSDT",
              "bid1Price": "0.07191",
              "bid1Size": "5000",
              "ask1Price": "0.07193",
              "ask1Size": "762.5",
              "lastPrice": "0.0719",
              "prevPrice24h": "0.07144",
              "price24hPcnt": "0.0064",
              "highPrice24h": "0.07361",
              "lowPrice24h": "0.0706",
              "turnover24h": "1519860.945567",
              "volume24h": "21089136.5",
              "usdIndexPrice": "0.0718906"
            },
            {
              "symbol": "AEVOUSDT",
              "bid1Price": "0.0952",
              "bid1Size": "11670.52",
              "ask1Price": "0.0953",
              "ask1Size": "5752.86",
              "lastPrice": "0.0952",
              "prevPrice24h": "0.0922",
              "price24hPcnt": "0.0325",
              "highPrice24h": "0.0984",
              "lowPrice24h": "0.0912",
              "turnover24h": "483461.205719",
              "volume24h": "5059462.87",
              "usdIndexPrice": "0.0952131"
            },
            {
              "symbol": "RENDERUSDT",
              "bid1Price": "4.305",
              "bid1Size": "33.95",
              "ask1Price": "4.306",
              "ask1Size": "75.29",
              "lastPrice": "4.303",
              "prevPrice24h": "4.069",
              "price24hPcnt": "0.0575",
              "highPrice24h": "4.474",
              "lowPrice24h": "3.98",
              "turnover24h": "4391669.19812",
              "volume24h": "1040114.98",
              "usdIndexPrice": "4.303639"
            },
            {
              "symbol": "WAXPUSDT",
              "bid1Price": "0.02407",
              "bid1Size": "1172.38",
              "ask1Price": "0.02408",
              "ask1Size": "556.34",
              "lastPrice": "0.02409",
              "prevPrice24h": "0.02671",
              "price24hPcnt": "-0.0981",
              "highPrice24h": "0.02843",
              "lowPrice24h": "0.02407",
              "turnover24h": "335251.5517809",
              "volume24h": "12718582.34"
            },
            {
              "symbol": "SPXUSDT",
              "bid1Price": "0.4291",
              "bid1Size": "607.8",
              "ask1Price": "0.4295",
              "ask1Size": "1233.9",
              "lastPrice": "0.4291",
              "prevPrice24h": "0.4416",
              "price24hPcnt": "-0.0283",
              "highPrice24h": "0.4506",
              "lowPrice24h": "0.427",
              "turnover24h": "1316907.4573",
              "volume24h": "3006506.4",
              "usdIndexPrice": "0.429219"
            },
            {
              "symbol": "AVLUSDT",
              "bid1Price": "0.2465",
              "bid1Size": "523.2",
              "ask1Price": "0.2467",
              "ask1Size": "79.1",
              "lastPrice": "0.2464",
              "prevPrice24h": "0.2027",
              "price24hPcnt": "0.2156",
              "highPrice24h": "0.2974",
              "lowPrice24h": "0.2016",
              "turnover24h": "6213270.98618",
              "volume24h": "26745546.9"
            },
            {
              "symbol": "DEGENUSDT",
              "bid1Price": "0.002491",
              "bid1Size": "103332.79",
              "ask1Price": "0.002497",
              "ask1Size": "80613.48",
              "lastPrice": "0.002497",
              "prevPrice24h": "0.002547",
              "price24hPcnt": "-0.0196",
              "highPrice24h": "0.00263",
              "lowPrice24h": "0.002463",
              "turnover24h": "705899.11381392",
              "volume24h": "278980834.52"
            },
            {
              "symbol": "DOGEUSDC",
              "bid1Price": "0.15651",
              "bid1Size": "1477.1",
              "ask1Price": "0.15652",
              "ask1Size": "2160",
              "lastPrice": "0.15673",
              "prevPrice24h": "0.15865",
              "price24hPcnt": "-0.0121",
              "highPrice24h": "0.15954",
              "lowPrice24h": "0.15629",
              "turnover24h": "357462.062131",
              "volume24h": "2262961.5",
              "usdIndexPrice": "0.156437"
            },
            {
              "symbol": "SEIUSDT",
              "bid1Price": "0.1707",
              "bid1Size": "14639.95",
              "ask1Price": "0.1708",
              "ask1Size": "2518.87",
              "lastPrice": "0.1707",
              "prevPrice24h": "0.1701",
              "price24hPcnt": "0.0035",
              "highPrice24h": "0.1757",
              "lowPrice24h": "0.1697",
              "turnover24h": "1577594.79815",
              "volume24h": "9142506.79",
              "usdIndexPrice": "0.170699"
            },
            {
              "symbol": "PBUXUSDT",
              "bid1Price": "0.003364",
              "bid1Size": "3405.61",
              "ask1Price": "0.003367",
              "ask1Size": "3461.8",
              "lastPrice": "0.003366",
              "prevPrice24h": "0.003356",
              "price24hPcnt": "0.0030",
              "highPrice24h": "0.00366",
              "lowPrice24h": "0.003242",
              "turnover24h": "39444.95977579",
              "volume24h": "11635866.37"
            },
            {
              "symbol": "ARBUSDT",
              "bid1Price": "0.2997",
              "bid1Size": "6009.07",
              "ask1Price": "0.2998",
              "ask1Size": "1358.78",
              "lastPrice": "0.2997",
              "prevPrice24h": "0.2932",
              "price24hPcnt": "0.0222",
              "highPrice24h": "0.3075",
              "lowPrice24h": "0.2909",
              "turnover24h": "3130574.496706",
              "volume24h": "10442176.05",
              "usdIndexPrice": "0.299569"
            },
            {
              "symbol": "NYANUSDT",
              "bid1Price": "0.01569",
              "bid1Size": "858.48",
              "ask1Price": "0.01574",
              "ask1Size": "998.42",
              "lastPrice": "0.01573",
              "prevPrice24h": "0.01556",
              "price24hPcnt": "0.0109",
              "highPrice24h": "0.01691",
              "lowPrice24h": "0.01531",
              "turnover24h": "31322.8936953",
              "volume24h": "1987095.99"
            },
            {
              "symbol": "ENAUSDT",
              "bid1Price": "0.2813",
              "bid1Size": "1742.35",
              "ask1Price": "0.2814",
              "ask1Size": "520.86",
              "lastPrice": "0.2813",
              "prevPrice24h": "0.2844",
              "price24hPcnt": "-0.0109",
              "highPrice24h": "0.2915",
              "lowPrice24h": "0.2799",
              "turnover24h": "2348112.703043",
              "volume24h": "8234950.11",
              "usdIndexPrice": "0.281319"
            },
            {
              "symbol": "AXSUSDT",
              "bid1Price": "2.301",
              "bid1Size": "198",
              "ask1Price": "2.303",
              "ask1Size": "184.98",
              "lastPrice": "2.303",
              "prevPrice24h": "2.297",
              "price24hPcnt": "0.0026",
              "highPrice24h": "2.385",
              "lowPrice24h": "2.212",
              "turnover24h": "347441.13877",
              "volume24h": "149688",
              "usdIndexPrice": "2.29639"
            },
            {
              "symbol": "USDCUSDT",
              "bid1Price": "1",
              "bid1Size": "6365125.65",
              "ask1Price": "1.0001",
              "ask1Size": "4606675.67",
              "lastPrice": "1",
              "prevPrice24h": "1",
              "price24hPcnt": "0",
              "highPrice24h": "1.0002",
              "lowPrice24h": "1",
              "turnover24h": "41370041.47457",
              "volume24h": "41367069.59",
              "usdIndexPrice": "1.000003"
            },
            {
              "symbol": "SOLBRL",
              "bid1Price": "814.6",
              "bid1Size": "6.219",
              "ask1Price": "817.8",
              "ask1Size": "2",
              "lastPrice": "818.7",
              "prevPrice24h": "815.9",
              "price24hPcnt": "0.0034",
              "highPrice24h": "832.2",
              "lowPrice24h": "807.5",
              "turnover24h": "520200.4746",
              "volume24h": "635.237"
            },
            {
              "symbol": "WUSDT",
              "bid1Price": "0.0729",
              "bid1Size": "108030.95",
              "ask1Price": "0.073",
              "ask1Size": "9000",
              "lastPrice": "0.073",
              "prevPrice24h": "0.072",
              "price24hPcnt": "0.0139",
              "highPrice24h": "0.0757",
              "lowPrice24h": "0.0717",
              "turnover24h": "2727303.147842",
              "volume24h": "37166324.28",
              "usdIndexPrice": "0.0729902"
            },
            {
              "symbol": "ADAEUR",
              "bid1Price": "0.5469",
              "bid1Size": "527.55",
              "ask1Price": "0.548",
              "ask1Size": "1903.06",
              "lastPrice": "0.5489",
              "prevPrice24h": "0.5534",
              "price24hPcnt": "-0.0081",
              "highPrice24h": "0.5558",
              "lowPrice24h": "0.547",
              "turnover24h": "2880.561079",
              "volume24h": "5219.59"
            },
            {
              "symbol": "ENSUSDT",
              "bid1Price": "14.35",
              "bid1Size": "136.91",
              "ask1Price": "14.36",
              "ask1Size": "18.35",
              "lastPrice": "14.36",
              "prevPrice24h": "14.29",
              "price24hPcnt": "0.0049",
              "highPrice24h": "14.68",
              "lowPrice24h": "14.22",
              "turnover24h": "473690.363",
              "volume24h": "32729",
              "usdIndexPrice": "14.345074"
            },
            {
              "symbol": "MBXUSDT",
              "bid1Price": "0.1622",
              "bid1Size": "116.47",
              "ask1Price": "0.1629",
              "ask1Size": "1408.66",
              "lastPrice": "0.1622",
              "prevPrice24h": "0.1621",
              "price24hPcnt": "0.0006",
              "highPrice24h": "0.1635",
              "lowPrice24h": "0.1615",
              "turnover24h": "18166.818316",
              "volume24h": "111725.22"
            },
            {
              "symbol": "METHETH",
              "bid1Price": "1.0629",
              "bid1Size": "0.03848",
              "ask1Price": "1.063",
              "ask1Size": "4.45033",
              "lastPrice": "1.0629",
              "prevPrice24h": "1.0629",
              "price24hPcnt": "0",
              "highPrice24h": "1.063",
              "lowPrice24h": "1.0629",
              "turnover24h": "7.484278697",
              "volume24h": "7.04104"
            },
            {
              "symbol": "RVNUSDT",
              "bid1Price": "0.01093",
              "bid1Size": "205855.2",
              "ask1Price": "0.01095",
              "ask1Size": "394335.9",
              "lastPrice": "0.01097",
              "prevPrice24h": "0.01084",
              "price24hPcnt": "0.0120",
              "highPrice24h": "0.01115",
              "lowPrice24h": "0.01073",
              "turnover24h": "63373.862664",
              "volume24h": "5788692.2",
              "usdIndexPrice": "0.0109471"
            },
            {
              "symbol": "TIAUSDC",
              "bid1Price": "2.457",
              "bid1Size": "861.61",
              "ask1Price": "2.475",
              "ask1Size": "92.81",
              "lastPrice": "2.472",
              "prevPrice24h": "2.391",
              "price24hPcnt": "0.0339",
              "highPrice24h": "2.522",
              "lowPrice24h": "2.353",
              "turnover24h": "5268.63603",
              "volume24h": "2192.51",
              "usdIndexPrice": "2.457799"
            },
            {
              "symbol": "RDNTUSDT",
              "bid1Price": "0.02042",
              "bid1Size": "27873.98",
              "ask1Price": "0.02045",
              "ask1Size": "11244.64",
              "lastPrice": "0.02045",
              "prevPrice24h": "0.0196",
              "price24hPcnt": "0.0434",
              "highPrice24h": "0.02133",
              "lowPrice24h": "0.01922",
              "turnover24h": "73117.0524205",
              "volume24h": "3581108.28",
              "usdIndexPrice": "0.020482"
            },
            {
              "symbol": "FLRUSDT",
              "bid1Price": "0.01636",
              "bid1Size": "15918.75",
              "ask1Price": "0.01638",
              "ask1Size": "30203.79",
              "lastPrice": "0.01637",
              "prevPrice24h": "0.01603",
              "price24hPcnt": "0.0212",
              "highPrice24h": "0.01724",
              "lowPrice24h": "0.01596",
              "turnover24h": "1605707.5640929",
              "volume24h": "97088894.81",
              "usdIndexPrice": "0.0163749"
            },
            {
              "symbol": "CORNUSDT",
              "bid1Price": "0.05017",
              "bid1Size": "277.8",
              "ask1Price": "0.05018",
              "ask1Size": "385.9",
              "lastPrice": "0.05017",
              "prevPrice24h": "0.05107",
              "price24hPcnt": "-0.0176",
              "highPrice24h": "0.05444",
              "lowPrice24h": "0.04995",
              "turnover24h": "1313041.704851",
              "volume24h": "25853847.9"
            },
            {
              "symbol": "SSVUSDT",
              "bid1Price": "5.578",
              "bid1Size": "44.1",
              "ask1Price": "5.583",
              "ask1Size": "44.81",
              "lastPrice": "5.579",
              "prevPrice24h": "5.453",
              "price24hPcnt": "0.0231",
              "highPrice24h": "5.866",
              "lowPrice24h": "5.349",
              "turnover24h": "578248.85958",
              "volume24h": "102729.86",
              "usdIndexPrice": "5.577403"
            },
            {
              "symbol": "SUSDT",
              "bid1Price": "0.4663",
              "bid1Size": "2337.49",
              "ask1Price": "0.4664",
              "ask1Size": "990",
              "lastPrice": "0.4664",
              "prevPrice24h": "0.4667",
              "price24hPcnt": "-0.0006",
              "highPrice24h": "0.4802",
              "lowPrice24h": "0.4636",
              "turnover24h": "3860806.924974",
              "volume24h": "8186881.59",
              "usdIndexPrice": "0.466393"
            },
            {
              "symbol": "G3USDT",
              "bid1Price": "0.003361",
              "bid1Size": "6620.29",
              "ask1Price": "0.003379",
              "ask1Size": "3856.03",
              "lastPrice": "0.003361",
              "prevPrice24h": "0.003517",
              "price24hPcnt": "-0.0444",
              "highPrice24h": "0.005368",
              "lowPrice24h": "0.003289",
              "turnover24h": "136814.6910642",
              "volume24h": "33640421.07"
            },
            {
              "symbol": "XCADUSDT",
              "bid1Price": "0.05546",
              "bid1Size": "166.55",
              "ask1Price": "0.05557",
              "ask1Size": "315.02",
              "lastPrice": "0.05558",
              "prevPrice24h": "0.05612",
              "price24hPcnt": "-0.0096",
              "highPrice24h": "0.05642",
              "lowPrice24h": "0.05471",
              "turnover24h": "32068.3914303",
              "volume24h": "576487.17"
            },
            {
              "symbol": "XAIUSDT",
              "bid1Price": "0.0479",
              "bid1Size": "10091.44",
              "ask1Price": "0.048",
              "ask1Size": "26929.35",
              "lastPrice": "0.0481",
              "prevPrice24h": "0.0439",
              "price24hPcnt": "0.0957",
              "highPrice24h": "0.0547",
              "lowPrice24h": "0.0434",
              "turnover24h": "1167737.171805",
              "volume24h": "23441627.02",
              "usdIndexPrice": "0.0479887"
            },
            {
              "symbol": "BEAMUSDT",
              "bid1Price": "0.006278",
              "bid1Size": "1412.78",
              "ask1Price": "0.006284",
              "ask1Size": "37800",
              "lastPrice": "0.006285",
              "prevPrice24h": "0.006197",
              "price24hPcnt": "0.0142",
              "highPrice24h": "0.006525",
              "lowPrice24h": "0.006111",
              "turnover24h": "361425.28539689",
              "volume24h": "57246276.28"
            },
            {
              "symbol": "JSTUSDT",
              "bid1Price": "0.03071",
              "bid1Size": "65167.8",
              "ask1Price": "0.03078",
              "ask1Size": "266.47",
              "lastPrice": "0.03074",
              "prevPrice24h": "0.03078",
              "price24hPcnt": "-0.0013",
              "highPrice24h": "0.03094",
              "lowPrice24h": "0.03056",
              "turnover24h": "30871.1666816",
              "volume24h": "1003895.97"
            },
            {
              "symbol": "GMTUSDT",
              "bid1Price": "0.05843",
              "bid1Size": "5175",
              "ask1Price": "0.05845",
              "ask1Size": "10350",
              "lastPrice": "0.05856",
              "prevPrice24h": "0.0566",
              "price24hPcnt": "0.0346",
              "highPrice24h": "0.06562",
              "lowPrice24h": "0.05648",
              "turnover24h": "6992409.5137588",
              "volume24h": "114568777.12",
              "usdIndexPrice": "0.0585222"
            },
            {
              "symbol": "SOLVUSDT",
              "bid1Price": "0.02544",
              "bid1Size": "28996.4",
              "ask1Price": "0.02547",
              "ask1Size": "68041.5",
              "lastPrice": "0.02547",
              "prevPrice24h": "0.02378",
              "price24hPcnt": "0.0711",
              "highPrice24h": "0.02688",
              "lowPrice24h": "0.02344",
              "turnover24h": "1193745.681608",
              "volume24h": "47645671.9",
              "usdIndexPrice": "0.0254713"
            },
            {
              "symbol": "MAVIAUSDT",
              "bid1Price": "0.1986",
              "bid1Size": "5061.55",
              "ask1Price": "0.1989",
              "ask1Size": "3858.28",
              "lastPrice": "0.1988",
              "prevPrice24h": "0.2199",
              "price24hPcnt": "-0.0960",
              "highPrice24h": "0.2324",
              "lowPrice24h": "0.1971",
              "turnover24h": "3029388.084256",
              "volume24h": "14327982.25"
            },
            {
              "symbol": "WAVESUSDT",
              "bid1Price": "1.127",
              "bid1Size": "216",
              "ask1Price": "1.128",
              "ask1Size": "216",
              "lastPrice": "1.128",
              "prevPrice24h": "1.073",
              "price24hPcnt": "0.0513",
              "highPrice24h": "1.213",
              "lowPrice24h": "1.067",
              "turnover24h": "2847144.178404",
              "volume24h": "2482585.05"
            },
            {
              "symbol": "TAIKOUSDT",
              "bid1Price": "0.5912",
              "bid1Size": "23.82",
              "ask1Price": "0.5914",
              "ask1Size": "23.86",
              "lastPrice": "0.5912",
              "prevPrice24h": "0.6022",
              "price24hPcnt": "-0.0183",
              "highPrice24h": "0.6129",
              "lowPrice24h": "0.5911",
              "turnover24h": "291299.535337",
              "volume24h": "483276.88",
              "usdIndexPrice": "0.591228"
            },
            {
              "symbol": "LAVAUSDT",
              "bid1Price": "0.03749",
              "bid1Size": "6233",
              "ask1Price": "0.03753",
              "ask1Size": "524.5",
              "lastPrice": "0.03751",
              "prevPrice24h": "0.03794",
              "price24hPcnt": "-0.0113",
              "highPrice24h": "0.0393",
              "lowPrice24h": "0.03708",
              "turnover24h": "391935.714745",
              "volume24h": "10249275.5"
            },
            {
              "symbol": "ETHPLN",
              "bid1Price": "5989",
              "bid1Size": "4.4192",
              "ask1Price": "5993",
              "ask1Size": "2.02",
              "lastPrice": "5993",
              "prevPrice24h": "6053",
              "price24hPcnt": "-0.0099",
              "highPrice24h": "6129",
              "lowPrice24h": "5984",
              "turnover24h": "1511826.9971",
              "volume24h": "249.872"
            },
            {
              "symbol": "GRASSUSDT",
              "bid1Price": "1.7237",
              "bid1Size": "37.4",
              "ask1Price": "1.7243",
              "ask1Size": "135",
              "lastPrice": "1.7235",
              "prevPrice24h": "1.6605",
              "price24hPcnt": "0.0379",
              "highPrice24h": "1.761",
              "lowPrice24h": "1.6508",
              "turnover24h": "2445699.15418",
              "volume24h": "1439238.5",
              "usdIndexPrice": "1.723501"
            },
            {
              "symbol": "CRVUSDT",
              "bid1Price": "0.6047",
              "bid1Size": "148.07",
              "ask1Price": "0.6048",
              "ask1Size": "181.22",
              "lastPrice": "0.6043",
              "prevPrice24h": "0.6201",
              "price24hPcnt": "-0.0255",
              "highPrice24h": "0.6276",
              "lowPrice24h": "0.6038",
              "turnover24h": "2353684.650189",
              "volume24h": "3828132.84",
              "usdIndexPrice": "0.60465"
            },
            {
              "symbol": "KSMUSDT",
              "bid1Price": "13.39",
              "bid1Size": "9",
              "ask1Price": "13.4",
              "ask1Size": "9",
              "lastPrice": "13.39",
              "prevPrice24h": "13.03",
              "price24hPcnt": "0.0276",
              "highPrice24h": "13.7",
              "lowPrice24h": "12.98",
              "turnover24h": "140365.99931",
              "volume24h": "10502.08",
              "usdIndexPrice": "13.393515"
            },
            {
              "symbol": "USDYUSDT",
              "bid1Price": "1.0851",
              "bid1Size": "45059",
              "ask1Price": "1.086",
              "ask1Size": "84905.12",
              "lastPrice": "1.0847",
              "prevPrice24h": "1.0849",
              "price24hPcnt": "-0.0002",
              "highPrice24h": "1.086",
              "lowPrice24h": "1.0845",
              "turnover24h": "52.505644",
              "volume24h": "48.39"
            },
            {
              "symbol": "CHZUSDT",
              "bid1Price": "0.0372",
              "bid1Size": "38184.24",
              "ask1Price": "0.0373",
              "ask1Size": "38917.82",
              "lastPrice": "0.0372",
              "prevPrice24h": "0.0373",
              "price24hPcnt": "-0.0027",
              "highPrice24h": "0.0384",
              "lowPrice24h": "0.037",
              "turnover24h": "98981.7971006",
              "volume24h": "2633015.88",
              "usdIndexPrice": "0.0372225"
            },
            {
              "symbol": "FMCUSDT",
              "bid1Price": "0.0003548",
              "bid1Size": "294.18",
              "ask1Price": "0.0003552",
              "ask1Size": "23635.41",
              "lastPrice": "0.0003548",
              "prevPrice24h": "0.0003548",
              "price24hPcnt": "0",
              "highPrice24h": "0.000378",
              "lowPrice24h": "0.0003451",
              "turnover24h": "17663.53672141",
              "volume24h": "48732725.92"
            },
            {
              "symbol": "VANRYUSDT",
              "bid1Price": "0.02538",
              "bid1Size": "6793.76",
              "ask1Price": "0.02543",
              "ask1Size": "19589.49",
              "lastPrice": "0.02538",
              "prevPrice24h": "0.02432",
              "price24hPcnt": "0.0436",
              "highPrice24h": "0.02635",
              "lowPrice24h": "0.02397",
              "turnover24h": "60201.4286208",
              "volume24h": "2393066.1",
              "usdIndexPrice": "0.0253992"
            },
            {
              "symbol": "VTHOUSDT",
              "bid1Price": "0.002701",
              "bid1Size": "18958",
              "ask1Price": "0.002703",
              "ask1Size": "68240",
              "lastPrice": "0.002707",
              "prevPrice24h": "0.002604",
              "price24hPcnt": "0.0396",
              "highPrice24h": "0.003045",
              "lowPrice24h": "0.002445",
              "turnover24h": "984874.322867",
              "volume24h": "373424746"
            },
            {
              "symbol": "FLUIDUSDT",
              "bid1Price": "3.9581",
              "bid1Size": "63.16",
              "ask1Price": "3.9659",
              "ask1Size": "13.16",
              "lastPrice": "3.9581",
              "prevPrice24h": "3.9674",
              "price24hPcnt": "-0.0023",
              "highPrice24h": "4.091",
              "lowPrice24h": "3.937",
              "turnover24h": "126124.939538",
              "volume24h": "31628.09"
            },
            {
              "symbol": "PUFFUSDT",
              "bid1Price": "0.0632",
              "bid1Size": "887",
              "ask1Price": "0.06367",
              "ask1Size": "1612",
              "lastPrice": "0.06367",
              "prevPrice24h": "0.06389",
              "price24hPcnt": "-0.0034",
              "highPrice24h": "0.0648",
              "lowPrice24h": "0.063",
              "turnover24h": "26641.47303",
              "volume24h": "419329"
            },
            {
              "symbol": "BTCPLN",
              "bid1Price": "319090",
              "bid1Size": "0.000001",
              "ask1Price": "319091",
              "ask1Size": "0.002305",
              "lastPrice": "319090",
              "prevPrice24h": "322143",
              "price24hPcnt": "-0.0095",
              "highPrice24h": "322826",
              "lowPrice24h": "319090",
              "turnover24h": "399855.851299",
              "volume24h": "1.245959"
            },
            {
              "symbol": "DYDXUSDT",
              "bid1Price": "0.5886",
              "bid1Size": "400.5",
              "ask1Price": "0.5888",
              "ask1Size": "200.25",
              "lastPrice": "0.5886",
              "prevPrice24h": "0.5795",
              "price24hPcnt": "0.0157",
              "highPrice24h": "0.6004",
              "lowPrice24h": "0.5781",
              "turnover24h": "1190727.2488446",
              "volume24h": "2030052.24",
              "usdIndexPrice": "0.588551"
            },
            {
              "symbol": "SONICUSDT",
              "bid1Price": "0.22782",
              "bid1Size": "48.3",
              "ask1Price": "0.22804",
              "ask1Size": "926.4",
              "lastPrice": "0.22777",
              "prevPrice24h": "0.2286",
              "price24hPcnt": "-0.0036",
              "highPrice24h": "0.24171",
              "lowPrice24h": "0.22693",
              "turnover24h": "707149.02668",
              "volume24h": "3022900.4",
              "usdIndexPrice": "0.227914"
            },
            {
              "symbol": "SAFEUSDT",
              "bid1Price": "0.4104",
              "bid1Size": "88.32",
              "ask1Price": "0.4106",
              "ask1Size": "479.05",
              "lastPrice": "0.4105",
              "prevPrice24h": "0.4191",
              "price24hPcnt": "-0.0205",
              "highPrice24h": "0.4278",
              "lowPrice24h": "0.4099",
              "turnover24h": "124171.130099",
              "volume24h": "295912.59",
              "usdIndexPrice": "0.410575"
            },
            {
              "symbol": "HFTUSDT",
              "bid1Price": "0.0665",
              "bid1Size": "16100.82",
              "ask1Price": "0.0666",
              "ask1Size": "40656.03",
              "lastPrice": "0.0666",
              "prevPrice24h": "0.0564",
              "price24hPcnt": "0.1809",
              "highPrice24h": "0.0679",
              "lowPrice24h": "0.0556",
              "turnover24h": "1890191.255239",
              "volume24h": "30553480.85",
              "usdIndexPrice": "0.0666365"
            },
            {
              "symbol": "B3USDT",
              "bid1Price": "0.003537",
              "bid1Size": "8602",
              "ask1Price": "0.00354",
              "ask1Size": "5889",
              "lastPrice": "0.003538",
              "prevPrice24h": "0.003423",
              "price24hPcnt": "0.0336",
              "highPrice24h": "0.003755",
              "lowPrice24h": "0.003355",
              "turnover24h": "1840361.485886",
              "volume24h": "521395730"
            },
            {
              "symbol": "CGPTUSDT",
              "bid1Price": "0.07357",
              "bid1Size": "3465",
              "ask1Price": "0.07372",
              "ask1Size": "2732.5",
              "lastPrice": "0.07357",
              "prevPrice24h": "0.06839",
              "price24hPcnt": "0.0757",
              "highPrice24h": "0.0769",
              "lowPrice24h": "0.06781",
              "turnover24h": "311740.2880135",
              "volume24h": "4323333.11"
            },
            {
              "symbol": "STETHEUR",
              "bid1Price": "1392.57",
              "bid1Size": "21.4949",
              "ask1Price": "1399.49",
              "ask1Size": "21.4841",
              "lastPrice": "1397.67",
              "prevPrice24h": "1397.67",
              "price24hPcnt": "0",
              "highPrice24h": "1397.67",
              "lowPrice24h": "1397.67",
              "turnover24h": "0",
              "volume24h": "0"
            },
            {
              "symbol": "MBOXUSDT",
              "bid1Price": "0.04732",
              "bid1Size": "332.7",
              "ask1Price": "0.04737",
              "ask1Size": "332.54",
              "lastPrice": "0.04744",
              "prevPrice24h": "0.04262",
              "price24hPcnt": "0.1131",
              "highPrice24h": "0.05651",
              "lowPrice24h": "0.04233",
              "turnover24h": "741214.4982223",
              "volume24h": "14930288.16"
            },
            {
              "symbol": "VELOUSDT",
              "bid1Price": "0.012832",
              "bid1Size": "1875.1",
              "ask1Price": "0.012836",
              "ask1Size": "1759.6",
              "lastPrice": "0.012839",
              "prevPrice24h": "0.012614",
              "price24hPcnt": "0.0178",
              "highPrice24h": "0.0135",
              "lowPrice24h": "0.01249",
              "turnover24h": "557452.17193822",
              "volume24h": "42946536.49"
            },
            {
              "symbol": "BANUSDT",
              "bid1Price": "0.04592",
              "bid1Size": "964",
              "ask1Price": "0.04594",
              "ask1Size": "215",
              "lastPrice": "0.04598",
              "prevPrice24h": "0.04527",
              "price24hPcnt": "0.0157",
              "highPrice24h": "0.04807",
              "lowPrice24h": "0.04256",
              "turnover24h": "684386.07072",
              "volume24h": "15220303"
            },
            {
              "symbol": "DOTBTC",
              "bid1Price": "0.0000456",
              "bid1Size": "168.44",
              "ask1Price": "0.00004574",
              "ask1Size": "350",
              "lastPrice": "0.00004567",
              "prevPrice24h": "0.00004392",
              "price24hPcnt": "0.0398",
              "highPrice24h": "0.00004632",
              "lowPrice24h": "0.00004353",
              "turnover24h": "0.0345799626",
              "volume24h": "764.41"
            },
            {
              "symbol": "GENEUSDT",
              "bid1Price": "0.0557",
              "bid1Size": "19.11",
              "ask1Price": "0.0558",
              "ask1Size": "19.11",
              "lastPrice": "0.05579",
              "prevPrice24h": "0.05519",
              "price24hPcnt": "0.0109",
              "highPrice24h": "0.05786",
              "lowPrice24h": "0.05482",
              "turnover24h": "24465.8320046",
              "volume24h": "433964.28"
            },
            {
              "symbol": "PLUMEUSDT",
              "bid1Price": "0.16478",
              "bid1Size": "87.8",
              "ask1Price": "0.16483",
              "ask1Size": "1628.8",
              "lastPrice": "0.16484",
              "prevPrice24h": "0.16365",
              "price24hPcnt": "0.0073",
              "highPrice24h": "0.17009",
              "lowPrice24h": "0.16177",
              "turnover24h": "2937654.218244",
              "volume24h": "17774533.5",
              "usdIndexPrice": "0.164845"
            },
            {
              "symbol": "SUNDOGUSDT",
              "bid1Price": "0.04871",
              "bid1Size": "5435.4",
              "ask1Price": "0.04875",
              "ask1Size": "263.54",
              "lastPrice": "0.04873",
              "prevPrice24h": "0.04793",
              "price24hPcnt": "0.0167",
              "highPrice24h": "0.04941",
              "lowPrice24h": "0.04774",
              "turnover24h": "729518.8527615",
              "volume24h": "15056553.25"
            },
            {
              "symbol": "DOGSUSDC",
              "bid1Price": "0.0001184",
              "bid1Size": "14775",
              "ask1Price": "0.0001186",
              "ask1Size": "2502513",
              "lastPrice": "0.0001184",
              "prevPrice24h": "0.0001144",
              "price24hPcnt": "0.0350",
              "highPrice24h": "0.0001224",
              "lowPrice24h": "0.0001124",
              "turnover24h": "984.5018214",
              "volume24h": "8492053",
              "usdIndexPrice": "0.000118065"
            },
            {
              "symbol": "XAUTUSDT",
              "bid1Price": "3350",
              "bid1Size": "0.65122",
              "ask1Price": "3350.1",
              "ask1Size": "0.93007",
              "lastPrice": "3350.1",
              "prevPrice24h": "3347",
              "price24hPcnt": "0.0009",
              "highPrice24h": "3352",
              "lowPrice24h": "3340",
              "turnover24h": "9686786.623466",
              "volume24h": "2892.11258",
              "usdIndexPrice": "3349.945821"
            },
            {
              "symbol": "VANAUSDT",
              "bid1Price": "5.061",
              "bid1Size": "1.63",
              "ask1Price": "5.062",
              "ask1Size": "12.09",
              "lastPrice": "5.061",
              "prevPrice24h": "5.152",
              "price24hPcnt": "-0.0177",
              "highPrice24h": "5.298",
              "lowPrice24h": "5.055",
              "turnover24h": "1154852.75602",
              "volume24h": "223399.17",
              "usdIndexPrice": "5.055831"
            },
            {
              "symbol": "EVERUSDT",
              "bid1Price": "0.012906",
              "bid1Size": "1787.75",
              "ask1Price": "0.012908",
              "ask1Size": "1802.04",
              "lastPrice": "0.012908",
              "prevPrice24h": "0.012892",
              "price24hPcnt": "0.0012",
              "highPrice24h": "0.013109",
              "lowPrice24h": "0.01271",
              "turnover24h": "35503.92043536",
              "volume24h": "2758107.26"
            },
            {
              "symbol": "ATHUSDT",
              "bid1Price": "0.027236",
              "bid1Size": "578.16",
              "ask1Price": "0.027255",
              "ask1Size": "2696.47",
              "lastPrice": "0.027242",
              "prevPrice24h": "0.027521",
              "price24hPcnt": "-0.0101",
              "highPrice24h": "0.028046",
              "lowPrice24h": "0.027229",
              "turnover24h": "711422.66473622",
              "volume24h": "25774861.04",
              "usdIndexPrice": "0.0272381"
            },
            {
              "symbol": "GSTSUSDT",
              "bid1Price": "0.001687",
              "bid1Size": "9344.42",
              "ask1Price": "0.001689",
              "ask1Size": "9330.58",
              "lastPrice": "0.001687",
              "prevPrice24h": "0.001709",
              "price24hPcnt": "-0.0129",
              "highPrice24h": "0.00174",
              "lowPrice24h": "0.00168",
              "turnover24h": "22464.60606856",
              "volume24h": "13241527.73"
            },
            {
              "symbol": "TUSDUSDT",
              "bid1Price": "0.9977",
              "bid1Size": "2136.4",
              "ask1Price": "0.9978",
              "ask1Size": "2049.46",
              "lastPrice": "0.9978",
              "prevPrice24h": "0.9979",
              "price24hPcnt": "-0.0001",
              "highPrice24h": "0.9984",
              "lowPrice24h": "0.9977",
              "turnover24h": "1110069.263913",
              "volume24h": "1112239.21"
            },
            {
              "symbol": "USDTBRZ",
              "bid1Price": "5.858",
              "bid1Size": "16.53",
              "ask1Price": "5.893",
              "ask1Size": "49.29",
              "lastPrice": "5.893",
              "prevPrice24h": "5.851",
              "price24hPcnt": "0.0072",
              "highPrice24h": "5.93",
              "lowPrice24h": "5.831",
              "turnover24h": "59613.15353",
              "volume24h": "10139.3"
            },
            {
              "symbol": "AMIUSDT",
              "bid1Price": "0.06761",
              "bid1Size": "3208.6",
              "ask1Price": "0.06772",
              "ask1Size": "449.3",
              "lastPrice": "0.06772",
              "prevPrice24h": "0.06336",
              "price24hPcnt": "0.0688",
              "highPrice24h": "0.07",
              "lowPrice24h": "0.06289",
              "turnover24h": "116179.160007",
              "volume24h": "2233970.5"
            },
            {
              "symbol": "ATOMUSDC",
              "bid1Price": "4.171",
              "bid1Size": "0.2",
              "ask1Price": "4.18",
              "ask1Size": "54.79",
              "lastPrice": "4.171",
              "prevPrice24h": "4.174",
              "price24hPcnt": "-0.0007",
              "highPrice24h": "4.253",
              "lowPrice24h": "4.132",
              "turnover24h": "17084.7529",
              "volume24h": "4123.54",
              "usdIndexPrice": "4.168292"
            },
            {
              "symbol": "CBKUSDT",
              "bid1Price": "0.5344",
              "bid1Size": "15.54",
              "ask1Price": "0.5349",
              "ask1Size": "93.17",
              "lastPrice": "0.5349",
              "prevPrice24h": "0.5453",
              "price24hPcnt": "-0.0191",
              "highPrice24h": "0.5537",
              "lowPrice24h": "0.5338",
              "turnover24h": "93065.175418",
              "volume24h": "171267.85"
            },
            {
              "symbol": "SVLUSDT",
              "bid1Price": "0.00443",
              "bid1Size": "2332.5",
              "ask1Price": "0.004433",
              "ask1Size": "1211.47",
              "lastPrice": "0.004432",
              "prevPrice24h": "0.004475",
              "price24hPcnt": "-0.0096",
              "highPrice24h": "0.004687",
              "lowPrice24h": "0.004423",
              "turnover24h": "67072.28463836",
              "volume24h": "14975619.75"
            },
            {
              "symbol": "MKRUSDT",
              "bid1Price": "1349",
              "bid1Size": "2.2126",
              "ask1Price": "1350",
              "ask1Size": "0.36",
              "lastPrice": "1349",
              "prevPrice24h": "1365",
              "price24hPcnt": "-0.0117",
              "highPrice24h": "1392",
              "lowPrice24h": "1349",
              "turnover24h": "1437976.8449",
              "volume24h": "1049.7226",
              "usdIndexPrice": "1350.80641"
            },
            {
              "symbol": "KROUSDT",
              "bid1Price": "0.00834",
              "bid1Size": "644",
              "ask1Price": "0.00836",
              "ask1Size": "6645",
              "lastPrice": "0.00833",
              "prevPrice24h": "0.0084",
              "price24hPcnt": "-0.0083",
              "highPrice24h": "0.00843",
              "lowPrice24h": "0.0083",
              "turnover24h": "24083.70627",
              "volume24h": "2880775"
            },
            {
              "symbol": "JASMYUSDT",
              "bid1Price": "0.015",
              "bid1Size": "58284.62",
              "ask1Price": "0.01502",
              "ask1Size": "24028.26",
              "lastPrice": "0.01501",
              "prevPrice24h": "0.015",
              "price24hPcnt": "0.0007",
              "highPrice24h": "0.0158",
              "lowPrice24h": "0.01407",
              "turnover24h": "3606329.9750274",
              "volume24h": "241766584.01",
              "usdIndexPrice": "0.0150083"
            },
            {
              "symbol": "SONUSDT",
              "bid1Price": "0.0001096",
              "bid1Size": "420033",
              "ask1Price": "0.0001102",
              "ask1Size": "80643.82",
              "lastPrice": "0.0001098",
              "prevPrice24h": "0.0001199",
              "price24hPcnt": "-0.0842",
              "highPrice24h": "0.0001204",
              "lowPrice24h": "0.0001076",
              "turnover24h": "34062.419148354",
              "volume24h": "287318423.67"
            },
            {
              "symbol": "WENUSDT",
              "bid1Price": "0.00002572",
              "bid1Size": "3991219.32",
              "ask1Price": "0.00002575",
              "ask1Size": "4186535.73",
              "lastPrice": "0.00002567",
              "prevPrice24h": "0.00002621",
              "price24hPcnt": "-0.0206",
              "highPrice24h": "0.00002642",
              "lowPrice24h": "0.00002461",
              "turnover24h": "219684.3312635787",
              "volume24h": "8614655917.26"
            },
            {
              "symbol": "DLCUSDT",
              "bid1Price": "0.14367",
              "bid1Size": "86.89",
              "ask1Price": "0.1441",
              "ask1Size": "1789.8",
              "lastPrice": "0.14388",
              "prevPrice24h": "0.14506",
              "price24hPcnt": "-0.0081",
              "highPrice24h": "0.14549",
              "lowPrice24h": "0.14353",
              "turnover24h": "40395.9780809",
              "volume24h": "278959.81"
            },
            {
              "symbol": "TRUMPUSDT",
              "bid1Price": "8.2",
              "bid1Size": "3437.74",
              "ask1Price": "8.21",
              "ask1Size": "550.41",
              "lastPrice": "8.21",
              "prevPrice24h": "8.41",
              "price24hPcnt": "-0.0238",
              "highPrice24h": "8.68",
              "lowPrice24h": "8.19",
              "turnover24h": "14440406.7599",
              "volume24h": "1716008.33",
              "usdIndexPrice": "8.203244"
            },
            {
              "symbol": "OPUSDC",
              "bid1Price": "0.703",
              "bid1Size": "4320.7",
              "ask1Price": "0.705",
              "ask1Size": "3678.87",
              "lastPrice": "0.704",
              "prevPrice24h": "0.671",
              "price24hPcnt": "0.0492",
              "highPrice24h": "0.717",
              "lowPrice24h": "0.668",
              "turnover24h": "75363.293573",
              "volume24h": "107806.76",
              "usdIndexPrice": "0.703992"
            },
            {
              "symbol": "BTCUSDR",
              "bid1Price": "84329.26",
              "bid1Size": "0.00143",
              "ask1Price": "84928.36",
              "ask1Size": "0.001728",
              "lastPrice": "84943.11",
              "prevPrice24h": "84943.11",
              "price24hPcnt": "0",
              "highPrice24h": "84943.11",
              "lowPrice24h": "84943.11",
              "turnover24h": "0",
              "volume24h": "0"
            },
            {
              "symbol": "WIFUSDT",
              "bid1Price": "0.424",
              "bid1Size": "3718.03",
              "ask1Price": "0.425",
              "ask1Size": "36786.41",
              "lastPrice": "0.424",
              "prevPrice24h": "0.403",
              "price24hPcnt": "0.0521",
              "highPrice24h": "0.442",
              "lowPrice24h": "0.401",
              "turnover24h": "3835544.23973",
              "volume24h": "9135901.16",
              "usdIndexPrice": "0.424044"
            },
            {
              "symbol": "COREUSDT",
              "bid1Price": "0.6912",
              "bid1Size": "285.04",
              "ask1Price": "0.6918",
              "ask1Size": "285.04",
              "lastPrice": "0.6916",
              "prevPrice24h": "0.6768",
              "price24hPcnt": "0.0219",
              "highPrice24h": "0.7099",
              "lowPrice24h": "0.6673",
              "turnover24h": "1077620.358773",
              "volume24h": "1574134.42",
              "usdIndexPrice": "0.691912"
            },
            {
              "symbol": "APEXUSDC",
              "bid1Price": "0.7129",
              "bid1Size": "544.42",
              "ask1Price": "0.7162",
              "ask1Size": "1399.38",
              "lastPrice": "0.7177",
              "prevPrice24h": "0.7069",
              "price24hPcnt": "0.0153",
              "highPrice24h": "0.7182",
              "lowPrice24h": "0.7046",
              "turnover24h": "323.372988",
              "volume24h": "452.05"
            },
            {
              "symbol": "VENOMUSDT",
              "bid1Price": "0.1329",
              "bid1Size": "81.94",
              "ask1Price": "0.13299",
              "ask1Size": "4374.71",
              "lastPrice": "0.13298",
              "prevPrice24h": "0.12795",
              "price24hPcnt": "0.0393",
              "highPrice24h": "0.133",
              "lowPrice24h": "0.12601",
              "turnover24h": "166443.0207472",
              "volume24h": "1277903.8"
            },
            {
              "symbol": "XRPUSDC",
              "bid1Price": "2.0639",
              "bid1Size": "50.98",
              "ask1Price": "2.064",
              "ask1Size": "195.74",
              "lastPrice": "2.064",
              "prevPrice24h": "2.086",
              "price24hPcnt": "-0.0105",
              "highPrice24h": "2.0976",
              "lowPrice24h": "2.0629",
              "turnover24h": "1850197.759691",
              "volume24h": "888426.65",
              "usdIndexPrice": "2.063591"
            },
            {
              "symbol": "HLGUSDT",
              "bid1Price": "0.0004942",
              "bid1Size": "46060.45",
              "ask1Price": "0.0004954",
              "ask1Size": "57879.64",
              "lastPrice": "0.0004955",
              "prevPrice24h": "0.0004982",
              "price24hPcnt": "-0.0054",
              "highPrice24h": "0.0005009",
              "lowPrice24h": "0.0004926",
              "turnover24h": "13840.124597718",
              "volume24h": "27893392.14"
            },
            {
              "symbol": "SOLUSDC",
              "bid1Price": "139.42",
              "bid1Size": "8.778",
              "ask1Price": "139.44",
              "ask1Size": "0.119",
              "lastPrice": "139.41",
              "prevPrice24h": "138.89",
              "price24hPcnt": "0.0037",
              "highPrice24h": "141.96",
              "lowPrice24h": "137.67",
              "turnover24h": "13682607.08149",
              "volume24h": "97960.528",
              "usdIndexPrice": "139.409822"
            },
            {
              "symbol": "IDUSDT",
              "bid1Price": "0.18506",
              "bid1Size": "1260",
              "ask1Price": "0.1852",
              "ask1Size": "110.72",
              "lastPrice": "0.18513",
              "prevPrice24h": "0.18314",
              "price24hPcnt": "0.0109",
              "highPrice24h": "0.20775",
              "lowPrice24h": "0.1801",
              "turnover24h": "902696.1229665",
              "volume24h": "4734736.63",
              "usdIndexPrice": "0.184938"
            },
            {
              "symbol": "AVAXUSDC",
              "bid1Price": "19.65",
              "bid1Size": "9.112",
              "ask1Price": "19.66",
              "ask1Size": "21.543",
              "lastPrice": "19.66",
              "prevPrice24h": "19.53",
              "price24hPcnt": "0.0067",
              "highPrice24h": "20.36",
              "lowPrice24h": "19.47",
              "turnover24h": "259265.914199",
              "volume24h": "13005.745",
              "usdIndexPrice": "19.649945"
            },
            {
              "symbol": "TRXUSDT",
              "bid1Price": "0.2421",
              "bid1Size": "25026.49",
              "ask1Price": "0.2422",
              "ask1Size": "13136.56",
              "lastPrice": "0.2422",
              "prevPrice24h": "0.2424",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "0.2455",
              "lowPrice24h": "0.24052",
              "turnover24h": "4475859.4284773",
              "volume24h": "18435337.39",
              "usdIndexPrice": "0.24211"
            },
            {
              "symbol": "5IREUSDT",
              "bid1Price": "0.001234",
              "bid1Size": "9836.1",
              "ask1Price": "0.001238",
              "ask1Size": "638.71",
              "lastPrice": "0.001235",
              "prevPrice24h": "0.001157",
              "price24hPcnt": "0.0674",
              "highPrice24h": "0.001263",
              "lowPrice24h": "0.001147",
              "turnover24h": "40485.84049842",
              "volume24h": "33911520.15"
            },
            {
              "symbol": "NRNUSDT",
              "bid1Price": "0.03039",
              "bid1Size": "144.25",
              "ask1Price": "0.03043",
              "ask1Size": "144.35",
              "lastPrice": "0.03039",
              "prevPrice24h": "0.0322",
              "price24hPcnt": "-0.0562",
              "highPrice24h": "0.03221",
              "lowPrice24h": "0.02955",
              "turnover24h": "81292.363455",
              "volume24h": "2635943.08"
            },
            {
              "symbol": "ANIMEUSDT",
              "bid1Price": "0.01772",
              "bid1Size": "47448.7",
              "ask1Price": "0.01774",
              "ask1Size": "44425.9",
              "lastPrice": "0.01775",
              "prevPrice24h": "0.01913",
              "price24hPcnt": "-0.0721",
              "highPrice24h": "0.01915",
              "lowPrice24h": "0.01771",
              "turnover24h": "899009.246354",
              "volume24h": "49000443.1",
              "usdIndexPrice": "0.0177318"
            },
            {
              "symbol": "WEMIXUSDT",
              "bid1Price": "0.6916",
              "bid1Size": "16.445",
              "ask1Price": "0.6935",
              "ask1Size": "33.348",
              "lastPrice": "0.6925",
              "prevPrice24h": "0.6844",
              "price24hPcnt": "0.0118",
              "highPrice24h": "0.75",
              "lowPrice24h": "0.665",
              "turnover24h": "76759.8266204",
              "volume24h": "110477.962"
            },
            {
              "symbol": "POPCATUSDT",
              "bid1Price": "0.2451",
              "bid1Size": "5436.45",
              "ask1Price": "0.2452",
              "ask1Size": "444.58",
              "lastPrice": "0.2453",
              "prevPrice24h": "0.2393",
              "price24hPcnt": "0.0251",
              "highPrice24h": "0.2652",
              "lowPrice24h": "0.2323",
              "turnover24h": "11333608.324707",
              "volume24h": "46457129.56",
              "usdIndexPrice": "0.244731"
            },
            {
              "symbol": "EGOUSDT",
              "bid1Price": "0.006226",
              "bid1Size": "77638.73",
              "ask1Price": "0.00624",
              "ask1Size": "2170.64",
              "lastPrice": "0.006226",
              "prevPrice24h": "0.006126",
              "price24hPcnt": "0.0163",
              "highPrice24h": "0.007236",
              "lowPrice24h": "0.006072",
              "turnover24h": "91446.19507456",
              "volume24h": "14242670.59"
            },
            {
              "symbol": "N3USDT",
              "bid1Price": "0.00216",
              "bid1Size": "153447.5",
              "ask1Price": "0.00218",
              "ask1Size": "144021.7",
              "lastPrice": "0.00217",
              "prevPrice24h": "0.00216",
              "price24hPcnt": "0.0046",
              "highPrice24h": "0.00219",
              "lowPrice24h": "0.00215",
              "turnover24h": "5241.748205",
              "volume24h": "2416966.9"
            },
            {
              "symbol": "SQDUSDT",
              "bid1Price": "0.1919",
              "bid1Size": "242.23",
              "ask1Price": "0.19198",
              "ask1Size": "42.76",
              "lastPrice": "0.1919",
              "prevPrice24h": "0.18518",
              "price24hPcnt": "0.0363",
              "highPrice24h": "0.1935",
              "lowPrice24h": "0.16389",
              "turnover24h": "509447.656892",
              "volume24h": "2789539.2"
            },
            {
              "symbol": "LMWRUSDT",
              "bid1Price": "0.07875",
              "bid1Size": "99.95",
              "ask1Price": "0.07876",
              "ask1Size": "3645.43",
              "lastPrice": "0.07875",
              "prevPrice24h": "0.07997",
              "price24hPcnt": "-0.0153",
              "highPrice24h": "0.08086",
              "lowPrice24h": "0.07842",
              "turnover24h": "33435.3492787",
              "volume24h": "420064.23"
            },
            {
              "symbol": "FUELUSDT",
              "bid1Price": "0.00924",
              "bid1Size": "124778.3",
              "ask1Price": "0.00926",
              "ask1Size": "1858.7",
              "lastPrice": "0.00925",
              "prevPrice24h": "0.00887",
              "price24hPcnt": "0.0428",
              "highPrice24h": "0.0098",
              "lowPrice24h": "0.00861",
              "turnover24h": "320913.323711",
              "volume24h": "35278512.3"
            },
            {
              "symbol": "ETHBTC",
              "bid1Price": "0.018789",
              "bid1Size": "0.81191",
              "ask1Price": "0.01879",
              "ask1Size": "1.9696",
              "lastPrice": "0.018791",
              "prevPrice24h": "0.018777",
              "price24hPcnt": "0.0007",
              "highPrice24h": "0.019148",
              "lowPrice24h": "0.018718",
              "turnover24h": "71.68728416576",
              "volume24h": "3792.80684"
            },
            {
              "symbol": "NSUSDT",
              "bid1Price": "0.15753",
              "bid1Size": "63",
              "ask1Price": "0.15777",
              "ask1Size": "117",
              "lastPrice": "0.15775",
              "prevPrice24h": "0.16275",
              "price24hPcnt": "-0.0307",
              "highPrice24h": "0.1707",
              "lowPrice24h": "0.15728",
              "turnover24h": "601775.81446",
              "volume24h": "3621710"
            },
            {
              "symbol": "BTCTRY",
              "bid1Price": "3216165",
              "bid1Size": "0.294395",
              "ask1Price": "3227650",
              "ask1Size": "0.294638",
              "lastPrice": "3252498",
              "prevPrice24h": "3224789",
              "price24hPcnt": "0.0086",
              "highPrice24h": "3252602",
              "lowPrice24h": "3224789",
              "turnover24h": "6510.79298",
              "volume24h": "0.002004"
            },
            {
              "symbol": "PIXFIUSDT",
              "bid1Price": "0.0004495",
              "bid1Size": "1140992",
              "ask1Price": "0.0004524",
              "ask1Size": "18345",
              "lastPrice": "0.0004495",
              "prevPrice24h": "0.0004453",
              "price24hPcnt": "0.0094",
              "highPrice24h": "0.0005521",
              "lowPrice24h": "0.0004453",
              "turnover24h": "92873.5774463",
              "volume24h": "194869878"
            },
            {
              "symbol": "SUIUSDC",
              "bid1Price": "2.1269",
              "bid1Size": "77.62",
              "ask1Price": "2.1274",
              "ask1Size": "148.14",
              "lastPrice": "2.1262",
              "prevPrice24h": "2.1477",
              "price24hPcnt": "-0.0100",
              "highPrice24h": "2.178",
              "lowPrice24h": "2.1222",
              "turnover24h": "1394308.259211",
              "volume24h": "648244.77",
              "usdIndexPrice": "2.126318"
            },
            {
              "symbol": "HNTUSDT",
              "bid1Price": "3.444",
              "bid1Size": "7.738",
              "ask1Price": "3.447",
              "ask1Size": "7.637",
              "lastPrice": "3.448",
              "prevPrice24h": "3.458",
              "price24hPcnt": "-0.0029",
              "highPrice24h": "3.533",
              "lowPrice24h": "3.401",
              "turnover24h": "291185.746069",
              "volume24h": "84160.244"
            },
            {
              "symbol": "MAGICUSDT",
              "bid1Price": "0.1364",
              "bid1Size": "1575",
              "ask1Price": "0.1365",
              "ask1Size": "1575",
              "lastPrice": "0.1364",
              "prevPrice24h": "0.0791",
              "price24hPcnt": "0.7244",
              "highPrice24h": "0.1546",
              "lowPrice24h": "0.0782",
              "turnover24h": "6550725.813955",
              "volume24h": "52448390.8",
              "usdIndexPrice": "0.136263"
            },
            {
              "symbol": "CARVUSDT",
              "bid1Price": "0.3083",
              "bid1Size": "77.69",
              "ask1Price": "0.3087",
              "ask1Size": "143.91",
              "lastPrice": "0.3089",
              "prevPrice24h": "0.3105",
              "price24hPcnt": "-0.0052",
              "highPrice24h": "0.3167",
              "lowPrice24h": "0.3084",
              "turnover24h": "213121.993968",
              "volume24h": "683273.18"
            },
            {
              "symbol": "GSTUSDT",
              "bid1Price": "0.00688",
              "bid1Size": "14400",
              "ask1Price": "0.006888",
              "ask1Size": "7200",
              "lastPrice": "0.006882",
              "prevPrice24h": "0.006786",
              "price24hPcnt": "0.0141",
              "highPrice24h": "0.006926",
              "lowPrice24h": "0.006561",
              "turnover24h": "42498.74437998",
              "volume24h": "6295215.08"
            },
            {
              "symbol": "ZENTUSDT",
              "bid1Price": "0.00964",
              "bid1Size": "16827.35",
              "ask1Price": "0.00969",
              "ask1Size": "1100.66",
              "lastPrice": "0.00969",
              "prevPrice24h": "0.00929",
              "price24hPcnt": "0.0431",
              "highPrice24h": "0.00988",
              "lowPrice24h": "0.00902",
              "turnover24h": "108756.1463627",
              "volume24h": "11567313.96"
            },
            {
              "symbol": "STETHUSDT",
              "bid1Price": "1589.63",
              "bid1Size": "0.1665",
              "ask1Price": "1589.88",
              "ask1Size": "0.333",
              "lastPrice": "1588.91",
              "prevPrice24h": "1601.26",
              "price24hPcnt": "-0.0077",
              "highPrice24h": "1630.32",
              "lowPrice24h": "1583.2",
              "turnover24h": "657666.2726265",
              "volume24h": "409.32296",
              "usdIndexPrice": "1589.324786"
            },
            {
              "symbol": "PPTUSDT",
              "bid1Price": "0.1943",
              "bid1Size": "48.01",
              "ask1Price": "0.19456",
              "ask1Size": "40.91",
              "lastPrice": "0.19455",
              "prevPrice24h": "0.2045",
              "price24hPcnt": "-0.0487",
              "highPrice24h": "0.20673",
              "lowPrice24h": "0.19059",
              "turnover24h": "1655629.6594431",
              "volume24h": "8286931.2"
            },
            {
              "symbol": "GODSUSDT",
              "bid1Price": "0.1012",
              "bid1Size": "564.59",
              "ask1Price": "0.10159",
              "ask1Size": "534.02",
              "lastPrice": "0.10145",
              "prevPrice24h": "0.09211",
              "price24hPcnt": "0.1014",
              "highPrice24h": "0.11912",
              "lowPrice24h": "0.08948",
              "turnover24h": "224540.2809604",
              "volume24h": "2168540.18"
            },
            {
              "symbol": "NESSUSDT",
              "bid1Price": "0.03489",
              "bid1Size": "17093.43",
              "ask1Price": "0.0349",
              "ask1Size": "1032.71",
              "lastPrice": "0.03489",
              "prevPrice24h": "0.03487",
              "price24hPcnt": "0.0006",
              "highPrice24h": "0.03491",
              "lowPrice24h": "0.03486",
              "turnover24h": "95629.8966922",
              "volume24h": "2740958.11"
            },
            {
              "symbol": "PYUSDUSDT",
              "bid1Price": "1",
              "bid1Size": "170997.56",
              "ask1Price": "1.0001",
              "ask1Size": "79.23",
              "lastPrice": "1",
              "prevPrice24h": "1.0001",
              "price24hPcnt": "-0.0001",
              "highPrice24h": "1.0006",
              "lowPrice24h": "1",
              "turnover24h": "169579.770582",
              "volume24h": "169555.48"
            },
            {
              "symbol": "IMXUSDT",
              "bid1Price": "0.482",
              "bid1Size": "2129.1",
              "ask1Price": "0.483",
              "ask1Size": "2845.21",
              "lastPrice": "0.483",
              "prevPrice24h": "0.468",
              "price24hPcnt": "0.0321",
              "highPrice24h": "0.489",
              "lowPrice24h": "0.458",
              "turnover24h": "493636.82812",
              "volume24h": "1039049.06",
              "usdIndexPrice": "0.482544"
            },
            {
              "symbol": "PINEYEUSDT",
              "bid1Price": "0.0000876",
              "bid1Size": "81360.3",
              "ask1Price": "0.0000918",
              "ask1Size": "341727.1",
              "lastPrice": "0.0000876",
              "prevPrice24h": "0.0000902",
              "price24hPcnt": "-0.0288",
              "highPrice24h": "0.000096",
              "lowPrice24h": "0.0000823",
              "turnover24h": "3308.24892221",
              "volume24h": "36937374.8"
            },
            {
              "symbol": "FIDAUSDT",
              "bid1Price": "0.0726",
              "bid1Size": "13105.2",
              "ask1Price": "0.0728",
              "ask1Size": "9252.58",
              "lastPrice": "0.0727",
              "prevPrice24h": "0.0737",
              "price24hPcnt": "-0.0136",
              "highPrice24h": "0.0757",
              "lowPrice24h": "0.0663",
              "turnover24h": "306726.503393",
              "volume24h": "4348261.19",
              "usdIndexPrice": "0.0726847"
            },
            {
              "symbol": "RATSUSDT",
              "bid1Price": "0.00002883",
              "bid1Size": "28286680.16",
              "ask1Price": "0.00002887",
              "ask1Size": "1171227.56",
              "lastPrice": "0.00002886",
              "prevPrice24h": "0.00002716",
              "price24hPcnt": "0.0626",
              "highPrice24h": "0.0000309",
              "lowPrice24h": "0.00002693",
              "turnover24h": "257906.5651398663",
              "volume24h": "9084239575.08"
            },
            {
              "symbol": "ANKRUSDT",
              "bid1Price": "0.01833",
              "bid1Size": "8592.2",
              "ask1Price": "0.01835",
              "ask1Size": "24571",
              "lastPrice": "0.01834",
              "prevPrice24h": "0.01886",
              "price24hPcnt": "-0.0276",
              "highPrice24h": "0.01891",
              "lowPrice24h": "0.01828",
              "turnover24h": "146742.092621",
              "volume24h": "7858472.2",
              "usdIndexPrice": "0.0183572"
            },
            {
              "symbol": "REALUSDT",
              "bid1Price": "0.00691",
              "bid1Size": "2270.37",
              "ask1Price": "0.00695",
              "ask1Size": "25106.8",
              "lastPrice": "0.00692",
              "prevPrice24h": "0.00695",
              "price24hPcnt": "-0.0043",
              "highPrice24h": "0.00717",
              "lowPrice24h": "0.00667",
              "turnover24h": "12243.6219713",
              "volume24h": "1765169.64"
            },
            {
              "symbol": "AVAILUSDT",
              "bid1Price": "0.02812",
              "bid1Size": "156",
              "ask1Price": "0.02814",
              "ask1Size": "7645.9",
              "lastPrice": "0.02814",
              "prevPrice24h": "0.02854",
              "price24hPcnt": "-0.0140",
              "highPrice24h": "0.02885",
              "lowPrice24h": "0.02792",
              "turnover24h": "190538.639547",
              "volume24h": "6708015.8"
            },
            {
              "symbol": "MNRYUSDT",
              "bid1Price": "0.00624",
              "bid1Size": "2594.24",
              "ask1Price": "0.00627",
              "ask1Size": "7490.63",
              "lastPrice": "0.00624",
              "prevPrice24h": "0.00626",
              "price24hPcnt": "-0.0032",
              "highPrice24h": "0.0068",
              "lowPrice24h": "0.00577",
              "turnover24h": "223830.2938844",
              "volume24h": "35709617.52"
            },
            {
              "symbol": "SCAUSDT",
              "bid1Price": "0.08555",
              "bid1Size": "493.8",
              "ask1Price": "0.0857",
              "ask1Size": "58.38",
              "lastPrice": "0.08551",
              "prevPrice24h": "0.08202",
              "price24hPcnt": "0.0426",
              "highPrice24h": "0.08746",
              "lowPrice24h": "0.08131",
              "turnover24h": "129871.3392237",
              "volume24h": "1528553.71"
            },
            {
              "symbol": "TAIUSDT",
              "bid1Price": "0.04125",
              "bid1Size": "494.23",
              "ask1Price": "0.04134",
              "ask1Size": "4155.03",
              "lastPrice": "0.04131",
              "prevPrice24h": "0.0253",
              "price24hPcnt": "0.6328",
              "highPrice24h": "0.04825",
              "lowPrice24h": "0.02527",
              "turnover24h": "4684446.8358657",
              "volume24h": "131479370.75"
            },
            {
              "symbol": "NAVXUSDT",
              "bid1Price": "0.04011",
              "bid1Size": "6539.56",
              "ask1Price": "0.04024",
              "ask1Size": "197.24",
              "lastPrice": "0.04011",
              "prevPrice24h": "0.03917",
              "price24hPcnt": "0.0240",
              "highPrice24h": "0.04149",
              "lowPrice24h": "0.03889",
              "turnover24h": "72092.5215928",
              "volume24h": "1787141.77"
            },
            {
              "symbol": "SUNUSDT",
              "bid1Price": "0.016678",
              "bid1Size": "6836.3",
              "ask1Price": "0.016708",
              "ask1Size": "13975.69",
              "lastPrice": "0.016694",
              "prevPrice24h": "0.016573",
              "price24hPcnt": "0.0073",
              "highPrice24h": "0.016854",
              "lowPrice24h": "0.016543",
              "turnover24h": "106614.56201426",
              "volume24h": "6400916.98"
            },
            {
              "symbol": "LDOUSDC",
              "bid1Price": "0.707",
              "bid1Size": "715.24",
              "ask1Price": "0.708",
              "ask1Size": "322.49",
              "lastPrice": "0.71",
              "prevPrice24h": "0.698",
              "price24hPcnt": "0.0172",
              "highPrice24h": "0.725",
              "lowPrice24h": "0.693",
              "turnover24h": "5728.2986",
              "volume24h": "8060.01",
              "usdIndexPrice": "0.707804"
            },
            {
              "symbol": "XRPEUR",
              "bid1Price": "1.812",
              "bid1Size": "58.18",
              "ask1Price": "1.8147",
              "ask1Size": "110.73",
              "lastPrice": "1.82",
              "prevPrice24h": "1.8311",
              "price24hPcnt": "-0.0061",
              "highPrice24h": "1.8409",
              "lowPrice24h": "1.814",
              "turnover24h": "7040.786722",
              "volume24h": "3854.24"
            },
            {
              "symbol": "DOGEUSDT",
              "bid1Price": "0.15651",
              "bid1Size": "4320",
              "ask1Price": "0.15652",
              "ask1Size": "4128.4",
              "lastPrice": "0.15652",
              "prevPrice24h": "0.15866",
              "price24hPcnt": "-0.0135",
              "highPrice24h": "0.15955",
              "lowPrice24h": "0.1563",
              "turnover24h": "9457426.067309",
              "volume24h": "59911617.8",
              "usdIndexPrice": "0.156437"
            },
            {
              "symbol": "TIMEUSDT",
              "bid1Price": "11.799",
              "bid1Size": "0.59",
              "ask1Price": "11.823",
              "ask1Size": "1.83",
              "lastPrice": "11.835",
              "prevPrice24h": "11.775",
              "price24hPcnt": "0.0051",
              "highPrice24h": "12.284",
              "lowPrice24h": "11.656",
              "turnover24h": "35595.57979",
              "volume24h": "2983.32"
            },
            {
              "symbol": "KCALUSDT",
              "bid1Price": "0.01155",
              "bid1Size": "45011.62",
              "ask1Price": "0.0116",
              "ask1Size": "50877.5",
              "lastPrice": "0.0116",
              "prevPrice24h": "0.01244",
              "price24hPcnt": "-0.0675",
              "highPrice24h": "0.01352",
              "lowPrice24h": "0.0116",
              "turnover24h": "119261.0036249",
              "volume24h": "9571883.81"
            },
            {
              "symbol": "ACHUSDT",
              "bid1Price": "0.02479",
              "bid1Size": "9000",
              "ask1Price": "0.0248",
              "ask1Size": "9000",
              "lastPrice": "0.02479",
              "prevPrice24h": "0.02497",
              "price24hPcnt": "-0.0072",
              "highPrice24h": "0.0256",
              "lowPrice24h": "0.02415",
              "turnover24h": "604165.063669",
              "volume24h": "24425006.4",
              "usdIndexPrice": "0.0247756"
            },
            {
              "symbol": "NLKUSDT",
              "bid1Price": "0.003025",
              "bid1Size": "17701.19",
              "ask1Price": "0.003056",
              "ask1Size": "3224.18",
              "lastPrice": "0.003047",
              "prevPrice24h": "0.003034",
              "price24hPcnt": "0.0043",
              "highPrice24h": "0.003119",
              "lowPrice24h": "0.003022",
              "turnover24h": "26425.71191548",
              "volume24h": "8638609.77"
            },
            {
              "symbol": "DOMEUSDT",
              "bid1Price": "0.0001312",
              "bid1Size": "438085.89",
              "ask1Price": "0.0001316",
              "ask1Size": "310587.76",
              "lastPrice": "0.0001312",
              "prevPrice24h": "0.0001312",
              "price24hPcnt": "0",
              "highPrice24h": "0.0001336",
              "lowPrice24h": "0.000129",
              "turnover24h": "51638.307141193",
              "volume24h": "393735282.61"
            },
            {
              "symbol": "SFUNDUSDT",
              "bid1Price": "0.501",
              "bid1Size": "32.91",
              "ask1Price": "0.5013",
              "ask1Size": "238.5",
              "lastPrice": "0.5014",
              "prevPrice24h": "0.5029",
              "price24hPcnt": "-0.0030",
              "highPrice24h": "0.5173",
              "lowPrice24h": "0.5001",
              "turnover24h": "36524.844633",
              "volume24h": "72124.23"
            },
            {
              "symbol": "OASUSDT",
              "bid1Price": "0.015073",
              "bid1Size": "117.53",
              "ask1Price": "0.015081",
              "ask1Size": "341.3",
              "lastPrice": "0.015073",
              "prevPrice24h": "0.014721",
              "price24hPcnt": "0.0239",
              "highPrice24h": "0.015329",
              "lowPrice24h": "0.01457",
              "turnover24h": "163304.00384905",
              "volume24h": "11012758.99"
            },
            {
              "symbol": "MEMEUSDT",
              "bid1Price": "0.002152",
              "bid1Size": "2429.86",
              "ask1Price": "0.002155",
              "ask1Size": "6815.98",
              "lastPrice": "0.002156",
              "prevPrice24h": "0.002141",
              "price24hPcnt": "0.0070",
              "highPrice24h": "0.002793",
              "lowPrice24h": "0.00202",
              "turnover24h": "3302340.9107373",
              "volume24h": "1446133433.24",
              "usdIndexPrice": "0.00214401"
            },
            {
              "symbol": "DOGSUSDT",
              "bid1Price": "0.000118",
              "bid1Size": "7312560",
              "ask1Price": "0.0001182",
              "ask1Size": "26879168",
              "lastPrice": "0.0001181",
              "prevPrice24h": "0.0001144",
              "price24hPcnt": "0.0323",
              "highPrice24h": "0.0001226",
              "lowPrice24h": "0.0001118",
              "turnover24h": "416631.4625222",
              "volume24h": "3553971242",
              "usdIndexPrice": "0.000118065"
            },
            {
              "symbol": "AGIUSDT",
              "bid1Price": "0.05307",
              "bid1Size": "5120.1",
              "ask1Price": "0.05311",
              "ask1Size": "5120.1",
              "lastPrice": "0.05307",
              "prevPrice24h": "0.05473",
              "price24hPcnt": "-0.0303",
              "highPrice24h": "0.05493",
              "lowPrice24h": "0.05295",
              "turnover24h": "342645.9832641",
              "volume24h": "6311043.3"
            },
            {
              "symbol": "VICUSDT",
              "bid1Price": "0.2048",
              "bid1Size": "2350.73",
              "ask1Price": "0.2052",
              "ask1Size": "477.6",
              "lastPrice": "0.2048",
              "prevPrice24h": "0.1997",
              "price24hPcnt": "0.0255",
              "highPrice24h": "0.2137",
              "lowPrice24h": "0.1991",
              "turnover24h": "67129.068759",
              "volume24h": "326228.58"
            },
            {
              "symbol": "DMAILUSDT",
              "bid1Price": "0.0776",
              "bid1Size": "205.48",
              "ask1Price": "0.078",
              "ask1Size": "205.48",
              "lastPrice": "0.0776",
              "prevPrice24h": "0.075",
              "price24hPcnt": "0.0347",
              "highPrice24h": "0.1057",
              "lowPrice24h": "0.0747",
              "turnover24h": "198677.557162",
              "volume24h": "2381028.27"
            },
            {
              "symbol": "ICPUSDC",
              "bid1Price": "4.83",
              "bid1Size": "47.34",
              "ask1Price": "4.842",
              "ask1Size": "47.14",
              "lastPrice": "4.875",
              "prevPrice24h": "4.868",
              "price24hPcnt": "0.0014",
              "highPrice24h": "4.955",
              "lowPrice24h": "4.803",
              "turnover24h": "5104.71464",
              "volume24h": "1053.07",
              "usdIndexPrice": "4.833991"
            },
            {
              "symbol": "QTUMUSDT",
              "bid1Price": "2.1022",
              "bid1Size": "584.032",
              "ask1Price": "2.1079",
              "ask1Size": "59.387",
              "lastPrice": "2.1048",
              "prevPrice24h": "2.1318",
              "price24hPcnt": "-0.0127",
              "highPrice24h": "2.1629",
              "lowPrice24h": "2.0956",
              "turnover24h": "39863.0089018",
              "volume24h": "18756.505"
            },
            {
              "symbol": "LINKUSDC",
              "bid1Price": "13.09",
              "bid1Size": "143.977",
              "ask1Price": "13.1",
              "ask1Size": "15.696",
              "lastPrice": "13.09",
              "prevPrice24h": "12.88",
              "price24hPcnt": "0.0163",
              "highPrice24h": "13.14",
              "lowPrice24h": "12.71",
              "turnover24h": "74588.76833",
              "volume24h": "5760.014",
              "usdIndexPrice": "13.089425"
            },
            {
              "symbol": "BLASTUSDT",
              "bid1Price": "0.003046",
              "bid1Size": "81000",
              "ask1Price": "0.003048",
              "ask1Size": "84639.14",
              "lastPrice": "0.003048",
              "prevPrice24h": "0.003073",
              "price24hPcnt": "-0.0081",
              "highPrice24h": "0.00323",
              "lowPrice24h": "0.00303",
              "turnover24h": "1789258.48568044",
              "volume24h": "576973717.61",
              "usdIndexPrice": "0.00304917"
            },
            {
              "symbol": "MEEUSDT",
              "bid1Price": "0.003383",
              "bid1Size": "6059.5",
              "ask1Price": "0.003389",
              "ask1Size": "3529.26",
              "lastPrice": "0.003383",
              "prevPrice24h": "0.003398",
              "price24hPcnt": "-0.0044",
              "highPrice24h": "0.003461",
              "lowPrice24h": "0.003322",
              "turnover24h": "46413.20158525",
              "volume24h": "13708878.92"
            },
            {
              "symbol": "C98USDT",
              "bid1Price": "0.05442",
              "bid1Size": "2250",
              "ask1Price": "0.05443",
              "ask1Size": "2250",
              "lastPrice": "0.05445",
              "prevPrice24h": "0.05598",
              "price24hPcnt": "-0.0273",
              "highPrice24h": "0.05746",
              "lowPrice24h": "0.05434",
              "turnover24h": "763822.0634907",
              "volume24h": "13607552.29",
              "usdIndexPrice": "0.0544821"
            },
            {
              "symbol": "SANDBTC",
              "bid1Price": "0.0000031",
              "bid1Size": "746",
              "ask1Price": "0.00000314",
              "ask1Size": "16.6",
              "lastPrice": "0.00000311",
              "prevPrice24h": "0.00000312",
              "price24hPcnt": "-0.0032",
              "highPrice24h": "0.00000328",
              "lowPrice24h": "0.00000305",
              "turnover24h": "2.780486631",
              "volume24h": "885965.3"
            },
            {
              "symbol": "AEGUSDT",
              "bid1Price": "0.00236",
              "bid1Size": "549.56",
              "ask1Price": "0.002375",
              "ask1Size": "84210.52",
              "lastPrice": "0.002378",
              "prevPrice24h": "0.002132",
              "price24hPcnt": "0.1154",
              "highPrice24h": "0.002486",
              "lowPrice24h": "0.002102",
              "turnover24h": "26953.47813092",
              "volume24h": "12038961.51"
            },
            {
              "symbol": "ULTIUSDT",
              "bid1Price": "0.003165",
              "bid1Size": "63653.72",
              "ask1Price": "0.003171",
              "ask1Size": "63653.72",
              "lastPrice": "0.003172",
              "prevPrice24h": "0.003131",
              "price24hPcnt": "0.0131",
              "highPrice24h": "0.003251",
              "lowPrice24h": "0.003109",
              "turnover24h": "16697.6371757",
              "volume24h": "5267404.53"
            },
            {
              "symbol": "RPLUSDT",
              "bid1Price": "4.221",
              "bid1Size": "188.53",
              "ask1Price": "4.237",
              "ask1Size": "60.13",
              "lastPrice": "4.233",
              "prevPrice24h": "4.042",
              "price24hPcnt": "0.0473",
              "highPrice24h": "4.479",
              "lowPrice24h": "3.978",
              "turnover24h": "129786.66033",
              "volume24h": "30919.11"
            },
            {
              "symbol": "GLMRUSDT",
              "bid1Price": "0.0695",
              "bid1Size": "4279.42",
              "ask1Price": "0.06957",
              "ask1Size": "1607.81",
              "lastPrice": "0.0696",
              "prevPrice24h": "0.06738",
              "price24hPcnt": "0.0329",
              "highPrice24h": "0.0735",
              "lowPrice24h": "0.0668",
              "turnover24h": "111926.9767378",
              "volume24h": "1614877.01"
            },
            {
              "symbol": "ZEROUSDT",
              "bid1Price": "0.0000804",
              "bid1Size": "614985.99",
              "ask1Price": "0.000081",
              "ask1Size": "500000",
              "lastPrice": "0.0000804",
              "prevPrice24h": "0.000081",
              "price24hPcnt": "-0.0074",
              "highPrice24h": "0.0000819",
              "lowPrice24h": "0.0000796",
              "turnover24h": "12348.852231406",
              "volume24h": "153178696.83"
            },
            {
              "symbol": "FORTUSDT",
              "bid1Price": "0.07133",
              "bid1Size": "65",
              "ask1Price": "0.07134",
              "ask1Size": "105.14",
              "lastPrice": "0.07131",
              "prevPrice24h": "0.07168",
              "price24hPcnt": "-0.0052",
              "highPrice24h": "0.07256",
              "lowPrice24h": "0.07056",
              "turnover24h": "5512.2689673",
              "volume24h": "77075.41"
            },
            {
              "symbol": "ALGOUSDT",
              "bid1Price": "0.1915",
              "bid1Size": "1000505.2",
              "ask1Price": "0.1916",
              "ask1Size": "48233.88",
              "lastPrice": "0.1915",
              "prevPrice24h": "0.1927",
              "price24hPcnt": "-0.0062",
              "highPrice24h": "0.1945",
              "lowPrice24h": "0.1895",
              "turnover24h": "2295692.1066082",
              "volume24h": "11937698.24",
              "usdIndexPrice": "0.1914"
            },
            {
              "symbol": "DYMUSDT",
              "bid1Price": "0.2845",
              "bid1Size": "855",
              "ask1Price": "0.2847",
              "ask1Size": "986.72",
              "lastPrice": "0.2848",
              "prevPrice24h": "0.2795",
              "price24hPcnt": "0.0190",
              "highPrice24h": "0.2956",
              "lowPrice24h": "0.2759",
              "turnover24h": "315047.072909",
              "volume24h": "1096465.03",
              "usdIndexPrice": "0.284545"
            },
            {
              "symbol": "USDDUSDT",
              "bid1Price": "1.0004",
              "bid1Size": "7418.21",
              "ask1Price": "1.0009",
              "ask1Size": "81.05",
              "lastPrice": "1.0009",
              "prevPrice24h": "1.0004",
              "price24hPcnt": "0.0005",
              "highPrice24h": "1.0009",
              "lowPrice24h": "1.0004",
              "turnover24h": "84.032765",
              "volume24h": "83.98",
              "usdIndexPrice": "1.00089"
            },
            {
              "symbol": "HTXUSDT",
              "bid1Price": "0.000001667",
              "bid1Size": "277860843.27",
              "ask1Price": "0.000001668",
              "ask1Size": "263330859.1",
              "lastPrice": "0.000001669",
              "prevPrice24h": "0.000001656",
              "price24hPcnt": "0.0079",
              "highPrice24h": "0.000001681",
              "lowPrice24h": "0.000001655",
              "turnover24h": "14829.24585779548",
              "volume24h": "8875538251.48"
            },
            {
              "symbol": "RSS3USDT",
              "bid1Price": "0.05204",
              "bid1Size": "5301.53",
              "ask1Price": "0.05224",
              "ask1Size": "1963.82",
              "lastPrice": "0.05206",
              "prevPrice24h": "0.05476",
              "price24hPcnt": "-0.0493",
              "highPrice24h": "0.05893",
              "lowPrice24h": "0.05085",
              "turnover24h": "159813.4437287",
              "volume24h": "2977397.72"
            },
            {
              "symbol": "MNTBTC",
              "bid1Price": "0.00000784",
              "bid1Size": "0.01",
              "ask1Price": "0.00000788",
              "ask1Size": "8.49",
              "lastPrice": "0.00000784",
              "prevPrice24h": "0.00000768",
              "price24hPcnt": "0.0208",
              "highPrice24h": "0.00000794",
              "lowPrice24h": "0.00000768",
              "turnover24h": "0.0681744508",
              "volume24h": "8731.82"
            },
            {
              "symbol": "CAKEUSDT",
              "bid1Price": "1.955",
              "bid1Size": "45.344",
              "ask1Price": "1.956",
              "ask1Size": "37.4",
              "lastPrice": "1.956",
              "prevPrice24h": "1.9",
              "price24hPcnt": "0.0295",
              "highPrice24h": "2.008",
              "lowPrice24h": "1.88",
              "turnover24h": "1311591.166027",
              "volume24h": "674411.285",
              "usdIndexPrice": "1.954826"
            },
            {
              "symbol": "GALAXISUSDT",
              "bid1Price": "0.0004597",
              "bid1Size": "21753.31",
              "ask1Price": "0.0004663",
              "ask1Size": "54225.72",
              "lastPrice": "0.0004663",
              "prevPrice24h": "0.0004512",
              "price24hPcnt": "0.0335",
              "highPrice24h": "0.0005466",
              "lowPrice24h": "0.0004453",
              "turnover24h": "182352.01931067",
              "volume24h": "377017293.39"
            },
            {
              "symbol": "BTCUSDE",
              "bid1Price": "84692.9",
              "bid1Size": "0.023634",
              "ask1Price": "84727.2",
              "ask1Size": "0.472697",
              "lastPrice": "84681.3",
              "prevPrice24h": "85333.3",
              "price24hPcnt": "-0.0076",
              "highPrice24h": "85679.8",
              "lowPrice24h": "84681.3",
              "turnover24h": "88041.27904742",
              "volume24h": "1.034001"
            },
            {
              "symbol": "ROOTUSDT",
              "bid1Price": "0.005738",
              "bid1Size": "69404.42",
              "ask1Price": "0.005739",
              "ask1Size": "8712.31",
              "lastPrice": "0.005738",
              "prevPrice24h": "0.006142",
              "price24hPcnt": "-0.0658",
              "highPrice24h": "0.006638",
              "lowPrice24h": "0.005415",
              "turnover24h": "187767.17559248",
              "volume24h": "31748466.12"
            },
            {
              "symbol": "SATSUSDT",
              "bid1Price": "0.00000003854",
              "bid1Size": "4998750312.4",
              "ask1Price": "0.00000003857",
              "ask1Size": "13679805846.4",
              "lastPrice": "0.00000003859",
              "prevPrice24h": "0.00000003793",
              "price24hPcnt": "0.0174",
              "highPrice24h": "0.00000004134",
              "lowPrice24h": "0.00000003771",
              "turnover24h": "665570.462357816985",
              "volume24h": "17216750058255.6",
              "usdIndexPrice": "0.000000038595"
            },
            {
              "symbol": "LUNAIUSDT",
              "bid1Price": "0.0089",
              "bid1Size": "80000",
              "ask1Price": "0.00892",
              "ask1Size": "12431.8",
              "lastPrice": "0.0089",
              "prevPrice24h": "0.00923",
              "price24hPcnt": "-0.0358",
              "highPrice24h": "0.00955",
              "lowPrice24h": "0.00888",
              "turnover24h": "77885.653818",
              "volume24h": "8416172"
            },
            {
              "symbol": "ZKUSDC",
              "bid1Price": "0.0499",
              "bid1Size": "8798.65",
              "ask1Price": "0.05",
              "ask1Size": "28525.64",
              "lastPrice": "0.05",
              "prevPrice24h": "0.0486",
              "price24hPcnt": "0.0288",
              "highPrice24h": "0.0518",
              "lowPrice24h": "0.0485",
              "turnover24h": "23620.425272",
              "volume24h": "472251.91",
              "usdIndexPrice": "0.0499749"
            },
            {
              "symbol": "DOGEEUR",
              "bid1Price": "0.13736",
              "bid1Size": "1460.83",
              "ask1Price": "0.13755",
              "ask1Size": "1000",
              "lastPrice": "0.1376",
              "prevPrice24h": "0.13929",
              "price24hPcnt": "-0.0121",
              "highPrice24h": "0.13953",
              "lowPrice24h": "0.1376",
              "turnover24h": "3451.9423174",
              "volume24h": "24888.83"
            },
            {
              "symbol": "FETUSDC",
              "bid1Price": "0.577",
              "bid1Size": "2927.59",
              "ask1Price": "0.579",
              "ask1Size": "2994.33",
              "lastPrice": "0.578",
              "prevPrice24h": "0.528",
              "price24hPcnt": "0.0947",
              "highPrice24h": "0.578",
              "lowPrice24h": "0.524",
              "turnover24h": "32962.02124",
              "volume24h": "59035.81"
            },
            {
              "symbol": "AVAUSDT",
              "bid1Price": "0.5856",
              "bid1Size": "397.89",
              "ask1Price": "0.5865",
              "ask1Size": "170.39",
              "lastPrice": "0.5866",
              "prevPrice24h": "0.5801",
              "price24hPcnt": "0.0112",
              "highPrice24h": "0.6187",
              "lowPrice24h": "0.5668",
              "turnover24h": "151107.43211",
              "volume24h": "256316.59"
            },
            {
              "symbol": "AKIUSDT",
              "bid1Price": "0.013236",
              "bid1Size": "1189.72",
              "ask1Price": "0.013237",
              "ask1Size": "1172.17",
              "lastPrice": "0.013238",
              "prevPrice24h": "0.01325",
              "price24hPcnt": "-0.0009",
              "highPrice24h": "0.013261",
              "lowPrice24h": "0.013234",
              "turnover24h": "3399.21490178",
              "volume24h": "256594.41"
            },
            {
              "symbol": "EOSUSDC",
              "bid1Price": "0.6289",
              "bid1Size": "41.93",
              "ask1Price": "0.6306",
              "ask1Size": "30.32",
              "lastPrice": "0.6301",
              "prevPrice24h": "0.6283",
              "price24hPcnt": "0.0029",
              "highPrice24h": "0.6475",
              "lowPrice24h": "0.6189",
              "turnover24h": "1896.989338",
              "volume24h": "2993.88",
              "usdIndexPrice": "0.629389"
            },
            {
              "symbol": "KMNOUSDT",
              "bid1Price": "0.05334",
              "bid1Size": "4799.41",
              "ask1Price": "0.05336",
              "ask1Size": "1874.09",
              "lastPrice": "0.05338",
              "prevPrice24h": "0.05228",
              "price24hPcnt": "0.0210",
              "highPrice24h": "0.05425",
              "lowPrice24h": "0.05116",
              "turnover24h": "507542.3088656",
              "volume24h": "9645092.38",
              "usdIndexPrice": "0.0533694"
            },
            {
              "symbol": "TAPUSDT",
              "bid1Price": "0.0004075",
              "bid1Size": "102306.51",
              "ask1Price": "0.0004088",
              "ask1Size": "25788.14",
              "lastPrice": "0.0004086",
              "prevPrice24h": "0.0004025",
              "price24hPcnt": "0.0152",
              "highPrice24h": "0.000409",
              "lowPrice24h": "0.0004004",
              "turnover24h": "22595.193634733",
              "volume24h": "56103526.57"
            },
            {
              "symbol": "CPOOLUSDT",
              "bid1Price": "0.12982",
              "bid1Size": "1504.63",
              "ask1Price": "0.13017",
              "ask1Size": "44.24",
              "lastPrice": "0.12997",
              "prevPrice24h": "0.12972",
              "price24hPcnt": "0.0019",
              "highPrice24h": "0.1378",
              "lowPrice24h": "0.12676",
              "turnover24h": "667661.8310336",
              "volume24h": "5040143.34"
            },
            {
              "symbol": "MAJORUSDT",
              "bid1Price": "0.1616",
              "bid1Size": "1993.9",
              "ask1Price": "0.162",
              "ask1Size": "13.4",
              "lastPrice": "0.1617",
              "prevPrice24h": "0.1266",
              "price24hPcnt": "0.2773",
              "highPrice24h": "0.17",
              "lowPrice24h": "0.1251",
              "turnover24h": "682881.29399",
              "volume24h": "4727333"
            },
            {
              "symbol": "BBSOLUSDC",
              "bid1Price": "149.78",
              "bid1Size": "3",
              "ask1Price": "150.28",
              "ask1Size": "0.103",
              "lastPrice": "149.79",
              "prevPrice24h": "148.8",
              "price24hPcnt": "0.0067",
              "highPrice24h": "152.34",
              "lowPrice24h": "148.8",
              "turnover24h": "13621.33463",
              "volume24h": "91.069",
              "usdIndexPrice": "149.538492"
            },
            {
              "symbol": "ODOSUSDT",
              "bid1Price": "0.006578",
              "bid1Size": "3966.5",
              "ask1Price": "0.0066",
              "ask1Size": "9168.1",
              "lastPrice": "0.006578",
              "prevPrice24h": "0.006368",
              "price24hPcnt": "0.0330",
              "highPrice24h": "0.00729",
              "lowPrice24h": "0.006338",
              "turnover24h": "232209.1711135",
              "volume24h": "35279828.4"
            },
            {
              "symbol": "ETH3LUSDT",
              "bid1Price": "0.0753",
              "bid1Size": "2000",
              "ask1Price": "0.0756",
              "ask1Size": "1847.0221",
              "lastPrice": "0.0754",
              "prevPrice24h": "0.0754",
              "price24hPcnt": "0",
              "highPrice24h": "0.08",
              "lowPrice24h": "0.0741",
              "turnover24h": "202678.26530305",
              "volume24h": "2664602.317"
            },
            {
              "symbol": "SHIBUSDC",
              "bid1Price": "0.00001229",
              "bid1Size": "238751401.4",
              "ask1Price": "0.0000123",
              "ask1Size": "25650000",
              "lastPrice": "0.0000123",
              "prevPrice24h": "0.00001222",
              "price24hPcnt": "0.0065",
              "highPrice24h": "0.00001247",
              "lowPrice24h": "0.00001212",
              "turnover24h": "109925.43585781676",
              "volume24h": "8950086382.8",
              "usdIndexPrice": "0.0000122937"
            },
            {
              "symbol": "FLOWUSDT",
              "bid1Price": "0.3689",
              "bid1Size": "1170",
              "ask1Price": "0.3691",
              "ask1Size": "585",
              "lastPrice": "0.3692",
              "prevPrice24h": "0.3706",
              "price24hPcnt": "-0.0038",
              "highPrice24h": "0.3745",
              "lowPrice24h": "0.3648",
              "turnover24h": "106308.178063",
              "volume24h": "288208.08",
              "usdIndexPrice": "0.369033"
            },
            {
              "symbol": "MINAUSDT",
              "bid1Price": "0.2153",
              "bid1Size": "1440",
              "ask1Price": "0.2154",
              "ask1Size": "4601.1",
              "lastPrice": "0.2152",
              "prevPrice24h": "0.2137",
              "price24hPcnt": "0.0070",
              "highPrice24h": "0.2206",
              "lowPrice24h": "0.2093",
              "turnover24h": "655392.55876",
              "volume24h": "3037791.13",
              "usdIndexPrice": "0.215233"
            },
            {
              "symbol": "VRAUSDT",
              "bid1Price": "0.001233",
              "bid1Size": "175500",
              "ask1Price": "0.001235",
              "ask1Size": "175500",
              "lastPrice": "0.001228",
              "prevPrice24h": "0.001259",
              "price24hPcnt": "-0.0246",
              "highPrice24h": "0.001315",
              "lowPrice24h": "0.00121",
              "turnover24h": "321511.86827808",
              "volume24h": "255408660.69"
            },
            {
              "symbol": "ETHTRY",
              "bid1Price": "60469",
              "bid1Size": "10.28",
              "ask1Price": "60674",
              "ask1Size": "15.6915",
              "lastPrice": "60774",
              "prevPrice24h": "60774",
              "price24hPcnt": "0",
              "highPrice24h": "60774",
              "lowPrice24h": "60774",
              "turnover24h": "0",
              "volume24h": "0"
            },
            {
              "symbol": "ZENUSDT",
              "bid1Price": "8.74",
              "bid1Size": "325.372",
              "ask1Price": "8.75",
              "ask1Size": "19.575",
              "lastPrice": "8.74",
              "prevPrice24h": "8.64",
              "price24hPcnt": "0.0116",
              "highPrice24h": "9.17",
              "lowPrice24h": "8.59",
              "turnover24h": "599280.72117",
              "volume24h": "68397.009",
              "usdIndexPrice": "8.743748"
            },
            {
              "symbol": "PENGUUSDT",
              "bid1Price": "0.00488",
              "bid1Size": "1355338",
              "ask1Price": "0.00489",
              "ask1Size": "266995",
              "lastPrice": "0.00489",
              "prevPrice24h": "0.0048",
              "price24hPcnt": "0.0188",
              "highPrice24h": "0.00511",
              "lowPrice24h": "0.00474",
              "turnover24h": "1398532.3094",
              "volume24h": "287071931",
              "usdIndexPrice": "0.00488729"
            },
            {
              "symbol": "ONEUSDT",
              "bid1Price": "0.01116",
              "bid1Size": "21150",
              "ask1Price": "0.01117",
              "ask1Size": "10575",
              "lastPrice": "0.01117",
              "prevPrice24h": "0.01098",
              "price24hPcnt": "0.0173",
              "highPrice24h": "0.0116",
              "lowPrice24h": "0.01087",
              "turnover24h": "84076.4614123",
              "volume24h": "7481617.25",
              "usdIndexPrice": "0.0111588"
            },
            {
              "symbol": "ALCHUSDT",
              "bid1Price": "0.1485",
              "bid1Size": "113.27",
              "ask1Price": "0.14859",
              "ask1Size": "199.45",
              "lastPrice": "0.14865",
              "prevPrice24h": "0.13885",
              "price24hPcnt": "0.0706",
              "highPrice24h": "0.16374",
              "lowPrice24h": "0.1379",
              "turnover24h": "6571888.336025",
              "volume24h": "44261216.3",
              "usdIndexPrice": "0.148592"
            },
            {
              "symbol": "ZEREBROUSDT",
              "bid1Price": "0.0202",
              "bid1Size": "114664.6",
              "ask1Price": "0.0203",
              "ask1Size": "147242.2",
              "lastPrice": "0.0203",
              "prevPrice24h": "0.0198",
              "price24hPcnt": "0.0253",
              "highPrice24h": "0.0223",
              "lowPrice24h": "0.0187",
              "turnover24h": "590510.81394",
              "volume24h": "28753688.4"
            },
            {
              "symbol": "FILUSDC",
              "bid1Price": "2.615",
              "bid1Size": "16.83",
              "ask1Price": "2.618",
              "ask1Size": "236.3",
              "lastPrice": "2.634",
              "prevPrice24h": "2.517",
              "price24hPcnt": "0.0465",
              "highPrice24h": "2.659",
              "lowPrice24h": "2.491",
              "turnover24h": "12558.03096",
              "volume24h": "4824.8",
              "usdIndexPrice": "2.61411"
            },
            {
              "symbol": "ERTHAUSDT",
              "bid1Price": "0.0004874",
              "bid1Size": "280796.28",
              "ask1Price": "0.0004892",
              "ask1Size": "18890.15",
              "lastPrice": "0.0004887",
              "prevPrice24h": "0.0004877",
              "price24hPcnt": "0.0021",
              "highPrice24h": "0.0005239",
              "lowPrice24h": "0.0004816",
              "turnover24h": "13989.604972503",
              "volume24h": "28226135.3"
            },
            {
              "symbol": "ELDAUSDT",
              "bid1Price": "0.001704",
              "bid1Size": "16192.72",
              "ask1Price": "0.001731",
              "ask1Size": "90105.06",
              "lastPrice": "0.001705",
              "prevPrice24h": "0.001933",
              "price24hPcnt": "-0.1180",
              "highPrice24h": "0.00196",
              "lowPrice24h": "0.001531",
              "turnover24h": "35737.66209746",
              "volume24h": "21190550.51"
            },
            {
              "symbol": "ZROUSDC",
              "bid1Price": "2.487",
              "bid1Size": "301.05",
              "ask1Price": "2.49",
              "ask1Size": "8.04",
              "lastPrice": "2.488",
              "prevPrice24h": "2.453",
              "price24hPcnt": "0.0143",
              "highPrice24h": "2.606",
              "lowPrice24h": "2.4",
              "turnover24h": "50970.58757",
              "volume24h": "20464.15",
              "usdIndexPrice": "2.488162"
            },
            {
              "symbol": "FXSUSDT",
              "bid1Price": "1.839",
              "bid1Size": "45",
              "ask1Price": "1.84",
              "ask1Size": "72.6",
              "lastPrice": "1.838",
              "prevPrice24h": "1.759",
              "price24hPcnt": "0.0449",
              "highPrice24h": "1.871",
              "lowPrice24h": "1.742",
              "turnover24h": "179974.80951",
              "volume24h": "99452.79",
              "usdIndexPrice": "1.838676"
            },
            {
              "symbol": "COQUSDT",
              "bid1Price": "0.0000005894",
              "bid1Size": "80196665",
              "ask1Price": "0.0000005898",
              "ask1Size": "78535015.9",
              "lastPrice": "0.0000005895",
              "prevPrice24h": "0.0000006073",
              "price24hPcnt": "-0.0293",
              "highPrice24h": "0.0000006168",
              "lowPrice24h": "0.0000005813",
              "turnover24h": "93629.35834093792",
              "volume24h": "155681975104.8"
            },
            {
              "symbol": "XARUSDT",
              "bid1Price": "0.008504",
              "bid1Size": "1322.42",
              "ask1Price": "0.008514",
              "ask1Size": "14193.98",
              "lastPrice": "0.008506",
              "prevPrice24h": "0.008453",
              "price24hPcnt": "0.0063",
              "highPrice24h": "0.008719",
              "lowPrice24h": "0.00836",
              "turnover24h": "28944.95315108",
              "volume24h": "3397192.54"
            },
            {
              "symbol": "JUPUSDT",
              "bid1Price": "0.3988",
              "bid1Size": "37.23",
              "ask1Price": "0.3989",
              "ask1Size": "5025.2",
              "lastPrice": "0.3988",
              "prevPrice24h": "0.3853",
              "price24hPcnt": "0.0350",
              "highPrice24h": "0.4089",
              "lowPrice24h": "0.3823",
              "turnover24h": "2896072.900414",
              "volume24h": "7324859.14",
              "usdIndexPrice": "0.398761"
            },
            {
              "symbol": "IPUSDT",
              "bid1Price": "3.726",
              "bid1Size": "27.72",
              "ask1Price": "3.73",
              "ask1Size": "1.36",
              "lastPrice": "3.728",
              "prevPrice24h": "3.883",
              "price24hPcnt": "-0.0399",
              "highPrice24h": "3.932",
              "lowPrice24h": "3.719",
              "turnover24h": "799027.65707",
              "volume24h": "206613.05",
              "usdIndexPrice": "3.728962"
            },
            {
              "symbol": "HPOS10IUSDT",
              "bid1Price": "0.0469",
              "bid1Size": "1688",
              "ask1Price": "0.0471",
              "ask1Size": "5322",
              "lastPrice": "0.0469",
              "prevPrice24h": "0.0458",
              "price24hPcnt": "0.0240",
              "highPrice24h": "0.0477",
              "lowPrice24h": "0.045",
              "turnover24h": "166758.0702",
              "volume24h": "3586692"
            },
            {
              "symbol": "MYROUSDT",
              "bid1Price": "0.01179",
              "bid1Size": "51714.36",
              "ask1Price": "0.01181",
              "ask1Size": "26268.12",
              "lastPrice": "0.01182",
              "prevPrice24h": "0.0114",
              "price24hPcnt": "0.0368",
              "highPrice24h": "0.01236",
              "lowPrice24h": "0.01103",
              "turnover24h": "595129.8154944",
              "volume24h": "51733881.97",
              "usdIndexPrice": "0.0118157"
            },
            {
              "symbol": "EXVGUSDT",
              "bid1Price": "0.00349",
              "bid1Size": "1110.8",
              "ask1Price": "0.003495",
              "ask1Size": "16301",
              "lastPrice": "0.00349",
              "prevPrice24h": "0.00343",
              "price24hPcnt": "0.0175",
              "highPrice24h": "0.003741",
              "lowPrice24h": "0.003384",
              "turnover24h": "52839.889986",
              "volume24h": "15003107.87"
            },
            {
              "symbol": "IZIUSDT",
              "bid1Price": "0.004672",
              "bid1Size": "3371.16",
              "ask1Price": "0.004674",
              "ask1Size": "3371.16",
              "lastPrice": "0.004673",
              "prevPrice24h": "0.004688",
              "price24hPcnt": "-0.0032",
              "highPrice24h": "0.004734",
              "lowPrice24h": "0.004665",
              "turnover24h": "101929.06092083",
              "volume24h": "21691185.48"
            },
            {
              "symbol": "ENAEUR",
              "bid1Price": "0.2468",
              "bid1Size": "1067",
              "ask1Price": "0.2473",
              "ask1Size": "2559",
              "lastPrice": "0.2493",
              "prevPrice24h": "0.2489",
              "price24hPcnt": "0.0016",
              "highPrice24h": "0.2493",
              "lowPrice24h": "0.2476",
              "turnover24h": "317.0329",
              "volume24h": "1277"
            },
            {
              "symbol": "EOSUSDT",
              "bid1Price": "0.6295",
              "bid1Size": "40.99",
              "ask1Price": "0.6296",
              "ask1Size": "165.74",
              "lastPrice": "0.6296",
              "prevPrice24h": "0.6203",
              "price24hPcnt": "0.0150",
              "highPrice24h": "0.6517",
              "lowPrice24h": "0.617",
              "turnover24h": "1489328.148313",
              "volume24h": "2354248.65",
              "usdIndexPrice": "0.629389"
            },
            {
              "symbol": "AFCUSDT",
              "bid1Price": "0.4854",
              "bid1Size": "137.46",
              "ask1Price": "0.486",
              "ask1Size": "72.62",
              "lastPrice": "0.4854",
              "prevPrice24h": "0.4881",
              "price24hPcnt": "-0.0055",
              "highPrice24h": "0.4941",
              "lowPrice24h": "0.4764",
              "turnover24h": "26100.060893",
              "volume24h": "53729.97"
            },
            {
              "symbol": "NEIROUSDT",
              "bid1Price": "0.01883",
              "bid1Size": "5998.12",
              "ask1Price": "0.01885",
              "ask1Size": "1928.24",
              "lastPrice": "0.01886",
              "prevPrice24h": "0.01827",
              "price24hPcnt": "0.0323",
              "highPrice24h": "0.02",
              "lowPrice24h": "0.01804",
              "turnover24h": "699611.6921651",
              "volume24h": "36469619.91",
              "usdIndexPrice": "0.0188518"
            },
            {
              "symbol": "APRSUSDT",
              "bid1Price": "0.01246",
              "bid1Size": "850.56",
              "ask1Price": "0.01248",
              "ask1Size": "945.06",
              "lastPrice": "0.01246",
              "prevPrice24h": "0.0132",
              "price24hPcnt": "-0.0561",
              "highPrice24h": "0.01323",
              "lowPrice24h": "0.01071",
              "turnover24h": "160373.0478989",
              "volume24h": "12968071.42"
            },
            {
              "symbol": "PERPUSDT",
              "bid1Price": "0.2299",
              "bid1Size": "652.5",
              "ask1Price": "0.2303",
              "ask1Size": "652.5",
              "lastPrice": "0.2302",
              "prevPrice24h": "0.1869",
              "price24hPcnt": "0.2317",
              "highPrice24h": "0.31",
              "lowPrice24h": "0.1862",
              "turnover24h": "848522.891973",
              "volume24h": "3830398.49",
              "usdIndexPrice": "0.229834"
            },
            {
              "symbol": "USDCEUR",
              "bid1Price": "0.878",
              "bid1Size": "1.14",
              "ask1Price": "0.8788",
              "ask1Size": "100",
              "lastPrice": "0.8784",
              "prevPrice24h": "0.8777",
              "price24hPcnt": "0.0008",
              "highPrice24h": "0.8794",
              "lowPrice24h": "0.8775",
              "turnover24h": "105052.754808",
              "volume24h": "119665.25"
            },
            {
              "symbol": "STARUSDT",
              "bid1Price": "0.006971",
              "bid1Size": "12482.78",
              "ask1Price": "0.006998",
              "ask1Size": "4279.03",
              "lastPrice": "0.006985",
              "prevPrice24h": "0.006997",
              "price24hPcnt": "-0.0017",
              "highPrice24h": "0.007064",
              "lowPrice24h": "0.006882",
              "turnover24h": "100888.33591737",
              "volume24h": "14408234.75"
            },
            {
              "symbol": "ELIXUSDT",
              "bid1Price": "0.006058",
              "bid1Size": "12173.9",
              "ask1Price": "0.006079",
              "ask1Size": "17045.26",
              "lastPrice": "0.006051",
              "prevPrice24h": "0.006063",
              "price24hPcnt": "-0.0020",
              "highPrice24h": "0.00621",
              "lowPrice24h": "0.005994",
              "turnover24h": "41005.05636259",
              "volume24h": "6719519.49"
            },
            {
              "symbol": "COOKIEUSDT",
              "bid1Price": "0.0932",
              "bid1Size": "15288.35",
              "ask1Price": "0.0934",
              "ask1Size": "2773.4",
              "lastPrice": "0.0932",
              "prevPrice24h": "0.0948",
              "price24hPcnt": "-0.0169",
              "highPrice24h": "0.1003",
              "lowPrice24h": "0.0931",
              "turnover24h": "1423302.435571",
              "volume24h": "14666342.75",
              "usdIndexPrice": "0.0932858"
            },
            {
              "symbol": "JASMYUSDC",
              "bid1Price": "0.01508",
              "bid1Size": "100",
              "ask1Price": "0.01509",
              "ask1Size": "15189.99",
              "lastPrice": "0.01507",
              "prevPrice24h": "0.01498",
              "price24hPcnt": "0.0060",
              "highPrice24h": "0.01577",
              "lowPrice24h": "0.01407",
              "turnover24h": "10732.1597371",
              "volume24h": "719679.23",
              "usdIndexPrice": "0.0150083"
            },
            {
              "symbol": "XLMUSDC",
              "bid1Price": "0.244",
              "bid1Size": "4329.1",
              "ask1Price": "0.2442",
              "ask1Size": "5067.8",
              "lastPrice": "0.2442",
              "prevPrice24h": "0.2471",
              "price24hPcnt": "-0.0117",
              "highPrice24h": "0.2494",
              "lowPrice24h": "0.2432",
              "turnover24h": "126123.92761",
              "volume24h": "512630.4",
              "usdIndexPrice": "0.24415"
            },
            {
              "symbol": "PEPEEUR",
              "bid1Price": "0.0000065",
              "bid1Size": "42514473",
              "ask1Price": "0.000006523",
              "ask1Size": "59152069",
              "lastPrice": "0.00000652",
              "prevPrice24h": "0.00000642",
              "price24hPcnt": "0.0156",
              "highPrice24h": "0.000006695",
              "lowPrice24h": "0.00000628",
              "turnover24h": "5150.172229772",
              "volume24h": "785170445"
            },
            {
              "symbol": "MONUSDT",
              "bid1Price": "0.02643",
              "bid1Size": "378.35",
              "ask1Price": "0.02644",
              "ask1Size": "509.85",
              "lastPrice": "0.02644",
              "prevPrice24h": "0.0252",
              "price24hPcnt": "0.0492",
              "highPrice24h": "0.02834",
              "lowPrice24h": "0.02395",
              "turnover24h": "443918.8147435",
              "volume24h": "17179353.46"
            },
            {
              "symbol": "SHRAPUSDT",
              "bid1Price": "0.005255",
              "bid1Size": "3809.52",
              "ask1Price": "0.005283",
              "ask1Size": "1659.44",
              "lastPrice": "0.005262",
              "prevPrice24h": "0.00507",
              "price24hPcnt": "0.0379",
              "highPrice24h": "0.0058",
              "lowPrice24h": "0.00506",
              "turnover24h": "28686.26254007",
              "volume24h": "5435282.14"
            },
            {
              "symbol": "PUMPUSDT",
              "bid1Price": "0.15634",
              "bid1Size": "1320.6",
              "ask1Price": "0.15656",
              "ask1Size": "3193.6",
              "lastPrice": "0.15647",
              "prevPrice24h": "0.1548",
              "price24hPcnt": "0.0108",
              "highPrice24h": "0.188",
              "lowPrice24h": "0.14702",
              "turnover24h": "5537968.651942",
              "volume24h": "34149559.1"
            },
            {
              "symbol": "ADAUSDT",
              "bid1Price": "0.623",
              "bid1Size": "6879.71",
              "ask1Price": "0.6231",
              "ask1Size": "2919.28",
              "lastPrice": "0.6231",
              "prevPrice24h": "0.6311",
              "price24hPcnt": "-0.0127",
              "highPrice24h": "0.6348",
              "lowPrice24h": "0.6191",
              "turnover24h": "8721761.418481",
              "volume24h": "13877935.15",
              "usdIndexPrice": "0.62292"
            },
            {
              "symbol": "AGLDUSDT",
              "bid1Price": "0.8568",
              "bid1Size": "292.5",
              "ask1Price": "0.8575",
              "ask1Size": "1101.36",
              "lastPrice": "0.8565",
              "prevPrice24h": "0.8647",
              "price24hPcnt": "-0.0095",
              "highPrice24h": "0.8954",
              "lowPrice24h": "0.8443",
              "turnover24h": "516239.786062",
              "volume24h": "597616.37",
              "usdIndexPrice": "0.856879"
            },
            {
              "symbol": "COTUSDT",
              "bid1Price": "0.003533",
              "bid1Size": "3608.67",
              "ask1Price": "0.003537",
              "ask1Size": "2754",
              "lastPrice": "0.003535",
              "prevPrice24h": "0.003614",
              "price24hPcnt": "-0.0219",
              "highPrice24h": "0.003632",
              "lowPrice24h": "0.003502",
              "turnover24h": "4061.24454553",
              "volume24h": "1136815.42"
            },
            {
              "symbol": "NIBIUSDT",
              "bid1Price": "0.01683",
              "bid1Size": "927.1",
              "ask1Price": "0.01685",
              "ask1Size": "296.38",
              "lastPrice": "0.01682",
              "prevPrice24h": "0.01703",
              "price24hPcnt": "-0.0123",
              "highPrice24h": "0.01764",
              "lowPrice24h": "0.0165",
              "turnover24h": "23087.7743351",
              "volume24h": "1359967.3"
            },
            {
              "symbol": "ZKJUSDT",
              "bid1Price": "2.2108",
              "bid1Size": "205.18",
              "ask1Price": "2.2109",
              "ask1Size": "75.28",
              "lastPrice": "2.2109",
              "prevPrice24h": "2.1988",
              "price24hPcnt": "0.0055",
              "highPrice24h": "2.2275",
              "lowPrice24h": "2.1829",
              "turnover24h": "4185618.077833",
              "volume24h": "1903823.04"
            },
            {
              "symbol": "GMXUSDT",
              "bid1Price": "15.16",
              "bid1Size": "12.62",
              "ask1Price": "15.18",
              "ask1Size": "47.92",
              "lastPrice": "15.2",
              "prevPrice24h": "15.55",
              "price24hPcnt": "-0.0225",
              "highPrice24h": "15.68",
              "lowPrice24h": "15.16",
              "turnover24h": "75232.5463",
              "volume24h": "4869.47",
              "usdIndexPrice": "15.184641"
            },
            {
              "symbol": "FLOKIUSDC",
              "bid1Price": "0.0000572",
              "bid1Size": "22362",
              "ask1Price": "0.00005742",
              "ask1Size": "3978268",
              "lastPrice": "0.0000573",
              "prevPrice24h": "0.00005684",
              "price24hPcnt": "0.0081",
              "highPrice24h": "0.00005952",
              "lowPrice24h": "0.00005684",
              "turnover24h": "1230.42619439",
              "volume24h": "21244663",
              "usdIndexPrice": "0.0000572528"
            },
            {
              "symbol": "CSPRUSDT",
              "bid1Price": "0.00954",
              "bid1Size": "3519.77",
              "ask1Price": "0.00956",
              "ask1Size": "3783.76",
              "lastPrice": "0.00954",
              "prevPrice24h": "0.00955",
              "price24hPcnt": "-0.0010",
              "highPrice24h": "0.00989",
              "lowPrice24h": "0.00931",
              "turnover24h": "92297.7009954",
              "volume24h": "9660962.08"
            },
            {
              "symbol": "DRIFTUSDT",
              "bid1Price": "0.4909",
              "bid1Size": "828.03",
              "ask1Price": "0.4912",
              "ask1Size": "36.24",
              "lastPrice": "0.4911",
              "prevPrice24h": "0.489",
              "price24hPcnt": "0.0043",
              "highPrice24h": "0.5055",
              "lowPrice24h": "0.4864",
              "turnover24h": "656975.989066",
              "volume24h": "1327461.68",
              "usdIndexPrice": "0.491048"
            },
            {
              "symbol": "CATBNBUSDT",
              "bid1Price": "0.00000559",
              "bid1Size": "97081781",
              "ask1Price": "0.00000561",
              "ask1Size": "130119800",
              "lastPrice": "0.0000056",
              "prevPrice24h": "0.00000554",
              "price24hPcnt": "0.0108",
              "highPrice24h": "0.00000582",
              "lowPrice24h": "0.00000548",
              "turnover24h": "15631.74902668",
              "volume24h": "2769521520"
            },
            {
              "symbol": "HMSTRUSDC",
              "bid1Price": "0.002603",
              "bid1Size": "178731.76",
              "ask1Price": "0.002619",
              "ask1Size": "666154.54",
              "lastPrice": "0.002603",
              "prevPrice24h": "0.002602",
              "price24hPcnt": "0.0004",
              "highPrice24h": "0.002644",
              "lowPrice24h": "0.002577",
              "turnover24h": "517.57983479",
              "volume24h": "198312.91",
              "usdIndexPrice": "0.00260717"
            },
            {
              "symbol": "DAIUSDT",
              "bid1Price": "1.0003",
              "bid1Size": "18235.76",
              "ask1Price": "1.0004",
              "ask1Size": "857.24",
              "lastPrice": "1.0003",
              "prevPrice24h": "1.0002",
              "price24hPcnt": "0.0001",
              "highPrice24h": "1.0009",
              "lowPrice24h": "1.0001",
              "turnover24h": "347517.8256",
              "volume24h": "347366.33",
              "usdIndexPrice": "1.000105"
            },
            {
              "symbol": "APTUSDC",
              "bid1Price": "4.88",
              "bid1Size": "794.44",
              "ask1Price": "4.89",
              "ask1Size": "1191.9",
              "lastPrice": "4.89",
              "prevPrice24h": "4.78",
              "price24hPcnt": "0.0230",
              "highPrice24h": "4.95",
              "lowPrice24h": "4.78",
              "turnover24h": "72312.60816",
              "volume24h": "14866.14",
              "usdIndexPrice": "4.881099"
            },
            {
              "symbol": "FMBUSDT",
              "bid1Price": "0.003981",
              "bid1Size": "2458.83",
              "ask1Price": "0.00399",
              "ask1Size": "3709.59",
              "lastPrice": "0.003989",
              "prevPrice24h": "0.004132",
              "price24hPcnt": "-0.0346",
              "highPrice24h": "0.00414",
              "lowPrice24h": "0.003974",
              "turnover24h": "118284.47584951",
              "volume24h": "29171339.02"
            },
            {
              "symbol": "GPSUSDT",
              "bid1Price": "0.01772",
              "bid1Size": "1583.3",
              "ask1Price": "0.01773",
              "ask1Size": "849.3",
              "lastPrice": "0.01772",
              "prevPrice24h": "0.01666",
              "price24hPcnt": "0.0636",
              "highPrice24h": "0.01932",
              "lowPrice24h": "0.01637",
              "turnover24h": "493101.618252",
              "volume24h": "28228889.8"
            },
            {
              "symbol": "FLIPUSDT",
              "bid1Price": "0.4526",
              "bid1Size": "23.81",
              "ask1Price": "0.4535",
              "ask1Size": "11.07",
              "lastPrice": "0.4539",
              "prevPrice24h": "0.46",
              "price24hPcnt": "-0.0133",
              "highPrice24h": "0.4698",
              "lowPrice24h": "0.4504",
              "turnover24h": "23410.011609",
              "volume24h": "50823.17"
            },
            {
              "symbol": "FHEUSDT",
              "bid1Price": "0.09485",
              "bid1Size": "474",
              "ask1Price": "0.09492",
              "ask1Size": "602",
              "lastPrice": "0.09502",
              "prevPrice24h": "0.08237",
              "price24hPcnt": "0.1536",
              "highPrice24h": "0.11032",
              "lowPrice24h": "0.07904",
              "turnover24h": "8734406.35424",
              "volume24h": "100596985"
            },
            {
              "symbol": "CATIUSDC",
              "bid1Price": "0.0819",
              "bid1Size": "4435.07",
              "ask1Price": "0.0821",
              "ask1Size": "2773.31",
              "lastPrice": "0.0818",
              "prevPrice24h": "0.0775",
              "price24hPcnt": "0.0555",
              "highPrice24h": "0.0888",
              "lowPrice24h": "0.0752",
              "turnover24h": "34961.003944",
              "volume24h": "417378.1",
              "usdIndexPrice": "0.0819992"
            },
            {
              "symbol": "NEXOUSDT",
              "bid1Price": "1.0157",
              "bid1Size": "36.56",
              "ask1Price": "1.0174",
              "ask1Size": "202.73",
              "lastPrice": "1.0174",
              "prevPrice24h": "1.0305",
              "price24hPcnt": "-0.0127",
              "highPrice24h": "1.0414",
              "lowPrice24h": "1.0163",
              "turnover24h": "55739.49958",
              "volume24h": "54103.46"
            },
            {
              "symbol": "TOSHIUSDT",
              "bid1Price": "0.0003301",
              "bid1Size": "200000",
              "ask1Price": "0.00033037",
              "ask1Size": "33983",
              "lastPrice": "0.00033033",
              "prevPrice24h": "0.00034898",
              "price24hPcnt": "-0.0534",
              "highPrice24h": "0.00035911",
              "lowPrice24h": "0.00032223",
              "turnover24h": "897239.33558876",
              "volume24h": "2609339225"
            },
            {
              "symbol": "LRCUSDT",
              "bid1Price": "0.0932",
              "bid1Size": "4964.17",
              "ask1Price": "0.0933",
              "ask1Size": "2970",
              "lastPrice": "0.0933",
              "prevPrice24h": "0.0922",
              "price24hPcnt": "0.0119",
              "highPrice24h": "0.0963",
              "lowPrice24h": "0.0914",
              "turnover24h": "60314.118119",
              "volume24h": "643248.42",
              "usdIndexPrice": "0.093352"
            },
            {
              "symbol": "BTCEUR",
              "bid1Price": "74387.2",
              "bid1Size": "0.000672",
              "ask1Price": "74405.6",
              "ask1Size": "0.003653",
              "lastPrice": "74394.7",
              "prevPrice24h": "74883.3",
              "price24hPcnt": "-0.0065",
              "highPrice24h": "75188.8",
              "lowPrice24h": "74381.5",
              "turnover24h": "267700.4253851",
              "volume24h": "3.575194"
            },
            {
              "symbol": "BOMEUSDT",
              "bid1Price": "0.001232",
              "bid1Size": "141750",
              "ask1Price": "0.001233",
              "ask1Size": "505101.63",
              "lastPrice": "0.001232",
              "prevPrice24h": "0.001211",
              "price24hPcnt": "0.0173",
              "highPrice24h": "0.001303",
              "lowPrice24h": "0.001184",
              "turnover24h": "1202383.98749312",
              "volume24h": "964397861.7",
              "usdIndexPrice": "0.00123233"
            },
            {
              "symbol": "BNBUSDT",
              "bid1Price": "593.8",
              "bid1Size": "1.8664",
              "ask1Price": "593.9",
              "ask1Size": "3.3004",
              "lastPrice": "593.8",
              "prevPrice24h": "592.8",
              "price24hPcnt": "0.0017",
              "highPrice24h": "595.2",
              "lowPrice24h": "587.3",
              "turnover24h": "4088292.1109363",
              "volume24h": "6919.62665",
              "usdIndexPrice": "593.926879"
            },
            {
              "symbol": "OPUSDT",
              "bid1Price": "0.703",
              "bid1Size": "19266.04",
              "ask1Price": "0.704",
              "ask1Size": "1956.4",
              "lastPrice": "0.703",
              "prevPrice24h": "0.669",
              "price24hPcnt": "0.0508",
              "highPrice24h": "0.718",
              "lowPrice24h": "0.668",
              "turnover24h": "2535846.489969",
              "volume24h": "3627623.45",
              "usdIndexPrice": "0.703992"
            },
            {
              "symbol": "LFTUSDT",
              "bid1Price": "0.01281",
              "bid1Size": "5467.83",
              "ask1Price": "0.01285",
              "ask1Size": "14372.63",
              "lastPrice": "0.01285",
              "prevPrice24h": "0.01291",
              "price24hPcnt": "-0.0046",
              "highPrice24h": "0.01298",
              "lowPrice24h": "0.0128",
              "turnover24h": "18125.2732509",
              "volume24h": "1408520.63"
            },
            {
              "symbol": "ORTUSDT",
              "bid1Price": "0.002788",
              "bid1Size": "32725.54",
              "ask1Price": "0.002794",
              "ask1Size": "2500.21",
              "lastPrice": "0.002792",
              "prevPrice24h": "0.002887",
              "price24hPcnt": "-0.0329",
              "highPrice24h": "0.002927",
              "lowPrice24h": "0.00279",
              "turnover24h": "33524.71548985",
              "volume24h": "11695477.4"
            },
            {
              "symbol": "TRVLUSDT",
              "bid1Price": "0.005886",
              "bid1Size": "7567.61",
              "ask1Price": "0.005892",
              "ask1Size": "2494.91",
              "lastPrice": "0.005887",
              "prevPrice24h": "0.005949",
              "price24hPcnt": "-0.0104",
              "highPrice24h": "0.005988",
              "lowPrice24h": "0.005875",
              "turnover24h": "78618.36490204",
              "volume24h": "13259126.9"
            },
            {
              "symbol": "BTCDAI",
              "bid1Price": "84609.8",
              "bid1Size": "0.00007",
              "ask1Price": "84915.7",
              "ask1Size": "0.045",
              "lastPrice": "84762.7",
              "prevPrice24h": "85376.8",
              "price24hPcnt": "-0.0072",
              "highPrice24h": "85531.2",
              "lowPrice24h": "84762.7",
              "turnover24h": "69.0531282",
              "volume24h": "0.000811"
            },
            {
              "symbol": "TONUSDT",
              "bid1Price": "2.976",
              "bid1Size": "222.51",
              "ask1Price": "2.977",
              "ask1Size": "1256.38",
              "lastPrice": "2.977",
              "prevPrice24h": "2.993",
              "price24hPcnt": "-0.0053",
              "highPrice24h": "3.013",
              "lowPrice24h": "2.94",
              "turnover24h": "4728380.6944",
              "volume24h": "1589850.16",
              "usdIndexPrice": "2.975389"
            },
            {
              "symbol": "THETAUSDT",
              "bid1Price": "0.6564",
              "bid1Size": "1851.74",
              "ask1Price": "0.6566",
              "ask1Size": "540",
              "lastPrice": "0.6563",
              "prevPrice24h": "0.6708",
              "price24hPcnt": "-0.0216",
              "highPrice24h": "0.6872",
              "lowPrice24h": "0.6543",
              "turnover24h": "682455.984999",
              "volume24h": "1019267.08",
              "usdIndexPrice": "0.655841"
            },
            {
              "symbol": "DOGSEUR",
              "bid1Price": "0.0001035",
              "bid1Size": "2544597",
              "ask1Price": "0.0001039",
              "ask1Size": "2514634",
              "lastPrice": "0.0001037",
              "prevPrice24h": "0.0001002",
              "price24hPcnt": "0.0349",
              "highPrice24h": "0.0001072",
              "lowPrice24h": "0.000099",
              "turnover24h": "3322.7267455",
              "volume24h": "32116392"
            },
            {
              "symbol": "DBRUSDT",
              "bid1Price": "0.01407",
              "bid1Size": "54416",
              "ask1Price": "0.0141",
              "ask1Size": "55090",
              "lastPrice": "0.01416",
              "prevPrice24h": "0.01503",
              "price24hPcnt": "-0.0579",
              "highPrice24h": "0.01581",
              "lowPrice24h": "0.01377",
              "turnover24h": "537366.75217",
              "volume24h": "36893669"
            },
            {
              "symbol": "SCUSDT",
              "bid1Price": "0.003336",
              "bid1Size": "37522.02",
              "ask1Price": "0.003338",
              "ask1Size": "3889.67",
              "lastPrice": "0.003337",
              "prevPrice24h": "0.003454",
              "price24hPcnt": "-0.0339",
              "highPrice24h": "0.00347",
              "lowPrice24h": "0.003334",
              "turnover24h": "126524.99986925",
              "volume24h": "37218054.05",
              "usdIndexPrice": "0.00333711"
            },
            {
              "symbol": "FOXYUSDT",
              "bid1Price": "0.001334",
              "bid1Size": "111668.08",
              "ask1Price": "0.001337",
              "ask1Size": "79096.54",
              "lastPrice": "0.001336",
              "prevPrice24h": "0.001295",
              "price24hPcnt": "0.0317",
              "highPrice24h": "0.001432",
              "lowPrice24h": "0.001278",
              "turnover24h": "261833.10933298",
              "volume24h": "193175200.6"
            },
            {
              "symbol": "TELUSDT",
              "bid1Price": "0.004683",
              "bid1Size": "3358.6",
              "ask1Price": "0.004696",
              "ask1Size": "2328.1",
              "lastPrice": "0.004683",
              "prevPrice24h": "0.004437",
              "price24hPcnt": "0.0554",
              "highPrice24h": "0.004705",
              "lowPrice24h": "0.004401",
              "turnover24h": "93952.7770809",
              "volume24h": "20536385.7"
            },
            {
              "symbol": "VPRUSDT",
              "bid1Price": "0.0003709",
              "bid1Size": "59491.61",
              "ask1Price": "0.0003714",
              "ask1Size": "54700.13",
              "lastPrice": "0.0003716",
              "prevPrice24h": "0.000366",
              "price24hPcnt": "0.0153",
              "highPrice24h": "0.0003724",
              "lowPrice24h": "0.0003639",
              "turnover24h": "33289.042178168",
              "volume24h": "90388832.35"
            },
            {
              "symbol": "LTCUSDC",
              "bid1Price": "76.36",
              "bid1Size": "4.455",
              "ask1Price": "76.37",
              "ask1Size": "2.2275",
              "lastPrice": "76.34",
              "prevPrice24h": "76.26",
              "price24hPcnt": "0.0010",
              "highPrice24h": "76.93",
              "lowPrice24h": "74.27",
              "turnover24h": "593672.9922388",
              "volume24h": "7903.52393",
              "usdIndexPrice": "76.339647"
            },
            {
              "symbol": "UNIUSDT",
              "bid1Price": "5.246",
              "bid1Size": "169.028",
              "ask1Price": "5.248",
              "ask1Size": "549.641",
              "lastPrice": "5.246",
              "prevPrice24h": "5.283",
              "price24hPcnt": "-0.0070",
              "highPrice24h": "5.357",
              "lowPrice24h": "5.222",
              "turnover24h": "1395950.929377",
              "volume24h": "264047.558",
              "usdIndexPrice": "5.245078"
            },
            {
              "symbol": "WBTCBTC",
              "bid1Price": "1",
              "bid1Size": "1.73913",
              "ask1Price": "1.0001",
              "ask1Size": "0.100336",
              "lastPrice": "1",
              "prevPrice24h": "0.9999",
              "price24hPcnt": "0.0001",
              "highPrice24h": "1.0048",
              "lowPrice24h": "0.9998",
              "turnover24h": "13.5097480579",
              "volume24h": "13.504372"
            },
            {
              "symbol": "SANDUSDT",
              "bid1Price": "0.2641",
              "bid1Size": "900",
              "ask1Price": "0.2642",
              "ask1Size": "900",
              "lastPrice": "0.2641",
              "prevPrice24h": "0.2643",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "0.2714",
              "lowPrice24h": "0.2616",
              "turnover24h": "783421.1828098",
              "volume24h": "2931252.14",
              "usdIndexPrice": "0.264111"
            },
            {
              "symbol": "NEONUSDT",
              "bid1Price": "0.11746",
              "bid1Size": "73.32",
              "ask1Price": "0.11763",
              "ask1Size": "251.43",
              "lastPrice": "0.11763",
              "prevPrice24h": "0.11084",
              "price24hPcnt": "0.0613",
              "highPrice24h": "0.1195",
              "lowPrice24h": "0.11025",
              "turnover24h": "165418.4287148",
              "volume24h": "1446066.44"
            },
            {
              "symbol": "OBTUSDT",
              "bid1Price": "0.01012",
              "bid1Size": "20975.8",
              "ask1Price": "0.01013",
              "ask1Size": "22050",
              "lastPrice": "0.01012",
              "prevPrice24h": "0.01011",
              "price24hPcnt": "0.0010",
              "highPrice24h": "0.01136",
              "lowPrice24h": "0.00999",
              "turnover24h": "1771218.181484",
              "volume24h": "165950796.7"
            },
            {
              "symbol": "SHIBEUR",
              "bid1Price": "0.00001079",
              "bid1Size": "18596818.2",
              "ask1Price": "0.00001081",
              "ask1Size": "30717749.9",
              "lastPrice": "0.00001083",
              "prevPrice24h": "0.00001073",
              "price24hPcnt": "0.0093",
              "highPrice24h": "0.00001091",
              "lowPrice24h": "0.00001067",
              "turnover24h": "1396.352944923",
              "volume24h": "128830798.2"
            },
            {
              "symbol": "XUSDT",
              "bid1Price": "0.00006633",
              "bid1Size": "5652698",
              "ask1Price": "0.00006644",
              "ask1Size": "30300",
              "lastPrice": "0.00006644",
              "prevPrice24h": "0.00006731",
              "price24hPcnt": "-0.0129",
              "highPrice24h": "0.00006954",
              "lowPrice24h": "0.00006589",
              "turnover24h": "518925.22065685",
              "volume24h": "7704037518",
              "usdIndexPrice": "0.0000664548"
            },
            {
              "symbol": "STATUSDT",
              "bid1Price": "0.07267",
              "bid1Size": "421.39",
              "ask1Price": "0.07272",
              "ask1Size": "3002.84",
              "lastPrice": "0.0727",
              "prevPrice24h": "0.07197",
              "price24hPcnt": "0.0101",
              "highPrice24h": "0.07325",
              "lowPrice24h": "0.07175",
              "turnover24h": "46937.3122562",
              "volume24h": "647340.87"
            },
            {
              "symbol": "CATIEUR",
              "bid1Price": "0.0718",
              "bid1Size": "2794.7",
              "ask1Price": "0.0723",
              "ask1Size": "2782.27",
              "lastPrice": "0.0721",
              "prevPrice24h": "0.0659",
              "price24hPcnt": "0.0941",
              "highPrice24h": "0.077",
              "lowPrice24h": "0.0659",
              "turnover24h": "4183.821152",
              "volume24h": "57342.34"
            },
            {
              "symbol": "AXLUSDT",
              "bid1Price": "0.2976",
              "bid1Size": "745.71",
              "ask1Price": "0.2978",
              "ask1Size": "382.5",
              "lastPrice": "0.2976",
              "prevPrice24h": "0.2954",
              "price24hPcnt": "0.0074",
              "highPrice24h": "0.3073",
              "lowPrice24h": "0.2923",
              "turnover24h": "317704.14266",
              "volume24h": "1060165.23",
              "usdIndexPrice": "0.297774"
            },
            {
              "symbol": "SNXUSDT",
              "bid1Price": "0.6359",
              "bid1Size": "14.7",
              "ask1Price": "0.6362",
              "ask1Size": "360",
              "lastPrice": "0.6357",
              "prevPrice24h": "0.6357",
              "price24hPcnt": "0",
              "highPrice24h": "0.6659",
              "lowPrice24h": "0.6219",
              "turnover24h": "310361.339097",
              "volume24h": "483359.11",
              "usdIndexPrice": "0.635659"
            },
            {
              "symbol": "TIAUSDT",
              "bid1Price": "2.459",
              "bid1Size": "1058.05",
              "ask1Price": "2.46",
              "ask1Size": "6.26",
              "lastPrice": "2.459",
              "prevPrice24h": "2.387",
              "price24hPcnt": "0.0302",
              "highPrice24h": "2.545",
              "lowPrice24h": "2.345",
              "turnover24h": "3487684.51844",
              "volume24h": "1426615.75",
              "usdIndexPrice": "2.457799"
            },
            {
              "symbol": "GUSDT",
              "bid1Price": "0.0141",
              "bid1Size": "3781",
              "ask1Price": "0.01414",
              "ask1Size": "3116",
              "lastPrice": "0.0141",
              "prevPrice24h": "0.01426",
              "price24hPcnt": "-0.0112",
              "highPrice24h": "0.01479",
              "lowPrice24h": "0.0141",
              "turnover24h": "28956.18543",
              "volume24h": "2009182"
            },
            {
              "symbol": "MPLXUSDT",
              "bid1Price": "0.20747",
              "bid1Size": "85.04",
              "ask1Price": "0.20748",
              "ask1Size": "762.58",
              "lastPrice": "0.20765",
              "prevPrice24h": "0.22416",
              "price24hPcnt": "-0.0737",
              "highPrice24h": "0.22883",
              "lowPrice24h": "0.20514",
              "turnover24h": "122789.9464283",
              "volume24h": "565654.18"
            },
            {
              "symbol": "FLTUSDT",
              "bid1Price": "0.04139",
              "bid1Size": "190.27",
              "ask1Price": "0.0414",
              "ask1Size": "515.67",
              "lastPrice": "0.04139",
              "prevPrice24h": "0.04117",
              "price24hPcnt": "0.0053",
              "highPrice24h": "0.04229",
              "lowPrice24h": "0.04057",
              "turnover24h": "10951.4497295",
              "volume24h": "265277.66"
            },
            {
              "symbol": "SLPUSDT",
              "bid1Price": "0.001503",
              "bid1Size": "20700",
              "ask1Price": "0.001507",
              "ask1Size": "1086091.5",
              "lastPrice": "0.001501",
              "prevPrice24h": "0.001508",
              "price24hPcnt": "-0.0046",
              "highPrice24h": "0.00163",
              "lowPrice24h": "0.001467",
              "turnover24h": "43301.8383386",
              "volume24h": "27862633.5"
            },
            {
              "symbol": "L3USDT",
              "bid1Price": "0.06473",
              "bid1Size": "621.4",
              "ask1Price": "0.06477",
              "ask1Size": "231.5",
              "lastPrice": "0.06477",
              "prevPrice24h": "0.06449",
              "price24hPcnt": "0.0043",
              "highPrice24h": "0.07019",
              "lowPrice24h": "0.06404",
              "turnover24h": "662253.03469",
              "volume24h": "9922004.2"
            },
            {
              "symbol": "BONKUSDC",
              "bid1Price": "0.00001221",
              "bid1Size": "24579795",
              "ask1Price": "0.00001224",
              "ask1Size": "149716217",
              "lastPrice": "0.00001229",
              "prevPrice24h": "0.00001226",
              "price24hPcnt": "0.0024",
              "highPrice24h": "0.00001272",
              "lowPrice24h": "0.00001212",
              "turnover24h": "18294.56834914",
              "volume24h": "1477334547",
              "usdIndexPrice": "0.0000122187"
            },
            {
              "symbol": "HVHUSDT",
              "bid1Price": "0.001499",
              "bid1Size": "113950.62",
              "ask1Price": "0.0015",
              "ask1Size": "127095.83",
              "lastPrice": "0.0015",
              "prevPrice24h": "0.00145",
              "price24hPcnt": "0.0345",
              "highPrice24h": "0.0015",
              "lowPrice24h": "0.001448",
              "turnover24h": "49297.33025527",
              "volume24h": "33516258.55"
            },
            {
              "symbol": "SIDUSUSDT",
              "bid1Price": "0.0009246",
              "bid1Size": "67510.59",
              "ask1Price": "0.0009285",
              "ask1Size": "14362.37",
              "lastPrice": "0.0009261",
              "prevPrice24h": "0.0008951",
              "price24hPcnt": "0.0346",
              "highPrice24h": "0.0010216",
              "lowPrice24h": "0.0008932",
              "turnover24h": "98477.852374481",
              "volume24h": "102441462.32"
            },
            {
              "symbol": "MANABTC",
              "bid1Price": "0.00000332",
              "bid1Size": "85",
              "ask1Price": "0.00000336",
              "ask1Size": "22.9",
              "lastPrice": "0.00000332",
              "prevPrice24h": "0.00000325",
              "price24hPcnt": "0.0215",
              "highPrice24h": "0.00000351",
              "lowPrice24h": "0.00000322",
              "turnover24h": "2.560263077",
              "volume24h": "768684.7"
            },
            {
              "symbol": "XTZUSDT",
              "bid1Price": "0.498",
              "bid1Size": "1401.17",
              "ask1Price": "0.499",
              "ask1Size": "6239.28",
              "lastPrice": "0.498",
              "prevPrice24h": "0.503",
              "price24hPcnt": "-0.0099",
              "highPrice24h": "0.51",
              "lowPrice24h": "0.498",
              "turnover24h": "195049.80231",
              "volume24h": "387622.1",
              "usdIndexPrice": "0.498797"
            },
            {
              "symbol": "BBUSDT",
              "bid1Price": "0.1066",
              "bid1Size": "1347.18",
              "ask1Price": "0.1067",
              "ask1Size": "12300.73",
              "lastPrice": "0.1066",
              "prevPrice24h": "0.1051",
              "price24hPcnt": "0.0143",
              "highPrice24h": "0.1125",
              "lowPrice24h": "0.1031",
              "turnover24h": "544790.749922",
              "volume24h": "5040994.61",
              "usdIndexPrice": "0.106541"
            },
            {
              "symbol": "MANAUSDT",
              "bid1Price": "0.2816",
              "bid1Size": "810",
              "ask1Price": "0.2817",
              "ask1Size": "810",
              "lastPrice": "0.2816",
              "prevPrice24h": "0.2791",
              "price24hPcnt": "0.0090",
              "highPrice24h": "0.2962",
              "lowPrice24h": "0.2771",
              "turnover24h": "690005.829986",
              "volume24h": "2422585.99",
              "usdIndexPrice": "0.281659"
            },
            {
              "symbol": "LINKUSDT",
              "bid1Price": "13.09",
              "bid1Size": "1386.971",
              "ask1Price": "13.1",
              "ask1Size": "439.722",
              "lastPrice": "13.09",
              "prevPrice24h": "12.88",
              "price24hPcnt": "0.0163",
              "highPrice24h": "13.14",
              "lowPrice24h": "12.7",
              "turnover24h": "7695679.6808763",
              "volume24h": "594738.654",
              "usdIndexPrice": "13.089425"
            },
            {
              "symbol": "PEOPLEUSDT",
              "bid1Price": "0.013",
              "bid1Size": "114787.9",
              "ask1Price": "0.01301",
              "ask1Size": "14850",
              "lastPrice": "0.01302",
              "prevPrice24h": "0.01178",
              "price24hPcnt": "0.1053",
              "highPrice24h": "0.01742",
              "lowPrice24h": "0.01146",
              "turnover24h": "3899146.1631083",
              "volume24h": "277505446.37",
              "usdIndexPrice": "0.0130136"
            },
            {
              "symbol": "NEAREUR",
              "bid1Price": "1.911",
              "bid1Size": "105",
              "ask1Price": "1.915",
              "ask1Size": "104.7",
              "lastPrice": "1.914",
              "prevPrice24h": "1.851",
              "price24hPcnt": "0.0340",
              "highPrice24h": "1.937",
              "lowPrice24h": "1.844",
              "turnover24h": "4854.4075",
              "volume24h": "2537.9"
            },
            {
              "symbol": "TURBOSUSDT",
              "bid1Price": "0.0009389",
              "bid1Size": "64710.19",
              "ask1Price": "0.0009483",
              "ask1Size": "42504.71",
              "lastPrice": "0.0009424",
              "prevPrice24h": "0.0009365",
              "price24hPcnt": "0.0063",
              "highPrice24h": "0.0009909",
              "lowPrice24h": "0.000932",
              "turnover24h": "62378.507810238",
              "volume24h": "65246505.78"
            },
            {
              "symbol": "AEROUSDT",
              "bid1Price": "0.4022",
              "bid1Size": "1170",
              "ask1Price": "0.4027",
              "ask1Size": "585",
              "lastPrice": "0.4025",
              "prevPrice24h": "0.3895",
              "price24hPcnt": "0.0334",
              "highPrice24h": "0.4114",
              "lowPrice24h": "0.386",
              "turnover24h": "833238.297552",
              "volume24h": "2081318.84"
            },
            {
              "symbol": "BRUSDT",
              "bid1Price": "0.04186",
              "bid1Size": "205",
              "ask1Price": "0.0419",
              "ask1Size": "8103",
              "lastPrice": "0.0419",
              "prevPrice24h": "0.04362",
              "price24hPcnt": "-0.0394",
              "highPrice24h": "0.05187",
              "lowPrice24h": "0.04146",
              "turnover24h": "1153097.22366",
              "volume24h": "25700489"
            },
            {
              "symbol": "OMUSDT",
              "bid1Price": "0.5897",
              "bid1Size": "684",
              "ask1Price": "0.59",
              "ask1Size": "700.59",
              "lastPrice": "0.5899",
              "prevPrice24h": "0.6375",
              "price24hPcnt": "-0.0747",
              "highPrice24h": "0.6404",
              "lowPrice24h": "0.5841",
              "turnover24h": "5169457.987212",
              "volume24h": "8492195.4"
            },
            {
              "symbol": "SANDUSDC",
              "bid1Price": "0.2639",
              "bid1Size": "2760.22",
              "ask1Price": "0.2644",
              "ask1Size": "866.07",
              "lastPrice": "0.2647",
              "prevPrice24h": "0.264",
              "price24hPcnt": "0.0027",
              "highPrice24h": "0.271",
              "lowPrice24h": "0.2623",
              "turnover24h": "7629.818482",
              "volume24h": "28602.04",
              "usdIndexPrice": "0.264111"
            },
            {
              "symbol": "TOMIUSDT",
              "bid1Price": "0.002097",
              "bid1Size": "2384.36",
              "ask1Price": "0.002106",
              "ask1Size": "7361.52",
              "lastPrice": "0.002097",
              "prevPrice24h": "0.002108",
              "price24hPcnt": "-0.0052",
              "highPrice24h": "0.002238",
              "lowPrice24h": "0.00203",
              "turnover24h": "371789.79478509",
              "volume24h": "175672396.35"
            },
            {
              "symbol": "OMGUSDT",
              "bid1Price": "0.1895",
              "bid1Size": "46.727",
              "ask1Price": "0.1898",
              "ask1Size": "83.004",
              "lastPrice": "0.19",
              "prevPrice24h": "0.1894",
              "price24hPcnt": "0.0032",
              "highPrice24h": "0.2114",
              "lowPrice24h": "0.1867",
              "turnover24h": "145107.7706125",
              "volume24h": "746114.627"
            },
            {
              "symbol": "ETHUSDC",
              "bid1Price": "1590.35",
              "bid1Size": "0.4725",
              "ask1Price": "1590.36",
              "ask1Size": "0.055",
              "lastPrice": "1590.04",
              "prevPrice24h": "1602.15",
              "price24hPcnt": "-0.0076",
              "highPrice24h": "1631.6",
              "lowPrice24h": "1585.64",
              "turnover24h": "11754873.7719949",
              "volume24h": "7317.77341",
              "usdIndexPrice": "1590.304724"
            },
            {
              "symbol": "JEFFUSDT",
              "bid1Price": "0.00435",
              "bid1Size": "1228.65",
              "ask1Price": "0.004389",
              "ask1Size": "1176.79",
              "lastPrice": "0.004352",
              "prevPrice24h": "0.004502",
              "price24hPcnt": "-0.0333",
              "highPrice24h": "0.004535",
              "lowPrice24h": "0.004344",
              "turnover24h": "44951.53592165",
              "volume24h": "10056979.13"
            },
            {
              "symbol": "BMTUSDT",
              "bid1Price": "0.0793",
              "bid1Size": "9237.87",
              "ask1Price": "0.0794",
              "ask1Size": "14556.88",
              "lastPrice": "0.0794",
              "prevPrice24h": "0.0802",
              "price24hPcnt": "-0.0100",
              "highPrice24h": "0.0835",
              "lowPrice24h": "0.078",
              "turnover24h": "4380469.128138",
              "volume24h": "54832732.46",
              "usdIndexPrice": "0.0793094"
            },
            {
              "symbol": "LTCEUR",
              "bid1Price": "67.02",
              "bid1Size": "1",
              "ask1Price": "67.12",
              "ask1Size": "17.6731",
              "lastPrice": "67.11",
              "prevPrice24h": "67.08",
              "price24hPcnt": "0.0004",
              "highPrice24h": "67.45",
              "lowPrice24h": "65.25",
              "turnover24h": "14447.2092271",
              "volume24h": "217.90034"
            },
            {
              "symbol": "YFIUSDT",
              "bid1Price": "4575",
              "bid1Size": "0.0247",
              "ask1Price": "4576",
              "ask1Size": "0.0247",
              "lastPrice": "4577",
              "prevPrice24h": "4559",
              "price24hPcnt": "0.0039",
              "highPrice24h": "4625",
              "lowPrice24h": "4511",
              "turnover24h": "374190.61934",
              "volume24h": "82.13688",
              "usdIndexPrice": "4575.213484"
            },
            {
              "symbol": "INJUSDC",
              "bid1Price": "8.27",
              "bid1Size": "5.04",
              "ask1Price": "8.31",
              "ask1Size": "27.56",
              "lastPrice": "8.31",
              "prevPrice24h": "8.15",
              "price24hPcnt": "0.0196",
              "highPrice24h": "8.61",
              "lowPrice24h": "8.11",
              "turnover24h": "1635.3312",
              "volume24h": "195.62",
              "usdIndexPrice": "8.274435"
            },
            {
              "symbol": "PIRATEUSDT",
              "bid1Price": "0.03494",
              "bid1Size": "286.2",
              "ask1Price": "0.03504",
              "ask1Size": "285.39",
              "lastPrice": "0.03491",
              "prevPrice24h": "0.03453",
              "price24hPcnt": "0.0110",
              "highPrice24h": "0.03749",
              "lowPrice24h": "0.03334",
              "turnover24h": "80573.6666456",
              "volume24h": "2302467.74"
            },
            {
              "symbol": "LUNCUSDC",
              "bid1Price": "0.00006068",
              "bid1Size": "259473",
              "ask1Price": "0.00006075",
              "ask1Size": "259344.8",
              "lastPrice": "0.00006114",
              "prevPrice24h": "0.00005974",
              "price24hPcnt": "0.0234",
              "highPrice24h": "0.00006177",
              "lowPrice24h": "0.00005941",
              "turnover24h": "2895.751097871",
              "volume24h": "47586429.5",
              "usdIndexPrice": "0.0000607763"
            },
            {
              "symbol": "CMETHUSDT",
              "bid1Price": "1690.92",
              "bid1Size": "14.9756",
              "ask1Price": "1692.12",
              "ask1Size": "3.8",
              "lastPrice": "1693.12",
              "prevPrice24h": "1701.02",
              "price24hPcnt": "-0.0046",
              "highPrice24h": "1734.2",
              "lowPrice24h": "1689.17",
              "turnover24h": "1557985.535275",
              "volume24h": "909.9644",
              "usdIndexPrice": "1693.102918"
            },
            {
              "symbol": "WIFUSDC",
              "bid1Price": "0.423",
              "bid1Size": "3863.12",
              "ask1Price": "0.425",
              "ask1Size": "1665.88",
              "lastPrice": "0.424",
              "prevPrice24h": "0.403",
              "price24hPcnt": "0.0521",
              "highPrice24h": "0.44",
              "lowPrice24h": "0.402",
              "turnover24h": "36535.34933",
              "volume24h": "87571.95",
              "usdIndexPrice": "0.424044"
            },
            {
              "symbol": "PUFFERUSDT",
              "bid1Price": "0.1477",
              "bid1Size": "2307.4",
              "ask1Price": "0.1479",
              "ask1Size": "738.9",
              "lastPrice": "0.1478",
              "prevPrice24h": "0.1471",
              "price24hPcnt": "0.0048",
              "highPrice24h": "0.1515",
              "lowPrice24h": "0.1451",
              "turnover24h": "721352.92832",
              "volume24h": "4891893.9",
              "usdIndexPrice": "0.147856"
            },
            {
              "symbol": "MASAUSDT",
              "bid1Price": "0.02057",
              "bid1Size": "2525.09",
              "ask1Price": "0.02058",
              "ask1Size": "9229.19",
              "lastPrice": "0.02057",
              "prevPrice24h": "0.0191",
              "price24hPcnt": "0.0770",
              "highPrice24h": "0.02198",
              "lowPrice24h": "0.01877",
              "turnover24h": "192218.1208266",
              "volume24h": "9580819.24"
            },
            {
              "symbol": "LTCBTC",
              "bid1Price": "0.000902",
              "bid1Size": "2.226",
              "ask1Price": "0.000903",
              "ask1Size": "36.392",
              "lastPrice": "0.000904",
              "prevPrice24h": "0.000894",
              "price24hPcnt": "0.0112",
              "highPrice24h": "0.000904",
              "lowPrice24h": "0.000875",
              "turnover24h": "1.623437062",
              "volume24h": "1815.868"
            },
            {
              "symbol": "SQRUSDT",
              "bid1Price": "0.006934",
              "bid1Size": "274.13",
              "ask1Price": "0.006962",
              "ask1Size": "1095.56",
              "lastPrice": "0.006962",
              "prevPrice24h": "0.006965",
              "price24hPcnt": "-0.0004",
              "highPrice24h": "0.00704",
              "lowPrice24h": "0.006811",
              "turnover24h": "8437.60711796",
              "volume24h": "1210676.32"
            },
            {
              "symbol": "LADYSUSDT",
              "bid1Price": "0.00000003459",
              "bid1Size": "35631518.8",
              "ask1Price": "0.00000003466",
              "ask1Size": "3672259197.4",
              "lastPrice": "0.00000003464",
              "prevPrice24h": "0.00000003452",
              "price24hPcnt": "0.0035",
              "highPrice24h": "0.00000003578",
              "lowPrice24h": "0.00000003355",
              "turnover24h": "115703.51005702219",
              "volume24h": "3344068517105.9"
            },
            {
              "symbol": "MOCAUSDT",
              "bid1Price": "0.07647",
              "bid1Size": "6156.36",
              "ask1Price": "0.07652",
              "ask1Size": "1485",
              "lastPrice": "0.0765",
              "prevPrice24h": "0.07703",
              "price24hPcnt": "-0.0069",
              "highPrice24h": "0.08042",
              "lowPrice24h": "0.07619",
              "turnover24h": "847899.0234543",
              "volume24h": "10865487.79"
            },
            {
              "symbol": "SWELLUSDC",
              "bid1Price": "0.00836",
              "bid1Size": "71527",
              "ask1Price": "0.00843",
              "ask1Size": "2295",
              "lastPrice": "0.00838",
              "prevPrice24h": "0.00807",
              "price24hPcnt": "0.0384",
              "highPrice24h": "0.00868",
              "lowPrice24h": "0.00807",
              "turnover24h": "559.54208",
              "volume24h": "65853"
            },
            {
              "symbol": "TWTUSDT",
              "bid1Price": "0.766",
              "bid1Size": "1618.33",
              "ask1Price": "0.7668",
              "ask1Size": "572.52",
              "lastPrice": "0.7666",
              "prevPrice24h": "0.7617",
              "price24hPcnt": "0.0064",
              "highPrice24h": "0.7796",
              "lowPrice24h": "0.7589",
              "turnover24h": "724890.128073",
              "volume24h": "942783.67",
              "usdIndexPrice": "0.766413"
            },
            {
              "symbol": "BTCUSDT",
              "bid1Price": "84633.6",
              "bid1Size": "3.893297",
              "ask1Price": "84633.7",
              "ask1Size": "0.155867",
              "lastPrice": "84633.6",
              "prevPrice24h": "85335.2",
              "price24hPcnt": "-0.0082",
              "highPrice24h": "85660.3",
              "lowPrice24h": "84613.9",
              "turnover24h": "385124005.38210989",
              "volume24h": "4522.332003",
              "usdIndexPrice": "84644.721367"
            },
            {
              "symbol": "LINKEUR",
              "bid1Price": "11.5",
              "bid1Size": "21.7",
              "ask1Price": "11.52",
              "ask1Size": "22.11",
              "lastPrice": "11.5",
              "prevPrice24h": "11.26",
              "price24hPcnt": "0.0213",
              "highPrice24h": "11.5",
              "lowPrice24h": "11.16",
              "turnover24h": "5099.441",
              "volume24h": "449.83"
            },
            {
              "symbol": "NOTUSDT",
              "bid1Price": "0.001903",
              "bid1Size": "402680.4",
              "ask1Price": "0.001904",
              "ask1Size": "399875.79",
              "lastPrice": "0.001903",
              "prevPrice24h": "0.001904",
              "price24hPcnt": "-0.0005",
              "highPrice24h": "0.00196",
              "lowPrice24h": "0.001812",
              "turnover24h": "3316301.43281407",
              "volume24h": "1771862409.9",
              "usdIndexPrice": "0.00190317"
            },
            {
              "symbol": "B3TRUSDC",
              "bid1Price": "0.125",
              "bid1Size": "534",
              "ask1Price": "0.1261",
              "ask1Size": "200",
              "lastPrice": "0.1259",
              "prevPrice24h": "0.1259",
              "price24hPcnt": "0",
              "highPrice24h": "0.1264",
              "lowPrice24h": "0.125",
              "turnover24h": "362.44141",
              "volume24h": "2884.7"
            },
            {
              "symbol": "XRPBTC",
              "bid1Price": "0.00002438",
              "bid1Size": "5468.7",
              "ask1Price": "0.00002439",
              "ask1Size": "1640.3",
              "lastPrice": "0.00002441",
              "prevPrice24h": "0.00002444",
              "price24hPcnt": "-0.0012",
              "highPrice24h": "0.00002455",
              "lowPrice24h": "0.00002434",
              "turnover24h": "3.357650869",
              "volume24h": "137220"
            },
            {
              "symbol": "KAIAUSDT",
              "bid1Price": "0.1016",
              "bid1Size": "6180",
              "ask1Price": "0.1017",
              "ask1Size": "3860",
              "lastPrice": "0.1017",
              "prevPrice24h": "0.1003",
              "price24hPcnt": "0.0140",
              "highPrice24h": "0.1046",
              "lowPrice24h": "0.1002",
              "turnover24h": "191558.253",
              "volume24h": "1870537",
              "usdIndexPrice": "0.101884"
            },
            {
              "symbol": "MASKUSDT",
              "bid1Price": "1.067",
              "bid1Size": "928.52",
              "ask1Price": "1.068",
              "ask1Size": "200.25",
              "lastPrice": "1.067",
              "prevPrice24h": "1.05",
              "price24hPcnt": "0.0162",
              "highPrice24h": "1.099",
              "lowPrice24h": "1.047",
              "turnover24h": "621704.76464",
              "volume24h": "581329.84",
              "usdIndexPrice": "1.066857"
            },
            {
              "symbol": "ZTXUSDT",
              "bid1Price": "0.002066",
              "bid1Size": "1191.85",
              "ask1Price": "0.002072",
              "ask1Size": "125478.03",
              "lastPrice": "0.002066",
              "prevPrice24h": "0.002048",
              "price24hPcnt": "0.0088",
              "highPrice24h": "0.002099",
              "lowPrice24h": "0.001993",
              "turnover24h": "22120.00501822",
              "volume24h": "10802242.4"
            },
            {
              "symbol": "BCUTUSDT",
              "bid1Price": "0.0209",
              "bid1Size": "2353.71",
              "ask1Price": "0.02101",
              "ask1Size": "2000",
              "lastPrice": "0.02095",
              "prevPrice24h": "0.02082",
              "price24hPcnt": "0.0062",
              "highPrice24h": "0.02632",
              "lowPrice24h": "0.02058",
              "turnover24h": "157991.0410838",
              "volume24h": "7529039.67"
            },
            {
              "symbol": "PSTAKEUSDT",
              "bid1Price": "0.01111",
              "bid1Size": "4865.77",
              "ask1Price": "0.01117",
              "ask1Size": "1366.07",
              "lastPrice": "0.01114",
              "prevPrice24h": "0.01078",
              "price24hPcnt": "0.0334",
              "highPrice24h": "0.01237",
              "lowPrice24h": "0.01064",
              "turnover24h": "33968.4104161",
              "volume24h": "3018597.03"
            },
            {
              "symbol": "PENDLEUSDT",
              "bid1Price": "3.092",
              "bid1Size": "80.85",
              "ask1Price": "3.094",
              "ask1Size": "104.92",
              "lastPrice": "3.09",
              "prevPrice24h": "3.174",
              "price24hPcnt": "-0.0265",
              "highPrice24h": "3.229",
              "lowPrice24h": "3.09",
              "turnover24h": "1785009.24842",
              "volume24h": "564132.13",
              "usdIndexPrice": "3.093059"
            },
            {
              "symbol": "MNTUSDT",
              "bid1Price": "0.6618",
              "bid1Size": "6788.69",
              "ask1Price": "0.6619",
              "ask1Size": "13757.97",
              "lastPrice": "0.6618",
              "prevPrice24h": "0.6584",
              "price24hPcnt": "0.0052",
              "highPrice24h": "0.6731",
              "lowPrice24h": "0.6583",
              "turnover24h": "63156587.547524",
              "volume24h": "94987134.93",
              "usdIndexPrice": "0.661793"
            },
            {
              "symbol": "CATIUSDT",
              "bid1Price": "0.082",
              "bid1Size": "4678.77",
              "ask1Price": "0.0821",
              "ask1Size": "10852.02",
              "lastPrice": "0.082",
              "prevPrice24h": "0.0775",
              "price24hPcnt": "0.0581",
              "highPrice24h": "0.0889",
              "lowPrice24h": "0.0752",
              "turnover24h": "1421516.956198",
              "volume24h": "17060097.6",
              "usdIndexPrice": "0.0819992"
            },
            {
              "symbol": "KUBUSDT",
              "bid1Price": "1.3526",
              "bid1Size": "5.02",
              "ask1Price": "1.3566",
              "ask1Size": "5.02",
              "lastPrice": "1.355",
              "prevPrice24h": "1.3603",
              "price24hPcnt": "-0.0039",
              "highPrice24h": "1.3698",
              "lowPrice24h": "1.354",
              "turnover24h": "6653.708775",
              "volume24h": "4882.78"
            },
            {
              "symbol": "BCHUSDT",
              "bid1Price": "335.2",
              "bid1Size": "2.255",
              "ask1Price": "335.3",
              "ask1Size": "3.726",
              "lastPrice": "335.2",
              "prevPrice24h": "338.8",
              "price24hPcnt": "-0.0106",
              "highPrice24h": "342.6",
              "lowPrice24h": "332.6",
              "turnover24h": "995401.4916",
              "volume24h": "2948.639",
              "usdIndexPrice": "335.15716"
            },
            {
              "symbol": "ZKUSDT",
              "bid1Price": "0.0499",
              "bid1Size": "346398.4",
              "ask1Price": "0.05",
              "ask1Size": "59337.17",
              "lastPrice": "0.05",
              "prevPrice24h": "0.0486",
              "price24hPcnt": "0.0288",
              "highPrice24h": "0.0526",
              "lowPrice24h": "0.0483",
              "turnover24h": "1722228.365958",
              "volume24h": "34088766.02",
              "usdIndexPrice": "0.0499749"
            },
            {
              "symbol": "MANTAUSDT",
              "bid1Price": "0.1992",
              "bid1Size": "1710",
              "ask1Price": "0.1993",
              "ask1Size": "855",
              "lastPrice": "0.1993",
              "prevPrice24h": "0.1869",
              "price24hPcnt": "0.0663",
              "highPrice24h": "0.2074",
              "lowPrice24h": "0.1837",
              "turnover24h": "668500.153597",
              "volume24h": "3380173.34",
              "usdIndexPrice": "0.199564"
            },
            {
              "symbol": "MOVEUSDT",
              "bid1Price": "0.2225",
              "bid1Size": "945",
              "ask1Price": "0.2226",
              "ask1Size": "487.8",
              "lastPrice": "0.2226",
              "prevPrice24h": "0.2428",
              "price24hPcnt": "-0.0832",
              "highPrice24h": "0.2453",
              "lowPrice24h": "0.2224",
              "turnover24h": "1704698.13901",
              "volume24h": "7257976.5",
              "usdIndexPrice": "0.222405"
            },
            {
              "symbol": "LUNAUSDT",
              "bid1Price": "0.1656",
              "bid1Size": "840.5",
              "ask1Price": "0.1657",
              "ask1Size": "1440",
              "lastPrice": "0.1656",
              "prevPrice24h": "0.1629",
              "price24hPcnt": "0.0166",
              "highPrice24h": "0.1732",
              "lowPrice24h": "0.1612",
              "turnover24h": "340311.018191621",
              "volume24h": "2031364.3488"
            },
            {
              "symbol": "DEEPUSDT",
              "bid1Price": "0.0839",
              "bid1Size": "2771",
              "ask1Price": "0.08397",
              "ask1Size": "2771",
              "lastPrice": "0.08389",
              "prevPrice24h": "0.08588",
              "price24hPcnt": "-0.0232",
              "highPrice24h": "0.08626",
              "lowPrice24h": "0.08346",
              "turnover24h": "836585.77909",
              "volume24h": "9847770",
              "usdIndexPrice": "0.0839186"
            },
            {
              "symbol": "ARKMUSDT",
              "bid1Price": "0.498",
              "bid1Size": "4439.67",
              "ask1Price": "0.499",
              "ask1Size": "7227.26",
              "lastPrice": "0.499",
              "prevPrice24h": "0.495",
              "price24hPcnt": "0.0081",
              "highPrice24h": "0.517",
              "lowPrice24h": "0.487",
              "turnover24h": "977101.88613",
              "volume24h": "1939932.69",
              "usdIndexPrice": "0.498266"
            },
            {
              "symbol": "CITYUSDT",
              "bid1Price": "1.0133",
              "bid1Size": "29.61",
              "ask1Price": "1.0141",
              "ask1Size": "30",
              "lastPrice": "1.0138",
              "prevPrice24h": "1.0003",
              "price24hPcnt": "0.0135",
              "highPrice24h": "1.0373",
              "lowPrice24h": "0.9909",
              "turnover24h": "40940.47375",
              "volume24h": "40427.48"
            },
            {
              "symbol": "WWYUSDT",
              "bid1Price": "0.0001832",
              "bid1Size": "193814.46",
              "ask1Price": "0.0001835",
              "ask1Size": "37004.45",
              "lastPrice": "0.0001833",
              "prevPrice24h": "0.0001884",
              "price24hPcnt": "-0.0271",
              "highPrice24h": "0.0002038",
              "lowPrice24h": "0.000182",
              "turnover24h": "95797.628847033",
              "volume24h": "487439419.11"
            },
            {
              "symbol": "ETHBRL",
              "bid1Price": "9322.73",
              "bid1Size": "0.12",
              "ask1Price": "9336.3",
              "ask1Size": "2.1667",
              "lastPrice": "9360.25",
              "prevPrice24h": "9389.36",
              "price24hPcnt": "-0.0031",
              "highPrice24h": "9568.34",
              "lowPrice24h": "9328.79",
              "turnover24h": "154158.42399",
              "volume24h": "16.3571"
            },
            {
              "symbol": "TRCUSDT",
              "bid1Price": "0.0002018",
              "bid1Size": "182132.42",
              "ask1Price": "0.000203",
              "ask1Size": "39449.97",
              "lastPrice": "0.000202",
              "prevPrice24h": "0.000203",
              "price24hPcnt": "-0.0049",
              "highPrice24h": "0.0002031",
              "lowPrice24h": "0.0002015",
              "turnover24h": "20788.489880715",
              "volume24h": "102487229.09"
            },
            {
              "symbol": "PRCLUSDT",
              "bid1Price": "0.0605",
              "bid1Size": "7713.91",
              "ask1Price": "0.0606",
              "ask1Size": "11104.27",
              "lastPrice": "0.0605",
              "prevPrice24h": "0.0574",
              "price24hPcnt": "0.0540",
              "highPrice24h": "0.0661",
              "lowPrice24h": "0.0574",
              "turnover24h": "1553371.581513",
              "volume24h": "25354754.2",
              "usdIndexPrice": "0.0605143"
            },
            {
              "symbol": "MCRTUSDT",
              "bid1Price": "0.0006188",
              "bid1Size": "569956.29",
              "ask1Price": "0.0006195",
              "ask1Size": "515017.22",
              "lastPrice": "0.0006195",
              "prevPrice24h": "0.000618",
              "price24hPcnt": "0.0024",
              "highPrice24h": "0.0006433",
              "lowPrice24h": "0.0006095",
              "turnover24h": "80249.20868804",
              "volume24h": "129702373.98"
            },
            {
              "symbol": "WIFEUR",
              "bid1Price": "0.372",
              "bid1Size": "639.4",
              "ask1Price": "0.374",
              "ask1Size": "593.3",
              "lastPrice": "0.379",
              "prevPrice24h": "0.354",
              "price24hPcnt": "0.0706",
              "highPrice24h": "0.387",
              "lowPrice24h": "0.354",
              "turnover24h": "8140.01",
              "volume24h": "22329.8"
            },
            {
              "symbol": "WCTUSDT",
              "bid1Price": "0.482",
              "bid1Size": "476.6",
              "ask1Price": "0.4822",
              "ask1Size": "72.5",
              "lastPrice": "0.4822",
              "prevPrice24h": "0.3828",
              "price24hPcnt": "0.2597",
              "highPrice24h": "0.5606",
              "lowPrice24h": "0.3586",
              "turnover24h": "14188853.45625",
              "volume24h": "30866584.5"
            },
            {
              "symbol": "TRUMPUSDC",
              "bid1Price": "8.2",
              "bid1Size": "113.6",
              "ask1Price": "8.22",
              "ask1Size": "174.51",
              "lastPrice": "8.21",
              "prevPrice24h": "8.42",
              "price24hPcnt": "-0.0249",
              "highPrice24h": "8.68",
              "lowPrice24h": "8.18",
              "turnover24h": "167988.1527",
              "volume24h": "19964.67",
              "usdIndexPrice": "8.203244"
            },
            {
              "symbol": "KILOUSDT",
              "bid1Price": "0.03964",
              "bid1Size": "5801.9",
              "ask1Price": "0.03979",
              "ask1Size": "360.4",
              "lastPrice": "0.03979",
              "prevPrice24h": "0.04102",
              "price24hPcnt": "-0.0300",
              "highPrice24h": "0.04243",
              "lowPrice24h": "0.03866",
              "turnover24h": "266051.211903",
              "volume24h": "6581672.4"
            },
            {
              "symbol": "MEWUSDT",
              "bid1Price": "0.002382",
              "bid1Size": "839441.18",
              "ask1Price": "0.002384",
              "ask1Size": "390853.19",
              "lastPrice": "0.002383",
              "prevPrice24h": "0.002452",
              "price24hPcnt": "-0.0281",
              "highPrice24h": "0.002527",
              "lowPrice24h": "0.002378",
              "turnover24h": "2035203.91277002",
              "volume24h": "831238735.11",
              "usdIndexPrice": "0.00238249"
            },
            {
              "symbol": "BRAWLUSDT",
              "bid1Price": "0.0000651",
              "bid1Size": "699308.75",
              "ask1Price": "0.0000652",
              "ask1Size": "445168.71",
              "lastPrice": "0.0000652",
              "prevPrice24h": "0.0000618",
              "price24hPcnt": "0.0550",
              "highPrice24h": "0.0000692",
              "lowPrice24h": "0.0000618",
              "turnover24h": "51939.032395703",
              "volume24h": "782871547.77"
            },
            {
              "symbol": "UMAUSDT",
              "bid1Price": "1.0955",
              "bid1Size": "74.455",
              "ask1Price": "1.0979",
              "ask1Size": "696.881",
              "lastPrice": "1.0981",
              "prevPrice24h": "1.0858",
              "price24hPcnt": "0.0113",
              "highPrice24h": "1.1264",
              "lowPrice24h": "1.0765",
              "turnover24h": "123777.1903687",
              "volume24h": "112121.828",
              "usdIndexPrice": "1.098483"
            },
            {
              "symbol": "BTCBRL",
              "bid1Price": "496220",
              "bid1Size": "0.00007",
              "ask1Price": "496845",
              "ask1Size": "0.111588",
              "lastPrice": "497435",
              "prevPrice24h": "500092",
              "price24hPcnt": "-0.0053",
              "highPrice24h": "502304",
              "lowPrice24h": "497117",
              "turnover24h": "41864.758706",
              "volume24h": "0.083761"
            },
            {
              "symbol": "PEPEUSDC",
              "bid1Price": "0.000007398",
              "bid1Size": "20409148",
              "ask1Price": "0.000007411",
              "ask1Size": "29176601",
              "lastPrice": "0.000007399",
              "prevPrice24h": "0.00000729",
              "price24hPcnt": "0.0150",
              "highPrice24h": "0.0000076",
              "lowPrice24h": "0.00000717",
              "turnover24h": "93605.67279663",
              "volume24h": "12551162121",
              "usdIndexPrice": "0.00000739762"
            },
            {
              "symbol": "ARUSDT",
              "bid1Price": "5.5",
              "bid1Size": "640.87",
              "ask1Price": "5.51",
              "ask1Size": "181.86",
              "lastPrice": "5.51",
              "prevPrice24h": "5.5",
              "price24hPcnt": "0.0018",
              "highPrice24h": "5.68",
              "lowPrice24h": "5.34",
              "turnover24h": "500271.3628",
              "volume24h": "90423.67",
              "usdIndexPrice": "5.511522"
            },
            {
              "symbol": "CHILLGUYUSDT",
              "bid1Price": "0.02114",
              "bid1Size": "657.3",
              "ask1Price": "0.02116",
              "ask1Size": "6189.8",
              "lastPrice": "0.02124",
              "prevPrice24h": "0.02141",
              "price24hPcnt": "-0.0079",
              "highPrice24h": "0.02213",
              "lowPrice24h": "0.02055",
              "turnover24h": "996805.41192",
              "volume24h": "47200753.6"
            },
            {
              "symbol": "ZRXUSDT",
              "bid1Price": "0.2553",
              "bid1Size": "900",
              "ask1Price": "0.2554",
              "ask1Size": "450",
              "lastPrice": "0.2553",
              "prevPrice24h": "0.2576",
              "price24hPcnt": "-0.0089",
              "highPrice24h": "0.2638",
              "lowPrice24h": "0.2538",
              "turnover24h": "146648.561341",
              "volume24h": "568722.8",
              "usdIndexPrice": "0.255214"
            },
            {
              "symbol": "CHZUSDC",
              "bid1Price": "0.0372",
              "bid1Size": "6146.83",
              "ask1Price": "0.0375",
              "ask1Size": "5285.77",
              "lastPrice": "0.0379",
              "prevPrice24h": "0.0371",
              "price24hPcnt": "0.0216",
              "highPrice24h": "0.0379",
              "lowPrice24h": "0.0371",
              "turnover24h": "29.623019",
              "volume24h": "781.61",
              "usdIndexPrice": "0.0372225"
            },
            {
              "symbol": "KCSUSDT",
              "bid1Price": "9.85",
              "bid1Size": "15.62",
              "ask1Price": "9.896",
              "ask1Size": "20.01",
              "lastPrice": "9.894",
              "prevPrice24h": "9.972",
              "price24hPcnt": "-0.0078",
              "highPrice24h": "10.048",
              "lowPrice24h": "9.81",
              "turnover24h": "78792.00269",
              "volume24h": "7902.42"
            },
            {
              "symbol": "GRTUSDT",
              "bid1Price": "0.0812",
              "bid1Size": "4950",
              "ask1Price": "0.08121",
              "ask1Size": "5020.89",
              "lastPrice": "0.08116",
              "prevPrice24h": "0.0811",
              "price24hPcnt": "0.0007",
              "highPrice24h": "0.08364",
              "lowPrice24h": "0.08034",
              "turnover24h": "1006494.7626963",
              "volume24h": "12302923.96",
              "usdIndexPrice": "0.0811533"
            },
            {
              "symbol": "BBSOLUSDT",
              "bid1Price": "149.69",
              "bid1Size": "9.79",
              "ask1Price": "149.95",
              "ask1Size": "0.506",
              "lastPrice": "149.54",
              "prevPrice24h": "149.37",
              "price24hPcnt": "0.0011",
              "highPrice24h": "152.51",
              "lowPrice24h": "146.69",
              "turnover24h": "268914.96155",
              "volume24h": "1793.888",
              "usdIndexPrice": "149.538492"
            },
            {
              "symbol": "JTOUSDT",
              "bid1Price": "1.657",
              "bid1Size": "872.06",
              "ask1Price": "1.659",
              "ask1Size": "2503.95",
              "lastPrice": "1.656",
              "prevPrice24h": "1.639",
              "price24hPcnt": "0.0104",
              "highPrice24h": "1.716",
              "lowPrice24h": "1.636",
              "turnover24h": "760994.67395",
              "volume24h": "453624.25",
              "usdIndexPrice": "1.657067"
            },
            {
              "symbol": "AFGUSDT",
              "bid1Price": "0.003003",
              "bid1Size": "9799.3",
              "ask1Price": "0.003019",
              "ask1Size": "2522.51",
              "lastPrice": "0.003019",
              "prevPrice24h": "0.00303",
              "price24hPcnt": "-0.0036",
              "highPrice24h": "0.003044",
              "lowPrice24h": "0.002999",
              "turnover24h": "22697.03443294",
              "volume24h": "7515363.12"
            },
            {
              "symbol": "ORDERUSDT",
              "bid1Price": "0.1042",
              "bid1Size": "4094.19",
              "ask1Price": "0.1044",
              "ask1Size": "4877.83",
              "lastPrice": "0.1044",
              "prevPrice24h": "0.0962",
              "price24hPcnt": "0.0852",
              "highPrice24h": "0.1298",
              "lowPrice24h": "0.0956",
              "turnover24h": "860808.499736",
              "volume24h": "8190328.75"
            },
            {
              "symbol": "NEARUSDT",
              "bid1Price": "2.176",
              "bid1Size": "1308.21",
              "ask1Price": "2.177",
              "ask1Size": "1204.63",
              "lastPrice": "2.176",
              "prevPrice24h": "2.111",
              "price24hPcnt": "0.0308",
              "highPrice24h": "2.207",
              "lowPrice24h": "2.088",
              "turnover24h": "5283714.829747",
              "volume24h": "2447723.7",
              "usdIndexPrice": "2.176409"
            },
            {
              "symbol": "TENETUSDT",
              "bid1Price": "0.0005461",
              "bid1Size": "17610.94",
              "ask1Price": "0.0005481",
              "ask1Size": "17545.1",
              "lastPrice": "0.000547",
              "prevPrice24h": "0.0005552",
              "price24hPcnt": "-0.0148",
              "highPrice24h": "0.000582",
              "lowPrice24h": "0.0005362",
              "turnover24h": "37646.335908672",
              "volume24h": "67493813"
            },
            {
              "symbol": "LEVERUSDT",
              "bid1Price": "0.0005112",
              "bid1Size": "393507.13",
              "ask1Price": "0.000512",
              "ask1Size": "30758.72",
              "lastPrice": "0.0005126",
              "prevPrice24h": "0.0004312",
              "price24hPcnt": "0.1888",
              "highPrice24h": "0.000616",
              "lowPrice24h": "0.0004232",
              "turnover24h": "1189964.64130979",
              "volume24h": "2360170493.15",
              "usdIndexPrice": "0.000512178"
            },
            {
              "symbol": "FETUSDT",
              "bid1Price": "0.578",
              "bid1Size": "2310.56",
              "ask1Price": "0.579",
              "ask1Size": "8462.03",
              "lastPrice": "0.578",
              "prevPrice24h": "0.526",
              "price24hPcnt": "0.0989",
              "highPrice24h": "0.58",
              "lowPrice24h": "0.524",
              "turnover24h": "2724437.093762",
              "volume24h": "4890993.79"
            },
            {
              "symbol": "LAYERUSDT",
              "bid1Price": "2.1702",
              "bid1Size": "5.1",
              "ask1Price": "2.1709",
              "ask1Size": "7.4",
              "lastPrice": "2.1729",
              "prevPrice24h": "2.0881",
              "price24hPcnt": "0.0406",
              "highPrice24h": "2.29",
              "lowPrice24h": "2.0628",
              "turnover24h": "1309336.05745",
              "volume24h": "608136.9"
            },
            {
              "symbol": "SUSHIUSDT",
              "bid1Price": "0.583",
              "bid1Size": "3215.399",
              "ask1Price": "0.584",
              "ask1Size": "935.033",
              "lastPrice": "0.584",
              "prevPrice24h": "0.571",
              "price24hPcnt": "0.0228",
              "highPrice24h": "0.598",
              "lowPrice24h": "0.566",
              "turnover24h": "298403.928444",
              "volume24h": "508491.162",
              "usdIndexPrice": "0.583398"
            },
            {
              "symbol": "BTCUSDC",
              "bid1Price": "84649",
              "bid1Size": "0.041313",
              "ask1Price": "84649.1",
              "ask1Size": "0.600712",
              "lastPrice": "84649.1",
              "prevPrice24h": "85331.1",
              "price24hPcnt": "-0.0080",
              "highPrice24h": "85653",
              "lowPrice24h": "84618.6",
              "turnover24h": "32031973.12186657",
              "volume24h": "376.038719",
              "usdIndexPrice": "84644.721367"
            },
            {
              "symbol": "GAMEUSDT",
              "bid1Price": "0.0158",
              "bid1Size": "3871",
              "ask1Price": "0.01591",
              "ask1Size": "659.52",
              "lastPrice": "0.01591",
              "prevPrice24h": "0.01653",
              "price24hPcnt": "-0.0375",
              "highPrice24h": "0.01807",
              "lowPrice24h": "0.01579",
              "turnover24h": "468199.826253",
              "volume24h": "27849623.86"
            },
            {
              "symbol": "HOTUSDT",
              "bid1Price": "0.000959",
              "bid1Size": "242971.5",
              "ask1Price": "0.000961",
              "ask1Size": "145996.6",
              "lastPrice": "0.000959",
              "prevPrice24h": "0.000953",
              "price24hPcnt": "0.0063",
              "highPrice24h": "0.000983",
              "lowPrice24h": "0.000949",
              "turnover24h": "28150.6665358",
              "volume24h": "29348758.6"
            },
            {
              "symbol": "ETH3SUSDT",
              "bid1Price": "0.015191",
              "bid1Size": "990.1173",
              "ask1Price": "0.015234",
              "ask1Size": "11515.3615",
              "lastPrice": "0.015226",
              "prevPrice24h": "0.014897",
              "price24hPcnt": "0.0221",
              "highPrice24h": "0.0153",
              "lowPrice24h": "0.014186",
              "turnover24h": "100425.1403548503",
              "volume24h": "6771407.6822"
            },
            {
              "symbol": "ALGOBTC",
              "bid1Price": "0.000002259",
              "bid1Size": "979.3",
              "ask1Price": "0.000002263",
              "ask1Size": "161.4",
              "lastPrice": "0.000002248",
              "prevPrice24h": "0.000002264",
              "price24hPcnt": "-0.0071",
              "highPrice24h": "0.000002287",
              "lowPrice24h": "0.000002238",
              "turnover24h": "0.027599543",
              "volume24h": "12157.4"
            },
            {
              "symbol": "PNUTUSDT",
              "bid1Price": "0.1345",
              "bid1Size": "46463.2",
              "ask1Price": "0.1347",
              "ask1Size": "18599.8",
              "lastPrice": "0.1345",
              "prevPrice24h": "0.1302",
              "price24hPcnt": "0.0330",
              "highPrice24h": "0.1421",
              "lowPrice24h": "0.1285",
              "turnover24h": "1087672.11543",
              "volume24h": "8083940",
              "usdIndexPrice": "0.134483"
            },
            {
              "symbol": "BOBAUSDT",
              "bid1Price": "0.07732",
              "bid1Size": "2738.54",
              "ask1Price": "0.07735",
              "ask1Size": "74.36",
              "lastPrice": "0.07731",
              "prevPrice24h": "0.07524",
              "price24hPcnt": "0.0275",
              "highPrice24h": "0.07981",
              "lowPrice24h": "0.07458",
              "turnover24h": "135142.9626916",
              "volume24h": "1755990.25"
            },
            {
              "symbol": "ZROUSDT",
              "bid1Price": "2.489",
              "bid1Size": "5.89",
              "ask1Price": "2.49",
              "ask1Size": "206.54",
              "lastPrice": "2.489",
              "prevPrice24h": "2.445",
              "price24hPcnt": "0.0180",
              "highPrice24h": "2.609",
              "lowPrice24h": "2.41",
              "turnover24h": "1433271.557773",
              "volume24h": "571935.01",
              "usdIndexPrice": "2.488162"
            },
            {
              "symbol": "MODEUSDT",
              "bid1Price": "0.002986",
              "bid1Size": "18786.29",
              "ask1Price": "0.003002",
              "ask1Size": "8193.38",
              "lastPrice": "0.002995",
              "prevPrice24h": "0.003121",
              "price24hPcnt": "-0.0404",
              "highPrice24h": "0.00323",
              "lowPrice24h": "0.002917",
              "turnover24h": "67884.73856257",
              "volume24h": "22441428.01"
            },
            {
              "symbol": "VINUUSDT",
              "bid1Price": "0.000000010882",
              "bid1Size": "816891894.65",
              "ask1Price": "0.000000010912",
              "ask1Size": "5214263876.72",
              "lastPrice": "0.000000010899",
              "prevPrice24h": "0.000000010817",
              "price24hPcnt": "0.0076",
              "highPrice24h": "0.000000011111",
              "lowPrice24h": "0.000000010386",
              "turnover24h": "65521.38547971166727",
              "volume24h": "6067544472280.32"
            },
            {
              "symbol": "SOSOUSDT",
              "bid1Price": "0.501",
              "bid1Size": "39.66",
              "ask1Price": "0.5011",
              "ask1Size": "39.66",
              "lastPrice": "0.501",
              "prevPrice24h": "0.5003",
              "price24hPcnt": "0.0014",
              "highPrice24h": "0.5091",
              "lowPrice24h": "0.4987",
              "turnover24h": "535139.489746",
              "volume24h": "1060558.2"
            },
            {
              "symbol": "WALUSDT",
              "bid1Price": "0.4187",
              "bid1Size": "89",
              "ask1Price": "0.4188",
              "ask1Size": "233.9",
              "lastPrice": "0.4187",
              "prevPrice24h": "0.4247",
              "price24hPcnt": "-0.0141",
              "highPrice24h": "0.4414",
              "lowPrice24h": "0.4157",
              "turnover24h": "3423292.51098",
              "volume24h": "8035447.7"
            },
            {
              "symbol": "SOLUSDE",
              "bid1Price": "139.52",
              "bid1Size": "14.346",
              "ask1Price": "139.58",
              "ask1Size": "82.4411",
              "lastPrice": "139.3",
              "prevPrice24h": "138.79",
              "price24hPcnt": "0.0037",
              "highPrice24h": "142",
              "lowPrice24h": "137.82",
              "turnover24h": "247567.038157",
              "volume24h": "1774.9342"
            },
            {
              "symbol": "MEMEFIUSDT",
              "bid1Price": "0.000829",
              "bid1Size": "245253",
              "ask1Price": "0.000831",
              "ask1Size": "123153",
              "lastPrice": "0.000833",
              "prevPrice24h": "0.000725",
              "price24hPcnt": "0.1490",
              "highPrice24h": "0.000848",
              "lowPrice24h": "0.000712",
              "turnover24h": "213114.233953",
              "volume24h": "272270013"
            },
            {
              "symbol": "BABY1USDT",
              "bid1Price": "0.07431",
              "bid1Size": "1083",
              "ask1Price": "0.07433",
              "ask1Size": "1362",
              "lastPrice": "0.07431",
              "prevPrice24h": "0.07029",
              "price24hPcnt": "0.0572",
              "highPrice24h": "0.07807",
              "lowPrice24h": "0.06851",
              "turnover24h": "8062094.28446",
              "volume24h": "110423787"
            },
            {
              "symbol": "AI16ZUSDT",
              "bid1Price": "0.1476",
              "bid1Size": "50875.37",
              "ask1Price": "0.1478",
              "ask1Size": "35998.24",
              "lastPrice": "0.1476",
              "prevPrice24h": "0.1353",
              "price24hPcnt": "0.0909",
              "highPrice24h": "0.1574",
              "lowPrice24h": "0.1339",
              "turnover24h": "4990793.219229",
              "volume24h": "34225054.5",
              "usdIndexPrice": "0.147609"
            },
            {
              "symbol": "VPADUSDT",
              "bid1Price": "0.004599",
              "bid1Size": "8744.43",
              "ask1Price": "0.004606",
              "ask1Size": "1801.31",
              "lastPrice": "0.004602",
              "prevPrice24h": "0.004591",
              "price24hPcnt": "0.0024",
              "highPrice24h": "0.00486",
              "lowPrice24h": "0.004529",
              "turnover24h": "40029.80140493",
              "volume24h": "8617771.49"
            },
            {
              "symbol": "SCRTUSDT",
              "bid1Price": "0.202",
              "bid1Size": "127.45",
              "ask1Price": "0.2022",
              "ask1Size": "194.96",
              "lastPrice": "0.2021",
              "prevPrice24h": "0.1938",
              "price24hPcnt": "0.0428",
              "highPrice24h": "0.2086",
              "lowPrice24h": "0.1912",
              "turnover24h": "158736.094252",
              "volume24h": "789595.86"
            },
            {
              "symbol": "GSWIFTUSDT",
              "bid1Price": "0.01332",
              "bid1Size": "1240.62",
              "ask1Price": "0.01334",
              "ask1Size": "1865.04",
              "lastPrice": "0.01333",
              "prevPrice24h": "0.01348",
              "price24hPcnt": "-0.0111",
              "highPrice24h": "0.0137",
              "lowPrice24h": "0.01284",
              "turnover24h": "129549.4625379",
              "volume24h": "9734194.31"
            },
            {
              "symbol": "GALAUSDT",
              "bid1Price": "0.01522",
              "bid1Size": "125472.15",
              "ask1Price": "0.01523",
              "ask1Size": "247871.15",
              "lastPrice": "0.01522",
              "prevPrice24h": "0.01447",
              "price24hPcnt": "0.0518",
              "highPrice24h": "0.0158",
              "lowPrice24h": "0.01446",
              "turnover24h": "2939096.2497388",
              "volume24h": "193449809.99",
              "usdIndexPrice": "0.015221"
            },
            {
              "symbol": "MANAUSDC",
              "bid1Price": "0.282",
              "bid1Size": "4.96",
              "ask1Price": "0.2821",
              "ask1Size": "2536.14",
              "lastPrice": "0.2827",
              "prevPrice24h": "0.2781",
              "price24hPcnt": "0.0165",
              "highPrice24h": "0.2954",
              "lowPrice24h": "0.2772",
              "turnover24h": "11640.170255",
              "volume24h": "40992.94",
              "usdIndexPrice": "0.281659"
            },
            {
              "symbol": "AGLAUSDT",
              "bid1Price": "0.001606",
              "bid1Size": "6484.19",
              "ask1Price": "0.0016141",
              "ask1Size": "15529.42",
              "lastPrice": "0.001612",
              "prevPrice24h": "0.0015879",
              "price24hPcnt": "0.0152",
              "highPrice24h": "0.00183",
              "lowPrice24h": "0.0015736",
              "turnover24h": "62058.762368322",
              "volume24h": "37730812.25"
            },
            {
              "symbol": "CAPSUSDT",
              "bid1Price": "0.001329",
              "bid1Size": "28471.19",
              "ask1Price": "0.001337",
              "ask1Size": "22171.53",
              "lastPrice": "0.001333",
              "prevPrice24h": "0.001336",
              "price24hPcnt": "-0.0022",
              "highPrice24h": "0.001344",
              "lowPrice24h": "0.001315",
              "turnover24h": "30807.29578734",
              "volume24h": "23142204.49"
            },
            {
              "symbol": "SERAPHUSDT",
              "bid1Price": "0.16673",
              "bid1Size": "407.2",
              "ask1Price": "0.16726",
              "ask1Size": "817",
              "lastPrice": "0.16673",
              "prevPrice24h": "0.16779",
              "price24hPcnt": "-0.0063",
              "highPrice24h": "0.16996",
              "lowPrice24h": "0.16568",
              "turnover24h": "25139.875155",
              "volume24h": "149741.6"
            },
            {
              "symbol": "ZETAUSDT",
              "bid1Price": "0.2309",
              "bid1Size": "990",
              "ask1Price": "0.2311",
              "ask1Size": "4290",
              "lastPrice": "0.2307",
              "prevPrice24h": "0.2341",
              "price24hPcnt": "-0.0145",
              "highPrice24h": "0.241",
              "lowPrice24h": "0.2267",
              "turnover24h": "629017.185266",
              "volume24h": "2690230.53",
              "usdIndexPrice": "0.230753"
            },
            {
              "symbol": "RPKUSDT",
              "bid1Price": "0.001362",
              "bid1Size": "20715.38",
              "ask1Price": "0.001365",
              "ask1Size": "11546.94",
              "lastPrice": "0.001363",
              "prevPrice24h": "0.001317",
              "price24hPcnt": "0.0349",
              "highPrice24h": "0.00143",
              "lowPrice24h": "0.001274",
              "turnover24h": "57281.86859683",
              "volume24h": "43633814.28"
            },
            {
              "symbol": "BELUSDT",
              "bid1Price": "0.4301",
              "bid1Size": "119.54",
              "ask1Price": "0.4313",
              "ask1Size": "543.27",
              "lastPrice": "0.4307",
              "prevPrice24h": "0.4708",
              "price24hPcnt": "-0.0852",
              "highPrice24h": "0.4765",
              "lowPrice24h": "0.4136",
              "turnover24h": "278765.288547",
              "volume24h": "610259.02"
            },
            {
              "symbol": "AVAXEUR",
              "bid1Price": "17.25",
              "bid1Size": "11.63",
              "ask1Price": "17.28",
              "ask1Size": "23.9",
              "lastPrice": "17.25",
              "prevPrice24h": "17.13",
              "price24hPcnt": "0.0070",
              "highPrice24h": "17.77",
              "lowPrice24h": "17.13",
              "turnover24h": "8697.502",
              "volume24h": "501.58"
            },
            {
              "symbol": "LOOKSUSDT",
              "bid1Price": "0.01019",
              "bid1Size": "11475",
              "ask1Price": "0.01021",
              "ask1Size": "13017.62",
              "lastPrice": "0.01024",
              "prevPrice24h": "0.01049",
              "price24hPcnt": "-0.0238",
              "highPrice24h": "0.01107",
              "lowPrice24h": "0.00998",
              "turnover24h": "230129.4257222",
              "volume24h": "21977066.87"
            },
            {
              "symbol": "NEIROCTOUSDT",
              "bid1Price": "0.0001826",
              "bid1Size": "486278",
              "ask1Price": "0.0001827",
              "ask1Size": "419440",
              "lastPrice": "0.0001825",
              "prevPrice24h": "0.0001812",
              "price24hPcnt": "0.0072",
              "highPrice24h": "0.0001944",
              "lowPrice24h": "0.0001745",
              "turnover24h": "249184.5831782",
              "volume24h": "1347019053"
            },
            {
              "symbol": "OLUSDT",
              "bid1Price": "0.05864",
              "bid1Size": "5706",
              "ask1Price": "0.05879",
              "ask1Size": "8681",
              "lastPrice": "0.05877",
              "prevPrice24h": "0.05374",
              "price24hPcnt": "0.0936",
              "highPrice24h": "0.06356",
              "lowPrice24h": "0.05239",
              "turnover24h": "2349187.35317",
              "volume24h": "40853753"
            },
            {
              "symbol": "SAILUSDT",
              "bid1Price": "0.0008328",
              "bid1Size": "86567.42",
              "ask1Price": "0.0008395",
              "ask1Size": "17915.76",
              "lastPrice": "0.0008367",
              "prevPrice24h": "0.0008379",
              "price24hPcnt": "-0.0014",
              "highPrice24h": "0.0009058",
              "lowPrice24h": "0.0008308",
              "turnover24h": "44863.837927106",
              "volume24h": "53368853.51"
            },
            {
              "symbol": "STRKUSDC",
              "bid1Price": "0.1307",
              "bid1Size": "5103.56",
              "ask1Price": "0.1308",
              "ask1Size": "4812.03",
              "lastPrice": "0.1309",
              "prevPrice24h": "0.1262",
              "price24hPcnt": "0.0372",
              "highPrice24h": "0.1354",
              "lowPrice24h": "0.1242",
              "turnover24h": "127062.767423",
              "volume24h": "976836.43",
              "usdIndexPrice": "0.130677"
            },
            {
              "symbol": "XECUSDT",
              "bid1Price": "0.0000202",
              "bid1Size": "111435177.6",
              "ask1Price": "0.00002025",
              "ask1Size": "12204424.8",
              "lastPrice": "0.00002028",
              "prevPrice24h": "0.00002013",
              "price24hPcnt": "0.0075",
              "highPrice24h": "0.00002071",
              "lowPrice24h": "0.00001999",
              "turnover24h": "52606.858872939",
              "volume24h": "2587075714.2"
            },
            {
              "symbol": "FARUSDT",
              "bid1Price": "0.001323",
              "bid1Size": "6756.94",
              "ask1Price": "0.001328",
              "ask1Size": "25616.46",
              "lastPrice": "0.001326",
              "prevPrice24h": "0.001382",
              "price24hPcnt": "-0.0405",
              "highPrice24h": "0.001467",
              "lowPrice24h": "0.0013",
              "turnover24h": "171443.13116365",
              "volume24h": "126648290.08"
            },
            {
              "symbol": "SALDUSDT",
              "bid1Price": "0.0002089",
              "bid1Size": "76792.72",
              "ask1Price": "0.0002095",
              "ask1Size": "85395.66",
              "lastPrice": "0.0002093",
              "prevPrice24h": "0.000203",
              "price24hPcnt": "0.0310",
              "highPrice24h": "0.0002106",
              "lowPrice24h": "0.0002",
              "turnover24h": "27857.43287406",
              "volume24h": "136951142.24"
            },
            {
              "symbol": "PYTHUSDT",
              "bid1Price": "0.1407",
              "bid1Size": "21451.25",
              "ask1Price": "0.1408",
              "ask1Size": "4229.07",
              "lastPrice": "0.1407",
              "prevPrice24h": "0.1384",
              "price24hPcnt": "0.0166",
              "highPrice24h": "0.1455",
              "lowPrice24h": "0.1376",
              "turnover24h": "2051530.3248605",
              "volume24h": "14556726.75",
              "usdIndexPrice": "0.140715"
            },
            {
              "symbol": "CTAUSDT",
              "bid1Price": "0.01904",
              "bid1Size": "1171.54",
              "ask1Price": "0.01913",
              "ask1Size": "387.28",
              "lastPrice": "0.01905",
              "prevPrice24h": "0.01867",
              "price24hPcnt": "0.0204",
              "highPrice24h": "0.01916",
              "lowPrice24h": "0.0184",
              "turnover24h": "21109.9915934",
              "volume24h": "1128284.23"
            },
            {
              "symbol": "AVAXUSDT",
              "bid1Price": "19.65",
              "bid1Size": "309.336",
              "ask1Price": "19.66",
              "ask1Size": "226.526",
              "lastPrice": "19.65",
              "prevPrice24h": "19.54",
              "price24hPcnt": "0.0056",
              "highPrice24h": "20.36",
              "lowPrice24h": "19.47",
              "turnover24h": "3751018.52563",
              "volume24h": "188855.27",
              "usdIndexPrice": "19.649945"
            },
            {
              "symbol": "BBSOLSOL",
              "bid1Price": "1.0745",
              "bid1Size": "588.905",
              "ask1Price": "1.0746",
              "ask1Size": "2839.162",
              "lastPrice": "1.0746",
              "prevPrice24h": "1.0754",
              "price24hPcnt": "-0.0007",
              "highPrice24h": "1.0755",
              "lowPrice24h": "1.0745",
              "turnover24h": "4437.2446918",
              "volume24h": "4125.908"
            },
            {
              "symbol": "RUNEUSDT",
              "bid1Price": "1.167",
              "bid1Size": "2769.81",
              "ask1Price": "1.168",
              "ask1Size": "1398.57",
              "lastPrice": "1.168",
              "prevPrice24h": "1.154",
              "price24hPcnt": "0.0121",
              "highPrice24h": "1.19",
              "lowPrice24h": "1.143",
              "turnover24h": "744177.88573",
              "volume24h": "635788.12",
              "usdIndexPrice": "1.16792"
            },
            {
              "symbol": "PORTALUSDT",
              "bid1Price": "0.08083",
              "bid1Size": "3150",
              "ask1Price": "0.08093",
              "ask1Size": "3150",
              "lastPrice": "0.0808",
              "prevPrice24h": "0.07611",
              "price24hPcnt": "0.0616",
              "highPrice24h": "0.0865",
              "lowPrice24h": "0.07468",
              "turnover24h": "1111204.8938293",
              "volume24h": "13859923.32",
              "usdIndexPrice": "0.0808856"
            },
            {
              "symbol": "SDUSDT",
              "bid1Price": "0.4763",
              "bid1Size": "117.17",
              "ask1Price": "0.4779",
              "ask1Size": "663",
              "lastPrice": "0.476",
              "prevPrice24h": "0.4747",
              "price24hPcnt": "0.0027",
              "highPrice24h": "0.4849",
              "lowPrice24h": "0.4667",
              "turnover24h": "76131.111812",
              "volume24h": "160351.32"
            },
            {
              "symbol": "USDTBUSDT",
              "bid1Price": "1.0003",
              "bid1Size": "24530.7",
              "ask1Price": "1.0005",
              "ask1Size": "6433007.35",
              "lastPrice": "1.0005",
              "prevPrice24h": "1.0003",
              "price24hPcnt": "0.0002",
              "highPrice24h": "1.0005",
              "lowPrice24h": "1.0003",
              "turnover24h": "700794.036173",
              "volume24h": "700454.97",
              "usdIndexPrice": "1.00049"
            },
            {
              "symbol": "USDRUSDT",
              "bid1Price": "0.9999",
              "bid1Size": "299.58",
              "ask1Price": "1.0198",
              "ask1Size": "442.34",
              "lastPrice": "0.9999",
              "prevPrice24h": "1.0199",
              "price24hPcnt": "-0.0196",
              "highPrice24h": "1.02",
              "lowPrice24h": "0.9997",
              "turnover24h": "1394.480743",
              "volume24h": "1370.74"
            },
            {
              "symbol": "ICPUSDT",
              "bid1Price": "4.834",
              "bid1Size": "117",
              "ask1Price": "4.835",
              "ask1Size": "117",
              "lastPrice": "4.834",
              "prevPrice24h": "4.857",
              "price24hPcnt": "-0.0047",
              "highPrice24h": "4.96",
              "lowPrice24h": "4.787",
              "turnover24h": "3395162.52235",
              "volume24h": "697385.13",
              "usdIndexPrice": "4.833991"
            },
            {
              "symbol": "MAKUSDT",
              "bid1Price": "0.00415",
              "bid1Size": "89926.27",
              "ask1Price": "0.00418",
              "ask1Size": "210449.03",
              "lastPrice": "0.00417",
              "prevPrice24h": "0.00442",
              "price24hPcnt": "-0.0566",
              "highPrice24h": "0.00443",
              "lowPrice24h": "0.00416",
              "turnover24h": "100378.2983011",
              "volume24h": "23301250.61"
            },
            {
              "symbol": "JUVUSDT",
              "bid1Price": "0.969",
              "bid1Size": "45.53",
              "ask1Price": "0.9697",
              "ask1Size": "10",
              "lastPrice": "0.9697",
              "prevPrice24h": "0.9637",
              "price24hPcnt": "0.0062",
              "highPrice24h": "0.9863",
              "lowPrice24h": "0.9507",
              "turnover24h": "41686.836792",
              "volume24h": "42985.27"
            },
            {
              "symbol": "SOLEUR",
              "bid1Price": "122.41",
              "bid1Size": "2.717",
              "ask1Price": "122.64",
              "ask1Size": "3.64",
              "lastPrice": "122.74",
              "prevPrice24h": "122.44",
              "price24hPcnt": "0.0025",
              "highPrice24h": "124.59",
              "lowPrice24h": "121",
              "turnover24h": "109301.92121",
              "volume24h": "893.063"
            },
            {
              "symbol": "KDAUSDT",
              "bid1Price": "0.4669",
              "bid1Size": "540",
              "ask1Price": "0.4672",
              "ask1Size": "1182.95",
              "lastPrice": "0.4667",
              "prevPrice24h": "0.4449",
              "price24hPcnt": "0.0490",
              "highPrice24h": "0.4766",
              "lowPrice24h": "0.4418",
              "turnover24h": "746418.417674",
              "volume24h": "1630669.55",
              "usdIndexPrice": "0.466684"
            },
            {
              "symbol": "BRETTUSDT",
              "bid1Price": "0.03436",
              "bid1Size": "14543.33",
              "ask1Price": "0.0344",
              "ask1Size": "2477.88",
              "lastPrice": "0.03433",
              "prevPrice24h": "0.03664",
              "price24hPcnt": "-0.0630",
              "highPrice24h": "0.03813",
              "lowPrice24h": "0.03249",
              "turnover24h": "4635616.6960788",
              "volume24h": "130675280.48",
              "usdIndexPrice": "0.0343407"
            },
            {
              "symbol": "SUPRAUSDT",
              "bid1Price": "0.00476",
              "bid1Size": "50932",
              "ask1Price": "0.00477",
              "ask1Size": "60000",
              "lastPrice": "0.00477",
              "prevPrice24h": "0.00509",
              "price24hPcnt": "-0.0629",
              "highPrice24h": "0.00514",
              "lowPrice24h": "0.00476",
              "turnover24h": "206223.17794",
              "volume24h": "41484590"
            },
            {
              "symbol": "COMPUSDT",
              "bid1Price": "39.79",
              "bid1Size": "5.85",
              "ask1Price": "39.81",
              "ask1Size": "5.85",
              "lastPrice": "39.8",
              "prevPrice24h": "39.71",
              "price24hPcnt": "0.0023",
              "highPrice24h": "40.68",
              "lowPrice24h": "39.55",
              "turnover24h": "129761.26084",
              "volume24h": "3236.118",
              "usdIndexPrice": "39.801174"
            },
            {
              "symbol": "MIXUSDT",
              "bid1Price": "0.001063",
              "bid1Size": "9758.65",
              "ask1Price": "0.001064",
              "ask1Size": "699.31",
              "lastPrice": "0.001063",
              "prevPrice24h": "0.001064",
              "price24hPcnt": "-0.0009",
              "highPrice24h": "0.001094",
              "lowPrice24h": "0.001055",
              "turnover24h": "91979.70051952",
              "volume24h": "86174880.52"
            },
            {
              "symbol": "SWEATUSDT",
              "bid1Price": "0.00413",
              "bid1Size": "264.17",
              "ask1Price": "0.004136",
              "ask1Size": "2180.3",
              "lastPrice": "0.004135",
              "prevPrice24h": "0.004163",
              "price24hPcnt": "-0.0067",
              "highPrice24h": "0.0043",
              "lowPrice24h": "0.004097",
              "turnover24h": "340441.47043351",
              "volume24h": "81575961.37"
            },
            {
              "symbol": "HMSTRUSDT",
              "bid1Price": "0.002606",
              "bid1Size": "90000",
              "ask1Price": "0.002607",
              "ask1Size": "90000",
              "lastPrice": "0.002606",
              "prevPrice24h": "0.002599",
              "price24hPcnt": "0.0027",
              "highPrice24h": "0.002642",
              "lowPrice24h": "0.00258",
              "turnover24h": "1453611.83896341",
              "volume24h": "557590631.21",
              "usdIndexPrice": "0.00260717"
            },
            {
              "symbol": "PSGUSDT",
              "bid1Price": "1.9338",
              "bid1Size": "13.75",
              "ask1Price": "1.9351",
              "ask1Size": "26.62",
              "lastPrice": "1.9351",
              "prevPrice24h": "1.9375",
              "price24hPcnt": "-0.0012",
              "highPrice24h": "1.9534",
              "lowPrice24h": "1.9134",
              "turnover24h": "50944.34281",
              "volume24h": "26331.33"
            },
            {
              "symbol": "XEMUSDT",
              "bid1Price": "0.01681",
              "bid1Size": "2748",
              "ask1Price": "0.01684",
              "ask1Size": "822.11",
              "lastPrice": "0.01682",
              "prevPrice24h": "0.01681",
              "price24hPcnt": "0.0006",
              "highPrice24h": "0.01795",
              "lowPrice24h": "0.01665",
              "turnover24h": "35960.3607821",
              "volume24h": "2073906.36"
            },
            {
              "symbol": "XLMBTC",
              "bid1Price": "0.0000028812",
              "bid1Size": "5230.2",
              "ask1Price": "0.0000028896",
              "ask1Size": "2543.2",
              "lastPrice": "0.0000029063",
              "prevPrice24h": "0.0000029007",
              "price24hPcnt": "0.0019",
              "highPrice24h": "0.0000029179",
              "lowPrice24h": "0.0000028722",
              "turnover24h": "0.3567850044",
              "volume24h": "123405.4"
            },
            {
              "symbol": "BTC3LUSDT",
              "bid1Price": "3.9754",
              "bid1Size": "49.0832",
              "ask1Price": "3.9788",
              "ask1Size": "8.3988",
              "lastPrice": "3.9735",
              "prevPrice24h": "4.0651",
              "price24hPcnt": "-0.0225",
              "highPrice24h": "4.0989",
              "lowPrice24h": "3.9735",
              "turnover24h": "410607.41304948",
              "volume24h": "101746.4148"
            },
            {
              "symbol": "WLDEUR",
              "bid1Price": "0.659",
              "bid1Size": "622.69",
              "ask1Price": "0.661",
              "ask1Size": "524.89",
              "lastPrice": "0.661",
              "prevPrice24h": "0.628",
              "price24hPcnt": "0.0525",
              "highPrice24h": "0.679",
              "lowPrice24h": "0.628",
              "turnover24h": "2808.63132",
              "volume24h": "4216.46"
            },
            {
              "symbol": "KASUSDC",
              "bid1Price": "0.07684",
              "bid1Size": "2912.96",
              "ask1Price": "0.07718",
              "ask1Size": "2977.93",
              "lastPrice": "0.07723",
              "prevPrice24h": "0.07756",
              "price24hPcnt": "-0.0043",
              "highPrice24h": "0.07893",
              "lowPrice24h": "0.07663",
              "turnover24h": "16424.2967824",
              "volume24h": "212115.2",
              "usdIndexPrice": "0.0770726"
            },
            {
              "symbol": "USDEUSDT",
              "bid1Price": "0.9992",
              "bid1Size": "3690.13",
              "ask1Price": "0.9993",
              "ask1Size": "131197.98",
              "lastPrice": "0.9992",
              "prevPrice24h": "0.9994",
              "price24hPcnt": "-0.0002",
              "highPrice24h": "0.9995",
              "lowPrice24h": "0.9992",
              "turnover24h": "4141707.577545",
              "volume24h": "4144598.39",
              "usdIndexPrice": "0.999014"
            },
            {
              "symbol": "FLOKIUSDT",
              "bid1Price": "0.00005724",
              "bid1Size": "200000",
              "ask1Price": "0.00005726",
              "ask1Size": "400000",
              "lastPrice": "0.0000572",
              "prevPrice24h": "0.0000571",
              "price24hPcnt": "0.0018",
              "highPrice24h": "0.00005962",
              "lowPrice24h": "0.00005661",
              "turnover24h": "273752.754815016",
              "volume24h": "4721587645.6",
              "usdIndexPrice": "0.0000572528"
            },
            {
              "symbol": "ONDOUSDC",
              "bid1Price": "0.8403",
              "bid1Size": "101.25",
              "ask1Price": "0.8406",
              "ask1Size": "101.25",
              "lastPrice": "0.8392",
              "prevPrice24h": "0.8463",
              "price24hPcnt": "-0.0084",
              "highPrice24h": "0.862",
              "lowPrice24h": "0.8372",
              "turnover24h": "34918.6634722",
              "volume24h": "41159.83",
              "usdIndexPrice": "0.840314"
            },
            {
              "symbol": "WELLUSDT",
              "bid1Price": "0.000163",
              "bid1Size": "204478",
              "ask1Price": "0.0001637",
              "ask1Size": "141569",
              "lastPrice": "0.0001632",
              "prevPrice24h": "0.0001654",
              "price24hPcnt": "-0.0133",
              "highPrice24h": "0.0001681",
              "lowPrice24h": "0.000163",
              "turnover24h": "187977.2550901",
              "volume24h": "1142583632"
            },
            {
              "symbol": "JUSDT",
              "bid1Price": "0.2195",
              "bid1Size": "1380.6",
              "ask1Price": "0.2198",
              "ask1Size": "2475.25",
              "lastPrice": "0.2198",
              "prevPrice24h": "0.2258",
              "price24hPcnt": "-0.0266",
              "highPrice24h": "0.2277",
              "lowPrice24h": "0.2142",
              "turnover24h": "332480.655065",
              "volume24h": "1514648.72",
              "usdIndexPrice": "0.219662"
            },
            {
              "symbol": "FTTUSDT",
              "bid1Price": "0.8306",
              "bid1Size": "12.079",
              "ask1Price": "0.8313",
              "ask1Size": "12.079",
              "lastPrice": "0.8317",
              "prevPrice24h": "0.8133",
              "price24hPcnt": "0.0226",
              "highPrice24h": "0.8491",
              "lowPrice24h": "0.7959",
              "turnover24h": "107571.1861054",
              "volume24h": "131067.39"
            },
            {
              "symbol": "TOKENUSDT",
              "bid1Price": "0.01356",
              "bid1Size": "28281.41",
              "ask1Price": "0.01357",
              "ask1Size": "17805.47",
              "lastPrice": "0.01358",
              "prevPrice24h": "0.01325",
              "price24hPcnt": "0.0249",
              "highPrice24h": "0.01421",
              "lowPrice24h": "0.01305",
              "turnover24h": "598276.3771034",
              "volume24h": "43830895.54"
            },
            {
              "symbol": "XIONUSDT",
              "bid1Price": "0.9858",
              "bid1Size": "15.98",
              "ask1Price": "0.9874",
              "ask1Size": "102.39",
              "lastPrice": "0.9872",
              "prevPrice24h": "0.9593",
              "price24hPcnt": "0.0291",
              "highPrice24h": "1.0048",
              "lowPrice24h": "0.9488",
              "turnover24h": "137286.746114",
              "volume24h": "141037.25"
            },
            {
              "symbol": "WOOUSDT",
              "bid1Price": "0.05766",
              "bid1Size": "5203.18",
              "ask1Price": "0.0577",
              "ask1Size": "5200.24",
              "lastPrice": "0.05771",
              "prevPrice24h": "0.05807",
              "price24hPcnt": "-0.0062",
              "highPrice24h": "0.06149",
              "lowPrice24h": "0.05662",
              "turnover24h": "1013516.7823072",
              "volume24h": "17270162.58",
              "usdIndexPrice": "0.0576685"
            },
            {
              "symbol": "NFTUSDT",
              "bid1Price": "0.0000004214",
              "bid1Size": "6083213256",
              "ask1Price": "0.0000004215",
              "ask1Size": "1779359430",
              "lastPrice": "0.0000004214",
              "prevPrice24h": "0.0000004188",
              "price24hPcnt": "0.0062",
              "highPrice24h": "0.0000004223",
              "lowPrice24h": "0.0000004188",
              "turnover24h": "34121.1255348338",
              "volume24h": "81066077104"
            },
            {
              "symbol": "WEETHETH",
              "bid1Price": "1.0585",
              "bid1Size": "0.1118",
              "ask1Price": "1.0602",
              "ask1Size": "0.1033",
              "lastPrice": "1.0597",
              "prevPrice24h": "1.0615",
              "price24hPcnt": "-0.0017",
              "highPrice24h": "1.0615",
              "lowPrice24h": "1.0597",
              "turnover24h": "0.03550142",
              "volume24h": "0.0335"
            },
            {
              "symbol": "BRETTUSDC",
              "bid1Price": "0.0342",
              "bid1Size": "6686",
              "ask1Price": "0.03452",
              "ask1Size": "12474",
              "lastPrice": "0.03422",
              "prevPrice24h": "0.03626",
              "price24hPcnt": "-0.0563",
              "highPrice24h": "0.03805",
              "lowPrice24h": "0.03258",
              "turnover24h": "18199.24313",
              "volume24h": "524673",
              "usdIndexPrice": "0.0343407"
            },
            {
              "symbol": "BATUSDT",
              "bid1Price": "0.1305",
              "bid1Size": "13018.97",
              "ask1Price": "0.1308",
              "ask1Size": "16855.6",
              "lastPrice": "0.131",
              "prevPrice24h": "0.1311",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "0.1341",
              "lowPrice24h": "0.13",
              "turnover24h": "10968.130962",
              "volume24h": "83290.75",
              "usdIndexPrice": "0.130587"
            },
            {
              "symbol": "GALFTUSDT",
              "bid1Price": "1.662",
              "bid1Size": "30.09",
              "ask1Price": "1.664",
              "ask1Size": "33.51",
              "lastPrice": "1.663",
              "prevPrice24h": "1.659",
              "price24hPcnt": "0.0024",
              "highPrice24h": "1.698",
              "lowPrice24h": "1.655",
              "turnover24h": "31713.71029",
              "volume24h": "19038.41"
            },
            {
              "symbol": "BTCBRZ",
              "bid1Price": "475000.2",
              "bid1Size": "0.006027",
              "ask1Price": "516924.8",
              "ask1Size": "0.000168",
              "lastPrice": "475000.4",
              "prevPrice24h": "500709.6",
              "price24hPcnt": "-0.0513",
              "highPrice24h": "516924.6",
              "lowPrice24h": "475000.4",
              "turnover24h": "34800.5623508",
              "volume24h": "0.069477"
            },
            {
              "symbol": "LDOUSDT",
              "bid1Price": "0.707",
              "bid1Size": "14189.3",
              "ask1Price": "0.708",
              "ask1Size": "2793.93",
              "lastPrice": "0.708",
              "prevPrice24h": "0.7",
              "price24hPcnt": "0.0114",
              "highPrice24h": "0.727",
              "lowPrice24h": "0.692",
              "turnover24h": "1863386.956592",
              "volume24h": "2610195.19",
              "usdIndexPrice": "0.707804"
            },
            {
              "symbol": "EGLDUSDT",
              "bid1Price": "14.38",
              "bid1Size": "19.8",
              "ask1Price": "14.39",
              "ask1Size": "231.615",
              "lastPrice": "14.37",
              "prevPrice24h": "14.19",
              "price24hPcnt": "0.0127",
              "highPrice24h": "14.91",
              "lowPrice24h": "14.08",
              "turnover24h": "348545.59094",
              "volume24h": "23995.976",
              "usdIndexPrice": "14.385486"
            },
            {
              "symbol": "REDUSDT",
              "bid1Price": "0.4001",
              "bid1Size": "1167.59",
              "ask1Price": "0.4005",
              "ask1Size": "464.41",
              "lastPrice": "0.4",
              "prevPrice24h": "0.3575",
              "price24hPcnt": "0.1189",
              "highPrice24h": "0.405",
              "lowPrice24h": "0.3506",
              "turnover24h": "801441.415679",
              "volume24h": "2132003.16"
            },
            {
              "symbol": "TNSRUSDT",
              "bid1Price": "0.1313",
              "bid1Size": "1845",
              "ask1Price": "0.1314",
              "ask1Size": "1845",
              "lastPrice": "0.1314",
              "prevPrice24h": "0.1276",
              "price24hPcnt": "0.0298",
              "highPrice24h": "0.1373",
              "lowPrice24h": "0.1245",
              "turnover24h": "346368.939372",
              "volume24h": "2619494.59",
              "usdIndexPrice": "0.131432"
            },
            {
              "symbol": "ADAUSDC",
              "bid1Price": "0.623",
              "bid1Size": "540",
              "ask1Price": "0.6231",
              "ask1Size": "540",
              "lastPrice": "0.6231",
              "prevPrice24h": "0.6309",
              "price24hPcnt": "-0.0124",
              "highPrice24h": "0.6345",
              "lowPrice24h": "0.6191",
              "turnover24h": "394562.403902",
              "volume24h": "628006.78",
              "usdIndexPrice": "0.62292"
            },
            {
              "symbol": "LLUSDT",
              "bid1Price": "0.01233",
              "bid1Size": "9547.6",
              "ask1Price": "0.01237",
              "ask1Size": "874595.35",
              "lastPrice": "0.01237",
              "prevPrice24h": "0.01258",
              "price24hPcnt": "-0.0167",
              "highPrice24h": "0.01263",
              "lowPrice24h": "0.01228",
              "turnover24h": "29764.0068604",
              "volume24h": "2395065.49"
            },
            {
              "symbol": "ETHDAI",
              "bid1Price": "1584.55",
              "bid1Size": "0.75",
              "ask1Price": "1602.02",
              "ask1Size": "0.75",
              "lastPrice": "1602.74",
              "prevPrice24h": "1606.33",
              "price24hPcnt": "-0.0022",
              "highPrice24h": "1630.72",
              "lowPrice24h": "1590.13",
              "turnover24h": "8515.8765428",
              "volume24h": "5.32784"
            },
            {
              "symbol": "SCRUSDT",
              "bid1Price": "0.24",
              "bid1Size": "4192.9",
              "ask1Price": "0.241",
              "ask1Size": "3387.5",
              "lastPrice": "0.24",
              "prevPrice24h": "0.233",
              "price24hPcnt": "0.0300",
              "highPrice24h": "0.25",
              "lowPrice24h": "0.229",
              "turnover24h": "202483.8682",
              "volume24h": "848110.3",
              "usdIndexPrice": "0.240568"
            },
            {
              "symbol": "OIKUSDT",
              "bid1Price": "0.0145",
              "bid1Size": "676.4",
              "ask1Price": "0.01456",
              "ask1Size": "1021.3",
              "lastPrice": "0.0145",
              "prevPrice24h": "0.0161",
              "price24hPcnt": "-0.0994",
              "highPrice24h": "0.01702",
              "lowPrice24h": "0.01426",
              "turnover24h": "207868.895363",
              "volume24h": "13625242.3"
            },
            {
              "symbol": "DIAMUSDT",
              "bid1Price": "0.00998",
              "bid1Size": "33704",
              "ask1Price": "0.01",
              "ask1Size": "904",
              "lastPrice": "0.01",
              "prevPrice24h": "0.00972",
              "price24hPcnt": "0.0288",
              "highPrice24h": "0.01002",
              "lowPrice24h": "0.0097",
              "turnover24h": "26266.96916",
              "volume24h": "2649881"
            },
            {
              "symbol": "LTCUSDT",
              "bid1Price": "76.37",
              "bid1Size": "17.22927",
              "ask1Price": "76.38",
              "ask1Size": "14.9449",
              "lastPrice": "76.36",
              "prevPrice24h": "76.33",
              "price24hPcnt": "0.0004",
              "highPrice24h": "76.97",
              "lowPrice24h": "74.24",
              "turnover24h": "7444969.9264706",
              "volume24h": "98154.16418",
              "usdIndexPrice": "76.339647"
            },
            {
              "symbol": "SEIUSDC",
              "bid1Price": "0.1705",
              "bid1Size": "1920.43",
              "ask1Price": "0.1708",
              "ask1Size": "92.26",
              "lastPrice": "0.1707",
              "prevPrice24h": "0.1703",
              "price24hPcnt": "0.0023",
              "highPrice24h": "0.1752",
              "lowPrice24h": "0.1698",
              "turnover24h": "7310.062052",
              "volume24h": "42204.88",
              "usdIndexPrice": "0.170699"
            },
            {
              "symbol": "ICXUSDT",
              "bid1Price": "0.09853",
              "bid1Size": "2340",
              "ask1Price": "0.09859",
              "ask1Size": "1170",
              "lastPrice": "0.09857",
              "prevPrice24h": "0.0999",
              "price24hPcnt": "-0.0133",
              "highPrice24h": "0.1013",
              "lowPrice24h": "0.09833",
              "turnover24h": "117394.0457971",
              "volume24h": "1179858.42"
            },
            {
              "symbol": "BONKUSDT",
              "bid1Price": "0.00001222",
              "bid1Size": "131270929.5",
              "ask1Price": "0.00001223",
              "ask1Size": "77664535.7",
              "lastPrice": "0.00001222",
              "prevPrice24h": "0.00001221",
              "price24hPcnt": "0.0008",
              "highPrice24h": "0.00001274",
              "lowPrice24h": "0.00001207",
              "turnover24h": "2544430.707317788",
              "volume24h": "204912852613.7",
              "usdIndexPrice": "0.0000122187"
            },
            {
              "symbol": "ACSUSDT",
              "bid1Price": "0.0011773",
              "bid1Size": "10075.56",
              "ask1Price": "0.0011802",
              "ask1Size": "16424.79",
              "lastPrice": "0.0011773",
              "prevPrice24h": "0.0011713",
              "price24hPcnt": "0.0051",
              "highPrice24h": "0.0011853",
              "lowPrice24h": "0.0011631",
              "turnover24h": "27260.391914611",
              "volume24h": "23230023.06"
            },
            {
              "symbol": "IOUSDT",
              "bid1Price": "0.647",
              "bid1Size": "3976.01",
              "ask1Price": "0.648",
              "ask1Size": "6960.83",
              "lastPrice": "0.647",
              "prevPrice24h": "0.612",
              "price24hPcnt": "0.0572",
              "highPrice24h": "0.68",
              "lowPrice24h": "0.602",
              "turnover24h": "1529945.55352",
              "volume24h": "2348132.91",
              "usdIndexPrice": "0.646991"
            },
            {
              "symbol": "COOKUSDT",
              "bid1Price": "0.006853",
              "bid1Size": "1251",
              "ask1Price": "0.006864",
              "ask1Size": "7310",
              "lastPrice": "0.006852",
              "prevPrice24h": "0.008234",
              "price24hPcnt": "-0.1678",
              "highPrice24h": "0.008267",
              "lowPrice24h": "0.006607",
              "turnover24h": "1136824.38288",
              "volume24h": "159233326"
            },
            {
              "symbol": "QNTUSDT",
              "bid1Price": "65.28",
              "bid1Size": "3.42",
              "ask1Price": "65.29",
              "ask1Size": "3.42",
              "lastPrice": "65.25",
              "prevPrice24h": "64.49",
              "price24hPcnt": "0.0118",
              "highPrice24h": "66.65",
              "lowPrice24h": "63.81",
              "turnover24h": "461223.28773",
              "volume24h": "7075.399",
              "usdIndexPrice": "65.269681"
            },
            {
              "symbol": "USDTEUR",
              "bid1Price": "0.8782",
              "bid1Size": "290.75",
              "ask1Price": "0.8783",
              "ask1Size": "4.62",
              "lastPrice": "0.8782",
              "prevPrice24h": "0.878",
              "price24hPcnt": "0.0002",
              "highPrice24h": "0.8785",
              "lowPrice24h": "0.8774",
              "turnover24h": "488713.677335",
              "volume24h": "556597.47"
            },
            {
              "symbol": "B3TRUSDT",
              "bid1Price": "0.1258",
              "bid1Size": "2374.9",
              "ask1Price": "0.1261",
              "ask1Size": "1047.6",
              "lastPrice": "0.1258",
              "prevPrice24h": "0.1259",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "0.127",
              "lowPrice24h": "0.1256",
              "turnover24h": "46342.66984",
              "volume24h": "370703.6"
            },
            {
              "symbol": "MOGUSDT",
              "bid1Price": "0.0000004506",
              "bid1Size": "157191511.5",
              "ask1Price": "0.0000004513",
              "ask1Size": "1134506948.2",
              "lastPrice": "0.000000451",
              "prevPrice24h": "0.0000004542",
              "price24hPcnt": "-0.0070",
              "highPrice24h": "0.0000004753",
              "lowPrice24h": "0.0000004476",
              "turnover24h": "264229.69580347135",
              "volume24h": "572064116606.6",
              "usdIndexPrice": "0.000000450779"
            },
            {
              "symbol": "PELLUSDT",
              "bid1Price": "0.003879",
              "bid1Size": "38780",
              "ask1Price": "0.00389",
              "ask1Size": "2082",
              "lastPrice": "0.003885",
              "prevPrice24h": "0.003997",
              "price24hPcnt": "-0.0280",
              "highPrice24h": "0.004194",
              "lowPrice24h": "0.003817",
              "turnover24h": "96983.525693",
              "volume24h": "24814715"
            },
            {
              "symbol": "GTAIUSDT",
              "bid1Price": "0.1146",
              "bid1Size": "195.93",
              "ask1Price": "0.1149",
              "ask1Size": "103.46",
              "lastPrice": "0.1147",
              "prevPrice24h": "0.111",
              "price24hPcnt": "0.0333",
              "highPrice24h": "0.1169",
              "lowPrice24h": "0.1085",
              "turnover24h": "45242.728197",
              "volume24h": "399805.06"
            },
            {
              "symbol": "CTCUSDT",
              "bid1Price": "0.5535",
              "bid1Size": "49.85",
              "ask1Price": "0.5536",
              "ask1Size": "25.5",
              "lastPrice": "0.5535",
              "prevPrice24h": "0.569",
              "price24hPcnt": "-0.0272",
              "highPrice24h": "0.5699",
              "lowPrice24h": "0.5532",
              "turnover24h": "308336.86913",
              "volume24h": "546207.01",
              "usdIndexPrice": "0.553424"
            },
            {
              "symbol": "HOOKUSDT",
              "bid1Price": "0.131",
              "bid1Size": "1780.22",
              "ask1Price": "0.1311",
              "ask1Size": "990",
              "lastPrice": "0.131",
              "prevPrice24h": "0.1251",
              "price24hPcnt": "0.0472",
              "highPrice24h": "0.1368",
              "lowPrice24h": "0.1244",
              "turnover24h": "587031.358947",
              "volume24h": "4495697.23",
              "usdIndexPrice": "0.131198"
            },
            {
              "symbol": "WBTCUSDT",
              "bid1Price": "84624.31",
              "bid1Size": "0.0027",
              "ask1Price": "84640.16",
              "ask1Size": "0.0027",
              "lastPrice": "84729.83",
              "prevPrice24h": "85311.57",
              "price24hPcnt": "-0.0068",
              "highPrice24h": "85566.36",
              "lowPrice24h": "84702.78",
              "turnover24h": "29882.00841535",
              "volume24h": "0.350689"
            },
            {
              "symbol": "BCHUSDC",
              "bid1Price": "335",
              "bid1Size": "0.3",
              "ask1Price": "335.5",
              "ask1Size": "5.324",
              "lastPrice": "334",
              "prevPrice24h": "339.2",
              "price24hPcnt": "-0.0153",
              "highPrice24h": "342",
              "lowPrice24h": "333.4",
              "turnover24h": "9178.0721",
              "volume24h": "27.206",
              "usdIndexPrice": "335.15716"
            },
            {
              "symbol": "TSTUSDT",
              "bid1Price": "0.003081",
              "bid1Size": "2776.43",
              "ask1Price": "0.003084",
              "ask1Size": "4417.16",
              "lastPrice": "0.003082",
              "prevPrice24h": "0.003093",
              "price24hPcnt": "-0.0036",
              "highPrice24h": "0.003123",
              "lowPrice24h": "0.003062",
              "turnover24h": "29152.70030499",
              "volume24h": "9446912.26"
            },
            {
              "symbol": "SENDUSDT",
              "bid1Price": "0.4473",
              "bid1Size": "223.2",
              "ask1Price": "0.4484",
              "ask1Size": "339.4",
              "lastPrice": "0.4485",
              "prevPrice24h": "0.4366",
              "price24hPcnt": "0.0273",
              "highPrice24h": "0.4666",
              "lowPrice24h": "0.421",
              "turnover24h": "116560.00753",
              "volume24h": "264191.2"
            },
            {
              "symbol": "USDTPLN",
              "bid1Price": "3.766",
              "bid1Size": "55958.7",
              "ask1Price": "3.768",
              "ask1Size": "68743.8",
              "lastPrice": "3.766",
              "prevPrice24h": "3.769",
              "price24hPcnt": "-0.0008",
              "highPrice24h": "3.77",
              "lowPrice24h": "3.759",
              "turnover24h": "1215762.2574",
              "volume24h": "322809.5"
            },
            {
              "symbol": "FUSDT",
              "bid1Price": "0.01144",
              "bid1Size": "111645.6",
              "ask1Price": "0.01147",
              "ask1Size": "787.7",
              "lastPrice": "0.01147",
              "prevPrice24h": "0.01095",
              "price24hPcnt": "0.0475",
              "highPrice24h": "0.0132",
              "lowPrice24h": "0.01095",
              "turnover24h": "737397.277505",
              "volume24h": "61477099.6"
            },
            {
              "symbol": "USTCUSDT",
              "bid1Price": "0.01211",
              "bid1Size": "26234.74",
              "ask1Price": "0.01212",
              "ask1Size": "24655.84",
              "lastPrice": "0.01212",
              "prevPrice24h": "0.01198",
              "price24hPcnt": "0.0117",
              "highPrice24h": "0.01284",
              "lowPrice24h": "0.01193",
              "turnover24h": "340979.6504057",
              "volume24h": "27635234.6"
            },
            {
              "symbol": "XLMUSDT",
              "bid1Price": "0.2441",
              "bid1Size": "10248.1",
              "ask1Price": "0.2442",
              "ask1Size": "23302.6",
              "lastPrice": "0.2441",
              "prevPrice24h": "0.2472",
              "price24hPcnt": "-0.0125",
              "highPrice24h": "0.2496",
              "lowPrice24h": "0.244",
              "turnover24h": "1440535.985774",
              "volume24h": "5846054.2",
              "usdIndexPrice": "0.24415"
            },
            {
              "symbol": "EIGENUSDT",
              "bid1Price": "0.844",
              "bid1Size": "837.5",
              "ask1Price": "0.845",
              "ask1Size": "1401.12",
              "lastPrice": "0.844",
              "prevPrice24h": "0.832",
              "price24hPcnt": "0.0144",
              "highPrice24h": "0.878",
              "lowPrice24h": "0.819",
              "turnover24h": "1380138.90756",
              "volume24h": "1609331.12",
              "usdIndexPrice": "0.842882"
            },
            {
              "symbol": "CLOUDUSDT",
              "bid1Price": "0.0746",
              "bid1Size": "3498.71",
              "ask1Price": "0.07466",
              "ask1Size": "1339.4",
              "lastPrice": "0.07459",
              "prevPrice24h": "0.07377",
              "price24hPcnt": "0.0111",
              "highPrice24h": "0.07499",
              "lowPrice24h": "0.07295",
              "turnover24h": "35852.3046351",
              "volume24h": "485694.68"
            },
            {
              "symbol": "STGUSDT",
              "bid1Price": "0.1909",
              "bid1Size": "2166.71",
              "ask1Price": "0.191",
              "ask1Size": "1894.22",
              "lastPrice": "0.191",
              "prevPrice24h": "0.1931",
              "price24hPcnt": "-0.0109",
              "highPrice24h": "0.1952",
              "lowPrice24h": "0.1909",
              "turnover24h": "113322.24255",
              "volume24h": "587704.89",
              "usdIndexPrice": "0.190933"
            },
            {
              "symbol": "G7USDT",
              "bid1Price": "0.004997",
              "bid1Size": "1050.7",
              "ask1Price": "0.005001",
              "ask1Size": "6279.3",
              "lastPrice": "0.004999",
              "prevPrice24h": "0.004951",
              "price24hPcnt": "0.0097",
              "highPrice24h": "0.005156",
              "lowPrice24h": "0.004901",
              "turnover24h": "93046.2089394",
              "volume24h": "18579223.9"
            },
            {
              "symbol": "ALTUSDT",
              "bid1Price": "0.02842",
              "bid1Size": "4500",
              "ask1Price": "0.02843",
              "ask1Size": "4702.61",
              "lastPrice": "0.02844",
              "prevPrice24h": "0.02717",
              "price24hPcnt": "0.0467",
              "highPrice24h": "0.02955",
              "lowPrice24h": "0.02677",
              "turnover24h": "658661.2408271",
              "volume24h": "23201906.89",
              "usdIndexPrice": "0.0284093"
            },
            {
              "symbol": "PAWSUSDT",
              "bid1Price": "0.0001327",
              "bid1Size": "10568",
              "ask1Price": "0.0001328",
              "ask1Size": "190517",
              "lastPrice": "0.000133",
              "prevPrice24h": "0.0001288",
              "price24hPcnt": "0.0326",
              "highPrice24h": "0.0001418",
              "lowPrice24h": "0.0001254",
              "turnover24h": "2851148.7253225",
              "volume24h": "21709429846"
            },
            {
              "symbol": "PIPUSDT",
              "bid1Price": "0.00288",
              "bid1Size": "381",
              "ask1Price": "0.00289",
              "ask1Size": "381",
              "lastPrice": "0.00289",
              "prevPrice24h": "0.00279",
              "price24hPcnt": "0.0358",
              "highPrice24h": "0.002978",
              "lowPrice24h": "0.00269",
              "turnover24h": "9645.16099682",
              "volume24h": "3430005.99"
            },
            {
              "symbol": "USDTBRL",
              "bid1Price": "5.864",
              "bid1Size": "2634.2",
              "ask1Price": "5.868",
              "ask1Size": "4536.6",
              "lastPrice": "5.864",
              "prevPrice24h": "5.867",
              "price24hPcnt": "-0.0005",
              "highPrice24h": "5.886",
              "lowPrice24h": "5.86",
              "turnover24h": "2402743.2548",
              "volume24h": "409390.1"
            },
            {
              "symbol": "CELOUSDT",
              "bid1Price": "0.3036",
              "bid1Size": "1997.43",
              "ask1Price": "0.3038",
              "ask1Size": "382.5",
              "lastPrice": "0.3036",
              "prevPrice24h": "0.3083",
              "price24hPcnt": "-0.0152",
              "highPrice24h": "0.3154",
              "lowPrice24h": "0.3036",
              "turnover24h": "569840.563793",
              "volume24h": "1839290.94",
              "usdIndexPrice": "0.303841"
            },
            {
              "symbol": "MEWUSDC",
              "bid1Price": "0.002381",
              "bid1Size": "126094.89",
              "ask1Price": "0.002386",
              "ask1Size": "216660.97",
              "lastPrice": "0.00239",
              "prevPrice24h": "0.00245",
              "price24hPcnt": "-0.0245",
              "highPrice24h": "0.002522",
              "lowPrice24h": "0.00239",
              "turnover24h": "10025.3194981",
              "volume24h": "4070892.85",
              "usdIndexPrice": "0.00238249"
            },
            {
              "symbol": "MOJOUSDT",
              "bid1Price": "0.003158",
              "bid1Size": "3399.91",
              "ask1Price": "0.003176",
              "ask1Size": "29405.1",
              "lastPrice": "0.00316",
              "prevPrice24h": "0.003165",
              "price24hPcnt": "-0.0016",
              "highPrice24h": "0.003196",
              "lowPrice24h": "0.00314",
              "turnover24h": "4071.7217619",
              "volume24h": "1285994.86"
            },
            {
              "symbol": "USDCBRL",
              "bid1Price": "5.864",
              "bid1Size": "2.7",
              "ask1Price": "5.868",
              "ask1Size": "405.2",
              "lastPrice": "5.868",
              "prevPrice24h": "5.867",
              "price24hPcnt": "0.0002",
              "highPrice24h": "5.879",
              "lowPrice24h": "5.862",
              "turnover24h": "85809.6153",
              "volume24h": "14613.2"
            },
            {
              "symbol": "FIREUSDT",
              "bid1Price": "0.05901",
              "bid1Size": "584.74",
              "ask1Price": "0.05935",
              "ask1Size": "341.3",
              "lastPrice": "0.05934",
              "prevPrice24h": "0.06006",
              "price24hPcnt": "-0.0120",
              "highPrice24h": "0.06838",
              "lowPrice24h": "0.05502",
              "turnover24h": "406949.4369124",
              "volume24h": "6889958.6"
            },
            {
              "symbol": "ETHWUSDT",
              "bid1Price": "1.277",
              "bid1Size": "742.71",
              "ask1Price": "1.2801",
              "ask1Size": "1672.06",
              "lastPrice": "1.2806",
              "prevPrice24h": "1.2366",
              "price24hPcnt": "0.0356",
              "highPrice24h": "1.3317",
              "lowPrice24h": "1.2313",
              "turnover24h": "127108.009732",
              "volume24h": "99960.73",
              "usdIndexPrice": "1.278245"
            },
            {
              "symbol": "INSPUSDT",
              "bid1Price": "0.006863",
              "bid1Size": "2435.08",
              "ask1Price": "0.006887",
              "ask1Size": "1281.01",
              "lastPrice": "0.006884",
              "prevPrice24h": "0.00719",
              "price24hPcnt": "-0.0426",
              "highPrice24h": "0.007244",
              "lowPrice24h": "0.006808",
              "turnover24h": "21767.39741254",
              "volume24h": "3122731.17"
            },
            {
              "symbol": "STRKUSDT",
              "bid1Price": "0.1307",
              "bid1Size": "18919.51",
              "ask1Price": "0.1308",
              "ask1Size": "16859.88",
              "lastPrice": "0.1307",
              "prevPrice24h": "0.1263",
              "price24hPcnt": "0.0348",
              "highPrice24h": "0.1356",
              "lowPrice24h": "0.1243",
              "turnover24h": "2152136.237584",
              "volume24h": "16525603.7",
              "usdIndexPrice": "0.130677"
            },
            {
              "symbol": "ZIGUSDT",
              "bid1Price": "0.07339",
              "bid1Size": "679.92",
              "ask1Price": "0.07369",
              "ask1Size": "161.44",
              "lastPrice": "0.07334",
              "prevPrice24h": "0.07282",
              "price24hPcnt": "0.0071",
              "highPrice24h": "0.07453",
              "lowPrice24h": "0.07256",
              "turnover24h": "138337.0735074",
              "volume24h": "1881188.97"
            },
            {
              "symbol": "GUMMYUSDT",
              "bid1Price": "0.001817",
              "bid1Size": "4122.01",
              "ask1Price": "0.001822",
              "ask1Size": "3275.6",
              "lastPrice": "0.001822",
              "prevPrice24h": "0.001756",
              "price24hPcnt": "0.0376",
              "highPrice24h": "0.001961",
              "lowPrice24h": "0.001738",
              "turnover24h": "159573.38229283",
              "volume24h": "86575577.31"
            },
            {
              "symbol": "SUIUSDT",
              "bid1Price": "2.1271",
              "bid1Size": "337.49",
              "ask1Price": "2.1274",
              "ask1Size": "388.8",
              "lastPrice": "2.1268",
              "prevPrice24h": "2.1485",
              "price24hPcnt": "-0.0101",
              "highPrice24h": "2.1784",
              "lowPrice24h": "2.1221",
              "turnover24h": "10395534.56607",
              "volume24h": "4833375.54",
              "usdIndexPrice": "2.126318"
            },
            {
              "symbol": "ETHUSDT",
              "bid1Price": "1590.43",
              "bid1Size": "3.4562",
              "ask1Price": "1590.44",
              "ask1Size": "0.26288",
              "lastPrice": "1590.42",
              "prevPrice24h": "1602.21",
              "price24hPcnt": "-0.0074",
              "highPrice24h": "1632",
              "lowPrice24h": "1585.41",
              "turnover24h": "89900156.576953",
              "volume24h": "55913.35433",
              "usdIndexPrice": "1590.308954"
            },
            {
              "symbol": "ZKLUSDT",
              "bid1Price": "0.03314",
              "bid1Size": "259.1",
              "ask1Price": "0.03331",
              "ask1Size": "272.7",
              "lastPrice": "0.03323",
              "prevPrice24h": "0.03341",
              "price24hPcnt": "-0.0054",
              "highPrice24h": "0.03381",
              "lowPrice24h": "0.0328",
              "turnover24h": "52012.223509",
              "volume24h": "1568848.6"
            },
            {
              "symbol": "QORPOUSDT",
              "bid1Price": "0.01828",
              "bid1Size": "1815.13",
              "ask1Price": "0.01832",
              "ask1Size": "2000",
              "lastPrice": "0.01832",
              "prevPrice24h": "0.01756",
              "price24hPcnt": "0.0433",
              "highPrice24h": "0.01887",
              "lowPrice24h": "0.01734",
              "turnover24h": "60233.2128076",
              "volume24h": "3340151.02"
            },
            {
              "symbol": "MOVRUSDT",
              "bid1Price": "5.302",
              "bid1Size": "334.99",
              "ask1Price": "5.316",
              "ask1Size": "74.15",
              "lastPrice": "5.303",
              "prevPrice24h": "5.172",
              "price24hPcnt": "0.0253",
              "highPrice24h": "5.475",
              "lowPrice24h": "5.092",
              "turnover24h": "138941.60979",
              "volume24h": "26211.92",
              "usdIndexPrice": "5.311117"
            },
            {
              "symbol": "1INCHUSDT",
              "bid1Price": "0.1721",
              "bid1Size": "5111.86",
              "ask1Price": "0.1722",
              "ask1Size": "1884.01",
              "lastPrice": "0.1724",
              "prevPrice24h": "0.1724",
              "price24hPcnt": "0",
              "highPrice24h": "0.1768",
              "lowPrice24h": "0.172",
              "turnover24h": "336056.430754",
              "volume24h": "1923448.96",
              "usdIndexPrice": "0.172186"
            },
            {
              "symbol": "VRTXUSDT",
              "bid1Price": "0.0449",
              "bid1Size": "181.39",
              "ask1Price": "0.04496",
              "ask1Size": "181.16",
              "lastPrice": "0.04499",
              "prevPrice24h": "0.04433",
              "price24hPcnt": "0.0149",
              "highPrice24h": "0.04556",
              "lowPrice24h": "0.04433",
              "turnover24h": "42615.5643416",
              "volume24h": "949721.27"
            },
            {
              "symbol": "APEUSDC",
              "bid1Price": "0.459",
              "bid1Size": "3425.31",
              "ask1Price": "0.461",
              "ask1Size": "2269.91",
              "lastPrice": "0.46",
              "prevPrice24h": "0.442",
              "price24hPcnt": "0.0407",
              "highPrice24h": "0.471",
              "lowPrice24h": "0.442",
              "turnover24h": "1902.54918",
              "volume24h": "4154.38",
              "usdIndexPrice": "0.459853"
            },
            {
              "symbol": "SOLBTC",
              "bid1Price": "0.001647",
              "bid1Size": "6.826",
              "ask1Price": "0.0016472",
              "ask1Size": "1.417",
              "lastPrice": "0.0016471",
              "prevPrice24h": "0.0016285",
              "price24hPcnt": "0.0114",
              "highPrice24h": "0.0016646",
              "lowPrice24h": "0.0016223",
              "turnover24h": "53.9825721542",
              "volume24h": "32880.722"
            },
            {
              "symbol": "RACAUSDT",
              "bid1Price": "0.00008522",
              "bid1Size": "154624.99",
              "ask1Price": "0.00008586",
              "ask1Size": "95634.45",
              "lastPrice": "0.00008589",
              "prevPrice24h": "0.00008501",
              "price24hPcnt": "0.0104",
              "highPrice24h": "0.00008951",
              "lowPrice24h": "0.00008417",
              "turnover24h": "18750.7012517416",
              "volume24h": "216144799.31"
            },
            {
              "symbol": "APEUSDT",
              "bid1Price": "0.46",
              "bid1Size": "2166.32",
              "ask1Price": "0.461",
              "ask1Size": "18611.71",
              "lastPrice": "0.46",
              "prevPrice24h": "0.444",
              "price24hPcnt": "0.0360",
              "highPrice24h": "0.473",
              "lowPrice24h": "0.442",
              "turnover24h": "608719.084125",
              "volume24h": "1323724.98",
              "usdIndexPrice": "0.459853"
            }
          ]
        },
        "retExtInfo": {},
        "time": 1745139316117
      }';
      $data = json_decode($json, true);



    // Flatten collection and convert to array
    $flattened = collect($data['result']['list'])
    ->flatMap(fn($item) => [$item['symbol'] => $item['lastPrice']])
    ->toArray();

    // Select multiple symbols
    $symbols = $cryptos;
    $selected = array_intersect_key($flattened, array_flip($symbols));

    // Return response
    return $selected;
}

function combineCryptoPrices($details)
{
  $response = Http::get("https://msw-app.com/crypto", [
      "details" => $details
  ]);

  return $response->json();


  $combineDetails = [
    "binance" => [],
    "bybit" => [],
  ];
  

  // binance
  if(isset($details["binance"]) && count($details["binance"]) > 0){
    $combineDetails["binance"] = binanceSpotPrices($details["binance"]);
  }

  // bybit 
  if(isset($details["bybit"]) && count($details["bybit"]) > 0){
    $combineDetails["bybit"] = bybitSpotPrices($details["bybit"]);
  }
  return  response()->json($combineDetails);
}




function bybitInfo($instruments, $market){
    // https://developers.coindesk.com/settings/api-keys
    $response = Http::get('https://data-api.coindesk.com/spot/v1/latest/tick', [
        'market' => $market,
        'instruments' => $instruments, //'LTC-USDT',
        "apply_mapping" => true,
        "api_key" => "c37c91234bb89ea9a136491e17c522f2cdf21d83a483ac3d897641cfd3b8f3f3"
    ]);

    if ($response->successful()) {
        $data = $response->json();
        if(isset($data["Data"][$instruments]["PRICE"])){
            $price = $data["Data"][$instruments]["PRICE"];
            return ["price" => $price, "status" => true];
        }else{
            return ["msg" => "Something went wrong, try again!", "status" => false];
        }
    } else {
        return ["msg" => $response["Err"]["message"], "status" => false];
    }
}

function bybitMultiInfo($instruments, $market){
    $response = Http::get('https://data-api.coindesk.com/spot/v1/latest/tick', [
        'market' => $market,
        'instruments' => $instruments, //'LTC-USDT',
        "apply_mapping" => true,
        "api_key" => "c37c91234bb89ea9a136491e17c522f2cdf21d83a483ac3d897641cfd3b8f3f3"
    ]);

    if ($response->successful()) {
        $data = $response->json();

        return ["price" => $data["Data"], "status" => true];
    } else {
        return ["msg" => $response["Err"]["message"], "status" => false];
    }
}

// format 
function formatNumberFlexible($number, $decimals = 8) {
  $formatted = number_format((float)$number, $decimals, '.', '');
  return rtrim(rtrim($formatted, '0'), '.');
}

// Notifications 
// TakeProfitTemplates.php

function getTakeProfitTemplate($trade, $hitted_tp)
{
    $template = [
        'title' => '',
        'body' => '',
        'recommendation' => '',
        'buttons' => [
            [['text' => '❌ Close Trade', 'callback_data' => "close_trade_{$trade->id}"]],
        ],
    ];

    switch ($hitted_tp) {
        case 1:
            $template['title'] = "✅ TAKE PROFIT 1 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP1] ← REACHED
            Next Target: [TP2]

            Your trade is still being tracked for higher targets.
            EOT;
            break;

        case 2:
            $template['title'] = "✅ TAKE PROFIT 2 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP2] ← REACHED
            Next Target: [TP3]

            Your trade is still being tracked for higher targets.
            EOT;
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 3:
          $template['title'] = "✅ TAKE PROFIT 3 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP3] ← REACHED
            Next Target: [TP4]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
        case 4:
            $template['title'] = "✅ TAKE PROFIT 3 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP4] ← REACHED
            Next Target: [TP5]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 5:
            $template['title'] = "🌟 TAKE PROFIT 4 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP5] ← REACHED
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider taking partial profits now and moving stop loss to your last TP level to lock in gains.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
    }

    return $template;
}
function aiAdvisorTakeProfit($trade, $hitted_tp, $chat_id)
{
    $template = getTakeProfitTemplate($trade, $hitted_tp);
    if (!$template) return;

    $replacements = [
        '[PAIR-USDT]' => $trade->instruments ?? 'PAIR-USDT',
        '[LONG/SHORT]' => strtoupper($trade->tp_mode ?? 'LONG'),
        '[Entry]' => $trade->entry_target."$" ?? 'N/A',
        '[TP1]' => $trade->take_profit1."$" ?? 'N/A',
        '[TP2]' => $trade->take_profit2."$" ?? 'N/A',
        '[TP3]' => $trade->take_profit3."$" ?? 'N/A',
        '[TP4]' => $trade->take_profit4."$" ?? 'N/A',
        '[TP5]' => $trade->take_profit5."$" ?? 'N/A',
    ];

    $text = $template['title'] . "\n\n" . str_replace(array_keys($replacements), array_values($replacements), $template['body']);

    if (!empty($template['recommendation'])) {
        $text .= "\n\n" . $template['recommendation'];
    }

    Telegram::sendMessage([
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode(['inline_keyboard' => $template['buttons']])
    ]);
}

function aiAdvisorTakeLose($trade, $chat_id)
{
    if($trade->type == "real"){
      Telegram::sendMessage([
          'chat_id' => $chat_id,
          'text' => <<<EOT
          ❌ STOP LOSS HIT!

          $trade->instruments $trade->tp_mode
          Entry: $trade->entry_target$
          Stop Loss: $trade->stop_loss$ ← REACHED

          Trade closed with a loss.

          Feel free to share your trade results or skip if you prefer.
          EOT,
          'parse_mode' => 'HTML',
          'reply_markup' => json_encode([
              'inline_keyboard' => [
                  [
                      ['text' => '📈 Provide Trade Report', 'callback_data' => "trade_report"],
                  ]
              ]
          ])
      ]);
    }else{
      Telegram::sendMessage([
          'chat_id' => $chat_id,
          'text' => <<<EOT
          ❌ STOP LOSS HIT!

          $trade->instruments $trade->tp_mode
          Entry: $trade->entry_target$
          Stop Loss: $trade->stop_loss$ ← REACHED

          Trade closed with a loss.

          Demo trade has been closed and moved to history.
          EOT,
          'parse_mode' => 'HTML',
      ]);
    }
}
function startWaitingTrade($trade, $chat_id)
{
  $mode = strtoupper($trade->tp_mode);

  Telegram::sendMessage([
      'chat_id' => $chat_id,
      'text' => <<<EOT
      🎯 ENTRY POINT REACHED!

      $trade->instruments $mode
      Entry: $trade->entry_target$ ← REACHED

      Your signal is now active and being tracked.
      Stop Loss: $trade->stop_loss$
      Take Profit Targets: TP1: $trade->take_profit1$, TP2: $trade->take_profit2$, TP3: $trade->take_profit3$, TP4: $trade->take_profit4$, TP5: $trade->take_profit5$

      I'll continue monitoring and alert you when any price targets are reached.
      EOT,
      'parse_mode' => 'HTML',
      'reply_markup' => json_encode([
          'inline_keyboard' => [
              [
                ['text' => '❌ Close Trade', 'callback_data' => "close_trade_$trade->id"],
              ],
              [
                ['text' => '📄 View Trade Details', 'callback_data' => "show_trade_details_$trade->id"]
              ]
          ]
      ])
  ]);
}