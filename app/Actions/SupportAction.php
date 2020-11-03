<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class SupportAction extends AbstractAction
{
    public function getTitle()
    {
        // Action title which display in button based on current status
        return[ $this->data->{'status'}=="NEW"?'Completed':'Cancel',];
    }

    public function getIcon()
    {
        // Action icon which display in left of button based on current status
        return $this->data->{'status'}=="NEW";
    }

    public function getAttributes()
    {
        // Action button class
        return [
            'class' => 'btn btn-sm btn-primary pull-left',
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'supports';
    }


    public function getDefaultRoute()
    {
        // URL for action button when click
        return route('supports.publish', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
}
