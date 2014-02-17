<?php

class BaseModel extends Eloquent
{
    /**
     * function set record params
     *
     * @param array $params params
     *
     * @return void
     */
    public function setRecordParams($params)
    {
        //die_dump($params);
        foreach ($params as $key => $value)
        {
            if ( substr($key, 0, 1)!='_' )
            {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * store record
     *
     * @param array $params params
     *
     * @return bool
     */
    public function saveRecord($params)
    {
        $this->setRecordParams($params);
        return $this->save();
    }
}
