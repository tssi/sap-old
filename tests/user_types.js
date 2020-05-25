"use strict";
define(['model'],function($model){
	return new $model(
		{
		  "meta": {
			"message": "List of User Types",
			"limit": 10,
			"next": 2,
			"prev": null,
			"last": 2,
			"count": 15,
			"page": 1,
			"pages": 2,
			"epoch": 1590387262,
			"code": 200
		  },
		  "data": [
			{
			  "id": "admin",
			  "name": "Admin"
			},
			{
			  "id": "advsr",
			  "name": "Adviser"
			},
			{
			  "id": "atten",
			  "name": "Attendance Encoder"
			},
			{
			  "id": "clbad",
			  "name": "Club Adviser"
			},
			{
			  "id": "dcoor",
			  "name": "Department Coordinator"
			},
			{
			  "id": "demo",
			  "name": "Demo"
			},
			{
			  "id": "guest",
			  "name": "Guest"
			},
			{
			  "id": "itech",
			  "name": "IT"
			},
			{
			  "id": "prncp",
			  "name": "Principal"
			},
			{
			  "id": "rgstr",
			  "name": "Registrar"
			}
		  ]
		}
	);
});