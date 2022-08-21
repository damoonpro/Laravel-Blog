## Blog 📑

### Description 📚
- This package make easily blog management
- Right now we are working on [ v1 ] package

### TODO ✍️
1. Set filter for blogs

#### Routes 🚀
- Every route start with [ v1/blog ] 

##### Guest 🧑‍⚕️👨‍⚕️

| URL | METHOD | REQUEST | DESCRIPTION | RESPONSE                                                                                                                                  |
| ----- | ----- | ----- | ----- |-------------------------------------------------------------------------------------------------------------------------------------------|
| / | GET | { ---- } | Collect latest confirmed blogs.<br>This route has paginate 9 | [ { title, slug, description, meta_title, meta_description, categories = [ { id, label } ], user = { name, ! is_admin } }, views, likes, files = [ { id, url } ]  }  ] |
| {slug} | GET | { ---- } | Get single view of blogs | { title, slug, description, body, meta_title, meta_description, categories = [ { id, label } ], ! user = { name, ! is_admin }, views, likes, files = [ { id, url } ] }           |


<br>

##### User 🧑‍💻


| URL                             | METHOD | REQUEST                                                                  | DESCRIPTION                                                   | RESPONSE                                                                                                                  |
|---------------------------------|--------|--------------------------------------------------------------------------|---------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------|
| me/blog/create                  | POST   | { title, description, body, meta_title, meta_description, ! categories } | create a blog for user                                        | { message, blog = { slug } }                                                                                              |
| me/blog | GET | { ---- } | Collect latest user blog.<br>This route has paginate 9 | [ { title, slug, description, meta_title, meta_description, categories = [ { id, label } ], views, likes, files = [ { id, url } ]  }  ] |
| me/{slug}                       | GET    | { ---- }                                                                 | Get single view of blogs if blog belong to authenticated user | { title, slug, description, body, meta_title, meta_description, categories = [ { id, label } ], views, likes, files = [ { id, url } ] } |
| me/blog/{slug}/update           | PUT    | { title, description, body, meta_title, meta_description, ! categories } | user update the his blog                                      | { message, blog = { slug } }                                                                                              |
| me/blog/{slug}/file/upload      | POST   | { file }  | upload file for blog if blog belong to user                   | { message, file = { url } }                                                                                               |
| me/blog/{slug}/file/{id}/delete | DELETE | { file }  | delete file of blog if blog belong to user                    | { message, file = { id } }      or { message, blog = { slug } }                                                           |
| {slug}/like                     | POST   | { ---- }                                                                 | like and unlike blog by authenticated user                    | { message, blog = { slug } }                                                                                              |


<br>

##### Admin 😎

| URL                                | METHOD | REQUEST                | DESCRIPTION                                                                     | RESPONSE                                                                                                                    |
|------------------------------------|--------|------------------------|---------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------|
| admin/blog                         | GET    | { ---- }               | Collect latest blogs for admin<br>This route has paginate 9                     | [ { title, slug, description, meta_title, meta_description, categories = [ { id, label } ], user = { name, ! is_admin }, views, likes, files = [ { id, url } ] } ] |
| admin/blog/category                | GET    | { ---- }               | Collect categories for admin<br>This route has <b>paginate 9</b>                | [ { id, label, user = { name, is_admin }, confirmed } ]                                                                     | 
| admin/blog/category/{id}/update    | PUT    | { label, ! confirmed } | Update category setting<br>If the category created by admin label can change to | { message, category = { id } }                                                                                              | 
| admin/blog/category/{id}/delete    | DELETE | { ---- }               | Delete category<br>If the category created by other admin you can't deleted     | { message, category = { id } }                                                                                              | 
| admin/blog/category/{id}/confirmed | POST     | { ---- }               | Change category state to enable or disable                                      | { message, category = { id } }                                                                                              | 
