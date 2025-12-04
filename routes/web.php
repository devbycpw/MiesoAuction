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
    "auctions" => "AuctionController@index",      
    "auction/show/{id}" => "AuctionController@show",       
    "auction/create" => "AuctionController@createForm", 
    "auction/store" => "AuctionController@store",      
    "auction/edit/{id}" => "AuctionController@editForm",   
    "auction/update/{id}" => "AuctionController@update",     
    "auction/delete/{id}" => "AuctionController@delete",     

    "categories" => "CategoryController@index",
    
    // bidding
    "bids/store" => "BidController@store",          
    "bids/auction/{id}" => "BidController@listByAuction",  

    // payments
    "payments" => "PaymentController@index",      
    "payment/show/{id}" => "PaymentController@show",       
    "payment/upload/{id}" => "PaymentController@uploadProof",
    "payment/create" => "PaymentController@store",      

    // transactions
    "transactions" => "TransactionController@index",  
    "transaction/show/{id}" => "TransactionController@show",   

    // ADMIN 
    // auctions
    "admin/auctions" => "AdminAuctionController@index",
    "admin/auction/approve/{id}" => "AdminAuctionController@approve",
    "admin/auction/reject/{id}" => "AdminAuctionController@reject",
    "admin/auction/close/{id}" => "AdminAuctionController@close",

    // payments
    "admin/payments" => "AdminPaymentController@index",
    "admin/payment/show/{id}" => "AdminPaymentController@show",
    "admin/payment/verify/{id}" => "AdminPaymentController@verify",
    "admin/payment/reject/{id}" => "AdminPaymentController@reject",

    // transactions
    "admin/transactions" => "AdminTransactionController@index",
    "admin/transaction/show/{id}" => "AdminTransactionController@show",

    // users management
    "admin/users" => "AdminUserController@index",
    "admin/user/delete/{id}" => "AdminUserController@delete"
    
    
];
