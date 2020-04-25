LOGIN:

```
curl --request GET 'http://127.0.0.1:8000/api/login' --header 'Content-Type: application/json' --data-raw '{"email": "ollie.berge@gmail.com","password": "password"}'
```
 
ACCESS RESOURCE:
 
 ``` 
curl --request GET 'http://127.0.0.1:8000/api/users' --header 'Authorization: Bearer YOUR_JWT_TOKEN_HERE' 
```