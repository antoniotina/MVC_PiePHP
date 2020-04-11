<?php

namespace Core;

class TemplateEngine
{
    public function replace($file, $scope)
    {
        extract($scope);
        $regexArray = [
            '/{{(.*?)}}/',
            '/@isset(.*)\)/',
            '/@endisset/',
            '/@empty(.*)\)/',
            '/@endempty/',
            '/@if(.*)\)/',
            '/@elseif(.*)\)/',
            '/@else/',
            '/@endif/',
            '/@foreach(.*)\)/',
            '/@endforeach/',
            '/<(.*)>/'
        ];
        $replaceWith = [
            'echo $1;',
            'if (isset$1)) {',
            '}',
            'if (empty$1)) {',
            '}',
            'if$1) {',
            '} elseif$1) {',
            '} else {',
            '}',
            'foreach$1) {',
            '}',
            'echo "<$1>";'
        ];
        $fileData = file_get_contents($file);
        $fileData = preg_replace($regexArray, $replaceWith, $fileData);
        eval($fileData);
    }
}
