<?php

class ContactTicket extends \SimpleMvc\ModelEntity
{
    public $title;
    public $description;
    public $storedFilename;
    public $originalFilename;

    public function Save()
    {
        if ($this->Validate()) {
            $dbCtx = $this->DatabaseConnect();

            $query = $dbCtx->prepare('INSERT INTO ContactTicket SET Title=?, Description=?, StoredFilename=?, OriginalFilename=?');
            $query->bind_param('ssss', $this->title, $this->description, $this->storedFilename, $this->originalFilename);

            $query->execute();
        }
    }

    public function Validate()
    {
        return strlen(trim($this->title)) > 0
        && strlen(trim($this->storedFilename)) > 0
        && strlen(trim($this->originalFilename)) > 0;
    }
}