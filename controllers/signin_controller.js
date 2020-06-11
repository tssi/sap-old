if (window.location.hostname == "localhost") 
var BASE_URL = window.location.origin+window.location.pathname;
else 
var BASE_URL = window.location.origin;


"use strict";
define(['app',
	'../controllers/signin/challenge',
	'../controllers/signin/change_password',
	'../controllers/signin/verify_account',
	'../controllers/signin/activate_account',
	], function (app) {
});

