# Transaction API Documentation

Response Schema:
JSON OBJECT {"success": Boolean, "message_code": String, "body": Array}

GET /transactions

- Fetches all transactions from the DB for current login user in current day.
- Request arguments: none
- 404 - No transaction was found

POST /transactions/create

- Create new transaction
- Request arguments: {"item_id": Integer, "quantity":Integer}
- 422 - if item_id param was not provided

PUT /transaction/update

- change the quantity of transaction.
- Request arguments: {"id": Integer}
- 422 - if id param was not provided
- 404 - if trnsaction was not found

DELETE /transaction/delete

- delete a transaction
- Request arguments: {"id": Integer}
- 422 - if id param was not provided
- 404 - if transaction was not found