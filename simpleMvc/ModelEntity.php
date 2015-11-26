<?php

namespace SimpleMvc;

class ModelEntity
{
    protected function DatabaseConnect()
    {
        $dbCtx = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

        return $dbCtx;
    }
}