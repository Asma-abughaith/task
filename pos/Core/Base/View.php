<?php

namespace Core\Base;

/**
 * Include the php html template
 * @param $view $data
 */
class View
{
    public function __construct(string $view, array $data = array())
    {
        //we should replace the . to / in any method that have veiw html we put it in dote so we should change it becaue that our desgin
        $view = \str_replace('.', '/', $view);
        //casting the data to object 
        $data = (object) $data;

        // these header footer they are for login page
        $header = 'header';
        $footer = 'footer';

        //if i have the user login we should prepare another header and footer
        if (isset($_SESSION['user']['is_admin_view'])) {
            if ($_SESSION['user']['is_admin_view']) {
                $header = 'header-admin';
                $footer = 'footer-admin';
            }
        }

        // now we need to include the header 
        include_once \dirname(__DIR__, 2) . "/resources/views/partials/$header.php"; // includes the header for all the views

        //here we need to inclued the view that i neec
        include_once \dirname(__DIR__, 2) . "/resources/views/$view.php";

        //here i need to include the footer 
        include_once \dirname(__DIR__, 2) . "/resources/views/partials/$footer.php"; // include the footer for all the views
    }
}