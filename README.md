## Vehicle App

Features:

- Authentication.
  - Signup
    - Fill form with frontend validation
    - Send signup to backend(API)
    - Get the token
    - Set signed user
  -![signup](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/c4dc8443-b5f4-437b-93df-c7c36d29ee6a)

  - Signin
    - Fill form with frontend validation
    - Send signin request to backend(API)
    - Get the token or error if credentials not matched
    - Set signed user
  - ![signin](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/2894e651-8959-43a7-b841-746229877d3c)

  - Signout
    - Send signout to backend(API)
    - Set guest user
- Dashboard.
  -  Show total number of cars
  -  ![dashboard](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/864cf404-2025-49a3-82bc-01e3e930220e)
- Category.
  - Table of categories data
    - Show 2 category per page and can get any page data
    - Sorting options
      - ASC and DESC according to category name column
      - ASC and DESC according to created at column
  -![categories](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/cbfd05b2-53dc-454d-a8b9-28cb3faddc5a)

  - Add new
    - Fill form with frontend validation
    - Backend validation to check category not already added
    - Add new category
  -![category add](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/055e5c06-8910-41c1-89cd-1596c15390bb)

  - Update
    - Fill from with frontend and backend validation
    - Update category
  - ![category update](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/b16f1c3b-ace1-4ccc-abe5-7e7424e24cc4)

  - Delete
    - Delete category
- Car.
  - Table of cars data
    - Show 2 cars per page and can get any page data
    - Sorting options
      - ASC and DESC according to car category name column
      - ASC and DESC according to car make column
      - ASC and DESC according to created at column
  -![cars](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/30900bbe-c5a5-4736-9b9a-a74935665103)

  - Add new
    - Fill form with frontend validation
    - Backend validation to check car registration number not already used
    - Add new car
  -![car add](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/f13e8d05-b8a5-48aa-bda1-e2f76486b179)

  - Update
    - Fill from with frontend and backend validation
    - Update car
  -![update](https://github.com/UM4IR-AHMAD/Vehicles-App/assets/93633549/7245ceec-6ebe-43f6-a12c-59ec4e67826a)

  - Delete
    - Delete car
Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation and use

- Backend
  - Set your database in .env file
  - Just run commands
    - composer install
    - php artisan migrate
    - php artisan serve

- Frontend
  - npm install
  - npm run dev


