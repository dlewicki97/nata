<?php
class addShipment {
  public $przesylki; // przesylkaType
}

class addShipmentResponse {
  public $retval; // addShipmentResponseItemType
}

class przesylkaType {
  public $guid; // guidType
  public $pakietGuid; // guidType
  public $opakowanieGuid; // guidType
  public $opis; // opisType
}

class pocztexKrajowyType {
  public $pobranie; // pobranieType
  public $odbiorPrzesylkiOdNadawcy; // odbiorPrzesylkiOdNadawcyType
  public $doreczenie; // doreczenieType
  public $zwrotDokumentow; // zwrotDokumentowType
  public $potwierdzenieOdbioru; // potwierdzenieOdbioruType
  public $potwierdzenieDoreczenia; // potwierdzenieDoreczeniaType
  public $posteRestante; // boolean
  public $terminRodzaj; // terminRodzajType
  public $kopertaFirmowa; // boolean
  public $masa; // masaType
  public $wartosc; // wartoscType
  public $ostroznie; // boolean
  public $ponadgabaryt; // boolean
  public $uiszczaOplate; // uiszczaOplateType
  public $odleglosc; // int
  public $zawartosc; // string
}

class umowaType {
}

class masaType {
}

class numerNadaniaType {
}

class changePassword {
  public $newPassword; // string
}

class changePasswordResponse {
  public $error; // errorType
}

class terminRodzajType {
  const MIEJSKI_DO_3H_DO_5KM = 'MIEJSKI_DO_3H_DO_5KM';
  const MIEJSKI_DO_3H_DO_10KM = 'MIEJSKI_DO_3H_DO_10KM';
  const MIEJSKI_DO_3H_DO_15KM = 'MIEJSKI_DO_3H_DO_15KM';
  const MIEJSKI_DO_3H_POWYZEJ_15KM = 'MIEJSKI_DO_3H_POWYZEJ_15KM';
  const MIEJSKI_DO_4H_DO_10KM = 'MIEJSKI_DO_4H_DO_10KM';
  const MIEJSKI_DO_4H_DO_15KM = 'MIEJSKI_DO_4H_DO_15KM';
  const MIEJSKI_DO_4H_DO_20KM = 'MIEJSKI_DO_4H_DO_20KM';
  const MIEJSKI_DO_4H_DO_30KM = 'MIEJSKI_DO_4H_DO_30KM';
  const MIEJSKI_DO_4H_DO_40KM = 'MIEJSKI_DO_4H_DO_40KM';
  const KRAJOWY = 'KRAJOWY';
  const BEZPOSREDNI_DO_30KG = 'BEZPOSREDNI_DO_30KG';
  const BEZPOSREDNI_OD_30KG_DO_100KG = 'BEZPOSREDNI_OD_30KG_DO_100KG';
  const EKSPRES24 = 'EKSPRES24';
}

class uiszczaOplateType {
  const NADAWCA = 'NADAWCA';
  const ADRESAT = 'ADRESAT';
}

class wartoscType {
}

class kwotaPobraniaType {
}

class sposobPobraniaType {
  const PRZEKAZ = 'PRZEKAZ';
  const RACHUNEK_BANKOWY = 'RACHUNEK_BANKOWY';
}

class sposobPrzekazaniaType {
  const LIST_ZWYKLY_PRIOTYTET = 'LIST_ZWYKLY_PRIOTYTET';
  const POCZTEX = 'POCZTEX';
}

class sposobDoreczeniaPotwierdzeniaType {
  const TELEFON = 'TELEFON';
  const TELEFAX = 'TELEFAX';
  const SMS = 'SMS';
  const EMAIL = 'EMAIL';
}

class iloscPotwierdzenOdbioruType {
}

class dataDlaDostarczeniaType {
}

class razemType {
}

class nazwaType {
}

class nazwa2Type {
}

class ulicaType {
}

class numerDomuType {
}

class numerLokaluType {
}

class miejscowoscType {
}

class kodPocztowyType {
}

class paczkaPocztowaType {
  public $posteRestante; // boolean
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $masa; // masaType
  public $wartosc; // wartoscType
  public $zwrotDoslanie; // boolean
  public $egzemplarzBiblioteczny; // boolean
  public $dlaOciemnialych; // boolean
}

class kategoriaType {
  const EKONOMICZNA = 'EKONOMICZNA';
  const PRIORYTETOWA = 'PRIORYTETOWA';
}

class gabarytType {
  const GABARYT_A = 'GABARYT_A';
  const GABARYT_B = 'GABARYT_B';
}

class paczkaPocztowaPLUSType {
  public $posteRestante; // boolean
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $wartosc; // wartoscType
  public $masa; // masaType
  public $zwrotDoslanie; // boolean
}

class przesylkaPobraniowaType {
  public $pobranie; // pobranieType
  public $posteRestante; // boolean
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $ostroznie; // boolean
  public $wartosc; // wartoscType
  public $masa; // masaType
}

class przesylkaNaWarunkachSzczegolnychType {
  public $posteRestante; // boolean
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $wartosc; // wartoscType
  public $masa; // masaType
}

class przesylkaPoleconaKrajowaType {
  public $epo; // EPOType
  public $posteRestante; // boolean
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $masa; // masaType
  public $egzemplarzBiblioteczny; // boolean
  public $dlaOciemnialych; // boolean
}

class przesylkaListowaZadeklarowanaWartoscType {
  public $posteRestante; // boolean
  public $wartosc; // wartoscType
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $masa; // masaType
}

class przesylkaFullType {
  public $przesylkaShort; // przesylkaShortType
  public $przesylkaFull; // przesylkaType
}

class errorType {
  public $errorNumber; // int
  public $errorDesc; // string
  public $guid; // guidType
}

class adresType {
  public $nazwa; // nazwaType
  public $nazwa2; // nazwa2Type
  public $ulica; // ulicaType
  public $numerDomu; // numerDomuType
  public $numerLokalu; // numerLokaluType
  public $miejscowosc; // miejscowoscType
  public $kodPocztowy; // kodPocztowyType
  public $kraj; // krajType
  public $telefon; // telefonType
}

class sendEnvelope {
  public $pakiet; // pakietType
  public $urzadNadania; // urzadNadaniaType
}

class sendEnvelopeResponseType {
  public $error; // errorType
  public $idEnvelope; // int
  public $envelopeStatus; // envelopeStatusType
}

class urzadNadaniaType {
}

class getUrzedyNadania {
}

class getUrzedyNadaniaResponse {
  public $urzedyNadania; // urzadNadaniaFullType
}

class clearEnvelope {
}

class clearEnvelopeResponse {
  public $error; // errorType
  public $retval; // boolean
}

class urzadNadaniaFullType {
  public $urzadNadania; // urzadNadaniaType
  public $opis; // string
}

class guidType {
}

class ePrzesylkaType {
  public $urzadWydaniaEPrzesylki; // urzadWydaniaEPrzesylkiType
  public $pobranie; // pobranieType
  public $masa; // masaType
  public $eSposobPowiadomieniaAdresata; // eSposobPowiadomieniaType
  public $eSposobPowiadomieniaNadawcy; // eSposobPowiadomieniaType
  public $eKontaktAdresata; // eKontaktType
  public $eKontaktNadawcy; // eKontaktType
  public $ostroznie; // boolean
  public $wartosc; // wartoscType
}

class eSposobPowiadomieniaType {
  const SMS = 'SMS';
  const EMAIL = 'EMAIL';
}

class eKontaktType {
}

class urzadWydaniaEPrzesylkiType {
}

class pobranieType {
  public $sposobPobrania; // sposobPobraniaType
  public $kwotaPobrania; // kwotaPobraniaType
  public $nrb; // anonymous51
  public $tytulem; // anonymous52
  public $sprawdzenieZawartosciPrzesylkiPrzezOdbiorce; // boolean
}

class anonymous51 {
}

class anonymous52 {
}

class przesylkaPoleconaZagranicznaType {
  public $posteRestante; // boolean
  public $kategoria; // kategoriaType
  public $masa; // masaType
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $ekspres; // boolean
}

class krajType {
}

class getUrzedyWydajaceEPrzesylki {
}

class getUrzedyWydajaceEPrzesylkiResponse {
  public $urzadWydaniaEPrzesylki; // urzadWydaniaEPrzesylkiType
}

class uploadIWDContent {
  public $IWDContent; // base64Binary
  public $urzadNadania; // urzadNadaniaType
}

class getEnvelopeStatus {
  public $idEnvelope; // int
}

class getEnvelopeStatusResponse {
  public $error; // errorType
  public $envelopeStatus; // envelopeStatusType
}

class envelopeStatusType {
  const WYSLANY = 'WYSLANY';
  const DOSTARCZONY = 'DOSTARCZONY';
  const PRZYJETY = 'PRZYJETY';
  const WALIDOWANY = 'WALIDOWANY';
  const BLEDNY = 'BLEDNY';
}

class downloadIWDContent {
  public $idEnvelope; // int
}

class downloadIWDContentResponse {
  public $IWDContent; // base64Binary
  public $error; // errorType
}

class przesylkaShortType {
  public $czynnosciUpustowe; // czynnoscUpustowaType
  public $numerNadania; // numerNadaniaType
  public $guid; // guidType
  public $dataNadania; // date
  public $razem; // int
  public $pobranie; // int
  public $status; // statusType
}

class addShipmentResponseItemType {
  public $error; // errorType
  public $numerNadania; // numerNadaniaType
  public $guid; // guidType
}

class getKarty {
}

class getKartyResponse {
  public $karta; // kartaType
}

class getPasswordExpiredDate {
}

class getPasswordExpiredDateResponse {
  public $dataWygasniecia; // date
}

class setAktywnaKarta {
  public $idKarta; // int
}

class setAktywnaKartaResponse {
  public $error; // errorType
}

class getEnvelopeContentFull {
  public $idEnvelope; // int
}

class getEnvelopeContentFullResponse {
  public $przesylka; // przesylkaFullType
}

class getEnvelopeContentShort {
  public $idEnvelope; // int
}

class getEnvelopeContentShortResponse {
  public $przesylka; // przesylkaShortType
}

class hello {
  public $in; // string
}

class helloResponse {
  public $out; // string
}

class kartaType {
  public $idKarta; // int
  public $opis; // string
  public $aktywna; // boolean
}

class telefonType {
}

class getAddressLabel {
  public $idEnvelope; // int
}

class getAddressLabelResponse {
  public $content; // addressLabelContent
  public $error; // errorType
}

class addressLabelContent {
  public $pdfContent; // base64Binary
  public $nrNadania; // string
  public $guid; // string
}

class getOutboxBook {
  public $idEnvelope; // int
}

class getOutboxBookResponse {
  public $pdfContent; // base64Binary
  public $error; // errorType
}

class getFirmowaPocztaBook {
  public $idEnvelope; // int
}

class getFirmowaPocztaBookResponse {
  public $pdfContent; // base64Binary
  public $error; // errorType
}

class getEnvelopeList {
  public $startDate; // date
  public $endDate; // date
}

class getEnvelopeListResponse {
  public $envelopes; // envelopeInfoType
}

class envelopeInfoType {
  public $error; // errorType
  public $idEnvelope; // int
  public $envelopeStatus; // envelopeStatusType
  public $dataTransmisji; // date
}

class przesylkaZagranicznaType {
  public $posteRestante; // boolean
  public $kategoria; // kategoriaType
  public $masa; // masaType
  public $ekspres; // boolean
  public $kraj; // string
}

class przesylkaRejestrowanaType {
  public $adres; // adresType
  public $numerNadania; // numerNadaniaType
}

class przesylkaNieRejestrowanaType {
  public $ilosc; // anonymous92
}

class anonymous92 {
}

class przesylkaBiznesowaType {
  public $pobranie; // pobranieType
  public $urzadWydaniaEPrzesylki; // urzadWydaniaEPrzesylkiType
  public $subPrzesylka; // subPrzesylkaBiznesowaType
  public $masa; // masaType
  public $gabaryt; // gabarytBiznesowaType
  public $wartosc; // wartoscType
  public $ostroznie; // boolean
}

class gabarytBiznesowaType {
  const XS = 'XS';
  const S = 'S';
  const M = 'M';
  const L = 'L';
  const XL = 'XL';
  const XXL = 'XXL';
}

class subPrzesylkaBiznesowaType {
  public $pobranie; // pobranieType
  public $numerNadania; // numerNadaniaType
  public $masa; // masaType
  public $gabaryt; // gabarytBiznesowaType
  public $wartosc; // wartoscType
  public $ostroznie; // boolean
}

class subPrzesylkaBiznesowaPlusType {
  public $pobranie; // pobranieType
  public $numerNadania; // numerNadaniaType
  public $masa; // masaType
  public $gabaryt; // gabarytBiznesowaType
  public $wartosc; // wartoscType
  public $ostroznie; // boolean
  public $numerPrzesylkiKlienta; // string
  public $kwotaTranzakcji; // int
}

class getAddresLabelByGuid {
  public $guid; // guidType
}

class getAddresLabelByGuidResponse {
  public $content; // addressLabelContent
  public $error; // errorType
}

class przesylkaBiznesowaPlusType {
  public $pobranie; // pobranieType
  public $urzadWydaniaPrzesylki; // placowkaPocztowaType
  public $subPrzesylka; // subPrzesylkaBiznesowaPlusType
  public $dataDrugiejProbyDoreczenia; // date
  public $drugaProbaDoreczeniaPoLiczbieDni; // int
  public $posteRestante; // boolean
  public $masa; // masaType
  public $gabaryt; // gabarytBiznesowaType
  public $wartosc; // wartoscType
  public $kwotaTranzakcji; // kwotaTranzakcjiType
  public $ostroznie; // boolean
  public $kategoria; // kategoriaType
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $zwrotDoslanie; // boolean
  public $eKontaktAdresata; // eKontaktType
  public $eSposobPowiadomieniaAdresata; // eSposobPowiadomieniaType
  public $numerPrzesylkiKlienta; // numerPrzesylkiKlientaType
  public $iloscDniOczekiwaniaNaWydanie; // int
  public $oczekiwanyTerminDoreczenia; // dateTime
  public $terminRodzajPlus; // terminRodzajPlusType
}

class opisType {
}

class numerPrzesylkiKlientaType {
}

class pakietType {
  public $kierunek; // kierunekType
  public $opakowanie; // opakowanieType
  public $czynnoscUpustowa; // czynnoscUpustowaType
  public $pakietGuid; // guidType
  public $miejsceOdbioru; // miejsceOdbioruType
  public $sposobNadania; // sposobNadaniaType
}

class opakowanieType {
  public $opakowanieGuid; // guidType
  public $typ; // typOpakowanieType
  public $sygnatura; // string
  public $ilosc; // int
  public $numerOpakowaniaZbiorczego; // string
}

class typOpakowaniaType {
}

class getPlacowkiPocztowe {
  public $idWojewodztwo; // idWojewodztwoType
}

class getPlacowkiPocztoweResponse {
  public $placowka; // placowkaPocztowaType
}

class getGuid {
  public $ilosc; // int
}

class getGuidResponse {
  public $guid; // guidType
}

class kierunekType {
  public $kodPocztowy; // kodPocztowyType
  public $id; // int
  public $opis; // string
  public $pna; // kodPocztowyType
}

class getKierunki {
  public $plan; // string
  public $prefixKodPocztowy; // anonymous111
}

class anonymous111 {
}

class getKierunkiResponse {
  public $kierunek; // kierunekType
  public $error; // errorType
}

class czynnoscUpustowaType {
  const POSORTOWANA = 'POSORTOWANA';
}

class miejsceOdbioruType {
  const NADAWCA = 'NADAWCA';
  const URZAD_NADANIA = 'URZAD_NADANIA';
}

class sposobNadaniaType {
  const WERYFIKACJA_WEZEL_DOCELOWY = 'WERYFIKACJA_WEZEL_DOCELOWY';
  const WERYFIKACJA_WEZEL_NADAWCZY = 'WERYFIKACJA_WEZEL_NADAWCZY';
}

class getKierunkiInfo {
  public $plan; // string
}

class getKierunkiInfoResponse {
  public $usluga; // uslugiType
  public $error; // errorType
  public $lastUpdate; // date
}

class kwotaTranzakcjiType {
}

class uslugiType {
  public $id; // string
  public $opis; // string
}

class idWojewodztwoType {
  const value_02 = '02';
  const value_04 = '04';
  const value_06 = '06';
  const value_08 = '08';
  const value_10 = '10';
  const value_12 = '12';
  const value_14 = '14';
  const value_16 = '16';
  const value_18 = '18';
  const value_20 = '20';
  const value_22 = '22';
  const value_24 = '24';
  const value_26 = '26';
  const value_28 = '28';
  const value_30 = '30';
  const value_32 = '32';
}

class placowkaPocztowaType {
  public $lokalizacjaGeograficzna; // lokalizacjaGeograficznaType
  public $id; // int
  public $prefixNazwy; // string
  public $nazwa; // string
  public $wojewodztwo; // string
  public $powiat; // string
  public $miejsce; // string
  public $kodPocztowy; // anonymous122
  public $miejscowosc; // anonymous123
  public $ulica; // string
  public $numerDomu; // string
  public $numerLokalu; // string
  public $nazwaWydruk; // string
  public $punktWydaniaEPrzesylki; // boolean
  public $powiadomienieSMS; // boolean
  public $punktWydaniaPrzesylkiBiznesowejPlus; // boolean
}

class anonymous122 {
}

class anonymous123 {
}

class punktWydaniaPrzesylkiBiznesowejPlus {
}

class statusType {
  const NIEPOTWIERDZONA = 'NIEPOTWIERDZONA';
  const POTWIERDZONA = 'POTWIERDZONA';
  const NOWA = 'NOWA';
  const BRAK = 'BRAK';
}

class terminRodzajPlusType {
  const PORANEK = 'PORANEK';
  const POLUDNIE = 'POLUDNIE';
  const STANDARD = 'STANDARD';
}

class typOpakowanieType {
  const KL1 = 'KL1';
  const KL2 = 'KL2';
  const KL3 = 'KL3';
  const S21 = 'S21';
  const S22 = 'S22';
  const S23 = 'S23';
  const P31 = 'P31';
  const P32 = 'P32';
  const P33 = 'P33';
  const SP41 = 'SP41';
  const SP42 = 'SP42';
  const WKL51 = 'WKL51';
  const K1 = 'K1';
  const K2 = 'K2';
  const K3 = 'K3';
  const P = 'P';
  const W = 'W';
}

class getEnvelopeBufor {
}

class getEnvelopeBuforResponse {
  public $przesylka; // przesylkaType
  public $error; // errorType
}

class clearEnvelopeByGuids {
  public $guid; // guidType
}

class clearEnvelopeByGuidsResponse {
  public $error; // errorType
}

class zwrotDokumentowType {
  public $rodzajPocztex; // terminRodzajType
  public $rodzajList; // rodzajListType
  public $odleglosc; // int
}

class odbiorPrzesylkiOdNadawcyType {
  public $wSobote; // boolean
  public $wNiedzieleLubSwieto; // boolean
  public $wGodzinachOd20Do7; // boolean
}

class potwierdzenieDoreczeniaType {
  public $sposob; // sposobDoreczeniaPotwierdzeniaType
  public $kontakt; // string
}

class listRodzajType {
}

class rodzajListType {
  public $polecony; // boolean
  public $kategoria; // kategoriaType
}

class potwierdzenieOdbioruType {
  public $ilosc; // iloscPotwierdzenOdbioruType
  public $sposob; // sposobPrzekazaniaPotwierdzeniaOdbioruType
}

class sposobPrzekazaniaPotwierdzeniaOdbioruType {
  const MIEJSKI_DO_3H_DO_5KM = 'MIEJSKI_DO_3H_DO_5KM';
  const MIEJSKI_DO_3H_DO_10KM = 'MIEJSKI_DO_3H_DO_10KM';
  const MIEJSKI_DO_3H_DO_15KM = 'MIEJSKI_DO_3H_DO_15KM';
  const MIEJSKI_DO_3H_POWYZEJ_15KM = 'MIEJSKI_DO_3H_POWYZEJ_15KM';
  const MIEJSKI_DO_4H_DO_10KM = 'MIEJSKI_DO_4H_DO_10KM';
  const MIEJSKI_DO_4H_DO_15KM = 'MIEJSKI_DO_4H_DO_15KM';
  const MIEJSKI_DO_4H_DO_20KM = 'MIEJSKI_DO_4H_DO_20KM';
  const MIEJSKI_DO_4H_DO_30KM = 'MIEJSKI_DO_4H_DO_30KM';
  const MIEJSKI_DO_4H_DO_40KM = 'MIEJSKI_DO_4H_DO_40KM';
  const EKSPRES24 = 'EKSPRES24';
  const LIST_ZWYKLY = 'LIST_ZWYKLY';
}

class doreczenieType {
  public $oczekiwanyTerminDoreczenia; // date
  public $oczekiwanaGodzinaDoreczenia; // oczekiwanaGodzinaDoreczeniaType
  public $wSobote; // boolean
  public $w90Minut; // boolean
  public $wNiedzieleLubSwieto; // boolean
  public $doRakWlasnych; // boolean
  public $wGodzinachOd20Do7; // boolean
}

class oczekiwanaGodzinaDoreczeniaType {
  const DO_0800 = 'DO 08:00';
  const DO_0900 = 'DO 09:00';
  const DO_1200 = 'DO 12:00';
  const NA_1300 = 'NA 13:00';
  const NA_1400 = 'NA 14:00';
  const NA_1500 = 'NA 15:00';
  const NA_1600 = 'NA 16:00';
  const NA_1700 = 'NA 17:00';
  const NA_1800 = 'NA 18:00';
  const NA_1900 = 'NA 19:00';
  const NA_2000 = 'NA 20:00';
}

class paczkaZagranicznaType {
  public $zwrot; // zwrotType
  public $posteRestante; // boolean
  public $masa; // masaType
  public $wartosc; // wartoscType
  public $kategoria; // kategoriaType
  public $iloscPotwierdzenOdbioru; // iloscPotwierdzenOdbioruType
  public $utrudnionaManipulacja; // boolean
}

class setEnvelopeBuforDataNadania {
  public $dataNadania; // date
}

class setEnvelopeBuforDataNadaniaResponse {
  public $error; // errorType
}

class lokalizacjaGeograficznaType {
  public $dlugosc; // wspolrzednaGeograficznaType
  public $szerokosc; // wspolrzednaGeograficznaType
}

class wspolrzednaGeograficznaType {
  public $dec; // float
  public $stopien; // int
  public $minuta; // int
  public $sekunda; // float
}

class zwrotType {
  public $zwrotPoLiczbieDni; // int
  public $traktowacJakPorzucona; // boolean
  public $sposobZwrotu; // sposobZwrotuType
}

class sposobZwrotuType {
  const LADOWO_MORSKA = 'LADOWO_MORSKA';
  const LOTNICZA = 'LOTNICZA';
}

class listZwyklyType {
  public $posteRestante; // boolean
  public $kategoria; // kategoriaType
  public $gabaryt; // gabarytType
  public $masa; // masaType
  public $egzemplarzBiblioteczny; // boolean
  public $dlaOciemnialych; // boolean
}

class reklamowaType {
  public $masa; // masaType
  public $gabaryt; // gabarytType
}

class getEPOStatus {
  public $guid; // guidType
  public $endedOnly; // boolean
  public $idEnvelope; // int
}

class getEPOStatusResponse {
  public $epo; // przesylkaEPOType
  public $error; // errorType
}

class statusEPOEnum {
  const ERROR = 'ERROR';
  const NADANIE = 'NADANIE';
  const W_TRANSPORCIE = 'W_TRANSPORCIE';
  const CLO = 'CLO';
  const SMS = 'SMS';
  const W_DORECZENIU = 'W_DORECZENIU';
  const AWIZO = 'AWIZO';
  const PONOWNE_AWIZO = 'PONOWNE_AWIZO';
  const ZWROT = 'ZWROT';
  const DORECZONA = 'DORECZONA';
}

class EPOType {
}

class EPOSimpleType {
}

class EPOExtendedType {
  public $zasadySpecjalne; // zasadySpecjalneEnum
}

class zasadySpecjalneEnum {
  const ADMINISTRACYJNA = 'ADMINISTRACYJNA';
  const PODATKOWA = 'PODATKOWA';
  const SADOWA_CYWILNA = 'SADOWA_CYWILNA';
  const SADOWA_KARNA = 'SADOWA_KARNA';
}

class przesylkaEPOType {
  public $EPOInfo; // EPOInfoType
  public $guid; // guidType
  public $numerNadania; // numerNadaniaType
  public $statusEPO; // statusEPOEnum
}

class przesylkaFirmowaPoleconaType {
  public $miejscowa; // boolean
}

class EPOInfoType {
  public $awizoPrzesylki; // awizoPrzesylkiType
  public $doreczeniePrzesylki; // doreczeniePrzesylkiType
  public $zwrotPrzesylki; // zwrotPrzesylkiType
}

class awizoPrzesylkiType {
  public $dataPierwszegoAwizowania; // date
  public $dataDrugiegoAwizowania; // date
  public $miejscePozostawienia; // miejscaPozostawieniaAwizoEnum
  public $idPlacowkaPocztowaWydajaca; // int
}

class doreczeniePrzesylkiType {
  public $data; // date
  public $osobaOdbierajaca; // string
  public $podmiotDoreczenia; // podmiotDoreczeniaEnum
}

class zwrotPrzesylkiType {
  public $przyczyna; // przyczynaZwrotuEnum
}

class miejscaPozostawieniaAwizoEnum {
  const SKRZYNKA_ADRESATA = 'SKRZYNKA_ADRESATA';
  const DRZWI_MIESZKANIA = 'DRZWI_MIESZKANIA';
  const DRZWI_BIURA = 'DRZWI_BIURA';
  const DRZWI_INNE = 'DRZWI_INNE';
  const PRZY_WEJSCIU_NA_POSESJE = 'PRZY_WEJSCIU_NA_POSESJE';
}

class podmiotDoreczeniaEnum {
  const ADRESAT = 'ADRESAT';
  const PELNOLETNI_DOMOWNIK = 'PELNOLETNI_DOMOWNIK';
  const SASIAD = 'SASIAD';
  const DOZORCA_DOMU = 'DOZORCA_DOMU';
}

class przyczynaZwrotuEnum {
  const ODMOWA = 'ODMOWA';
  const ADRESAT_ZMARL = 'ADRESAT_ZMARL';
  const ADRESAT_NIEZNANY = 'ADRESAT_NIEZNANY';
  const ADRESAT_WYPROWADZIL_SIE = 'ADRESAT_WYPROWADZIL_SIE';
  const ADRESAT_NIE_PODJAL = 'ADRESAT_NIE_PODJAL';
  const INNA = 'INNA';
}


/**
 * ElektronicznyNadawca class
 * 
 *  
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class ElektronicznyNadawca extends SoapClient {

  private static $classmap = array(
                                    'addShipment' => 'addShipment',
                                    'addShipmentResponse' => 'addShipmentResponse',
                                    'przesylkaType' => 'przesylkaType',
                                    'pocztexKrajowyType' => 'pocztexKrajowyType',
                                    'umowaType' => 'umowaType',
                                    'masaType' => 'masaType',
                                    'numerNadaniaType' => 'numerNadaniaType',
                                    'changePassword' => 'changePassword',
                                    'changePasswordResponse' => 'changePasswordResponse',
                                    'terminRodzajType' => 'terminRodzajType',
                                    'uiszczaOplateType' => 'uiszczaOplateType',
                                    'wartoscType' => 'wartoscType',
                                    'kwotaPobraniaType' => 'kwotaPobraniaType',
                                    'sposobPobraniaType' => 'sposobPobraniaType',
                                    'sposobPrzekazaniaType' => 'sposobPrzekazaniaType',
                                    'sposobDoreczeniaPotwierdzeniaType' => 'sposobDoreczeniaPotwierdzeniaType',
                                    'iloscPotwierdzenOdbioruType' => 'iloscPotwierdzenOdbioruType',
                                    'dataDlaDostarczeniaType' => 'dataDlaDostarczeniaType',
                                    'razemType' => 'razemType',
                                    'nazwaType' => 'nazwaType',
                                    'nazwa2Type' => 'nazwa2Type',
                                    'ulicaType' => 'ulicaType',
                                    'numerDomuType' => 'numerDomuType',
                                    'numerLokaluType' => 'numerLokaluType',
                                    'miejscowoscType' => 'miejscowoscType',
                                    'kodPocztowyType' => 'kodPocztowyType',
                                    'paczkaPocztowaType' => 'paczkaPocztowaType',
                                    'kategoriaType' => 'kategoriaType',
                                    'gabarytType' => 'gabarytType',
                                    'paczkaPocztowaPLUSType' => 'paczkaPocztowaPLUSType',
                                    'przesylkaPobraniowaType' => 'przesylkaPobraniowaType',
                                    'przesylkaNaWarunkachSzczegolnychType' => 'przesylkaNaWarunkachSzczegolnychType',
                                    'przesylkaPoleconaKrajowaType' => 'przesylkaPoleconaKrajowaType',
                                    'przesylkaListowaZadeklarowanaWartoscType' => 'przesylkaListowaZadeklarowanaWartoscType',
                                    'przesylkaFullType' => 'przesylkaFullType',
                                    'errorType' => 'errorType',
                                    'adresType' => 'adresType',
                                    'sendEnvelope' => 'sendEnvelope',
                                    'sendEnvelopeResponseType' => 'sendEnvelopeResponseType',
                                    'urzadNadaniaType' => 'urzadNadaniaType',
                                    'getUrzedyNadania' => 'getUrzedyNadania',
                                    'getUrzedyNadaniaResponse' => 'getUrzedyNadaniaResponse',
                                    'clearEnvelope' => 'clearEnvelope',
                                    'clearEnvelopeResponse' => 'clearEnvelopeResponse',
                                    'urzadNadaniaFullType' => 'urzadNadaniaFullType',
                                    'guidType' => 'guidType',
                                    'ePrzesylkaType' => 'ePrzesylkaType',
                                    'eSposobPowiadomieniaType' => 'eSposobPowiadomieniaType',
                                    'eKontaktType' => 'eKontaktType',
                                    'urzadWydaniaEPrzesylkiType' => 'urzadWydaniaEPrzesylkiType',
                                    'pobranieType' => 'pobranieType',
                                    'anonymous51' => 'anonymous51',
                                    'anonymous52' => 'anonymous52',
                                    'przesylkaPoleconaZagranicznaType' => 'przesylkaPoleconaZagranicznaType',
                                    'krajType' => 'krajType',
                                    'getUrzedyWydajaceEPrzesylki' => 'getUrzedyWydajaceEPrzesylki',
                                    'getUrzedyWydajaceEPrzesylkiResponse' => 'getUrzedyWydajaceEPrzesylkiResponse',
                                    'uploadIWDContent' => 'uploadIWDContent',
                                    'getEnvelopeStatus' => 'getEnvelopeStatus',
                                    'getEnvelopeStatusResponse' => 'getEnvelopeStatusResponse',
                                    'envelopeStatusType' => 'envelopeStatusType',
                                    'downloadIWDContent' => 'downloadIWDContent',
                                    'downloadIWDContentResponse' => 'downloadIWDContentResponse',
                                    'przesylkaShortType' => 'przesylkaShortType',
                                    'addShipmentResponseItemType' => 'addShipmentResponseItemType',
                                    'getKarty' => 'getKarty',
                                    'getKartyResponse' => 'getKartyResponse',
                                    'getPasswordExpiredDate' => 'getPasswordExpiredDate',
                                    'getPasswordExpiredDateResponse' => 'getPasswordExpiredDateResponse',
                                    'setAktywnaKarta' => 'setAktywnaKarta',
                                    'setAktywnaKartaResponse' => 'setAktywnaKartaResponse',
                                    'getEnvelopeContentFull' => 'getEnvelopeContentFull',
                                    'getEnvelopeContentFullResponse' => 'getEnvelopeContentFullResponse',
                                    'getEnvelopeContentShort' => 'getEnvelopeContentShort',
                                    'getEnvelopeContentShortResponse' => 'getEnvelopeContentShortResponse',
                                    'hello' => 'hello',
                                    'helloResponse' => 'helloResponse',
                                    'kartaType' => 'kartaType',
                                    'telefonType' => 'telefonType',
                                    'getAddressLabel' => 'getAddressLabel',
                                    'getAddressLabelResponse' => 'getAddressLabelResponse',
                                    'addressLabelContent' => 'addressLabelContent',
                                    'getOutboxBook' => 'getOutboxBook',
                                    'getOutboxBookResponse' => 'getOutboxBookResponse',
                                    'getFirmowaPocztaBook' => 'getFirmowaPocztaBook',
                                    'getFirmowaPocztaBookResponse' => 'getFirmowaPocztaBookResponse',
                                    'getEnvelopeList' => 'getEnvelopeList',
                                    'getEnvelopeListResponse' => 'getEnvelopeListResponse',
                                    'envelopeInfoType' => 'envelopeInfoType',
                                    'przesylkaZagranicznaType' => 'przesylkaZagranicznaType',
                                    'przesylkaRejestrowanaType' => 'przesylkaRejestrowanaType',
                                    'przesylkaNieRejestrowanaType' => 'przesylkaNieRejestrowanaType',
                                    'anonymous92' => 'anonymous92',
                                    'przesylkaBiznesowaType' => 'przesylkaBiznesowaType',
                                    'gabarytBiznesowaType' => 'gabarytBiznesowaType',
                                    'subPrzesylkaBiznesowaType' => 'subPrzesylkaBiznesowaType',
                                    'subPrzesylkaBiznesowaPlusType' => 'subPrzesylkaBiznesowaPlusType',
                                    'getAddresLabelByGuid' => 'getAddresLabelByGuid',
                                    'getAddresLabelByGuidResponse' => 'getAddresLabelByGuidResponse',
                                    'przesylkaBiznesowaPlusType' => 'przesylkaBiznesowaPlusType',
                                    'opisType' => 'opisType',
                                    'numerPrzesylkiKlientaType' => 'numerPrzesylkiKlientaType',
                                    'pakietType' => 'pakietType',
                                    'opakowanieType' => 'opakowanieType',
                                    'typOpakowaniaType' => 'typOpakowaniaType',
                                    'getPlacowkiPocztowe' => 'getPlacowkiPocztowe',
                                    'getPlacowkiPocztoweResponse' => 'getPlacowkiPocztoweResponse',
                                    'getGuid' => 'getGuid',
                                    'getGuidResponse' => 'getGuidResponse',
                                    'kierunekType' => 'kierunekType',
                                    'getKierunki' => 'getKierunki',
                                    'anonymous111' => 'anonymous111',
                                    'getKierunkiResponse' => 'getKierunkiResponse',
                                    'czynnoscUpustowaType' => 'czynnoscUpustowaType',
                                    'miejsceOdbioruType' => 'miejsceOdbioruType',
                                    'sposobNadaniaType' => 'sposobNadaniaType',
                                    'getKierunkiInfo' => 'getKierunkiInfo',
                                    'getKierunkiInfoResponse' => 'getKierunkiInfoResponse',
                                    'kwotaTranzakcjiType' => 'kwotaTranzakcjiType',
                                    'uslugiType' => 'uslugiType',
                                    'idWojewodztwoType' => 'idWojewodztwoType',
                                    'placowkaPocztowaType' => 'placowkaPocztowaType',
                                    'anonymous122' => 'anonymous122',
                                    'anonymous123' => 'anonymous123',
                                    'punktWydaniaPrzesylkiBiznesowejPlus' => 'punktWydaniaPrzesylkiBiznesowejPlus',
                                    'statusType' => 'statusType',
                                    'terminRodzajPlusType' => 'terminRodzajPlusType',
                                    'typOpakowanieType' => 'typOpakowanieType',
                                    'getEnvelopeBufor' => 'getEnvelopeBufor',
                                    'getEnvelopeBuforResponse' => 'getEnvelopeBuforResponse',
                                    'clearEnvelopeByGuids' => 'clearEnvelopeByGuids',
                                    'clearEnvelopeByGuidsResponse' => 'clearEnvelopeByGuidsResponse',
                                    'zwrotDokumentowType' => 'zwrotDokumentowType',
                                    'odbiorPrzesylkiOdNadawcyType' => 'odbiorPrzesylkiOdNadawcyType',
                                    'potwierdzenieDoreczeniaType' => 'potwierdzenieDoreczeniaType',
                                    'listRodzajType' => 'listRodzajType',
                                    'rodzajListType' => 'rodzajListType',
                                    'potwierdzenieOdbioruType' => 'potwierdzenieOdbioruType',
                                    'sposobPrzekazaniaPotwierdzeniaOdbioruType' => 'sposobPrzekazaniaPotwierdzeniaOdbioruType',
                                    'doreczenieType' => 'doreczenieType',
                                    'oczekiwanaGodzinaDoreczeniaType' => 'oczekiwanaGodzinaDoreczeniaType',
                                    'paczkaZagranicznaType' => 'paczkaZagranicznaType',
                                    'setEnvelopeBuforDataNadania' => 'setEnvelopeBuforDataNadania',
                                    'setEnvelopeBuforDataNadaniaResponse' => 'setEnvelopeBuforDataNadaniaResponse',
                                    'lokalizacjaGeograficznaType' => 'lokalizacjaGeograficznaType',
                                    'wspolrzednaGeograficznaType' => 'wspolrzednaGeograficznaType',
                                    'zwrotType' => 'zwrotType',
                                    'sposobZwrotuType' => 'sposobZwrotuType',
                                    'listZwyklyType' => 'listZwyklyType',
                                    'reklamowaType' => 'reklamowaType',
                                    'getEPOStatus' => 'getEPOStatus',
                                    'getEPOStatusResponse' => 'getEPOStatusResponse',
                                    'statusEPOEnum' => 'statusEPOEnum',
                                    'EPOType' => 'EPOType',
                                    'EPOSimpleType' => 'EPOSimpleType',
                                    'EPOExtendedType' => 'EPOExtendedType',
                                    'zasadySpecjalneEnum' => 'zasadySpecjalneEnum',
                                    'przesylkaEPOType' => 'przesylkaEPOType',
                                    'przesylkaFirmowaPoleconaType' => 'przesylkaFirmowaPoleconaType',
                                    'EPOInfoType' => 'EPOInfoType',
                                    'awizoPrzesylkiType' => 'awizoPrzesylkiType',
                                    'doreczeniePrzesylkiType' => 'doreczeniePrzesylkiType',
                                    'zwrotPrzesylkiType' => 'zwrotPrzesylkiType',
                                    'miejscaPozostawieniaAwizoEnum' => 'miejscaPozostawieniaAwizoEnum',
                                    'podmiotDoreczeniaEnum' => 'podmiotDoreczeniaEnum',
                                    'przyczynaZwrotuEnum' => 'przyczynaZwrotuEnum',
                                   );

  public function ElektronicznyNadawcaWSDL($wsdl = "O:\wwwroot\webEN2\ElektronicznyNadawca\websrv\en.wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
	$options["login"] = "{username}";
	$options["password"] = "{password}";
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param addShipment $parameters
   * @return addShipmentResponse
   */
  public function addShipment(addShipment $parameters) {
    return $this->__soapCall('addShipment', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param changePassword $parameters
   * @return changePasswordResponse
   */
  public function changePassword(changePassword $parameters) {
    return $this->__soapCall('changePassword', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param sendEnvelope $parameters
   * @return sendEnvelopeResponseType
   */
  public function sendEnvelope(sendEnvelope $parameters) {
    return $this->__soapCall('sendEnvelope', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getUrzedyNadania $parameters
   * @return getUrzedyNadaniaResponse
   */
  public function getUrzedyNadania(getUrzedyNadania $parameters) {
    return $this->__soapCall('getUrzedyNadania', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param clearEnvelope $parameters
   * @return clearEnvelopeResponse
   */
  public function clearEnvelope(clearEnvelope $parameters) {
    return $this->__soapCall('clearEnvelope', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getUrzedyWydajaceEPrzesylki $parameters
   * @return getUrzedyWydajaceEPrzesylkiResponse
   */
  public function getUrzedyWydajaceEPrzesylki(getUrzedyWydajaceEPrzesylki $parameters) {
    return $this->__soapCall('getUrzedyWydajaceEPrzesylki', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param uploadIWDContent $parameters
   * @return sendEnvelopeResponseType
   */
  public function uploadIWDContent(uploadIWDContent $parameters) {
    return $this->__soapCall('uploadIWDContent', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEnvelopeStatus $parameters
   * @return getEnvelopeStatusResponse
   */
  public function getEnvelopeStatus(getEnvelopeStatus $parameters) {
    return $this->__soapCall('getEnvelopeStatus', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param downloadIWDContent $parameters
   * @return downloadIWDContentResponse
   */
  public function downloadIWDContent(downloadIWDContent $parameters) {
    return $this->__soapCall('downloadIWDContent', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getKarty $parameters
   * @return getKartyResponse
   */
  public function getKarty(getKarty $parameters) {
    return $this->__soapCall('getKarty', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getPasswordExpiredDate $parameters
   * @return getPasswordExpiredDateResponse
   */
  public function getPasswordExpiredDate(getPasswordExpiredDate $parameters) {
    return $this->__soapCall('getPasswordExpiredDate', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param setAktywnaKarta $parameters
   * @return setAktywnaKartaResponse
   */
  public function setAktywnaKarta(setAktywnaKarta $parameters) {
    return $this->__soapCall('setAktywnaKarta', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param hello $parameters
   * @return helloResponse
   */
  public function hello(hello $parameters) {
    return $this->__soapCall('hello', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEnvelopeContentShort $parameters
   * @return getEnvelopeContentShortResponse
   */
  public function getEnvelopeContentShort(getEnvelopeContentShort $parameters) {
    return $this->__soapCall('getEnvelopeContentShort', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEnvelopeContentFull $parameters
   * @return getEnvelopeContentFullResponse
   */
  public function getEnvelopeContentFull(getEnvelopeContentFull $parameters) {
    return $this->__soapCall('getEnvelopeContentFull', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAddressLabel $parameters
   * @return getAddressLabelResponse
   */
  public function getAddressLabel(getAddressLabel $parameters) {
    return $this->__soapCall('getAddressLabel', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getOutboxBook $parameters
   * @return getOutboxBookResponse
   */
  public function getOutboxBook(getOutboxBook $parameters) {
    return $this->__soapCall('getOutboxBook', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getFirmowaPocztaBook $parameters
   * @return getFirmowaPocztaBookResponse
   */
  public function getFirmowaPocztaBook(getFirmowaPocztaBook $parameters) {
    return $this->__soapCall('getFirmowaPocztaBook', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEnvelopeList $parameters
   * @return getEnvelopeListResponse
   */
  public function getEnvelopeList(getEnvelopeList $parameters) {
    return $this->__soapCall('getEnvelopeList', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getAddresLabelByGuid $parameters
   * @return getAddresLabelByGuidResponse
   */
  public function getAddresLabelByGuid(getAddresLabelByGuid $parameters) {
    return $this->__soapCall('getAddresLabelByGuid', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getPlacowkiPocztowe $parameters
   * @return getPlacowkiPocztoweResponse
   */
  public function getPlacowkiPocztowe(getPlacowkiPocztowe $parameters) {
    return $this->__soapCall('getPlacowkiPocztowe', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getGuid $parameters
   * @return getGuidResponse
   */
  public function getGuid(getGuid $parameters) {
    return $this->__soapCall('getGuid', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getKierunki $parameters
   * @return getKierunkiResponse
   */
  public function getKierunki(getKierunki $parameters) {
    return $this->__soapCall('getKierunki', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getKierunkiInfo $parameters
   * @return getKierunkiInfoResponse
   */
  public function getKierunkiInfo(getKierunkiInfo $parameters) {
    return $this->__soapCall('getKierunkiInfo', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEnvelopeBufor $parameters
   * @return getEnvelopeBuforResponse
   */
  public function getEnvelopeBufor(getEnvelopeBufor $parameters) {
    return $this->__soapCall('getEnvelopeBufor', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param clearEnvelopeByGuids $parameters
   * @return clearEnvelopeByGuidsResponse
   */
  public function clearEnvelopeByGuids(clearEnvelopeByGuids $parameters) {
    return $this->__soapCall('clearEnvelopeByGuids', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param setEnvelopeBuforDataNadania $parameters
   * @return setEnvelopeBuforDataNadaniaResponse
   */
  public function setEnvelopeBuforDataNadania(setEnvelopeBuforDataNadania $parameters) {
    return $this->__soapCall('setEnvelopeBuforDataNadania', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param getEPOStatus $parameters
   * @return getEPOStatusResponse
   */
  public function getEPOStatus(getEPOStatus $parameters) {
    return $this->__soapCall('getEPOStatus', array($parameters),       array(
            'uri' => 'http://e-nadawca.poczta-polska.pl',
            'soapaction' => ''
           )
      );
  }

}

?>
