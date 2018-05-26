<?php

namespace App\Twig;

/**
 * AppExtension - twig functions to be used in twig files.
 */
class AppExtension extends \Twig_Extension
{
    /**
     * GetFunctions - define twig functions to use in twig files.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_Function('query_builder', array($this, 'queryBuilder')),
        );
    }

    /**
     * QueryBuilder - twig function to build query paramters for search url.
     *
     * @param string $selectedParam     all selected parameters
     * @param string $currentParamKey   current param key to process
     * @param string $currentParamValue current param value to process
     *
     * @return string
     */
    public function queryBuilder($selectedParam, $currentParamKey, $currentParamValue)
    {
        $params = array();
        $query = null;
        if ('*.*' == $selectedParam) {
            $query = $currentParamKey.':'.$currentParamValue;
        } else {
            $queryArr = explode('AND', $selectedParam);
            foreach ($queryArr as $key => $query) {
                list($queryKey, $queryValue) = explode(':', $query);
                $queryValue = trim($queryValue);
                $queryKey = trim($queryKey);
                unset($queryArr[$key]);
                $queryArr[$queryKey] = $queryValue;
            }

            $queryArr[$currentParamKey] = $currentParamValue;
            $query = null;
            $i = 0;
            foreach ($queryArr as $key => $value) {
                ++$i;
                if ($i == count($queryArr)) {
                    $query .= $key.':'.$value;
                } else {
                    $query .= $key.':'.$value.' AND ';
                }
            }
        }

        return $query;
    }
}
