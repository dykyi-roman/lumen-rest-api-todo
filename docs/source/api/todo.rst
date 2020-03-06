Todo
===================

All list
---------------------------------------

**GET api/todo/**

Request:

.. code-block:: javascript

    {
        "api_token": "8c153564c9bb199bff00646968674c0b64c0dae84c29035ce54c49f6c0c0ba53",
        "status": "new",
    }

Response unauthorized:

.. code-block:: javascript

    {
        "error": "Unauthorized"
    }

Response success:

.. code-block:: javascript

    {
    "status": "success",
    "data": [
        {
            "name": "test-note",
            "description": "test-description",
            "datetime": "2020-04-01 00:00:00",
            "status": "new",
            "category": "new"
        }
    }

Create
--------------------------

**POST api/todo/**

Request:

.. code-block:: javascript

    {
        "name": "test-note",
        "description": "test-description",
        "datetime": "2020-04-01 00:00:00",
        "status": "new",
        "category": "yesterday",
    }

Response:

.. code-block:: javascript

    {
        "status": "success"
    }

Update
-------------

**PUT api/todo/{id}**

Request:

.. code-block:: javascript

    {
        "name": "new-name",
        "status": "new-status",
    }

Response:

.. code-block:: javascript

   {
        "status": "success"
   }

Show
-------------

**GET api/todo/{id}**

Response:

.. code-block:: javascript

    {
        "status": "success",
        "data": {
            "name": "new-name",
            "description": "test-description",
            "datetime": "2020-04-01 00:00:00",
            "status": "new-status",
            "category": "new"
        }
    }

Delete
-------------

**DELETE api/todo/{id}**

Response:

.. code-block:: javascript

    {
        "status": "success"
    }