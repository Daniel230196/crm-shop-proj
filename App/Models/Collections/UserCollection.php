<?php


namespace App\Models\Collections;


class UserCollection extends Collection
{

    /**
     * @inheritDoc
     */
    protected function targetClass(): string
    {
        return \App\Models\User::class;
    }


    public function notifyAccess()
    {
        parent::notifyAccess(); // TODO: Change the autogenerated stub
    }

}