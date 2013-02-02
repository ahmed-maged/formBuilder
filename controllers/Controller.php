<?php

class Controller extends BaseController {

    /**
     *  render main view
     */
    public function get_index()
    {

        $_POST = array(
            'formName'=>'new form',
            'formDesc'=>'new form desc',
            'inputs'=>array(
                array(
                    'label'=>'name',
                    'type'=>'text',
                ),
                array(
                    'label'=>'password',
                    'type'=>'password',
                ),
            )
        );
        $form = new Form();
        $form->name = $_POST['formName'];
        $form->description = $_POST['formDesc'];
        $form->inputs = array();
        if(isset($_POST['inputs']))
        {
            $inputs = $_POST['inputs'];
            foreach($inputs as $input)
            {
                $newInput = Input::generateInput($input['type'],array('type'=>$input['type'],'label'=>$input['label']));
                $newInput->type = $input['type'];
                $newInput->label = $input['label'];
                $form->inputs[] = $newInput;
            }
        }
        $form->save();
//        $this->render('index.php');
    }

    public function post_index()
    {
        $form = new FBForm();
        $form->name = $_POST['formName'];
        $form->description = $_POST['formDesc'];
        $form->save();
        if(isset($_POST['inputs']))
        {
            $inputs = $_POST['inputs'];
            foreach($inputs as $input)
            {
                $newInput = new FBInput();
                $newInput->form_id = $form->id;
                $newInput->type = $input['type'];
                $newInput->name = $input['label'];
                $newInput->save();
            }
        }
        $msg = "Your form has been submitted!";
        $this->render('message.php',array('msg'=>$msg));

    }
    
    public function get_forms()
    {
        $forms = FBForm::all();
        $this->render('forms.php',array('forms'=>$forms));
    }

    public function get_entries($formId)
    {
        $entriesOriginal = Data::where('form_id','=',$formId)->order_by('form_number')->get();
        $form = FBForm::find($formId);
        $entries = array();
        foreach ($entriesOriginal as $entry)
        {
            $entries[$entry->form_number][] = $entry;
        }
//        echo "<pre>";
//        print_r($entries);
//        echo "</pre>";
        return View::make('home.entries',array('entries'=>$entries,'form'=>$form));
    }
    
    public function get_entry($formNumber,$formId)
    {
        $entry = Data::with('input')->where('form_number','=',$formNumber)->where('form_id','=',$formId)->get();
        return View::make('home.entry',array('entry'=>$entry));
    }
    
    public function get_msg()
    {
        return View::make('home.message',array('msg'=>"Your action was successfully finished!"));
    }
    
    public function post_delete_form()
    {
        $formId = Input::get('formId');
        FBForm::find($formId)->data()->delete();
        FBForm::find($formId)->inputs()->delete();
        FBForm::find($formId)->delete();
        return json_encode(array('success'=>true));
    }
    
    public function post_delete_entry()
    {
        $formNumber = Input::get('formNumber');
        $formId = Input::get('formId');
        Data::where('form_number','=',$formNumber)->where('form_id','=',$formId)->delete();
        return json_encode(array('success'=>true));
    }
    
    public function get_test()
    {
//        $m = new MongoClient();
//        $db = $m->formbuilder;
//        $collection = $db->Form;
//        print_r($collection->drop());
//        $cursor = $collection->findone(array('_id'=>new MongoId("50e2ed15360a03742c000000")));
//        $cursor = $collection->find();
//        foreach($cursor as $doc)
//        {
//            print_r($cursor);
//        }
//        die;
//        $form = new Entry();
//        $form->form_id = '50e39550360a038c2c000002';
//        $form->inputs = array('dfs','qwq');
//        $form->save();
//        echo 'id='. $form->id.':::<br>';
//        echo 'form_id='. $form->form_id.':::<br>';
//        print_r(Entry::all());
//        $filter = array('form_id'=>' ');
//        Entry::delete($filter);
//          print_r(Entry::find('50e449e6360a03b42e00000b'));
//        $inputText = new InputText();
//        $inputText->label = 'name';
//        $inputText->default_value = 'your name';
//        $inputText->name = 'name';
//        $inputText->data = null;
//        $inputPass = new InputPassword();
//        $inputPass->label = 'password';
//        $inputPass->default_value = null;
//        $inputPass->name = 'pass';
//        $inputPass->data = null;
//        $form = new Form();
//        $form->name = 'login';
//        $form->description = 'login form';
//        $form->inputs = array($inputText,$inputPass);
//        $form->save();
                print_r(Form::all());
    }


    public function get_form($id)
    {
        $form = FBForm::with('inputs')->find($id);
        return View::make('home.form',array('form'=>$form));
    }

    public function post_form()
    {
        $inputs = FBInput::where('form_id','=',Input::get('formId'))->get();
        $inputIds = array();
        foreach ($inputs as $input)
        {
            $inputIds[] = $input->id;
        }
        $formNumber = DB::table('data')->where_in('input_id',$inputIds)->max('form_number') + 1 ;
//        echo "form_number = $formNumber <br>";
        foreach (Input::get() as $input=>$data)
        {
            if($input == 'formId')
                continue;
            $inputId = explode('_', $input);
            $inputId = $inputId[1];
            $newData = new Data();
            $newData->form_number = $formNumber;
            $newData->form_id = Input::get('formId');
            $newData->input_id = $inputId;
            $newData->data = $data;
            $newData->save();

//            echo "input_id = $inputId <br>";
//            echo "data = $data <br>";
        }
        $msg = "Your form has been submitted!";
        return View::make('home.message',array('msg'=>$msg));
    }

}
