<?php

require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/EstimationClass.php';

if (!defined('_PS_VERSION_')) {
    exit;
}

class Jm_Estimation extends Module
{

    public function __construct()
    {
        $this->name = 'jm_estimation';
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "Jensen MOOROONGAPILLAY";
        $this->ps_versions_compliancy = [
            "min" => "1.6",
            "max" => _PS_VERSION_
        ];

        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l("Estimation Module");
        $this->description = $this->l("Customized Heating Duct Estimation Module.");
        $this->confirmUninstall = $this->l('Voulez-vous vraiment désinstaller ce module ?');
    }

    public function install()
    {
        if (
            !parent::install() ||
            !$this->createTable() ||
            !$this->installTab('AdminEstimation', 'Estimations', 'AdminParentOrders') ||
            !$this->registerHook('actionFrontControllerSetMedia')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (
            !parent::uninstall() ||
            !Configuration::deleteByName('KEY') ||
            !$this->deleteTable() ||
            !$this->uninstallTab('AdminEstimation') ||
            !$this->deleteUploadedFiles()
        ) {
            return false;
        }

        return true;
    }

    public function getContent()
    {
        return $this->PostProcess() . $this->renderForm();
    }

    public function renderForm()
    {

        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings')
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Key Value'),
                    'name' => 'KEY',
                    'required' => true
                ],
            ],
            'submit' => [
                'title' => $this->l('save'),
                'name' => 'save',
                'class' => 'btn btn-primary'
            ]
        ];

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->fields_value['KEY'] = Configuration::get('KEY');
        return $helper->generateForm($fieldsForm);
    }

    public function PostProcess()
    {

        if (Tools::isSubmit('save')) {

            $key = Tools::getValue('KEY');
            $errors = false;

            if (empty($key)) {
                $errors = true;
                return $this->displayError('Key can\'t be empty.');
            }


            if (!Validate::isString($key)) {
                $errors = true;
                return $this->displayError('Key type is not a string.');
            }

            if ($errors == false) {
                Configuration::updateValue('KEY', $key);
                return $this->displayConfirmation('Key has been saved.');
            }
        }
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . _DB_PREFIX_ . "estimation (
            `id_estimation` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `duct_type` VARCHAR(255) NOT NULL,
            `stove_height` INT NOT NULL,
            `stove_ceiling_height` INT NOT NULL,
            `ceiling_thickness` INT NOT NULL,
            `parapet_height` INT,
            `installation_timeframe` VARCHAR(255) NOT NULL,
            `heating_appliance` VARCHAR(255) NOT NULL,
            `smoke_outlet_diameter` INT NOT NULL,
            `additional_details` TEXT,
            `drawing_file` VARCHAR(255),
            `last_name` VARCHAR(50) NOT NULL,
            `first_name` VARCHAR(50) NOT NULL,
            `address` VARCHAR(255) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `phone` VARCHAR(20) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME
        ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8";

        return Db::getInstance()->execute($sql);
    }


    public function deleteTable()
    {
        return Db::getInstance()->execute("DROP TABLE IF EXISTS " . _DB_PREFIX_ . "estimation");
    }


    public function installTab($className, $tabName, $tabParentName = false)
    {
        $tabId = (int) Tab::getIdFromClassName($className);
        if (!$tabId) {
            $tabId = null;
        }

        $tab =  new Tab();
        $tab->active = true;
        $tab->class_name = $className;
        $tab->name = array();

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $this->trans($tabName, array(), 'Modules.EstimationModule.Admin', $lang['locale']);
        }

        if ($tabParentName) {
            $tab->id_parent = Tab::getIdFromClassName($tabParentName);
        } else {
            $tab->id_parent = 10;
        }

        $tab->module = $this->name;
        return $tab->save();
    }


    public function uninstallTab($className)
    {
        $idTab = Tab::getIdFromClassName($className);
        if (!$idTab) {
            return true;
        }
        $tab = new Tab($idTab);
        return $tab->delete();
    }

    public function deleteUploadedFiles()
    {
        $uploadsDir = _PS_MODULE_DIR_ . $this->name . '/uploads/';

        if (!is_dir($uploadsDir)) {
            return false;
        }
        // Get Files 
        $files = scandir($uploadsDir);

        // Verify Path Files 
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $uploadsDir . $file;

                if (is_file($filePath)) {
                    // Delete File 
                    unlink($filePath);
                }
            }
        }
        return true;
    }

    public function hookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->addJS(_PS_MODULE_DIR_ . $this->name . '/views/js/estimation.js');
    }
}
