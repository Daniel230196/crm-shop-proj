<?php


namespace App\Views;


class PipelineView extends View
{

    /**
     * @inheritDoc
     */
    public function template()
    {
        include static::TEMP_PATH . 'pipeline.php';
    }
}