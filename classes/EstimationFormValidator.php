<?php

class EstimationFormValidator
{
    public $module;
    public $context;
    public $values;

    public function __construct($values)
    {
        $this->module = Module::getInstanceByName('jm_estimation');
        $this->context = Context::getContext();
        $this->values = $values;
    }

    // Validates Form Values 
    public function validateForm()
    {
        $errors = array();

        $errors = array_merge($errors, $this->validateDuctType($this->values['duct_type']));
        $errors = array_merge($errors, $this->validateStoveHeight($this->values['stove_height']));
        $errors = array_merge($errors, $this->validateStoveCeilingHeight($this->values['stove_ceiling_height']));
        $errors = array_merge($errors, $this->validateCeilingThickness($this->values['ceiling_thickness']));
        $errors = array_merge($errors, $this->validateParapetHeight($this->values['parapet_height']));
        $errors = array_merge($errors, $this->validateInstallationTimeframe($this->values['installation_timeframe']));
        $errors = array_merge($errors, $this->validateHeatingAppliance($this->values['heating_appliance']));
        $errors = array_merge($errors, $this->validateSmokeOutletDiameter($this->values['smoke_outlet_diameter']));
        $errors = array_merge($errors, $this->validateAdditionalDetails($this->values['duct_type']));
        $errors = array_merge($errors, $this->validateLastName($this->values['last_name']));
        $errors = array_merge($errors, $this->validateFirstName($this->values['first_name']));
        $errors = array_merge($errors, $this->validateAddress($this->values['address']));
        $errors = array_merge($errors, $this->validateEmail($this->values['email']));
        $errors = array_merge($errors, $this->validatePhone($this->values['phone']));
        if ($this->values['file']) {
            $errors = array_merge($errors, $this->validateFile($this->values['file']));
        }
        return $errors;
    }

    private function validateDuctType($ductType)
    {
        $errors = array();

        if (empty($ductType) || !Validate::isGenericName($ductType)) {
            $errors[] = $this->context->getTranslator()->trans('Veuillez sélection un type de conduit.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateStoveHeight($stoveHeight)
    {
        $errors = array();

        if (empty($stoveHeight) || !Validate::isUnsignedInt($stoveHeight)) {
            $errors[] = $this->context->getTranslator()->trans('Hauteur du Poêle (mm) est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateStoveCeilingHeight($stoveCeilingHeight)
    {
        $errors = array();

        if (empty($stoveCeilingHeight) || !Validate::isUnsignedInt($stoveCeilingHeight)) {
            $errors[] = $this->context->getTranslator()->trans('Hauteur Poêle / Plafond (mm) est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateCeilingThickness($ceilingThickness)
    {
        $errors = array();

        if (empty($ceilingThickness) || !Validate::isUnsignedInt($ceilingThickness)) {
            $errors[] = $this->context->getTranslator()->trans('Épaisseur Plafond (mm) est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateParapetHeight($parapetHeight)
    {
        $errors = array();

        if (!empty($parapetHeight) && !Validate::isUnsignedInt($parapetHeight)) {
            $errors[] = $this->context->getTranslator()->trans('Hauteur Acrotère (mm) est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateInstallationTimeframe($installationTimeframe)
    {
        $errors = array();

        if (empty($installationTimeframe) || !Validate::isGenericName($installationTimeframe)) {
            $errors[] = $this->context->getTranslator()->trans('Veuillez sélectionner un Délai Installation.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateHeatingAppliance($heatingAppliance)
    {
        $errors = array();

        if (empty($heatingAppliance) || !Validate::isGenericName($heatingAppliance)) {
            $errors[] = $this->context->getTranslator()->trans('Veuillez sélectionner un Appareil Chauffage.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateSmokeOutletDiameter($smokeOutletDiameter)
    {
        $errors = array();

        if (empty($smokeOutletDiameter) || !Validate::isUnsignedInt($smokeOutletDiameter)) {
            $errors[] = $this->context->getTranslator()->trans('Diamètre Sortie Fumée Appareil Chauffage (mm) est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateAdditionalDetails($additionalDetails)
    {
        $errors = array();

        if (!empty($additionalDetails) && strlen($additionalDetails) > 500) {
            $errors[] = $this->context->getTranslator()->trans('Précision Supplémentaires ne doit pas dépasser 500 caractères.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateLastName($lastName)
    {
        $errors = array();

        if (empty($lastName) || !Validate::isName($lastName)) {
            $errors[] = $this->context->getTranslator()->trans('Le champ Nom est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateFirstName($firstName)
    {
        $errors = array();

        if (empty($firstName) || !Validate::isName($firstName)) {
            $errors[] = $this->context->getTranslator()->trans('Le champ Prénom est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateAddress($address)
    {
        $errors = array();

        if (empty($address) || !Validate::isGenericName($address)) {
            $errors[] = $this->context->getTranslator()->trans('Le champ Adresse est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateEmail($email)
    {
        $errors = array();

        if (empty($email) || !Validate::isEmail($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = $this->context->getTranslator()->trans('Le champ Email est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validatePhone($phone)
    {
        $errors = array();

        if (empty($phone)) {
            $errors[] = $this->context->getTranslator()->trans('Le champ Téléphone est invalide.', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }

    private function validateFile($file)
    {
        $EXTENSIONS_VALID = ['pdf', 'jpg', 'jpeg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $errors = array();

        if (!in_array($fileExt, $EXTENSIONS_VALID)) {
            $this->context->getTranslator()->trans('Seuls les fichiers PDF, JPG, JPEG et PNG sont autorisés.', [], 'Admin.Notifications.Error');
        }
        return $errors;
    }
}
