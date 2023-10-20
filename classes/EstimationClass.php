<?php

/**
 * @property int|null $id_estimation Estimation Identifier
 * @property string|null $duct_type Duct Type
 * @property int|null $stove_height Stove Height (mm)
 * @property int|null $stove_ceiling_height Stove Ceiling Height (mm)
 * @property int|null $ceiling_thickness Ceiling Thickness (mm)
 * @property int|null $parapet_height Parapet Height (mm)
 * @property string|null $installation_timeframe Installation Timeframe
 * @property string|null $heating_appliance Heating Appliance
 * @property int|null $smoke_outlet_diameter Smoke Outlet Diameter (mm)
 * @property string|null $additional_details Additional Details
 * @property string|null $drawing_file Drawing File
 * @property string|null $last_name Last Name
 * @property string|null $first_name First Name
 * @property string|null $address Address
 * @property string|null $email Email Address
 * @property string|null $phone Phone Number
 * @property string|null $created_at Creation Date
 * @property string|null $updated_at Update Date
 */
class EstimationClass extends ObjectModel
{
    public $id_estimation;
    public $duct_type;
    public $stove_height;
    public $stove_ceiling_height;
    public $ceiling_thickness;
    public $parapet_height;
    public $installation_timeframe;
    public $heating_appliance;
    public $smoke_outlet_diameter;
    public $additional_details;
    public $drawing_file;
    public $last_name;
    public $first_name;
    public $address;
    public $email;
    public $phone;
    public $created_at;
    public $updated_at;

    public static $definition = array(
        'table' => 'estimation',
        'primary' => 'id_estimation',
        'fields' => array(
            'duct_type' => array('type' => self::TYPE_STRING, 'size' => 255, 'required' => true),
            'stove_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'stove_ceiling_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'ceiling_thickness' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'parapet_height' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'installation_timeframe' => array('type' => self::TYPE_STRING, 'size' => 255, 'required' => true),
            'heating_appliance' => array('type' => self::TYPE_STRING, 'size' => 255, 'required' => true),
            'smoke_outlet_diameter' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'additional_details' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'drawing_file' => array('type' => self::TYPE_STRING, 'size' => 255),
            'last_name' => array('type' => self::TYPE_STRING, 'size' => 50, 'required' => true),
            'first_name' => array('type' => self::TYPE_STRING, 'size' => 50, 'required' => true),
            'address' => array('type' => self::TYPE_STRING, 'size' => 255, 'required' => true),
            'email' => array('type' => self::TYPE_STRING, 'size' => 100, 'validate' => 'isEmail', 'required' => true),
            'phone' => array('type' => self::TYPE_STRING, 'size' => 20, 'required' => true),
            'created_at' => array('type' => self::TYPE_DATE, 'required' => false, 'validate' => 'isDate'),
            'updated_at' => array('type' => self::TYPE_DATE, 'required' => false, 'validate' => 'isDate'),
        ),
    );

    /**
     * @return int|null
     */
    public function getIdEstimation(): ?int
    {
        return $this->id_estimation;
    }

    /**
     * @param int $id_estimation
     */
    public function setIdEstimation(int $id_estimation): void
    {
        $this->id_estimation = $id_estimation;
    }

    /**
     * @return string|null
     */
    public function getDuctType(): ?string
    {
        return $this->duct_type;
    }

    /**
     * @param string $duct_type
     */
    public function setDuctType(string $duct_type): void
    {
        $this->duct_type = $duct_type;
    }

    /**
     * @return int|null
     */
    public function getStoveHeight(): ?int
    {
        return $this->stove_height;
    }

    /**
     * @param string $stove_height
     */
    public function setStoveHeight(string $stove_height): void
    {
        $this->stove_height = intval($stove_height);
    }

    /**
     * @return int|null
     */
    public function getStoveCeilingHeight(): ?int
    {
        return $this->stove_ceiling_height;
    }

    /**
     * @param string $stove_ceiling_height
     */
    public function setStoveCeilingHeight(string $stove_ceiling_height): void
    {
        $this->stove_ceiling_height = intval($stove_ceiling_height);
    }

    /**
     * @return int|null
     */
    public function getCeilingThickness(): ?int
    {
        return $this->ceiling_thickness;
    }

    /**
     * @param string $ceiling_thickness
     */
    public function setCeilingThickness(string $ceiling_thickness): void
    {
        $this->ceiling_thickness = intval($ceiling_thickness);
    }

    /**
     * @return int|null
     */
    public function getParapetHeight(): ?int
    {
        return $this->parapet_height;
    }

    /**
     * @param string $parapet_height
     */
    public function setParapetHeight(string $parapet_height): void
    {
        $this->parapet_height = intval($parapet_height);
    }

    /**
     * @return string|null
     */
    public function getInstallationTimeframe(): ?string
    {
        return $this->installation_timeframe;
    }

    /**
     * @param string $installation_timeframe
     */
    public function setInstallationTimeframe(string $installation_timeframe): void
    {
        $this->installation_timeframe = $installation_timeframe;
    }

    /**
     * @return string|null
     */
    public function getHeatingAppliance(): ?string
    {
        return $this->heating_appliance;
    }

    /**
     * @param string $heating_appliance
     */
    public function setHeatingAppliance(string $heating_appliance): void
    {
        $this->heating_appliance = $heating_appliance;
    }

    /**
     * @return int|null
     */
    public function getSmokeOutletDiameter(): ?int
    {
        return $this->smoke_outlet_diameter;
    }

    /**
     * @param string $smoke_outlet_diameter
     */
    public function setSmokeOutletDiameter(string $smoke_outlet_diameter): void
    {
        $this->smoke_outlet_diameter = intval($smoke_outlet_diameter);
    }

    /**
     * @return string|null
     */
    public function getAdditionalDetails(): ?string
    {
        return $this->additional_details;
    }

    /**
     * @param string $additional_details
     */
    public function setAdditionalDetails(string $additional_details): void
    {
        $this->additional_details = $additional_details;
    }

    /**
     * @return string|null
     */
    public function getDrawingFile(): ?string
    {
        return $this->drawing_file;
    }

    /**
     * @param string $drawing_file
     */
    public function setDrawingFile(string $drawing_file): void
    {
        $this->drawing_file = $drawing_file;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @param string $date
     */
    public function setCreatedAt(string $date): void
    {
        $this->created_at = $date;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string $date
     */
    public function setUpdatedAt(string $date): void
    {
        $this->updated_at = $date;
    }

    /**
     * @param array $values
     */
    public function saveByFormValues(array $values)
    {
        $this->setDuctType($values['duct_type']);
        $this->setStoveHeight($values['stove_height']);
        $this->setStoveCeilingHeight($values['stove_ceiling_height']);
        $this->setCeilingThickness($values['ceiling_thickness']);
        $this->setParapetHeight($values['parapet_height']);
        $this->setInstallationTimeframe($values['installation_timeframe']);
        $this->setHeatingAppliance($values['heating_appliance']);
        $this->setSmokeOutletDiameter($values['smoke_outlet_diameter']);
        $this->setAdditionalDetails($values['additional_details']);
        $this->setLastName($values['last_name']);
        $this->setFirstName($values['first_name']);
        $this->setAddress($values['address']);
        $this->setEmail($values['email']);
        $this->setPhone($values['phone']);
        $this->setDrawingFile($values['file_path']);
        return $this->save();
    }

    // Send Estimation Mail 

    public function sendEstimationRequestConfirmation()
    {
        $filePath = $this->getDrawingFile();
        if ($filePath) {
            $attachment = array(
                'content' => file_get_contents($filePath),
                'name' => basename($filePath),
                'mime' => 'image/png',
            );
        } else {
            $attachment = NULL;
        }
        $templateVars = array(
            '{id_estimation}' => $this->getIdEstimation(),
            '{duct_type}' => $this->getDuctType(),
            '{stove_height}' => $this->getStoveHeight(),
            '{stove_ceiling_height}' => $this->getStoveCeilingHeight(),
            '{parapet_height}' => $this->getParapetHeight(),
            '{installation_timeframe}' => $this->getInstallationTimeframe(),
            '{heating_appliance}' => $this->getHeatingAppliance(),
            '{smoke_outlet_diameter}' => $this->getSmokeOutletDiameter(),
            '{additional_details}' => $this->getAdditionalDetails(),
            '{last_name}' => $this->getLastName(),
            '{first_name}' => $this->getFirstName(),
            '{address}' => $this->getAddress(),
            '{email}' => $this->getEmail(),
            '{phone}' => $this->getPhone(),
        );
        return Mail::Send(
            (int)Context::getContext()->language->id, // Language ID
            'estimation', // Email template file to be used
            $this->trans('Estimation Request Confirmation', [], 'Modules.JmEstimation.Admin'), // Email subject
            $templateVars, // Email content
            $this->getEmail(), // Receiver email address
            // "queenofspachess@protonmail.com", // Receiver email address
            $this->getLastName() . ' ' . $this->getFirstName(), // Receiver name
            Configuration::get('PS_SHOP_EMAIL'), // From email address
            Configuration::get('PS_SHOP_NAME'), // From name
            $attachment, // File attachment
            NULL, // SMTP mode
            _PS_MODULE_DIR_ . Module::getInstanceByName('jm_estimation')->name . '/mails' // Custom template path
        );
    }

    public function sendEstimationRequestNotification()
    {
        $filePath = $this->getDrawingFile();
        if ($filePath) {
            $attachment = array(
                'content' => file_get_contents($filePath),
                'name' => basename($filePath),
                'mime' => 'image/png',
            );
        } else {
            $attachment = NULL;
        }
        $templateVars = array(
            '{id_estimation}' => $this->getIdEstimation(),
            '{duct_type}' => $this->getDuctType(),
            '{stove_height}' => $this->getStoveHeight(),
            '{stove_ceiling_height}' => $this->getStoveCeilingHeight(),
            '{parapet_height}' => $this->getParapetHeight(),
            '{installation_timeframe}' => $this->getInstallationTimeframe(),
            '{heating_appliance}' => $this->getHeatingAppliance(),
            '{smoke_outlet_diameter}' => $this->getSmokeOutletDiameter(),
            '{additional_details}' => $this->getAdditionalDetails(),
            '{last_name}' => $this->getLastName(),
            '{first_name}' => $this->getFirstName(),
            '{address}' => $this->getAddress(),
            '{email}' => $this->getEmail(),
            '{phone}' => $this->getPhone(),
        );
        return Mail::Send(
            (int)Context::getContext()->language->id, // Language ID
            'estimation', // Email template file to be used
            $this->trans('Estimation Request Notification', [], 'Modules.JmEstimation.Admin'), // Email subject
            $templateVars, // Email content
            Configuration::get('JM_RECEIVER_EMAIL')  ? Configuration::get('JM_RECEIVER_EMAIL') : Configuration::get('PS_SHOP_EMAIL'), // Receiver email address
            // "queenofspachess@protonmail.com", // Receiver email address
            Configuration::get('PS_SHOP_NAME'), // Receiver name
            Configuration::get('PS_SHOP_EMAIL'), // From email address
            Configuration::get('PS_SHOP_NAME'), // From name
            $attachment, // File attachment
            NULL, // SMTP mode
            _PS_MODULE_DIR_ . Module::getInstanceByName('jm_estimation')->name . '/mails' // Custom template path
        );
    }

    public function sendEstimation()
    {
        $filePath = $this->getDrawingFile();
        if ($filePath) {
            $attachment = array(
                'content' => file_get_contents($filePath),
                'name' => basename($filePath),
                'mime' => 'image/png',
            );
        } else {
            $attachment = NULL;
        }
        $templateVars = array(
            '{id_estimation}' => $this->getIdEstimation(),
            '{duct_type}' => $this->getDuctType(),
            '{stove_height}' => $this->getStoveHeight(),
            '{stove_ceiling_height}' => $this->getStoveCeilingHeight(),
            '{parapet_height}' => $this->getParapetHeight(),
            '{installation_timeframe}' => $this->getInstallationTimeframe(),
            '{heating_appliance}' => $this->getHeatingAppliance(),
            '{smoke_outlet_diameter}' => $this->getSmokeOutletDiameter(),
            '{additional_details}' => $this->getAdditionalDetails(),
            '{last_name}' => $this->getLastName(),
            '{first_name}' => $this->getFirstName(),
            '{address}' => $this->getAddress(),
            '{email}' => $this->getEmail(),
            '{phone}' => $this->getPhone(),
        );
        return Mail::Send(
            (int)Context::getContext()->language->id, // Language ID
            'estimation', // Email template file to be used
            $this->trans('Estimation Request Notification', [], 'Modules.JmEstimation.Admin'), // Email subject
            $templateVars, // Email content
            $this->getEmail(), // Receiver email address
            // "queenofspachess@protonmail.com", // Receiver email address
            $this->getLastName() . ' ' . $this->getFirstName(),  // Receiver name
            Configuration::get('PS_SHOP_EMAIL'), // From email address
            Configuration::get('PS_SHOP_NAME'), // From name
            $attachment, // File attachment
            NULL, // SMTP mode
            _PS_MODULE_DIR_ . Module::getInstanceByName('jm_estimation')->name . '/mails' // Custom template path
        );
    }
}
