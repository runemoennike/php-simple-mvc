<?php

class AboutController extends \SimpleMvc\Controller
{
    public function ViewAction() {
        $this->SetMasterPage('master-page.html');

        $this->SetPageTitle('About Us');
        return $this->Render('about.html');
    }
}