# Nick Klein's Portfolio
This is the source code for my portfolio website, which includes all the front-end and the back-end developement files.
nickklein.ca

## Gulp
### Requirements
1. Node
2. NPM
3. Advanced Custom Fields Pro
4. Composer (Optional. Can be used to quickly download plugins and the WP core files)

### Static
Compiles inside /src/ folder

```gulp watch```

### Build
Compiles inside /wp-content/themes/[NAME]/

```gulp watch --build```

### Production
Minifies and compiles inside /wp-content/themes/[NAME]

```gulp minify --build```


## Docker (Optional)
1. Make any edits that you will need inside the vhost.conf file inside .docker folder
2. Make changes to your wp-config file
```
DB_NAME: db
DB_USER: root
DB_PASSWORD: root
DB_HOST: mysql
```
3. Might need to chown /var/www/html again && and create .htaccess to remote server
4. Add virtual host to local computer
