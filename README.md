### **Service that counts users which opened current page of website**

INSTALLATION - 
1) To test this task you have to be installed only php-cli.(I didn`t create development with web-server(nginx or apache) because it is unnecessary for this task). I can do this. If you want to watch my experience with docker, you can look my another public repositories.
2) You have to run several scripts - 
 - ```git clone https://github.com/LuborRod/service_counter.git```
 
And then from dir {service_counter} you have to enable built-in web server in php-cli.
- ```php -S localhost:8888``` . You can change number of port, if you want.

USING - 
1) Go to ```localhost:8888``` in your browser. You can refresh the page as long as you want. Everytime you will see 1 count, 
because my script counts only users ip. Two files will be created after your first request. The first file will show you 
all unique ip of users. The second file will show you log data. To check the correct work in local development, you have to open
manually totalIps.json and change ip, or add new. Then you can refresh page and see another count. If you want to 
see the log data, you can go to index.php and uncomment 1 row.)

P.S I am not frontender, my data is not very good for reading). I did this task for several hours, that`s why I use files 
instead DB. You can believe me, I can work with DB connections). I am very interested in learning the second language - GoLang.
I don`t like to work with JS/HTML/CSS. But I will be very excited to work with threads and processes. Learn a lower-level language.)
See you.
