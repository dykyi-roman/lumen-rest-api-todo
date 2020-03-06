# Docker + Lumen with Nginx and MySQL

![image](Lumen_splash.png)

This setup is great for writing quick apps in PHP using Lumen from an any Docker client. It uses docker-compose to setup the application services.

### Build & Run

```bash
1) docker-compose up --build -d
2) docker-compose exec -ti todo_php_1 bash
3) cd ../ && php artisan migrate
```

Navigate to [http://localhost:80](http://localhost:80) 

Success! You can now start developing your Lumen app on your host machine and you should see your changes on refresh! Classic PHP development cycle. A good place to start is `images/php/app/routes/web.php`.

Feel free to configure the default port 80 in `docker-compose.yml` to whatever you like.


## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)

