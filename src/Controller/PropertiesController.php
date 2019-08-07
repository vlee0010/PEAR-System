<?php
namespace App\Controller;

class PropertiesController extends AppController
{

    public function index()
    {
//        $this->loadModel('Properties');

        // Load all properties from the database which are not yet sold.
        $unsoldProperties = $this->Properties->find()->where(['sold_price IS' => null]);

        // Pass these to the view so that they can be shown to the user. Make them available
        // to the view in a variable called 'properties'.
        $this->set('properties', $unsoldProperties);

        // At the end of this function, CakePHP will render the template in src/Templates/Properties/index.ctp.
    }



    public function details($id)
    {
//      Find the post(property and match the $id value passed in);
        $currentProperty = $this->Properties->find()->where(['id' => $id]);


//      Pass it into a variable called 'details';
        $this->set('details', $currentProperty);
    }



}
