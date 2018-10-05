# Reverse Proxy 

Add the domain to the hosts file (linux style)
```bash
echo '127.0.0.1         symfony_project.develop' >> /etc/hosts
```


### Start the Reverse-Proxy
```bash
docker-compose up -d
```



### Generate ssl certificate : 

```bash
cd ssl/symfony_cours/
sudo openssl req -x509 -sha256 -newkey rsa:2048 -keyout cert.key -out cert.pem -days 1024 -nodes -subj '/CN=symfony_project.develop'
```
