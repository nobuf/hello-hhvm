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



> PHP7 is charting a new course away from PHP5, and we want to do the same, via a renewed focus on Hack. Consequently, **HHVM will not aim to target PHP7**.
>
> https://hhvm.com/blog/2017/09/18/the-future-of-hhvm.html

This move sounds a bit tricky for a small organization.

Let's see if I'd face any compatibility issue.

```shell
composer require slim/slim "^3.0"
```

Edit `index.php` and it seems Slim's Hello World is working well.