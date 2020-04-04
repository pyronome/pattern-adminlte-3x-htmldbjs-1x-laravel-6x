<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminLTE;
use App\AdminLTEUser;
use App\HTMLDB;

class LanguagesController extends Controller
{
    public $columns = [];
    public $protectedColumns = [];
    public $row = [];

    public function get_copiedtranslation(Request $request)
    {

        $this->columns = [
            'id',
            'page',
            'fromLanguage',
            'toLanguage'
        ];

        $list = [];

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_languages(Request $request)
    {

        $this->columns = [
            'id',
            'code',
            'name'
        ];
        
        $list = array();
        $index = 0;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ar';
        $list[$index]['name'] = 'العربية';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'az';
        $list[$index]['name'] = 'Azərbaycanca';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'azb';
        $list[$index]['name'] = 'تۆرکجه';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ba';
        $list[$index]['name'] = 'Башҡортса';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'bg';
        $list[$index]['name'] = 'Български';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'bs';
        $list[$index]['name'] = 'Bosanski';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ca';
        $list[$index]['name'] = 'Català';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'crh';
        $list[$index]['name'] = 'Qırımtatarca';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'cs';
        $list[$index]['name'] = 'Čeština';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'cv';
        $list[$index]['name'] = 'Чӑвашла';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'da';
        $list[$index]['name'] = 'Dansk';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'de';
        $list[$index]['name'] = 'Deutsch';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'el';
        $list[$index]['name'] = 'Ελληνικά';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'en';
        $list[$index]['name'] = 'English';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'eo';
        $list[$index]['name'] = 'Esperanto';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'es';
        $list[$index]['name'] = 'Español';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'et';
        $list[$index]['name'] = 'Eesti';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'eu';
        $list[$index]['name'] = 'Euskara';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'fa';
        $list[$index]['name'] = 'فارسی';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'fi';
        $list[$index]['name'] = 'Suomi';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'fr';
        $list[$index]['name'] = 'Français';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'gag';
        $list[$index]['name'] = 'Gagauz';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'he';
        $list[$index]['name'] = 'עברית';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'hi';
        $list[$index]['name'] = 'हिन्दी';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'hr';
        $list[$index]['name'] = 'Hrvatski';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'hu';
        $list[$index]['name'] = 'Magyar';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'id';
        $list[$index]['name'] = 'Bahasa Indonesia';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'it';
        $list[$index]['name'] = 'İtaliano';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ja';
        $list[$index]['name'] = '日本語';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'kaa';
        $list[$index]['name'] = 'Qaraqalpaqsha';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ka';
        $list[$index]['name'] = 'ქართული';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'kk';
        $list[$index]['name'] = 'Қазақша';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ko';
        $list[$index]['name'] = '한국어';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'krc';
        $list[$index]['name'] = 'Къарачай-малкъар';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ku';
        $list[$index]['name'] = 'Kurdî';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ky';
        $list[$index]['name'] = 'Кыргызча';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'la';
        $list[$index]['name'] = 'Latina';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'lt';
        $list[$index]['name'] = 'Lietuvių';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'mk';
        $list[$index]['name'] = 'Македонски';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ms';
        $list[$index]['name'] = 'Bahasa Melayu';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'nl';
        $list[$index]['name'] = 'Nederlands';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'nn';
        $list[$index]['name'] = 'Norsk nynorsk';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'no';
        $list[$index]['name'] = 'Norsk bokmål';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'pl';
        $list[$index]['name'] = 'Polski';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'pt';
        $list[$index]['name'] = 'Português';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ro';
        $list[$index]['name'] = 'Română';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ru';
        $list[$index]['name'] = 'Русский';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sh';
        $list[$index]['name'] = 'Srpskohrvatski / српскохрватски';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sk';
        $list[$index]['name'] = 'Slovenčina';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sl';
        $list[$index]['name'] = 'Slovenščina';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sq';
        $list[$index]['name'] = 'Shqip';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sr';
        $list[$index]['name'] = 'Српски / srpski';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'sv';
        $list[$index]['name'] = 'Svenska';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'th';
        $list[$index]['name'] = 'ไทย';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'tr';
        $list[$index]['name'] = 'Türkçe';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'tk';
        $list[$index]['name'] = 'Türkmençe';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'tt';
        $list[$index]['name'] = 'Татарча/tatarça';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'ug';
        $list[$index]['name'] = 'ئۇيغۇرچە / Uyghurche';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'uk';
        $list[$index]['name'] = 'Українська';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'uz';
        $list[$index]['name'] = 'Oʻzbekcha/ўзбекча';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'vi';
        $list[$index]['name'] = 'Tiếng Việt';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'vo';
        $list[$index]['name'] = 'Volapük';
        $index++;

        $list[$index]['id'] = ($index + 1);
        $list[$index]['code'] = 'zh';
        $list[$index]['name'] = '中文</';

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_pages(Request $request)
    {

        $this->columns = [
            'id',
            'name'
        ];
        
        $list = array();
        $index = 0;

        includeLibrary('adminlte/getPanelPages');
        $pages = getPanelPages();
        $pageCount = count($pages);

        $list[$index]['id'] = ('adminlte');
        $list[$index]['name'] = 'adminlte';

        $index++;

        for ($i = 0; $i < $pageCount; $i++) {

            $list[$index]['id'] = $pages[$i]['id'];
            $list[$index]['name'] = $pages[$i]['name'];

            $index++;

        } // for ($i = 0; $i < $pageCount; $i++) {

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function get_translation(Request $request)
    {

        $this->columns = [
            'id',
            'deleted',
            'language',
            'page',
            'sentence',
            'translation'
        ];

        $language = 'en';
        if (isset($parameters[0])) {
            $language = htmlspecialchars($parameters[0]);
        } // if (isset($parameters[0])) {
        
        $page = 'adminlte';
        if (isset($parameters[1])) {
            $page = htmlspecialchars($parameters[1]);
        } // if (isset($parameters[0])) {

        $_SPRIT['LANGUAGE'] = array();
        
        $defaultFile = (DIR . '/languages/adminlte/' . $language . '/' . $page . '.php');
        $userFile = (CNFDIR . '/languages/adminlte/' . $language . '/' . $page . '.php');

        // Default Translations
        if (file_exists($defaultFile)) {
            include($defaultFile);
        } // if (file_exists($defaultFile)) {

        // User Translations
        if (file_exists($userFile)) {
            include($userFile);
        } // if (file_exists($userFile)) {

        $sentences = array_keys($_SPRIT['LANGUAGE']);
        $sentenceCount = count($sentences);

        $list = array();

        for ($i = 0; $i < $sentenceCount; $i++) {
            $list[$i]['id'] = ($i + 1);
            $list[$i]['deleted'] = 0;
            $list[$i]['language'] = $language;
            $list[$i]['page'] = $page;
            $list[$i]['sentence'] = $sentences[$i];
            $list[$i]['translation'] = $_SPRIT['LANGUAGE'][$sentences[$i]];
        } // for ($i = 0; $i < $sentenceCount; $i++) {

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;

    }

    public function post_copiedtranslation(Request $request)
    {

        $page = isset($_REQUEST['htmldb_row0_page'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_page'])
            : '';

        $fromLanguage = isset($_REQUEST['htmldb_row0_fromLanguage'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_fromLanguage'])
            : '';

        $toLanguage = isset($_REQUEST['htmldb_row0_toLanguage'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_toLanguage'])
            : '';

        $_SPRIT['LANGUAGE'] = array();
        $languageBase = array();

        $defaultLanguageDirectory = (DIR . '/languages/adminlte/' . $fromLanguage . '/');

        if (file_exists($defaultLanguageDirectory . $page . '.php')) {
            include($defaultLanguageDirectory . $page . '.php');
        } // if (file_exists($defaultLanguageDirectory . $page . '.php')) {

        $languageBase = array_replace($languageBase, $_SPRIT['LANGUAGE']);

        includeLibrary('openFTPConnection');
        openFTPConnection();

        includeLibrary('adminlte/writeLanguageTranslationFile');
        writeLanguageTranslationFile($toLanguage, $page, $languageBase);

        includeLibrary('closeFTPConnection');
        closeFTPConnection();

        return;

    }

    public function post_translation(Request $request)
    {
        loadLanguageFile('languages', 'adminlte');

        $index = 0;
        $prefix = '';

        $translations = array();

        while (isset($_REQUEST['htmldb_row' . $index . '_id'])) {
            $prefix = ('htmldb_row' . $index . '_');

            $language = isset($_REQUEST[$prefix . 'language'])
                ? htmlspecialchars($_REQUEST[$prefix . 'language'])
                : '';

            $page = isset($_REQUEST[$prefix . 'page'])
                ? htmlspecialchars($_REQUEST[$prefix . 'page'])
                : '';

            $sentence = isset($_REQUEST[$prefix . 'sentence'])
                ? htmlspecialchars($_REQUEST[$prefix . 'sentence'])
                : '';

            $translation = isset($_REQUEST[$prefix . 'translation'])
                ? htmlspecialchars($_REQUEST[$prefix . 'translation'])
                : '';
            
            $translations[$sentence] = $translation;
            
            $index++;
        } // while (isset($_REQUEST['htmldb_row' . $index . '_id'])) {


        includeLibrary('openFTPConnection');
        openFTPConnection();

        includeLibrary('adminlte/writeLanguageTranslationFile');
        writeLanguageTranslationFile($language, $page, $translations);

        includeLibrary('closeFTPConnection');
        closeFTPConnection();

        return;
    }

}
