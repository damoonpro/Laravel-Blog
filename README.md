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
