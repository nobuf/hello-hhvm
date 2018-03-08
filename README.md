This is going to be a project for learning HHVM/Hack.

```shell
mkdir hello-hhvm
cd hello-hhvm
# docker swarm init

docker run --name=hello-hhvm \
	-v $(pwd):/var/www \
	-p 12345:80 \
	hhvm/hhvm-proxygen:latest

mkdir public
touch public/index.php
atom .
open http://localhost:12345/
```

Apparently there's no update since "[Hack Language Support in PhpStorm Postponed](https://blog.jetbrains.com/phpstorm/2015/06/hack-language-support-in-phpstorm-postponed/)" was announced on June, 2015. [Nuclide](https://nuclide.io/docs/quick-start/getting-started/) looks like a natural choice of editor.