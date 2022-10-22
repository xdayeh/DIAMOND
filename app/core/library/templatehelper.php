<?php
namespace DIAMOND\Core\Library;

trait TemplateHelper
{
    public function matchUrl($url): bool
    {
        $directoryURI   = htmlspecialchars($_SERVER['REQUEST_URI']);
        $path           = parse_url($directoryURI, PHP_URL_PATH);
        $components     = explode('/', $path);
        return $components[1] === $url;
    }
    public function showValue($fieldName, $object = null)
    {
        return $_POST[$fieldName] ?? (is_null($object) ? '' : $object->$fieldName);
    }
    public function selectedIf($fieldName, $value, $object = null): string
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected="selected"' : '';
    }
}