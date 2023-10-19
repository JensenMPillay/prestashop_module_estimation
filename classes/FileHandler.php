<?php

class FileHandler
{
    public static function getFilePath($file)
    {
        $filePath = '';
        if ($file) {
            $module = Module::getInstanceByName('jm_estimation');
            $uploadsDir = _PS_MODULE_DIR_ . $module->name . '/uploads/';

            $fileTempPath = $file["tmp_name"];
            $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $fileName = time();
            $filePath = $uploadsDir . $fileName . '.' . $fileExt;
            if (!move_uploaded_file($fileTempPath, $filePath)) {
                $filePath = '';
            }
        }
        return $filePath;
    }

    public static function deleteFileByPath($filePath)
    {
        if (!empty($filePath) && file_exists($filePath)) {
            unlink($filePath);
        }
        return true;
    }

    public static function validateFileSize()
    {
        $errors = array();

        if (isset($_FILES) && !empty($_FILES['drawing_file']['name']) && $_FILES['drawing_file']['error'] === 1) {
            $errors[] = Context::getContext()->getTranslator()->trans('La taille du fichier "dessin" dépasse la limite autorisée (2 Mo).', [], 'Admin.Notifications.Error');
        }

        return $errors;
    }
}
