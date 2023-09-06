# KnotAPI Secured Dockerized Laravel RESTful APIs implemented by Daniel Kimani M (DevOps Engineer)
Greetings Isaac.

I have effectively finished the technical assessment. Within the documentation, I've detailed all the technologies I've utilized to ensure that the RESTful APIs are secure, accessible, dependable, and efficient, especially for front-end developers.

# Laravel version

For the technical evaluation, I employed Laravel version 9.52.15.

# Docker and Docker-compose

I have employed Docker to containerize these RESTful APIs, and this decision offers numerous benefits and advantages, aligning with common practices in modern web development.

# Passport
To bolster the security of these RESTful APIs, I've integrated Passport for user authentication. Upon successful registration or login, a token is generated. This token must then be utilized in subsequent API requests to ensure secure access to protected resources.

# Swagger

To ensure well-documented RESTful APIs, I've employed Swagger, a modern technology designed for creating comprehensive API documentation.

# Postman 

I've utilized Postman for testing the RESTful APIs. Postman is a valuable tool for efficiently testing and validating API endpoints, ensuring their functionality and correctness.

# Version Control

I've utilized GitHub as the version control system for this project. This choice enables efficient code management, collaboration, and version tracking throughout the development process. 

# Jenkins

I've incorporated Jenkins into the workflow to automate Continuous Integration (CI), Continuous Development (CD), and Continuous Deployment (CD). Jenkins plays a crucial role in streamlining and automating various aspects of the development and deployment pipeline, enhancing efficiency and reliability in the software development process.
# AWS EC2

I've deployed this project on AWS EC2, leveraging its capabilities to provide a reliable, efficient, and scalable environment for web-based applications. AWS EC2's infrastructure offers the flexibility and resources necessary to ensure the application's performance and availability.

# Instructions on how to run your API

Here is the link to the Swagger documentation for the RESTful APIs:

http://3.94.140.108:9020/api/documentation

This link contains all the APIs that were requested in the technical test.


The Registration and Login Endpoints do not initially use Passport tokens. To obtain a token, you need to complete the registration or login process successfully. Once you've registered or logged in and received the token, you can then proceed by clicking on the lock icon and placing the token as follows.
Bearer <TOKEN>

After successfully setting the token, you will have the capability to access and utilize the other available endpoints. 

To access the database for this project, please use the provided database connection information and credentials
Link: http://3.94.140.108:9025/
Server: mysqldbknotapi
Username: root
Password: knotapi@2023@
Database: mysqldbknotapi

# Instructions on how to set up

To ensure you have Docker and Docker Compose on your machine and to clone a project from a repository.

Navigate to cloned project and execute the following commands:

docker-compose build

docker-compose up -d

docker exec knotapi bash -c "php artisan migrate"

docker exec knotapi bash -c "php artisan passport:client --personal"

docker exec knotapi bash -c "php artisan l5-swagger:generate"

docker exec cemesltdmonitor bash -c "php artisan optimize:clear"

docker exec knotapi bash -c "php artisan optimize:clear"

After successfully completing the setup and ensuring Docker and Docker Compose are installed, you can typically access a project via a web browser.

http://YOUR_IP:9020/api/documentation

The technical test was a positive experience, and I had a pleasant journey throughout the entire implementation process. I eagerly anticipate your response and the chance to collaborate together.





