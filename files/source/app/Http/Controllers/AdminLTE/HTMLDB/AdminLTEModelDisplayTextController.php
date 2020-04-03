<?php

namespace App\Http\Controllers\AdminLTE\HTMLDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AdminLTE;
use App\AdminLTEUser;
use App\HTMLDB;

class AdminLTEModelDisplayTextController extends Controller
{

    public $columns = [];
    public $protectedColumns = [];
    public $row = [];

    public function get_model_display_texts(Request $request)
    {
        $this->columns = [
            'id',
            'model',
            'display_text_json'
        ];

        $adminLTE = new AdminLTE();
        $list = array();

        $Models = $adminLTE->getModelList();
        $displayTexts = $adminLTE->getAllModelDisplayTexts();

        $countModels = count($Models);
        $index = 0;

        for ($i=0; $i < $countModels; $i++) { 
            $model = $Models[$i];

            $list[$index]['id'] = ($index + 1);
            $list[$index]['model'] = $model;
            $list[$index]['display_text_json'] = json_encode(
                    $displayTexts[$model],
                    (JSON_HEX_QUOT
                    | JSON_HEX_TAG
                    | JSON_HEX_AMP
                    | JSON_HEX_APOS));

            $index++;
        } // for ($i=0; $i < $countModels; $i++) { 

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function get_model_property_list(Request $request)
    {
        $this->columns = [
            'id',
            'model',
            'property',
            'type'
        ];

        $adminLTE = new AdminLTE();
        $list = array();

        $Models = $adminLTE->getModelList();

        $countModels = count($Models);
        $index = 0;

        for ($i=0; $i < $countModels; $i++)
        {
            $model = $Models[$i];
            
            $modelNameWithNamespace = ('\\App\\' . $model);
            $object = new $modelNameWithNamespace;
            $property_list = $adminLTE->getModelPropertyList($object);
            $countProperty = count($property_list);

            for ($j=0; $j < $countProperty; $j++)
            {
                $list[$index]['id'] = ($index + 1);
                $list[$index]['model'] = $model;
                $list[$index]['property'] = $property_list[$j]['property'];
                $list[$index]['type'] = 'text';

                $index++;
            } // for ($j=0; $j < $countProperty; $j++) { 
        } // for ($i=0; $i < $countModels; $i++) { 

        $objectHTMLDB = new HTMLDB();
        $objectHTMLDB->list = $list;
        $objectHTMLDB->columns = $this->columns;
        $objectHTMLDB->printHTMLDBList();
        return;
    }

    public function post_model_display_texts(Request $request)
    {
        $controller->errorCount = 0;
        $controller->messageCount = 0;
        $controller->lastError = '';
        $controller->lastMessage = '';
        
        $model = isset($_REQUEST['htmldb_row0_model'])
            ? htmlspecialchars($_REQUEST['htmldb_row0_model'])
            : '';

        $display_text_json = isset($_REQUEST['htmldb_row0_display_text_json'])
            ? $_REQUEST['htmldb_row0_display_text_json']
            : '[]';

        includeLibrary('adminlte/base64encode');
        $display_texts = base64encode($display_text_json);
        
        includeModel('__ModelDisplayText');
        $list__ModelDisplayText = new __ModelDisplayText();
        $list__ModelDisplayText->addFilter('deleted', '==', false);
        $list__ModelDisplayText->addFilter('model', '==', $model);
        $list__ModelDisplayText->bufferSize = 1;
        $list__ModelDisplayText->page = 0;
        $list__ModelDisplayText->find();

        if ($list__ModelDisplayText->listCount > 0) {
            $object__ModelDisplayText = $list__ModelDisplayText->list[0];
            $object__ModelDisplayText->display_texts = $display_texts;
            $object__ModelDisplayText->update();
        } else {
            $object__ModelDisplayText = new __ModelDisplayText();;
            $object__ModelDisplayText->model = $model;
            $object__ModelDisplayText->display_texts = $display_texts;
            $object__ModelDisplayText->insert();
        } // if ($list__ModelDisplayText->listCount > 0) {

        $controller->messageCount = 1;
        $controller->lastMessage = 'UPDATED';
        return true;
    }

}
