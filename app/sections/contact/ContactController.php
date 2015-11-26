<?php
require(APP_ROOT_PATH . '/model/ContactTicket.php');

class ContactController extends \SimpleMvc\Controller
{
    protected $hasSubmitted = false;

    public function ViewAction() {
        $this->SetMasterPage('master-page.html');

        $this->SetPageTitle('Contact Us');
        return $this->Render('contact.html');
    }

    public function SubmitAction() {
        $uploadedFileTmpName = $_FILES['file']['tmp_name'];

        if(is_uploaded_file($uploadedFileTmpName)) {
            // Store file.
            $storedFilename = sha1(microtime() + rand());
            move_uploaded_file($uploadedFileTmpName, UPLOAD_PATH . '/' . $storedFilename);

            // Save entry to DB.
            $dbContactTicket = new ContactTicket();
            $dbContactTicket->title = \SimpleMvc\CleanText($_POST['title']);
            $dbContactTicket->description = \SimpleMvc\CleanText($_POST['description']);
            $dbContactTicket->storedFilename = $storedFilename;
            $dbContactTicket->originalFilename = \SimpleMvc\CleanText($_FILES['file']['name']);

            $dbContactTicket->Save();
        }

        $this->hasSubmitted = true;
        $this->ViewAction();
    }
}