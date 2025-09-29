FROM mysql:8.0-debian

ENV MYSQL_DATABASE=db_food_store
ENV MYSQL_ROOT_PASSWORD=secret
#ENV MYSQL_ALLOW_EMPTY_PASSWORD=true

# Custom MySQL configuration if needed
COPY ./docker/mysql/my.cnf /etc/mysql/my.cnf

EXPOSE 3306

CMD ["mysqld"]
