<?php

use PrestaShop\Module\FacetedSearch\Filters\Products;

require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/EstimationClass.php';
require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/EstimationFormValidator.php';
require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/FileHandler.php';

class Jm_EstimationEstimationModuleFrontController extends ModuleFrontController
{
    // public $php_self = 'estimation';

    public function __construct()
    {
        parent::__construct();
        // Get Context 
        $this->context = Context::getContext();
    }

    // Page 
    public function initContent()
    {
        parent::initContent();
        // Get Products 
        $ductTypes = $this->getProducts();

        $this->context->smarty->assign(
            array(
                'ductTypes' => $ductTypes,
            )
        );
        $this->setTemplate('module:' . $this->module->name . '/views/templates/front/estimation.tpl');
    }

    // Get Products from BDD 
    protected function getProducts()
    {
        // Art Category ID
        $categoryID = 9;

        // Number of Products to Retrieve
        $limit = 10;

        // Array to Store Products
        $products = [];

        // Get Category
        $category = new Category($categoryID, $this->context->language->id);

        if (Validate::isLoadedObject($category)) {
            // Get Products in the Category
            $productsCategory = $category->getProducts($this->context->language->id, 0, $limit);

            foreach ($productsCategory as $productCategory) {
                $productId = $productCategory['id_product'];

                // Get Product Object
                $product = new Product($productId, true, $this->context->language->id);

                if (Validate::isLoadedObject($product)) {
                    // Get the Main Product Image
                    $image = $product->getImages($this->context->language->id)[0];

                    if (isset($image['id_image'])) {
                        // Get Image Link Rewrited
                        $imageLink = $this->context->link->getImageLink(
                            $product->link_rewrite ? $product->link_rewrite : $product->name,
                            (int) $image['id_image']
                        );

                        // Store Product Info 
                        $products[] = [
                            'id_product' => $productId,
                            'image' => $imageLink,
                            'name' => $product->name,
                        ];
                    }
                }
            }
        }

        return $products;

        // $ductTypes = array(
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 1'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 2'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 3'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 4'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 5'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 6'),
        //     array('image' => 'https://placehold.co/600x400', 'name' => 'Duct Type 7'),
        // );
        // return $ductTypes;
    }

    // Form Handler 
    public function postProcess()
    {
        // Submission Handler 
        if (Tools::isSubmit('estimation_submit')) {

            // Get Form Values
            $values = Tools::getAllValues();
            $values['file'] = Tools::fileAttachment('drawing_file');

            // Validate Form
            $formValidator = new EstimationFormValidator($values);
            $errors = $formValidator->validateForm();
            $errors = array_merge($errors, FileHandler::validateFileSize());

            if (empty($errors)) {

                // File Behavior Renaming
                $values['file_path'] = FileHandler::getFilePath($values['file']);
                // Success Handler
                $this->processSuccess($values);
            } else {

                // Errors Handler
                $this->processErrors($errors);
            }
        }
    }

    // Success Handler
    private function processSuccess($values)
    {
        $estimation = new EstimationClass();

        // Date Behavior 
        $currentDateTime = date('Y-m-d H:i:s');
        $estimation->setCreatedAt($currentDateTime);

        if (!$estimation->saveByFormValues($values) || !$estimation->sendEstimationRequestConfirmation()) {
            // Display Errors 
            $this->errors[] = $this->context->getTranslator()->trans('Votre demande n\'a pas pu être soumise. Veuillez contacter l\'administrateur.', [], 'Admin.Notifications.Error');
            $this->redirectWithNotifications($this->getCurrentURL());
        }
        // Display Success
        $estimation->sendEstimationRequestNotification();
        $this->success[] = $this->context->getTranslator()->trans('Votre demande a été soumise avec succès.', [], 'Admin.Notifications.Success');
        $this->redirectWithNotifications($this->getCurrentURL());;
    }

    // Errors Handler
    private function processErrors($errors)
    {
        // Display Each Error Message 
        foreach ($errors as $error) {
            $this->errors[] = $error;
        }
        $this->redirectWithNotifications($this->getCurrentURL());
    }
}
