mediatheque_paris_grp1/
│
├── config/
│   ├── database.php
│
├── controllers/
│   ├──admin_controller.php
│   ├──auth_controller.php
│   ├──catalog_controller.php
│   ├──borrow_controller.php
|   └──home_controller.php
├── core/
│   ├──database.php
|   ├──router.php
|   └──view.php
├── database/
|   └──schema.sql
├── includes/
│   └──helpers.php
├── models/
|    ├──catalogue_model.php
|    ├──media_model.php
|    ├──item_model.php
|    ├──borrow_model.php
|    └──user_model.php
├── public/
|    ├──assets/
|    |   ├──css/
|    |   |  ├──admin.css    
|    |   |  ├──auth.css   
|    |   |  ├──banner.css   
|    |   |  ├──borrow.css    
|    |   |  ├──catalog.css   
|    |   |  ├──header.css
|    |   |  ├──home.css  
|    |   |  ├──layout.css  
|    |   |  ├──style(@media).css  
|    |   |  └──style.css
|    |   ├──images/    
|    |   └──js/
|    |     ├──borrow.js
|    |     └──app.js                                                           
|    ├──.htaccess
|    └──index.php
├── views/
│   ├── admin/
|   |   ├──dashboard.php    
|   |   ├──sidebar.php    
|   |   ├──loans_edit.php    
|   |   ├──loans_list.php    
|   |   ├──media_edit.php    
|   |   ├──media_list.php    
|   |   ├──user_detail.php    
|   |   └──users_list.php
│   ├── auth/
|   |   ├──login.php    
|   |   └──register.php
│   ├── borrow/
|   |   └──my_borrow.php
|   |   
│   ├── catalog/
|   |   ├──details.php   
|   |   └──index.php   
|   |  
|   ├──errors/
|   |   └──404.php
|   ├──home/  
|   |   ├──about.php
|   |   ├──upload.php
|   |   ├──contact.php
|   |   ├──index.php
|   |   ├──profile.php
|   |   └──test.php
|   └──layouts/ 
|      ├──banner.php
|      ├──search.php
|      ├──header.php
|      ├──admin_layout.php
|      └──layouts.php
|  
├── .gitignore
├──bootstrap.php
├──CHANGELOG.md
├──CODING_STANDARDS.md
├──CODING_STANDARDS.pdf
├──map.php
├──README.md
└── README.pdf