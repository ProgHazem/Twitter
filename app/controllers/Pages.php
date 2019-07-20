<?php
    class Pages extends Controller {
        public function __construct() {

        }
        public function index() {
            if (loggedin()) {
                return redirectTo('tweetes/index');
            }
            $data = [
                'title' => 'Welcome In Our Social APP',
                'description' => 'Social media is computer-based technology that facilitates the sharing of ideas, thoughts, and information through the building of virtual networks and communities. By design, social media is internet-based and gives users quick electronic communication of content. Content includes personal information, documents, videos, and photos. Users engage with social media via computer, tablet or smartphone via web-based software or web application, often utilizing it for messaging.'
            ];
            return $this->view('pages/index',$data);
        }
        public function edit($id){
            $this->view('pages/edit');
        }
    }


?>