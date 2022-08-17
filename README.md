## Blog 📑

### Description 📚
- This package make easily blog management
- Right now we are working on [ v1 ] package

### TODO ✍️
1. Set category for blogs
2. Return count of blogs view
3. Return count of blogs like
4. Set filter for blogs

#### Routes 🚀
- Every route start with [ v1/blog ] 

##### Guest 🧑‍⚕️👨‍⚕️

| URL | METHOD | REQUEST | DESCRIPTION | RESPONSE                                                                                                                    |
| ----- | ----- | ----- | ----- |-----------------------------------------------------------------------------------------------------------------------------|
| / | GET | { ---- } | Collect latest confirmed blogs.<br>This route has paginate 9 | [ { title, slug, descriptoin, meta_title, meta_description, categories = [ { id, label } ], user = { name, ! is_admin } } ] |
| {slug} | GET | { ---- } | Get single view of blogs | { title, slug, description, body, meta_title, meta_description, categories = [ { id, label } ], ! user = { name, ! is_admin } } |

<br>

##### User 🧑‍💻

| URL                   | METHOD | REQUEST | DESCRIPTION                                                   | RESPONSE                                                                                         |
|-----------------------|--------| ----- |---------------------------------------------------------------|--------------------------------------------------------------------------------------------------|
| me/blog/create        | POST   | { title, description, body, meta_title, meta_description, ! categories } | create a blog for user                                        | { message, blog = { slug } }                                                                     |
| me/{slug}             | GET | { ---- } | Get single view of blogs if blog belong to authenitacted user | { title, slug, description, body, meta_title, meta_description, categories = [ { id, label } ] } |
| me/blog/{slug}/update | PUT    | { title, description, body, meta_title, meta_description, ! categories } | user update the his blog                                      | { message, blog = { slug } }                                                                     |
