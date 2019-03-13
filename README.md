#### Задача

_Для начала работы над проектом - сделайте Fork и работайте в своем репозитории._

1. Создайте скрипт `index.php`, в котором разместите форму для ввода длинного URL
2. После отправки формы генерируйте уникальный короткий адрес из 6 символов в диапазонах `A-Z`, `a-z`, например, `JhBFZp` и сохраняйте оригинальный длинный URL в файл `/urls/JhBFZp.url`
3. Создайте скрипт `go.php`, который будет принимать GET параметр `u=короткий_адрес`, например `go.php?u=JhBFZp` и перенаправлять браузер на оригинальный длинный URL
4. Сделайте перенаправление через `header()` и заголовок 302 Found; предусмотрите, что один и тот же URL может создаваться разными пользователями, а значит, каждый из них должен иметь уникальный короткий адрес
5. Предусмотрите, что если короткий адрес не существует, скрипт должен отдавать ответ 404 Not Found
6. Добавьте логотип на главную страницу, оформите страницу с bootstrap
7. Загрузите свой сервис на свой хостинг на st.php-academy.org

#### Дополнительное задание
1. Сделайте с помощью .htaccess перенаправление таким образом, чтобы запрос `http://localhost/go/JhBFZp` перенаправлялся на `http://localhost/go.php?u=JhBFZp`
2. Сделайте на главной странице счетчик созданных ссылок (сделайте это через подсчет кол-ва файлов в директории через функцию `glob()`)
3. Запоминайте пользователя с помощью Cookie; сделайте так, чтобы пользователь мог смотреть и удалять свои ссылки
