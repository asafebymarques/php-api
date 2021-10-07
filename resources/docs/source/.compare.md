---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://10.0.108.137:8080/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_1a5481bdcdf0e47e46de2ae0152a770b -->
## docs/{page?}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/docs/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/docs/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET docs/{page?}`

`POST docs/{page?}`

`PUT docs/{page?}`

`PATCH docs/{page?}`

`DELETE docs/{page?}`

`OPTIONS docs/{page?}`


<!-- END_1a5481bdcdf0e47e46de2ae0152a770b -->

<!-- START_7e3072a9c6d43c05123a799823b02c6d -->
## api/docs
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/docs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/docs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/docs`


<!-- END_7e3072a9c6d43c05123a799823b02c6d -->

<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/oauth/token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/oauth/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/oauth/tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/oauth/token/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/oauth/scopes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/oauth/personal-access-tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_81cf26da8f10173400ef80bc62cd0abc -->
## Lista chamados

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/solicitation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/solicitation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/solicitation`


<!-- END_81cf26da8f10173400ef80bc62cd0abc -->

<!-- START_96520ad032808215159146644814776f -->
## api/v1/admin/cnpj/{cnpj}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/cnpj/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/cnpj/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/cnpj/{cnpj}`


<!-- END_96520ad032808215159146644814776f -->

<!-- START_e057a8d679e3009a1077307bcd272732 -->
## api/v1/admin/cep/{cep}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/cep/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/cep/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/cep/{cep}`


<!-- END_e057a8d679e3009a1077307bcd272732 -->

<!-- START_4b7fcaf95ed095bd77e11f5cf3e0ebac -->
## api/v1/admin/calls
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/calls" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/calls"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/calls`


<!-- END_4b7fcaf95ed095bd77e11f5cf3e0ebac -->

<!-- START_ba65bd6fb42d165308f08a43f946fde2 -->
## api/v1/admin/feriados
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/feriados" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/feriados"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/feriados`


<!-- END_ba65bd6fb42d165308f08a43f946fde2 -->

<!-- START_e081a2d0f6eeb8a38ae90373f2ef60ee -->
## api/v1/admin/file/delete/{image}/{folder}
> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/api/v1/admin/file/delete/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/file/delete/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/file/delete/{image}/{folder}`


<!-- END_e081a2d0f6eeb8a38ae90373f2ef60ee -->

<!-- START_ec7b507cc291dd8df22f455c7d1025b2 -->
## api/v1/admin/sms/send
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/sms/send" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/sms/send"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/sms/send`


<!-- END_ec7b507cc291dd8df22f455c7d1025b2 -->

<!-- START_a8f2cd73f7f241bac59f75ba0b3cb4bd -->
## api/v1/admin/user
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/user`


<!-- END_a8f2cd73f7f241bac59f75ba0b3cb4bd -->

<!-- START_78a0df324c538801e1d5afb35775e8a5 -->
## api/v1/admin/user/upload
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/user/upload" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/upload"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/user/upload`


<!-- END_78a0df324c538801e1d5afb35775e8a5 -->

<!-- START_63be53f13f96228da7366e65c664746a -->
## api/v1/admin/authenticated
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/authenticated" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/authenticated"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/authenticated`


<!-- END_63be53f13f96228da7366e65c664746a -->

<!-- START_9cafc90ccf899b3989f83a1a368ffcd5 -->
## api/v1/admin/user
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/user`


<!-- END_9cafc90ccf899b3989f83a1a368ffcd5 -->

<!-- START_c3b756f81b646873536cd1fb47fa50c4 -->
## api/v1/admin/user/attendant
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/user/attendant" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/attendant"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/user/attendant`


<!-- END_c3b756f81b646873536cd1fb47fa50c4 -->

<!-- START_dbaf473f0be6edf70b801a272ee9a893 -->
## api/v1/admin/user/{id}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/user/{id}`


<!-- END_dbaf473f0be6edf70b801a272ee9a893 -->

<!-- START_be6ee07596f951da0c8f5966f56e09b4 -->
## api/v1/admin/permissions
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/permissions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/permissions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/permissions`


<!-- END_be6ee07596f951da0c8f5966f56e09b4 -->

<!-- START_e36658e786064d7072730f9e42400161 -->
## api/v1/admin/user/permission
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/user/permission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/permission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/user/permission`


<!-- END_e36658e786064d7072730f9e42400161 -->

<!-- START_b84bc995ebaf16fcbb87cec8a93d6d99 -->
## api/v1/admin/user/{id}
> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/user/{id}`


<!-- END_b84bc995ebaf16fcbb87cec8a93d6d99 -->

<!-- START_7ab5b1a43e991ed34962f12a3834403d -->
## api/v1/admin/user/{id}
> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/user/{id}`


<!-- END_7ab5b1a43e991ed34962f12a3834403d -->

<!-- START_2657a63ef00b6e636a8530957bcd4bba -->
## api/v1/admin/user/{id}
> Example request:

```bash
curl -X PATCH \
    "http://10.0.108.137:8080/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/user/{id}`


<!-- END_2657a63ef00b6e636a8530957bcd4bba -->

<!-- START_98dffcb6fb022c728c360259ab30984a -->
## api/v1/admin/user/password/{id}
> Example request:

```bash
curl -X PATCH \
    "http://10.0.108.137:8080/api/v1/admin/user/password/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/user/password/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/user/password/{id}`


<!-- END_98dffcb6fb022c728c360259ab30984a -->

<!-- START_8524ac20b8071d8b70218f3e21977e68 -->
## api/v1/admin/company
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/company" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/company`


<!-- END_8524ac20b8071d8b70218f3e21977e68 -->

<!-- START_c5cbe87dd8dc874d65c2a4d182c36864 -->
## api/v1/admin/company/upload/{folder}
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/company/upload/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company/upload/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/company/upload/{folder}`


<!-- END_c5cbe87dd8dc874d65c2a4d182c36864 -->

<!-- START_76cef6721300ca11fcf9291c717f328e -->
## api/v1/admin/company
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/company" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/company`


<!-- END_76cef6721300ca11fcf9291c717f328e -->

<!-- START_61edec17eeff4692455908af23585273 -->
## api/v1/admin/company/{id}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/company/{id}`


<!-- END_61edec17eeff4692455908af23585273 -->

<!-- START_b49576b60c7d598e96f906b3cba2da7a -->
## api/v1/admin/company/{id}
> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/company/{id}`


<!-- END_b49576b60c7d598e96f906b3cba2da7a -->

<!-- START_d6da8055b917b12957e6d330d462ed8f -->
## api/v1/admin/company/{id}
> Example request:

```bash
curl -X PATCH \
    "http://10.0.108.137:8080/api/v1/admin/company/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/company/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/company/{id}`


<!-- END_d6da8055b917b12957e6d330d462ed8f -->

<!-- START_895f7ea6068465d25828d7380c97b995 -->
## api/v1/admin/receiver
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/receiver" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/receiver`


<!-- END_895f7ea6068465d25828d7380c97b995 -->

<!-- START_0dd9ed60a83ad77fdf2b30a89e853208 -->
## api/v1/admin/receiver/upload/{folder}
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/receiver/upload/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver/upload/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/receiver/upload/{folder}`


<!-- END_0dd9ed60a83ad77fdf2b30a89e853208 -->

<!-- START_ef6231af325d3b349aa17ca903cbdd14 -->
## api/v1/admin/receiver
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/receiver" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/receiver`


<!-- END_ef6231af325d3b349aa17ca903cbdd14 -->

<!-- START_e2fc888e5528d5fa112133bb8eb70ebb -->
## api/v1/admin/receiver/cpf/{cpf}
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/receiver/cpf/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver/cpf/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/receiver/cpf/{cpf}`


<!-- END_e2fc888e5528d5fa112133bb8eb70ebb -->

<!-- START_ac8e86c8ab38aa4717f6cbdaf039db9a -->
## api/v1/admin/receiver/{id}
> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/receiver/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/receiver/{id}`


<!-- END_ac8e86c8ab38aa4717f6cbdaf039db9a -->

<!-- START_5a9685ec7ed220fd2bcd1da310011a17 -->
## api/v1/admin/receiver/{id}
> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/api/v1/admin/receiver/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/receiver/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/receiver/{id}`


<!-- END_5a9685ec7ed220fd2bcd1da310011a17 -->

<!-- START_6e9f7ad936d831dcc4342feaedba5abf -->
## api/v1/admin/product
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/product`


<!-- END_6e9f7ad936d831dcc4342feaedba5abf -->

<!-- START_402061c2a9790d017696767d173f86cc -->
## api/v1/admin/product
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/product`


<!-- END_402061c2a9790d017696767d173f86cc -->

<!-- START_b168830b51dec3f2d3db7b73320fdfe2 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/product/filter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/product/filter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/product/filter`


<!-- END_b168830b51dec3f2d3db7b73320fdfe2 -->

<!-- START_4425fbdab2bab983cd96ca8a3b99f414 -->
## api/v1/admin/product/{id}
> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/product/{id}`


<!-- END_4425fbdab2bab983cd96ca8a3b99f414 -->

<!-- START_a24904635573b27b849a71af1fc4f85b -->
## api/v1/admin/product/{id}
> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/api/v1/admin/product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/product/{id}`


<!-- END_a24904635573b27b849a71af1fc4f85b -->

<!-- START_55a886563eca486b57ae08d02a3662b8 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/address/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/address/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/address/{id}`


<!-- END_55a886563eca486b57ae08d02a3662b8 -->

<!-- START_6fa7483df8025ae79fe6a4cf7260c97f -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/address/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/address/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/address/{id}`


<!-- END_6fa7483df8025ae79fe6a4cf7260c97f -->

<!-- START_8ca7261e4a3d9087bfaa052144086367 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/address`


<!-- END_8ca7261e4a3d9087bfaa052144086367 -->

<!-- START_5ed290eedf853ae2183df9b8a6c6b3f2 -->
## Criar solicitação e envia email para sac novonordisk

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/solicitation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/solicitation`


<!-- END_5ed290eedf853ae2183df9b8a6c6b3f2 -->

<!-- START_059fe2e5401f8b4feabdf1abe33f69d5 -->
## Criar agendamento caso nao tenha agendamento ativo

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/scheduling" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/scheduling"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/solicitation/scheduling`


<!-- END_059fe2e5401f8b4feabdf1abe33f69d5 -->

<!-- START_3fa7e9cd608ecb84fe8a70923c374266 -->
## Mudar endereço na solicitação

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/solicitation/{id}`


<!-- END_3fa7e9cd608ecb84fe8a70923c374266 -->

<!-- START_8ffa5bdd92b56b3a2ee851afd9461b66 -->
## api/v1/admin/solicitation/upload/{folder}
> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/upload/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/upload/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/solicitation/upload/{folder}`


<!-- END_8ffa5bdd92b56b3a2ee851afd9461b66 -->

<!-- START_4cb20e3d043df7088fe5407f4b9fca98 -->
## Lista chamados

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/solicitation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/solicitation`


<!-- END_4cb20e3d043df7088fe5407f4b9fca98 -->

<!-- START_21c8b599fe127d15ecdb5b28d2a048bf -->
## Get por id

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/solicitation/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/solicitation/{id}`


<!-- END_21c8b599fe127d15ecdb5b28d2a048bf -->

<!-- START_1583dc223daef03b5d2a61c66a047d34 -->
## api/v1/admin/solicitation/user
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/solicitation/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/solicitation/user`


<!-- END_1583dc223daef03b5d2a61c66a047d34 -->

<!-- START_74cbea504b33f599546908b30c21f99e -->
## update em construção

> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/solicitation/{id}`


<!-- END_74cbea504b33f599546908b30c21f99e -->

<!-- START_30f0ee4fefeba1c1f05f05f253ec4b05 -->
## Cancelar agendamento

> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/schedule/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/schedule/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/solicitation/schedule/{id}`


<!-- END_30f0ee4fefeba1c1f05f05f253ec4b05 -->

<!-- START_9bfaf29be5cdadab364fa0ebfdf022aa -->
## Criar agendamento caso nao tenha agendamento ativo

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/api/v1/admin/attempt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/attempt"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/attempt`


<!-- END_9bfaf29be5cdadab364fa0ebfdf022aa -->

<!-- START_2b229510e60ab38f4e064ec01e346448 -->
## Delte logico

> Example request:

```bash
curl -X DELETE \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/solicitation/{id}`


<!-- END_2b229510e60ab38f4e064ec01e346448 -->

<!-- START_a627edce6485ea5cf0e277399bdfbbad -->
## api/v1/admin/solicitation
> Example request:

```bash
curl -X PUT \
    "http://10.0.108.137:8080/api/v1/admin/solicitation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/solicitation`


<!-- END_a627edce6485ea5cf0e277399bdfbbad -->

<!-- START_da22824176f88ee1e615cdf3c8d4539b -->
## Iniciar atendimento

> Example request:

```bash
curl -X PATCH \
    "http://10.0.108.137:8080/api/v1/admin/solicitation/init/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/solicitation/init/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/solicitation/init/{id}`


<!-- END_da22824176f88ee1e615cdf3c8d4539b -->

<!-- START_052aa3066686d0438305d176a3f128d6 -->
## retorna os contadores do dash

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/count`


<!-- END_052aa3066686d0438305d176a3f128d6 -->

<!-- START_a6c438fab052938c634dee2db308dcc4 -->
## api/v1/admin/mounth
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/mounth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/mounth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/admin/mounth`


<!-- END_a6c438fab052938c634dee2db308dcc4 -->

<!-- START_691c6c0341bd4e2efc3b350c9d049112 -->
## api/v1/admin/audit
> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/api/v1/admin/audit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/api/v1/admin/audit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/v1/admin/audit`


<!-- END_691c6c0341bd4e2efc3b350c9d049112 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://10.0.108.137:8080/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_c88fc6aa6eb1bee7a494d3c0a02038b1 -->
## Show the email verification notice.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/email/verify" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/email/verify"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET email/verify`


<!-- END_c88fc6aa6eb1bee7a494d3c0a02038b1 -->

<!-- START_af069c1c23cec25f2be1688621969179 -->
## Mark the authenticated user&#039;s email address as verified.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/email/verify/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/email/verify/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET email/verify/{id}`


<!-- END_af069c1c23cec25f2be1688621969179 -->

<!-- START_b44c38c624a55f23870089f09fba5cef -->
## Resend the email verification notification.

> Example request:

```bash
curl -X GET \
    -G "http://10.0.108.137:8080/email/resend" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://10.0.108.137:8080/email/resend"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET email/resend`


<!-- END_b44c38c624a55f23870089f09fba5cef -->


