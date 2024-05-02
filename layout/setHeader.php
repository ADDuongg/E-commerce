<?php
function setPageInfo($page)
{
    $pageInfo = ['title' => '', 'description' => ''];

    switch ($page) {
        case 'page':
            $pageInfo['title'] = 'Authentic Italian Pizzeria';
            $pageInfo['description'] = 'Et praesent nulla urna consequat dui arcu cursus diam fringilla libero risus, aliquam diam, aliquam ullamcorper urna pulvinar velit suspendisse aliquam lacus sollicitudin mauris.
            ';
            break;
        case 'home':
            $pageInfo['title'] = 'Welcome to our home page';
            $pageInfo['description'] = 'Discover our delicious pizzas and more.';
            break;
        case 'menu':
            $pageInfo['title'] = 'Explore our menu';
            $pageInfo['description'] = 'Find your favorite pizzas, pasta, and more.';
            break;
        case 'about':
            $pageInfo['title'] = 'Learn about us';
            $pageInfo['description'] = 'Our history and commitment to quality.';
            break;
        case 'offer':
            $pageInfo['title'] = 'Check out our offers';
            $pageInfo['description'] = 'Latest discounts and deals.';
            break;
        case 'contact':
            $pageInfo['title'] = 'Get in touch with us';
            $pageInfo['description'] = 'Inquiries, reservations, and feedback.';
            break;
        case 'fooddetail':
            $pageInfo['title'] = 'Food Details';
            $pageInfo['description'] = 'Dignissim sed suscipit mattis neque, in nibh blandit at nec in urna tristique ornare aliquam orci augue vestibulum dignissim vel aliquam.';
            break;
        case 'setting':
            $pageInfo['title'] = 'Setting Your Account';
            $pageInfo['description'] = 'Dignissim sed suscipit mattis neque, in nibh blandit at nec in urna tristique ornare aliquam orci augue vestibulum dignissim vel aliquam.';
            break;
        default:
            $pageInfo['title'] = 'Default Title';
            $pageInfo['description'] = 'Default description for unknown pages.';
            break;
    }

    return $pageInfo;
}
