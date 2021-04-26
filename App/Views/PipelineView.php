<?php


namespace App\Views;


class PipelineView extends View
{

    /**
     * @inheritDoc
     */
    public function renderTemplate()
    {
        include static::TEMP_PATH . 'pipeline.php';
    }
}