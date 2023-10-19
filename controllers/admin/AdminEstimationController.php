<?php
require _PS_MODULE_DIR_ . '/jm_estimation/classes/EstimationClass.php';
require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/EstimationFormValidator.php';
require_once _PS_MODULE_DIR_ . '/jm_estimation/classes/FileHandler.php';
class AdminEstimationController extends ModuleAdminController
{

    public function __construct()
    {

        $this->table = 'estimation';
        $this->className = 'estimationClass';
        $this->module = 'jm_estimation';
        $this->identifier = 'id_estimation';
        $this->_orderBy = 'id_estimation';
        $this->bootstrap = true;

        parent::__construct();

        $this->bulk_actions = array('send' => array('text' => $this->trans('Send Estimation', [], 'Admin.Notifications.Error'), 'icon' => 'icon-pencil', 'confirm' => $this->trans('Are You Sure ? ', [], 'Admin.Notifications.Error')));

        $this->fields_list = array(
            'id_estimation' => array(
                'title' => 'ID',
                'align' => 'center',
            ),
            'duct_type' => array(
                'title' => 'Duct Type',
                'align' => 'center',
            ),
            'installation_timeframe' => array(
                'title' => 'Installation Timeframe',
                'align' => 'center',
            ),
            'heating_appliance' => array(
                'title' => 'Heating Appliance',
                'align' => 'center',
            ),
            'last_name' => array(
                'title' => 'Last Name',
                'align' => 'center',
            ),
            'first_name' => array(
                'title' => 'First Name',
                'align' => 'center',
            ),
            'address' => array(
                'title' => 'Address',
                'align' => 'center',
            ),
            'email' => array(
                'title' => 'Email',
                'align' => 'center',
            ),
            'phone' => array(
                'title' => 'Phone',
                'align' => 'center',
            ),
            'created_at' => array(
                'title' => 'Création',
                'align' => 'center',
            ),
            'updated_at' => array(
                'title' => 'MAJ',
                'align' => 'center',
            ),
        );
        $this->addRowAction('view');
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    public function renderView()
    {
        /** @var EstimationClass $estimation */
        $estimation = $this->object;

        // Redirection if Not Found 
        if (!Validate::isLoadedObject($estimation)) {
            $this->errors[] = $this->trans('Estimation Request not found.', [], 'Admin.Notifications.Error');
            Tools::redirectAdmin($this->context->link->getAdminLink($this->controller_name));
        }
        $imageLink = Media::getMediaPath($estimation->getDrawingFile());
        // Variable 
        $this->context->smarty->assign(array(
            'estimation' => $estimation,
            'imageLink' => $imageLink,
        ));

        // Display 
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/estimation.tpl');
    }

    public function renderForm()
    {
        $id_estimation = (int) Tools::getValue('id_estimation');
        $estimation = new EstimationClass($id_estimation);
        $drawingFilePath = $estimation->getDrawingFile();
        // Form Skeleton 
        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Estimation', [], 'Modules.JmEstimation.Admin'),
                'icon' => 'icon-cog'
            ],
            'input' => [
                [
                    'type' => 'text',
                    'name' => 'id_estimation',
                    'label' => $this->trans('ID', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'duct_type',
                    'label' => $this->trans('Duct Type', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'stove_height',
                    'label' => $this->trans('Stove Height', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'stove_ceiling_height',
                    'label' => $this->trans('Stove Ceiling Height', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'ceiling_thickness',
                    'label' => $this->trans('Ceiling Thickness', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'parapet_height',
                    'label' => $this->trans('Parapet Height', [], 'Modules.JmEstimation.Admin'),
                ],
                [
                    'type' => 'radio',
                    'name' => 'installation_timeframe',
                    'label' => $this->trans('Installation Timeframe', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                    'values' => [
                        [
                            'id' => '15 jours',
                            'value' => '15 jours',
                            'label' => $this->trans('Prochain 15 jours.', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => '1 mois',
                            'value' => '1 mois',
                            'label' => $this->trans('D\'ici 1 mois.', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => '2/3 mois',
                            'value' => '2/3 mois',
                            'label' => $this->trans('D\'ici 2 à 3 mois.', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => '+3 mois',
                            'value' => '+3 mois',
                            'label' => $this->trans('Dans + de 3 mois.', [], 'Modules.JmEstimation.Admin'),
                        ],
                    ],
                ],
                [
                    'type' => 'radio',
                    'name' => 'heating_appliance',
                    'label' => $this->trans('Heating Appliance', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                    'values' => [
                        [
                            'id' => 'Poêle à granulés de bois',
                            'value' => 'Poêle à granulés de bois',
                            'label' => $this->trans('Poêle à granulés de bois', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => 'Poêle ou insert à bois',
                            'value' => 'Poêle ou insert à bois',
                            'label' => $this->trans('Poêle ou insert à bois', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => 'Chaudière à granulés de bois',
                            'value' => 'Chaudière à granulés de bois',
                            'label' => $this->trans('Chaudière à granulés de bois', [], 'Modules.JmEstimation.Admin'),
                        ],
                        [
                            'id' => 'Chaudière à bois/bûches',
                            'value' => 'Chaudière à bois/bûches',
                            'label' => $this->trans('Chaudière à bois/bûches', [], 'Modules.JmEstimation.Admin'),
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'name' => 'smoke_outlet_diameter',
                    'label' => $this->trans('Smoke Outlet Diameter', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'textarea',
                    'name' => 'additional_details',
                    'label' => $this->trans('Additional Details', [], 'Modules.JmEstimation.Admin'),
                ],
                [
                    'type' => 'file',
                    'name' => 'drawing_file',
                    'label' => $this->trans('Drawing File', [], 'Modules.JmEstimation.Admin'),
                    'image' => $drawingFilePath,
                ],
                [
                    'type' => 'text',
                    'name' => 'last_name',
                    'label' => $this->trans('Last Name', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'first_name',
                    'label' => $this->trans('First Name', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'address',
                    'label' => $this->trans('Address', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'email',
                    'label' => $this->trans('Email', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],
                [
                    'type' => 'text',
                    'name' => 'phone',
                    'label' => $this->trans('Phone', [], 'Modules.JmEstimation.Admin'),
                    'required' => true,
                    'empty_message' => $this->trans('This input is required.', [], 'Admin.Notifications.Error'),
                ],

            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Modules.JmEstimation.Admin'),
                'class' => 'btn btn-warning'
            ]
        ];

        return parent::renderForm();
    }

    // Success Handler
    private function processSuccess($operation, $values, $id_estimation = null)
    {
        $estimation = new EstimationClass($id_estimation);

        // Date Behavior 
        $currentDateTime = date('Y-m-d H:i:s');
        if ($operation === "add") {
            $estimation->setCreatedAt($currentDateTime);
        }
        if ($operation === "updat") {
            $estimation->setUpdatedAt($currentDateTime);
        }

        if (!$estimation->saveByFormValues($values)) {
            // Display Errors 
            $this->errors[] = $this->context->getTranslator()->trans('An error occurred while ' . $operation . 'ing the estimation.', [], 'Admin.Notifications.Error');
        }
        // Display Success
        $this->confirmations[] = $this->trans('Estimation Request ' . $operation . 'ed successfully.', [], 'Admin.Notifications.Success');
    }

    // Errors Handler
    private function processErrors($errors)
    {
        // Display Each Error Message 
        foreach ($errors as $error) {
            $this->errors[] = $error;
        }
    }

    public function processAdd()
    {

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
            $this->processSuccess('add', $values);
        } else {
            // Errors Handler
            $this->processErrors($errors);
        }
        $this->processErrors($errors);
    }

    public function processUpdate()
    {
        $id_estimation = Tools::getValue('id_estimation');
        $estimation = new EstimationClass($id_estimation);
        if (Validate::isLoadedObject($estimation)) {
            // Get Form Values
            $values = Tools::getAllValues();
            $values['file'] = Tools::fileAttachment('drawing_file');
            // Validate Form
            $formValidator = new EstimationFormValidator($values);
            $errors = $formValidator->validateForm();
            $errors = array_merge($errors, FileHandler::validateFileSize());

            if (empty($errors)) {
                // File Behavior Renaming
                $drawingFile = $estimation->getDrawingFile();
                if ($values['file']) {
                    $values['file_path'] = FileHandler::getFilePath($values['file']);
                    if ($drawingFile && !empty($values['file_path'])) {
                        FileHandler::deleteFileByPath($drawingFile);
                    }
                } else {
                    $values['file_path'] = $drawingFile;
                }
                $this->processSuccess('updat', $values, $id_estimation);
            } else {
                // Errors Handler
                $this->processErrors($errors);
            }
        } else {
            $this->errors[] = $this->trans('Estimation Request Not Found.', [], 'Admin.Notifications.Error');
        }
    }

    public function processDelete()
    {
        $id_estimation = (int) Tools::getValue('id_estimation');
        $estimation = new EstimationClass($id_estimation);

        if (Validate::isLoadedObject($estimation)) {
            $drawingFile = $estimation->getDrawingFile();
            if (FileHandler::deleteFileByPath($drawingFile) && $estimation->delete()) {
                $this->confirmations[] = $this->trans('Estimation Request deleted successfully.', [], 'Admin.Notifications.Success');
            } else {
                $this->errors[] = $this->trans('An error occurred while deleting the estimation.', [], 'Admin.Notifications.Error');
            }
        } else {
            $this->errors[] = $this->trans('Estimation Request Not Found.', [], 'Admin.Notifications.Error');
        }
    }


    protected function processBulkSend()
    {
        if (is_array($this->boxes) && !empty($this->boxes)) {
            // Count Emails Sent 
            $successCount = 0;
            foreach ($this->boxes as $id_estimation) {
                // Get Estimation 
                $estimation = new EstimationClass($id_estimation);
                // Send Estimation 
                if ($estimation->sendEstimation()) {
                    $successCount++;
                }
            }
            if ($successCount === count($this->boxes)) {
                $this->confirmations[] = $this->trans('Estimations have been sent successfully.', [], 'Admin.Notifications.Success');
            } else {
                $this->errors[] = $this->trans('An error occurred while sending some of the estimations.', [], 'Admin.Notifications.Error');
            }
        }
    }
}
