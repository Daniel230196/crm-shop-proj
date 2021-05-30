<?php
declare(strict_types=1);


namespace App\Controllers\Api\v1;


class LeadsController extends \App\Controllers\Api\BaseApiController
{
    private const LIMIT = 50;

    public function test(): string
    {
        $testArray = [
            'test4' => 'test',
            'test3' => 'test',
            'test2' => 'test',
            'test1' => 'test',
        ];

        return json_encode($testArray);
    }
}