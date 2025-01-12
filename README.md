# LitePress

This is a personal project which will setup WordPress using composer and will install sqlite integration plugin automatically.

The `mu-plugins` folder, contains some plugins I copied from a WordPress project created by **Wordpress Studio**.

## Create project:

Run the command

```bash
composer create-project zaherg/litepress litepress
```

### Login information:

- **Username**: admin
- **Password**: password

### Reinstall

If you decided that you want to reset your project and start with a fresh WordPress installation, you can run

```bash
./install.sh
```

check the code to know what the command do.

### Docker

Replace YOUR_PORT with the port you choose to run on.

```bash
docker build -t litepress-test .
docker run -it -p YOUR_PORT:80 -v $(pwd):/var/www litepress-test
```

### Notes:

Please note that not all WordPress plugins support sqlite, some uses specific syntax that is supported by mysql only, when creating extra tables.