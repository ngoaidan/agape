<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class PublishAction extends AbstractAction
{
    public function getTitle()
    {
        // Action title which display in button based on current status
        return $this->data->{'status'}=="ACCEPT"?'Block':'Accept';
    }

    public function getIcon()
    {
        // Action icon which display in left of button based on current status
        return $this->data->{'status'}=="ACCEPT"?'voyager-lock':'voyager-list-add';
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
        return $this->dataType->slug == 'customers';
    }


    public function getDefaultRoute()
    {
        // URL for action button when click
        return route('customers.publish', array("id"=>$this->data->{$this->data->getKeyName()}));
    }
}
