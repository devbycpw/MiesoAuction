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
    
    "auctions" => "AuctionController@index",      
    "auction/create" => "AuctionController@createForm", 
    "auction/store" => "AuctionController@store",      
    "auction/autoCloseAuctions" => "AuctionController@autoCloseAuctions",
    "api/current-price/(:num)" => "AuctionController@getCurrentPrice",
    "auction/show/{id}" => "AuctionController@show",       
    "auction/edit/{id}" => "AuctionController@editForm",   
    "auction/update/{id}" => "AuctionController@update",     
    "auction/delete/{id}" => "AuctionController@delete",     

    // bidding
    "myBids" => "BidController@index",          
    "bids/placeBid" => "BidController@placeBid",          
    "bids/auction/{id}" => "BidController@listByAuction",  

    // payments
    "payment/show/{id}" => "PaymentController@show",       
    "payment/upload/{id}" => "PaymentController@uploadProof",
    "payment/create" => "PaymentController@store",      

    // transactions
    "transactions" => "TransactionController@index",  
    "transaction/show/{id}" => "TransactionController@show",   

    "categories" => "CategoryController@index",

<<<<<<< Updated upstream
    
    // =======================================================
=======
    // profile
    "profile" => "ProfileController@index",
    "profile/client" => "ProfileController@client",

>>>>>>> Stashed changes
    // ADMIN 
    // auctions
    "admin/dashboard" => "AdminController@index",
    "admin/auctions" => "AdminController@showAuctions",
    "admin/auction/approve/{id}" => "AdminController@approve",
    "admin/auction/reject/{id}" => "AdminController@reject",
    "admin/auction/close/{id}" => "AdminController@close",

    // payments
    "admin/payments" => "PaymentController@index",
    "admin/payment/show/{id}" => "AdminPaymentController@show",
    "admin/payment/verify/{id}" => "AdminPaymentController@verify",
    "admin/payment/reject/{id}" => "AdminPaymentController@reject",

    "admin/payment/pending" => "AdminController@pending",
    "admin/payment/all" => "AdminController@selectAll",
    "admin/payment/rejected" => "AdminController@selectRejected",
    "admin/payment/approved" => "AdminController@selectApproved",

    // transactions
    "admin/transactions" => "AdminTransactionController@index",
    "admin/transaction/show/{id}" => "AdminTransactionController@show",

    // users management
    "admin/users" => "AdminController@selectUser",
    "admin/user/delete/{id}" => "AdminController@delete"
    
    
];
