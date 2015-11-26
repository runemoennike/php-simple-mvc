<?php

class HomeController extends \SimpleMvc\Controller
{
    public function ViewAction() {
        $this->SetMasterPage('master-page.html');

        $this->SetPageTitle('Home');
        return $this->Render('home.html');
    }
}