This is going to be a project for learning HHVM/Hack.

```shell
mkdir hello-hhvm
cd hello-hhvm

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

Edit `index.php` and it seems Slim's Hello World is working well. Note that `composer` was installed separately to the host environment, macOS, in my case.



Nuclide's "Go to Declaration" does nothing out of the box.

```shell
brew tap hhvm/hhvm
brew install hhvm
hh_client
```

> For example, if you want to go to the definition of `getPages()`, hover over `getPages()` and either press `Cmd-<mouse click>` or `Cmd-Option-Enter` (`Ctrl-Alt-Enter` on Linux).
>
> https://nuclide.io/docs/languages/hack/#jump-to-definition

OK, for some reason it's not `Option-Command-↓`. Plus, you probably need to restart Atom/Nuclide.



I just realized that maybe I should have used the below command from the beginning:

```shell
composer create-project slim/slim-skeleton hello-hhvm
```

```shell
composer test
```

All green. Well, this is using php7 on macOS though.

```shell
docker-compose up
curl -v http://localhost:8080/
curl -v http://localhost:8080/nobuf
```

Alright, it's working!

```shell
hhvm -v Eval.Jit=false vendor/bin/phpunit
```

Without option, phpunit runs painfully slow.

[Documentation has a section](https://docs.hhvm.com/hack/tools/hackificator) for `hackificator`, but apparently `brew` [doesn't include this tool](https://github.com/hhvm/homebrew-hhvm/issues/19).



```shell
composer require tuupola/slim-jwt-auth "^2.0"
```

The latest version of this library requires php7.1. And, HHVM would get an error at:

```
Fatal error: syntax error, unexpected '|', expecting T_VARIABLE
```

> In PHP 7.1 and later, a [*catch*](http://php.net/manual/en/language.exceptions.php#language.exceptions.catch) block may specify multiple exceptions using the pipe (*|*) character.

So, there are compatibility issues.



Vanilla php7 doesn't provide `async/await` yet. One endpoint might require communicating with multiple databases and http APIs, if that's the case, Hack has an advantage.

[Null Safe](https://docs.hhvm.com/hack/operators/null-safe) and [Placeholder Variable](https://docs.hhvm.com/hack/other-features/placeholder-variable) caught my eyes, and they look like welcomed features.

For 99% of php5 users, it'd be better to switch to php7 because of its larger community size, though 1% might want to think twice. If their stack is similar to Facebook or Slack (no framework, MySQL), running benchmark on their code base might be worth it.

No PhpStorm support could be a deal breaker while it is a great IDE out of the box, and code search/refactoring work well on large code repository.