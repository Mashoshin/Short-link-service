# HTTP service for URL shortening
___
## Развертывание локально
1. Клонировать репозиторий на локальный компьютер
2. Добавить в etc/hosts строку "127.0.0.1 shrturl"
3. В корне репозитория выполнить команду "docker-compose up -d --build"
___
## Использование

Получить короткое предстваление
POST http://shrturl:8088
{
    "url": <your_url>
}

Пример ответа:
>{
>"status": "OK",
>"data": {
>"short_url": "http://shrturl:8088/d1e7b91ce39097990dc8e2d89edf1956"
>}
>}

