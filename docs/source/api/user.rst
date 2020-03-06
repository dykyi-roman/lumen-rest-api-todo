User
===================

Register
---------------------------------------

**POST api/register**

Request:

.. code-block:: javascript

    {
        "first_name": "test",
        "last_name": "test",
        "email": "test@gmail.com",
        "mobile_number": "+380938982443",
        "gender": "man",
        "birthday": "1989-07-01",
        "password": "1testwW_",
    }

Response:

.. code-block:: javascript

    {
        "status": "success",
         "token": "Bearer 8c153564c9bb199bff00646968674c0b64c0dae84c29035ce54c49f6c0c0ba53"
    }

Login
--------------------------

**GET api/login**

Request:

.. code-block:: javascript

    {
        "email": "test@gmail.com",
        "password": "1testwW_",
    }

Response:

.. code-block:: javascript

    {
        "status": "success",
        "user": {
            "id": 2,
            "first_name": "test",
            "last_name": "test",
            "email": "testjbcx@gmail.com",
            "mobile_number": "+380938982443",
            "gender": "man",
            "birthday": "1989-01-07",
            "remember_token": null,
            "created_at": "2020-03-06 17:39:40",
            "updated_at": "2020-03-06 17:39:40"
        },
        "token": "Bearer ce6feb3a0a1ca7dc2533de6aabe8cf6d046b9a6863617f3faacf5c9c2475b9bc"
Logout
-------------

**GET api/logout**

Request:

.. code-block:: javascript

    {
        "email": "test@gmail.com",
    }

Response:

.. code-block:: javascript

   {
        "status": "success"
   }