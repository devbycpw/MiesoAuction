<?php
// routes/web.php

return [
    "" => "HomeController@index",
    "home" => "HomeController@index",
    
    // auth
    "login" => "AuthController@showLogin",
    "login/auth" => "AuthController@login",
    "logout" => "AuthController@logout",
    "register" => "AuthController@showRegister",
    "register/create" => "AuthController@register",


    // CUSTOMER 
    // auctions
    "about" => "AboutUsController@index",
    
    "api/current-price/(:num)" => "AuctionController@getCurrentPrice",
    "auctions" => "AuctionController@index",      
    "auction/show/{id}" => "AuctionController@show",       
    "auction/create" => "AuctionController@createForm", 
    "auction/store" => "AuctionController@store",      
    "auction/edit/{id}" => "AuctionController@editForm",   
    "auction/update/{id}" => "AuctionController@update",     
    "auction/delete/{id}" => "AuctionController@delete",     

    // bidding
    "myBids" => "BidController@index",          
    "bids/placeBid" => "BidController@placeBid",          
    "bids/auction/{id}" => "BidController@listByAuction",  

    // payments
    "payments" => "PaymentController@index",      
    "payment/show/{id}" => "PaymentController@show",       
    "payment/upload/{id}" => "PaymentController@uploadProof",
    "payment/create" => "PaymentController@store",      

    // transactions
    "transactions" => "TransactionController@index",  
    "transaction/show/{id}" => "TransactionController@show",   

    "categories" => "CategoryController@index",

    // =======================================================
    // ADMIN 
    // auctions
    "admin/dashboard" => "AdminController@index",
    "admin/auctions" => "AdminController@showAuctions",
    "admin/auction/approve/{id}" => "AdminController@approve",
    "admin/auction/reject/{id}" => "AdminController@reject",
    "admin/auction/close/{id}" => "AdminController@close",

    // payments
    "admin/payments" => "AdminPaymentController@index",
    "amin/payment/show/{id}" => "AdminPaymentController@show",
    "admin/payment/verify/{id}" => "AdminPaymentController@verify",
    "admin/payment/reject/{id}" => "AdminPaymentController@reject",

    // transactions
    "admin/transactions" => "AdminTransactionController@index",
    "admin/transaction/show/{id}" => "AdminTransactionController@show",

    // users management
    "admin/users" => "AdminUserController@index",
    "admin/user/delete/{id}" => "AdminUserController@delete"
    
    
];
